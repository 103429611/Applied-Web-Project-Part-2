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
    // stripslashes() removes backslashes added by some PHP configurations
    // strip_tags() removes any HTML/PHP tags from input (prevents XSS)
    // trim() removes leading and trailing whitespace
    // mysqli_real_escape_string() escapes special characters for safe SQL use
    return mysqli_real_escape_string($conn, trim(strip_tags(stripslashes($val))));
}

// $action_message is a local variable - stores feedback to display after an action
$action_message = '';

// checks if logout was requested via URL parameter
if (isset($_GET['logout'])) {
    // remove all session variables from server memory
    session_unset();
    // destroy the session completely (user is now logged out)
    session_destroy();
    header('Location: login.php');
    exit();
}

// $_POST: receives data sent via POST (invisible in URL)
// checks if this specific action was submitted
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['action']) && $_POST['action'] === 'delete_by_ref') {

    // sanitise input using our clean() function
    $del_ref = clean($conn, $_POST['delete_ref'] ?? '');

    // empty() checks if the field was left blank
    if (empty($del_ref)) {
        $action_message = "Please enter a job reference to delete.";
    } else {
        // ? placeholder prevents SQL injection
        $stmt = mysqli_prepare($conn, "DELETE FROM eoi WHERE reference = ?");
        // 's' = string data type
        mysqli_stmt_bind_param($stmt, 's', $del_ref);
        // send query to the database
        mysqli_stmt_execute($stmt);
        // mysqli_stmt_affected_rows() tells us how many rows were deleted
        $rows_deleted = mysqli_stmt_affected_rows($stmt);
        mysqli_stmt_close($stmt);
        // htmlspecialchars() converts special characters to safe HTML entities
        $action_message = "Deleted " . $rows_deleted . " EOI(s) for job reference: " . htmlspecialchars($del_ref);
    }
}

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['action']) && $_POST['action'] === 'change_status') {

    // intval() converts input to an integer - safe for numeric ID fields
    $eoi_num    = intval($_POST['eoi_number'] ?? 0);
    $new_status = clean($conn, $_POST['new_status'] ?? '');

    $allowed_statuses = ['New', 'Current', 'Final']; //prevents someone injecting unexpected values into the status field

    // validates both the EOI number and status before touching database
    if ($eoi_num <= 0 || !in_array($new_status, $allowed_statuses)) {
        $action_message = "Please enter a valid EOI number and select a status.";
    } else {
        // two ? placeholders for status (string) and EOInumber (integer)
        $stmt = mysqli_prepare($conn, "UPDATE eoi SET status = ? WHERE eoi_number = ?");
        // 'si' = string then integer (data types for each parameter)
        mysqli_stmt_bind_param($stmt, 'si', $new_status, $eoi_num);
        mysqli_stmt_execute($stmt);
        mysqli_stmt_close($stmt);
        $action_message = "EOI #" . $eoi_num . " status updated to: " . htmlspecialchars($new_status);
    }
}

$allowed_sorts = ['eoi_number', 'first_name', 'last_name', 'reference', 'status', 'submitted_at'];

// $_GET: appends data to URL, good for retrieving/filtering 
$sort = $_GET['sort'] ?? 'eoi_number';

// reset to default if someone tampers with the URL
if (!in_array($sort, $allowed_sorts)) {
    $sort = 'eoi_number';
}

$query = "SELECT e.eoi_number, e.reference, e.first_name, e.last_name, 
                 e.email_address, e.phone_number, e.status, e.submitted_at,
                 j.job_title
          FROM eoi e
          LEFT JOIN jobs j ON e.reference = j.job_ref
          WHERE 1=1";

// filter by job reference (from $_GET superglobal)
$filter_ref = clean($conn, $_GET['filter_ref'] ?? '');
if (!empty($filter_ref)) {
    // String concatenation using . to build the query
    $query .= " AND reference = '$filter_ref'";
}

// filter by first name - LIKE with % means "contains" (partial match)
$filter_first = clean($conn, $_GET['filter_first'] ?? '');
if (!empty($filter_first)) {
    $query .= " AND first_name LIKE '%$filter_first%'";
}

// filter by last name
$filter_last = clean($conn, $_GET['filter_last'] ?? '');
if (!empty($filter_last)) {
    $query .= " AND last_name LIKE '%$filter_last%'";
}

$query .= " ORDER BY $sort ASC";

// send query to the database and store the result set
$result = mysqli_query($conn, $query);

