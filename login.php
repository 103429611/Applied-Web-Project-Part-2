<?php
/*
 * executes on the web server, client only sees HTML output, authenticates HR managers before granting access to manage.php
 */

session_start(); //stores info on the server

// isset() determines if a session variable is set and not null
// if already logged in, skip the login page entirely using header() redirect
if (isset($_SESSION['manager_logged_in']) && $_SESSION['manager_logged_in'] === true) {
    header('Location: manage.php');
    exit(); 
}

require_once 'settings.php'; //for importing credentials
$error = '';

// $_SERVER["REQUEST_METHOD"] checks how the page was accessed
if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    // trim() removes leading/trailing spaces from input
    // strip_tags() removes any HTML tags to prevent XSS attacks
    // $_POST superglobal receives data sent via POST method (invisible in URL)
    // ?? '' means "use empty string if this key doesn't exist in $_POST"
    $input_username = trim(strip_tags($_POST['username'] ?? ''));
    $input_password = $_POST['password'] ?? '';

    // empty() returns true if value is "" (empty string), NULL, FALSE, or 0
    if (empty($input_username) || empty($input_password)) {
        $error = 'Please enter both username and password.';

    } else {
        $conn = @mysqli_connect($host, $username, $password, $database); //establish connection

        // check if connection succeeded
        if (!$conn) {
            $error = 'Unable to connect to database. Please try again later.';
        } else {
            // ? placeholder prevents SQL injection
            $stmt = mysqli_prepare($conn, 
                "SELECT password_hash FROM users WHERE username = ? LIMIT 1"
            );
            // 's' = string data type for the username parameter
            mysqli_stmt_bind_param($stmt, 's', $input_username);

            // send query to the database
            mysqli_stmt_execute($stmt);

            // bind the result to a variable so we can use it in PHP
            mysqli_stmt_bind_result($stmt, $stored_hash);
            mysqli_stmt_fetch($stmt);
            mysqli_stmt_close($stmt);

            // close connection to free server memory
            mysqli_close($conn);

            // password_verify() checks the plain password against the bcrypt hash
            if ($stored_hash && password_verify($input_password, $stored_hash)) {

                // regenerate session ID to prevent session fixation attacks
                session_regenerate_id(true);

                // save login state on the server
                $_SESSION['manager_logged_in'] = true;
                $_SESSION['manager_username']  = htmlspecialchars($input_username);
                // htmlspecialchars() converts special characters to HTML entities

                // redirect to the manager dashboard
                header('Location: manage.php');
                exit();

            } else {
                // error message on purpose
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
    <link rel="stylesheet" href="styles/styles.css">
    <?php
    $page_title = "Manager Login";
     include 'header.inc'; ?>



<main style="display: flex; justify-content: center; align-items: center; padding: 3rem 1rem;">
    <div class="panel" style="width: 100%; max-width: 450px; padding: 2.5rem; box-sizing: border-box; text-align: center; margin: 0 auto;">
        
        <h2 style="margin-top: 0; margin-bottom: 0.5rem;">Manager Login</h2>
        <p style="margin-bottom: 2rem; color: #b3bec9; font-size: 0.95rem;">Restricted to authorised HR staff only.</p>

        <?php if (!empty($error)): ?>
            <p style="color: #e74c3c; font-weight: bold; margin-bottom: 1.5rem;">
                <?php echo htmlspecialchars($error); ?>
            </p>
        <?php endif; ?>

        <form method="POST" action="login.php" style="max-width: 280px; margin: 0 auto; text-align: left;">
            <div style="margin-bottom: 1.25rem;">
                <label for="username" style="display: block; margin-bottom: 0.5rem; font-weight: bold;">Username</label>
                <input type="text" id="username" name="username" required autofocus placeholder="Enter username" style="width: 100%; box-sizing: border-box; padding: 0.5rem;">
            </div>

            <div style="margin-bottom: 2rem;">
                <label for="password" style="display: block; margin-bottom: 0.5rem; font-weight: bold;">Password</label>
                <input type="password" id="password" name="password" required placeholder="Enter password" style="width: 100%; box-sizing: border-box; padding: 0.5rem;">
            </div>

            <div style="text-align: center;">
                <button type="submit">Log In</button>
            </div>
        </form>
        
    </div>
</main>

<?php include 'footer.inc'; ?>

</body>
</html>