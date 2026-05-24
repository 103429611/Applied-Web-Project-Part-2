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
    <!-- viewport meta tag makes the page mobile responsive -->
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>InfraWatch – Manager Login</title>
    <link rel="stylesheet" href="styles/styles.css">
    <style>
        .login-wrapper {
            min-height: 70vh;
            display: flex;
            align-items: center;
            justify-content: center;
        }
        .login-box {
            background: #fff;
            border: 1px solid #d0dde8;
            border-radius: 10px;
            padding: 2.5rem 3rem;
            width: 100%;
            max-width: 400px;
            box-shadow: 0 4px 20px rgba(0,0,0,0.08);
        }
        .login-box label {
            display: block;
            font-weight: 600;
            margin-bottom: 0.3rem;
        }
        .login-box input[type="text"],
        .login-box input[type="password"] {
            width: 100%;
            padding: 0.7rem;
            margin-bottom: 1rem;
            border: 1px solid #c0cfd8;
            border-radius: 6px;
            font-size: 1rem;
            box-sizing: border-box;
        }
        .login-box input[type="submit"] {
            width: 100%;
            padding: 0.8rem;
            background: #1a3a5c;
            color: #fff;
            border: none;
            border-radius: 6px;
            font-size: 1rem;
            cursor: pointer;
        }
        .login-box input[type="submit"]:hover { background: #1a6dbc; }
        .error-msg {
            background: #fdecea;
            color: #c0392b;
            border: 1px solid #f5b7b1;
            border-radius: 6px;
            padding: 0.7rem;
            margin-bottom: 1rem;
            font-size: 0.9rem;
        }
    </style>
</head>
<body>

<?php include 'header.inc'; ?>

<main>
    <div class="login-wrapper">
        <div class="login-box">
            <h2>Manager Login</h2>
            <p>Restricted to authorised HR staff only.</p>

            <!-- only show error box if $error is not empty -->
            <?php if (!empty($error)): ?>
                <div class="error-msg">
                    <!-- htmlspecialchars() prevents XSS by converting < > to safe HTML entities -->
                    <?php echo htmlspecialchars($error); ?>
                </div>
            <?php endif; ?>

            <!-- method="post": sends data in HTTP body, invisible in URL -->
            <!-- action="login.php": form submits back to this same file -->
            <form action="login.php" method="post">

                <label for="username">Username</label>
                <!-- type="text" creates a text input box -->
                <input type="text" id="username" name="username" 
                       placeholder="Enter username">

                <label for="password">Password</label>
                <!-- type="password" hides characters as the user types -->
                <input type="password" id="password" name="password" 
                       placeholder="Enter password">

                <input type="submit" value="Log In">
            </form>
        </div>
    </div>
</main>

<?php include 'footer.inc'; ?>

</body>
</html>