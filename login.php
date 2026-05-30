<?php
/**
 * login.php
 */

session_start();

// isset() checks if session variable exists and is not null, if already logged in, skip login form and go straight to dashboard
if (isset($_SESSION['manager_logged_in']) && $_SESSION['manager_logged_in'] === true) {
    header('Location: manage.php');
    exit();
}

// require_once loads HUPD credentials exactly once
require_once 'settings.php';

// get live EOI count to display on login page
$eoi_count = 0;
$temp_conn = @mysqli_connect($host, $username, $password, $database);
if ($temp_conn) {
    // COUNT() aggregate function counts matching rows
    $count_result = mysqli_query($temp_conn, "SELECT COUNT(*) as total FROM eoi WHERE status = 'New'");
    if ($count_result) {
        $count_row = mysqli_fetch_assoc($count_result);
        $eoi_count = $count_row['total'];
        mysqli_free_result($count_result);
    }
    mysqli_close($temp_conn);
}

$error = '';

// $_SERVER["REQUEST_METHOD"] checks how page was accessed
if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    // server-side sanitisation
    $input_username = trim(strip_tags($_POST['username'] ?? ''));
    $input_password = $_POST['password'] ?? '';

    // server-side validation
    if (empty($input_username) || empty($input_password)) {
        $error = 'Please enter both username and password.';
    } else {

        // establish connection to database
        $conn = @mysqli_connect($host, $username, $password, $database);

        if (!$conn) {
            $error = 'Unable to connect to database. Please try again later.';
        } else {

            // prepared statement prevents SQL injection
            $stmt = mysqli_prepare($conn, "SELECT password_hash FROM users WHERE username = ? LIMIT 1");
            mysqli_stmt_bind_param($stmt, 's', $input_username);

            // send the query to the database
            mysqli_stmt_execute($stmt);

            // bind result to variable so we can use it in PHP
            mysqli_stmt_bind_result($stmt, $stored_hash);
            mysqli_stmt_fetch($stmt);
            mysqli_stmt_close($stmt);

            // close connection to free server memory
            mysqli_close($conn);

            // password_verify() checks plain text against stored bcrypt hash
            if ($stored_hash && password_verify($input_password, $stored_hash)) {

                // regenerate session ID prevents session fixation attacks
                session_regenerate_id(true);

                // store login state in session on the server
                $_SESSION['manager_logged_in'] = true;
                $_SESSION['manager_username'] = htmlspecialchars($input_username);

                header('Location: manage.php');
                exit();

            } else {
                $error = 'Invalid username or password.';
            }
        }
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="InfraWatch HR Manager login - restricted access">
    <title>InfraWatch – Manager Login</title>
    <link rel="stylesheet" href="styles/styles.css">
    <style>
        /* ensures the entire page environment background remains dark */
        body {
            background-color: #06090c;
            color: #ffffff;
        }

        /* stylises the big text header so it sits perfectly centered on top */
        .login-wrapper h2 {
            font-size: 3.5rem;
            font-weight: 900;
            color: #1a6dbc !important;
            letter-spacing: 0.3em;
            text-transform: uppercase;
            text-align: center;
            margin: 0 0 1.5rem 0;
            text-shadow: 0 0 20px rgba(26,109,188,0.4);
        }

        /* extra cushion spacing for the live pending badge below the title */
        .login-wrapper .eoi-badge {
            display: block;
            text-align: center;
            margin-bottom: 1.5rem;
        }
    </style>
</head>
<body>

<?php include 'header.inc'; ?>

<main>
    <div class="login-page-wrapper">

        <div class="login-wrapper">
            
            <h2>Login</h2>

            <?php if ($eoi_count > 0): ?>
                <span class="eoi-badge">
                    <?php echo $eoi_count; ?> new application(s) awaiting review
                </span>
            <?php endif; ?>

            <div class="login-box">
                <p style="color:rgba(252, 252, 252, 0.4); font-size:0.8rem; margin-top:0; margin-bottom:1.2rem; text-align:center;">
                    Restricted to authorised staff only
                </p>

                <?php if (!empty($error)): ?>
                    <div class="error-msg" role="alert">
                        <?php echo htmlspecialchars($error); ?>
                    </div>
                <?php endif; ?>

                <form action="login.php" method="post">
                    <label for="username">Username</label>
                    <input type="text" id="username" name="username" placeholder="Enter username">

                    <label for="password">Password</label>
                    <input type="password" id="password" name="password" placeholder="Enter password">

                    <input type="submit" value="Log In">
                </form>
            </div>
        </div>

    </div>
</main>

<?php include 'footer.inc'; ?>

</body>
</html>