<?php
/**
 * login.php - HR Manager authentication portal
 */

session_start();

// If manager is already authenticated, skip login and jump straight to dashboard
if (isset($_SESSION['manager_logged_in']) && $_SESSION['manager_logged_in'] === true) {
    header('Location: manage.php');
    exit();
}

// require_once loads settings exactly once
require_once 'settings.php';

// Connect to the database using your settings file
$conn = @mysqli_connect($host, $username, $password, $database);
if (!$conn) {
    die("Unable to connect to database. Please check settings.php.");
}

function clean($conn, $val) {
    return mysqli_real_escape_string($conn, trim(strip_tags(stripslashes($val))));
}

$error_message = '';

// Check if form was submitted
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $user = clean($conn, $_POST['username'] ?? '');
    $pass = clean($conn, $_POST['password'] ?? '');

    // Queries the 'admin' table created by your setup script
    $query = "SELECT * FROM admin WHERE username = ? AND password = ?";
    $stmt = mysqli_prepare($conn, $query);
    
    if ($stmt) {
        mysqli_stmt_bind_param($stmt, 'ss', $user, $pass);
        mysqli_stmt_execute($stmt);
        $result = mysqli_stmt_get_result($stmt);

        if ($row = mysqli_fetch_assoc($result)) {
            // Match found from database setup!
            $_SESSION['manager_logged_in'] = true;
            $_SESSION['manager_username'] = $row['username'];
            
            mysqli_stmt_close($stmt);
            mysqli_close($conn);
            header('Location: manage.php');
            exit();
        } else {
            $error_message = "Invalid username and password.";
        }
        mysqli_stmt_close($stmt);
    } else {
        // If your setup table was named 'managers' instead of 'admin', try checking that automatically
        $query_alt = "SELECT * FROM managers WHERE username = ? AND password = ?";
        $stmt_alt = mysqli_prepare($conn, $query_alt);
        
        if ($stmt_alt) {
            mysqli_stmt_bind_param($stmt_alt, 'ss', $user, $pass);
            mysqli_stmt_execute($stmt_alt);
            $result_alt = mysqli_stmt_get_result($stmt_alt);

            if ($row_alt = mysqli_fetch_assoc($result_alt)) {
                $_SESSION['manager_logged_in'] = true;
                $_SESSION['manager_username'] = $row_alt['username'];
                
                mysqli_stmt_close($stmt_alt);
                mysqli_close($conn);
                header('Location: manage.php');
                exit();
            } else {
                $error_message = "Invalid username and password.";
            }
            mysqli_stmt_close($stmt_alt);
        } else {
            $error_message = "Invalid username and password.";
        }
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>InfraWatch – Manager Login</title>
    <link rel="stylesheet" href="styles/styles.css">
</head>
<body>

<?php include 'header.inc'; ?>

<main style="display: flex; justify-content: center; align-items: center; padding: 3rem 1rem;">
    <div class="panel" style="width: 100%; max-width: 450px; padding: 2.5rem; box-sizing: border-box; text-align: center; margin: 0 auto;">
        
        <h2 style="margin-top: 0; margin-bottom: 0.5rem;">Manager Login</h2>
        <p style="margin-bottom: 2rem; color: #b3bec9; font-size: 0.95rem;">Restricted to authorised HR staff only.</p>

        <?php if (!empty($error_message)): ?>
            <p style="color: #e74c3c; font-weight: bold; margin-bottom: 1.5rem;"><?php echo htmlspecialchars($error_message); ?></p>
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
<?php
mysqli_close($conn);
?>