// MYSQLI_ASSOC means keys are column names e.g. $row['first_name']
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


/* commented out by ashley for breaking site wide sizing conventions  .manage-container { max-width: 800px; margin: 2rem auto; padding: 0 1rem; } */
    
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
        <!-- $_SESSION stores manager's username from login -->
        <span>Logged in as: <strong><?php echo htmlspecialchars($_SESSION['manager_username']); ?></strong></span>
        <!-- logout=1 triggers the logout block at the top of this file -->
        <a href="manage.php?logout=1" class="logout-link">Log Out</a>
    </div>

    <!-- only show the feedback message if it is not empty -->
    <?php if (!empty($action_message)): ?>
        <div class="success-msg" role="status"><?php echo htmlspecialchars($action_message); ?></div>
    <?php endif; ?>

    <div class="panel">
        <h3>Filter and Sort EOIs</h3>
        <!-- method="GET": appends to URL, good for retrieving/filtering data (may or may not have stolen this from my notes hehe) -->
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
                    <!-- foreach loop iterates through the allowed_sorts array -->
                    <?php foreach ($allowed_sorts as $sort_option): ?>
                        <option value="<?php echo $sort_option; ?>"
                            <?php echo ($sort === $sort_option) ? 'selected' : ''; ?>>
                            <?php echo $sort_option; ?>
                        </option>
                    <?php endforeach; ?>
                </select>
            </div>

            <button type="submit">Apply Filters</button>
            <a href="manage.php" style="color:#567890; font-size:0.85rem; align-self:center;">Clear All</a>
        </form>
    </div>

    <div class="panel">
        <!-- count() returns the number of items in the $eois array -->
        <h3>EOI Results (<?php echo count($eois); ?> found)</h3>
        <div class="table-scroll">

        <!-- show message if no results, otherwise show the table -->
        <?php if (empty($eois)): ?>
            <p>No EOIs found matching your filters.</p>
        <?php else: ?>
            <table class="eoi-table">
                <caption class="visually-hidden">EOI Application Results</caption>
                <tr>
                    <th>EOI #</th>
                    <th>Job Ref</th>
                    <th>Job Title</th>
                    <th>First Name</th>
                    <th>Last Name</th>
                    <th>Email</th>
                    <th>Phone</th>
                    <th>Status</th>
                    <th>Submitted</th>
                </tr>

                <!-- foreach loop pulls each row from the result array -->
                <!-- mysqli_fetch_all returned an associative array - keys are column names -->
                <?php foreach ($eois as $row): ?>
                <tr>
                    <!-- echo prints the value to the browser as HTML -->
                    <!-- htmlspecialchars() converts < > & to safe HTML entities -->
                    <td><?php echo htmlspecialchars($row['eoi_number']); ?></td>
                    <td><?php echo htmlspecialchars($row['reference']); ?></td>
                    <td><?php echo htmlspecialchars($row['job_title'] ?? 'Unknown'); ?></td>
                    <td><?php echo htmlspecialchars($row['first_name']); ?></td>
                    <td><?php echo htmlspecialchars($row['last_name']); ?></td>
                    <td><?php echo htmlspecialchars($row['email_address']); ?></td>
                    <td><?php echo htmlspecialchars($row['phone_number']); ?></td>
                    <td>
                        <?php
                        // switch compares status against case labels 
                        switch ($row['status']) {
                            case 'New':
                                $badge = 'badge-new';
                                break; // break stops execution after match is found
                            case 'Current':
                                $badge = 'badge-current';
                                break;
                            case 'Final':
                                $badge = 'badge-final';
                                break;
                            default:
                                $badge = '';
                        }
                        ?>
                        <span class="badge <?php echo $badge; ?>">
                            <?php echo htmlspecialchars($row['status']); ?>
                        </span>
                    </td>
                    <td><?php echo htmlspecialchars($row['submitted_at']); ?></td>
                </tr>
                <?php endforeach; ?>

            </table>
        <?php endif; ?>
        </div>
    </div>

    <div class="panel">
        <h3>Change EOI Status</h3>
        <!-- method="POST": sends data in HTTP body, not visible in URL -->
        <form method="POST" action="manage.php" class="inline-form">
            <!-- hidden input sends action name to PHP without showing it to the user -->
            <input type="hidden" name="action" value="change_status">

            <div>
                <label for="eoi_number">EOI Number</label>
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
mysqli_close($conn); // for cleaup so we can save memory too 
?>