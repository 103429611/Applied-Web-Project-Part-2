<?php
/**
 * Executes solely on the web server and not visible to clients.
 * The purpose of this is to create the admin user in the users table with a hashed password.
 * I'll be deleting this file after running it once because it is a security risk to leave it.
 */

// If settings.php is missing, require_once stops the script automatically
require_once 'settings.php';

// This @ suppresses messy system errors so we can show a clean custom message instead
$conn = @mysqli_connect($host, $username, $password, $database);

// This is to check the connection and we use an if statementfor it, die() stops the script immediately and prints an error if connection fails
if (!$conn) {
    die("Unable to connect to database. Please check your settings.php file.");
}

// password_hash() scrambles "admin" into a long secure string using bcrypt which means even if someone steals the database, they cannot read the password
$hashed_password = password_hash('admin', PASSWORD_DEFAULT);

// This is a prepared statement which is used to insert the admin user and prevent SQL injection attacks
$stmt = mysqli_prepare($conn, 
    "INSERT INTO users (username, password_hash) 
     VALUES (?, ?) 
     ON DUPLICATE KEY UPDATE password_hash = ?"
);

// 'sss' means all three parameters are strings 
mysqli_stmt_bind_param($stmt, 'sss', $admin_username, $hashed_password, $hashed_password);

// $admin_username stores the username value
$admin_username = 'admin';

// This just executes the prepared statement 
mysqli_stmt_execute($stmt);

// This disconnects from MySQL server to save server memory
mysqli_close($conn);

// echo prints output as HTML to the browser
echo "<h2>Done! Admin user created.</h2>";
echo "<p>Username: <strong>admin</strong> | Password: <strong>admin</strong></p>";
echo "<p style='color:red;'><strong>Delete this file</strong> - it is a security risk.</p>";
echo "<p><a href='login.php'>Go to Login Page</a></p>";
?>