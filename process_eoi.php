<?php
error_reporting(E_ALL);
require_once("settings.php");
$conn = mysqli_connect($host,$username,$password,$database);
if(!$conn) {
    echo "<p> Database connection failed". mysqli_connect_error(). "</p>";
}
// Step 1: Check if form has been submitted using POST method
if ($_SERVER["REQUEST_METHOD"] == "POST") {

    // Step 2: Collect and sanitise form inputs
    $reference = sanitise_input($_POST["reference"]);
    $firstname = sanitise_input($_POST["firstname"]);
    $lastname = sanitise_input($_POST["lastname"]);
    $dob = sanitise_input($_POST["dob"]);
    $gender = sanitise_input($_POST["gender"]);
    $address = sanitise_input($_POST["address"]);
    $suburb = sanitise_input($_POST["suburb"]);
    $postcode = sanitise_input($_POST["postcode"]);
    $state = sanitise_input($_POST["state"]);
    $email = sanitise_input($_POST["email"]);
    $phone = sanitise_input($_POST["phone"]);
    $other_skills = sanitise_input($_POST["other_skills"]);


    // Step 3: Handle checkboxes (convert arrays into comma-separated strings)
    $skills = isset($_POST["skills"]) ? implode(", ", array_map('sanitise_input', $_POST["skills"])) : "";

    // Step 4: Basic form validation
    $errors = [];

    if (empty($reference)){
        $errors[] = "Reference is required";
    } elseif (!preg_match("/^[a-zA-Z][0-9]{5}$/", $reference)) {
        $errors[] = "Reference must be exactly 5 alphanumeric characters";
    }

    if (empty($firstname)){
         $errors[] = "First name is required.";
    } elseif (!preg_match("/^[a-zA-Z]{1,20}$/", $firstname)) {
         $errors[] = "First name must be between 1 and 20 characters and contain only alpha characters.";
    }

    if (empty($lastname)){
         $errors[] = "Last name is required.";
    } elseif (!preg_match("/^[a-zA-Z]{1,20}$/", $lastname)) {
         $errors[] = "Last name must be between 1 and 20 characters and contain only alpa characters.";
    }

    if (empty($dob)) $errors[] = "Date Of Birth is required.";

    if (empty($gender)) $errors[] = "Gender is required.";

    if (empty($address)) $errors[] = "Street address name is required.";

    if (empty($suburb)) $errors[] = "Suburb is required.";

    if (empty($postcode)){
         $errors[] = "Postcode is required";
    } elseif(!preg_match("/^[0-9]{4}$/", $postcode)) {
         $errors[] = "Postcode must be 4 digits (0–9).";
    }

    if (empty($state)) $errors[] = "State is required.";

    if (empty($email)) {
       $errors[] = "Email is required";
     } elseif (!preg_match("/[a-zA-Z0-9.!#$%&’*+/=?^_`{|}~-]+@[a-zA-Z0-9-]+(?:\.[a-zA-Z0-9-]+)*/", $email)) {
         $errors[] = "Invalid email format";
    }


    if (empty($phone)) {
        $errors[] = "Phone number is required.";

    } elseif (!preg_match("/^[0-9]{8-12}$/", $phone)){
        $errors[] = "Phone number must be between 8-12 digits.";
    }


    // Step 5: Show errors or insert data into database
    if (!empty($errors)) {
        // Display all error messages
        foreach ($errors as $error) {
            echo "<p style='color:red;'>" . htmlspecialchars($error) . "</p>";
        }
        echo "<p><strong>Please go back and fix the errors.</strong></p>";
    }
    else{ 
        $sql = "INSERT INTO eoi (reference, firstname, lastname, dob, gender, address, suburb, postcode, state, email, phone, skills, other_skills)
            VALUES ('$reference','$firstname','$lastname','$dob','$gender','$address','$suburb','$postcode','$state','$email','$phone', '$skills', '$other_skills)";
        if (mysqli_query($conn , $sql)){
            echo "<p style='color:green>Sumbitted!, your EOI number is:" .mysqli_insert_id($conn). "</p>";
        }else{
            echo "<p style='color:red'> Error:".mysqli_error($conn)."</p>";
        }
    }
    mysqli_close($conn);
}



// Function to sanitise form input
function sanitise_input($data) {
    $data = trim($data);           // Remove extra spaces
    $data = stripslashes($data);   // Remove backslashes
    $data = htmlspecialchars($data); // Convert special characters to HTML entities
    return $data;
}
?>