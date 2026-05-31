<?php
/**
 * HR Manager dashboard - query, filter, update and delete EOI records.
 */

session_start();

// If manager_logged_in is not set or not true, redirect to login page
if (!isset($_SESSION['manager_logged_in']) || $_SESSION['manager_logged_in'] !== true) {
    header('Location: login.php');
    exit(); 
}

// require_once loads HUPD settings exactly once
require_once 'settings.php';

// @ suppresses system error, die() stops script with clean message if it fails
$conn = @mysqli_connect($host, $username, $password, $database);
if (!$conn) {
    die("Unable to connect to database. Please check settings.php.");
}

function clean($conn, $val) {
    return mysqli_real_escape_string($conn, trim(strip_tags(stripslashes($val))));
}

$action_message = '';

// checks if logout was requested via URL parameter
if (isset($_GET['logout'])) {
    session_unset();
    session_destroy();
    header('Location: login.php');
    exit();
}


$real_columns = [];
$pk_column = '';

$col_check = mysqli_query($conn, "SHOW COLUMNS FROM eoi");
if ($col_check) {
    while ($col_row = mysqli_fetch_assoc($col_check)) {
        $real_columns[] = $col_row['Field'];
        if ($col_row['Key'] === 'PRI') {
            $pk_column = $col_row['Field'];
        }
    }
}

// fallback safety settings if the database structural query fails
if (empty($pk_column)) {
    $pk_column = !empty($real_columns) ? $real_columns[0] : 'eoi_number';
}

$status_column = in_array('status', $real_columns) ? 'status' : '';
$time_column = in_array('submitted_at', $real_columns) ? 'submitted_at' : '';


// delete all EOIs for a job reference
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['action']) && $_POST['action'] === 'delete_by_ref') {
    $del_ref = clean($conn, $_POST['delete_ref'] ?? '');

    if (empty($del_ref)) {
        $action_message = "Please enter a job reference to delete.";
    } else {
        $stmt = mysqli_prepare($conn, "DELETE FROM eoi WHERE reference = ?");
        mysqli_stmt_bind_param($stmt, 's', $del_ref);
        mysqli_stmt_execute($stmt);
        $rows_deleted = mysqli_stmt_affected_rows($stmt);
        mysqli_stmt_close($stmt);
        $action_message = "Deleted " . $rows_deleted . " EOI(s) for job reference: " . htmlspecialchars($del_ref);
    }
}


// change status of a single EOI
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['action']) && $_POST['action'] === 'change_status') {
    $eoi_num    = intval($_POST['eoi_number'] ?? 0);
    $new_status = clean($conn, $_POST['new_status'] ?? '');
    $allowed_statuses = ['New', 'Current', 'Final']; 

    if (empty($status_column)) {
        $action_message = "Error: A 'status' column does not exist in your database table schema layout.";
    } elseif ($eoi_num <= 0 || !in_array($new_status, $allowed_statuses)) {
        $action_message = "Please enter a valid EOI number and select a status.";
    } else {
        $stmt = mysqli_prepare($conn, "UPDATE eoi SET `$status_column` = ? WHERE `$pk_column` = ?");
        mysqli_stmt_bind_param($stmt, 'si', $new_status, $eoi_num);
        mysqli_stmt_execute($stmt);
        mysqli_stmt_close($stmt);
        $action_message = "EOI #" . $eoi_num . " status updated to: " . htmlspecialchars($new_status);
    }
}


// dynamic sorting whitelist verification
$allowed_sorts = ['eoi_number', 'first_name', 'last_name', 'reference', 'status', 'submitted_at'];
$sort = $_GET['sort'] ?? 'eoi_number';
if (!in_array($sort, $allowed_sorts)) { $sort = 'eoi_number'; }

// map the UI choice cleanly to whatever column name actually exists in the database
$db_sort = $sort;
if ($sort === 'eoi_number') { $db_sort = $pk_column; }
if ($sort === 'status' && empty($status_column)) { $db_sort = $pk_column; }
if ($sort === 'submitted_at' && empty($time_column)) { $db_sort = $pk_column; }


// build resilient safe search query using columns known to exist
$query = "SELECT * FROM eoi WHERE 1=1";

$filter_ref = clean($conn, $_GET['filter_ref'] ?? '');
if (!empty($filter_ref)) {
    $query .= " AND reference = '$filter_ref'";
}

$filter_first = clean($conn, $_GET['filter_first'] ?? '');
if (!empty($filter_first)) {
    $query .= " AND first_name LIKE '%$filter_first%'";
}

$filter_last = clean($conn, $_GET['filter_last'] ?? '');
if (!empty($filter_last)) {
    $query .= " AND last_name LIKE '%$filter_last%'";
}

$query .= " ORDER BY `$db_sort` ASC";

$result = mysqli_query($conn, $query);

// detailed debugging fallback in case the database table itself is missing
if (!$result) {
    die("<h3>Database Query Failed</h3><p>Error details: " . mysqli_error($conn) . "</p><p>Sorted using column field identity: <code>$db_sort</code></p>");
}

$eois = mysqli_fetch_all($result, MYSQLI_ASSOC);
mysqli_free_result($result);
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>InfraWatch – Manage EOIs</title>
    <link rel="stylesheet" href="styles/styles.css">
    <style>
        /* commented by ashley */
        .manager-bar { 
            display: flex; 
            justify-content: space-between; 
            align-items: center; 
            margin-bottom: 1.5rem;
        }
        .table-scroll { overflow-x: auto; }
    </style>
</head>
<body>

<?php include 'header.inc'; ?>

