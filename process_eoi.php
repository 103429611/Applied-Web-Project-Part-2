<?php
session_start();
if ($_SERVER['REQUEST_METHOD'] == 'GET') {
    header("Location: ./apply.php");
    die('Direct access not permitted');
}

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
    $other_gender = sanitise_input($_POST["other_gender"]);
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
    } elseif (!preg_match("/^[a-zA-Z0-9]{5}$/", $reference)) {
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
    if (preg_match("/other/", $gender)) $gender = $other_gender;
    

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
     } elseif (!preg_match("/^[a-zA-Z0-9._%+-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,}$/", $email)) {
         $errors[] = "Invalid email format";
    }


    if (empty($phone)) {
        $errors[] = "Phone number is required.";

    } elseif (!preg_match("/^[0-9]{8,12}$/", $phone)){
        $errors[] = "Phone number must be between 8-12 digits.";
    }


    // Step 5: Show errors or insert data into database
    if (!empty($errors)) {
        // Display all error messages
       // $queryString = http_build_query(['errors' => $errors, 'old' => $_POST]);
       // header("Location: ./apply.php?" . $queryString);
        
        $_SESSION["errors"] = $errors;
        $_SESSION["id"] = null;

        $_SESSION["reference"] = $reference;
        $_SESSION["firstname"] = $firstname;
        $_SESSION["lastname"] = $lastname;
        $_SESSION["dob"] = $dob;
        $_SESSION["gender"] = $gender;
        $_SESSION["address"] = $address;
        $_SESSION["suburb"] = $suburb;
        $_SESSION["postcode"] = $postcode;
        $_SESSION["state"] = $state;
        $_SESSION["email"] = $email;
        $_SESSION["phone"] = $phone;
        $_SESSION["skills"] = $skills;
        $_SESSION["other_skills"] = $other_skills;


        header("Location: ./apply.php?#results");
        
    }
    else{ 
        $createTableSql = "CREATE TABLE IF NOT EXISTS eoi (
        `eoi_number` int(11) AUTO_INCREMENT PRIMARY KEY NOT NULL,
        `reference` varchar(5) NOT NULL,
        `first_name` varchar(20) NOT NULL,
        `last_name` varchar(20) NOT NULL,
        `dob` date NOT NULL,
        `gender` varchar(20) NOT NULL,
        `address` varchar(40) NOT NULL,
        `suburb` varchar(40) NOT NULL,
        `postcode` int(11) NOT NULL,
        `state` varchar(10) NOT NULL,
        `email_address` varchar(100) NOT NULL,
        `phone_number` int(11) NOT NULL,
        `skills` varchar(200) NOT NULL,
        `other_skills` text NOT NULL,
        `submitted_at` datetime(6) NOT NULL DEFAULT current_timestamp(6),
        `status` enum('New','Current','Final') NOT NULL DEFAULT 'New'
        ) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;";
    
    if (!mysqli_query($conn, $createTableSql)) {
            echo "<p style='color:red'> Error creating table: " . mysqli_error($conn) . "</p>";
            mysqli_close($conn);
            exit();
        }    
        $sql = "INSERT INTO eoi (reference, first_name, last_name, dob, gender, address, suburb, postcode, state, email_address, phone_number, skills, other_skills)
            VALUES ('$reference','$firstname','$lastname','$dob','$gender','$address','$suburb','$postcode','$state','$email','$phone', '$skills', '$other_skills')";
        if (mysqli_query($conn , $sql)){
            $_SESSION["id"] = htmlspecialchars(mysqli_insert_id($conn));
            $_SESSION["errors"] = null;
            header("Location: ./apply.php?#results");
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