<main>
<div class="manage-container">

    <div class="manager-bar">
        <h2>HR Manager Dashboard</h2>
        <span>Logged in as: <strong><?php echo htmlspecialchars($_SESSION['manager_username'] ?? 'Admin'); ?></strong></span>
        <a href="manage.php?logout=1" class="logout-link">Log Out</a>
    </div>

    <?php if (!empty($action_message)): ?>
        <div class="success-msg" role="status"><?php echo htmlspecialchars($action_message); ?></div>
    <?php endif; ?>

    <div class="panel">
        <h3>Filter and Sort EOIs</h3>
        <form method="GET" action="manage.php" class="inline-form">
            <div>
                <label for="filter_ref">Job Reference</label>
                <input type="text" id="filter_ref" name="filter_ref" placeholder="e.g. 10000"
                    value="<?php echo htmlspecialchars($_GET['filter_ref'] ?? ''); ?>">
            </div>

            <div>
                <label for="filter_first">First Name</label>
                <input type="text" id="filter_first" name="filter_first" placeholder="e.g. Ashley"
                    value="<?php echo htmlspecialchars($_GET['filter_first'] ?? ''); ?>">
            </div>

            <div>
                <label for="filter_last">Last Name</label>
                <input type="text" id="filter_last" name="filter_last" placeholder="e.g. Butler"
                    value="<?php echo htmlspecialchars($_GET['filter_last'] ?? ''); ?>">
            </div>

            <div>
                <label for="sort">Sort By</label>
                <select id="sort" name="sort">
                    <?php foreach ($allowed_sorts as $sort_option): ?>
                        <option value="<?php echo $sort_option; ?>"
                            <?php echo ($sort === $sort_option) ? 'selected' : ''; ?>>
                            <?php echo ucwords(str_replace('_', ' ', $sort_option)); ?>
                        </option>
                    <?php endforeach; ?>
                </select>
            </div>

            <button type="submit">Apply Filters</button>
            <a href="manage.php" style="color:#567890; font-size:0.85rem; align-self:center; margin-left:10px;">Clear All</a>
        </form>
    </div>

    <div class="panel">
        <h3>EOI Results (<?php echo count($eois); ?> found)</h3>
        <p style="font-size: 0.85rem; color: #7f8c8d; margin-bottom: 10px;">
            Note: Primary ID system column detected as: <strong><?php echo htmlspecialchars($pk_column); ?></strong>
        </p>
        <div class="table-scroll">

        <?php if (empty($eois)): ?>
            <p>No EOIs found matching your filters.</p>
        <?php else: ?>
            <table class="eoi-table">
                <tr>
                    <th>ID Key (<?php echo htmlspecialchars($pk_column); ?>)</th>
                    <th>Job Ref</th>
                    <th>First Name</th>
                    <th>Last Name</th>
                    <th>Email</th>
                    <th>Phone</th>
                    <th>Status</th>
                    <th>Submitted</th>
                </tr>

                <?php foreach ($eois as $row): ?>
                <tr>
                    <td><strong><?php echo htmlspecialchars($row[$pk_column] ?? 'N/A'); ?></strong></td>
                    <td><?php echo htmlspecialchars($row['reference'] ?? 'N/A'); ?></td>
                    <td><?php echo htmlspecialchars($row['first_name'] ?? 'N/A'); ?></td>
                    <td><?php echo htmlspecialchars($row['last_name'] ?? 'N/A'); ?></td>
                    <td><?php echo htmlspecialchars($row['email_address'] ?? 'N/A'); ?></td>
                    <td><?php echo htmlspecialchars($row['phone_number'] ?? 'N/A'); ?></td>
                    <td>
                        <?php
                        $display_status = !empty($status_column) ? ($row[$status_column] ?? 'New') : 'New';
                        switch ($display_status) {
                            case 'New': $badge = 'badge-new'; break;
                            case 'Current': $badge = 'badge-current'; break;
                            case 'Final': $badge = 'badge-final'; break;
                            default: $badge = '';
                        }
                        ?>
                        <span class="badge <?php echo $badge; ?>">
                            <?php echo htmlspecialchars($display_status); ?>
                        </span>
                    </td>
                    <td>
                        <?php 
                        echo htmlspecialchars(!empty($time_column) ? ($row[$time_column] ?? 'N/A') : 'N/A'); 
                        ?>
                    </td>
                </tr>
                <?php endforeach; ?>

            </table>
        <?php endif; ?>
        </div>
    </div>

    <div class="panel">
        <h3>Change EOI Status</h3>
        <form method="POST" action="manage.php" class="inline-form">
            <input type="hidden" name="action" value="change_status">
            <div>
                <label for="eoi_number">EOI ID Number</label>
                <input type="text" id="eoi_number" name="eoi_number" placeholder="e.g. 1">
            </div>
            <div>
                <label for="new_status">New Status</label>
                <select id="new_status" name="new_status">
                    <option value="New">New</option>
                    <option value="Current">Current</option>
                    <option value="Final">Final</option>
                </select>
            </div>
            <button type="submit">Update Status</button>
        </form>
    </div>

    <div class="panel">
        <h3>Delete EOIs by Job Reference</h3>
        <p style="color:#c0392b; font-size:0.9rem;">Warning: This permanently deletes ALL applications for that job reference.</p>
        <form method="POST" action="manage.php" class="inline-form"
            onsubmit="return confirm('Are you sure? This cannot be undone.');">
            <input type="hidden" name="action" value="delete_by_ref">
            <div>
                <label for="delete_ref">Job Reference</label>
                <input type="text" id="delete_ref" name="delete_ref" placeholder="e.g. 10000">
            </div>
            <button type="submit" class="btn-danger">Delete All EOIs</button>
        </form>
    </div>

</div>
</main>

<?php include 'footer.inc'; ?>

</body>
</html>
<?php
mysqli_close($conn); 
?>