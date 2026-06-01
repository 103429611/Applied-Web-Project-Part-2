<!DOCTYPE html>
<html lang="en">
<head> <!-- Head containing nesseccary info on Character set, Description, Keywords and Author -->

    <meta charset="UTF-8">
    <meta name="description" content="Job listings page">
    <meta name="keywords" content="HTML, Doctype, Head, Body, Meta, Paragraph, Headings">
    <meta name="author" content="Ashley Butler">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">


    <!-- CSS linking file -->
    <link rel="stylesheet" href="styles/styles.css">
    <!-- embeded CSS adds a box around both jobs individually, and then changes the color of the text of the headings and content -->
    <style>


        #job_descriptions h4 {color: #EBC0AD;}
        #job_descriptions p {color: #FFD6F8;}
        #job_descriptions ol li {color: #EBC0AD;}
        #job_descriptions ol li ul li {color: #FFD6F8;}

    </style>

    <?php
    $page_title = "Jobs"; // Set the specific title for this page
    include 'header.inc'; 
    ?>

<div class="search-container">
    <a href="jobs.php" class="btn-primary">Return To Job Listings</a>
</div>

<?php

require_once "settings.php";
    $conn = @mysqli_connect ($host,$username,$password,$database);
    if(!$conn) {
            echo "<p> Database connection failed: ". mysqli_connect_error()."</p>";
    }
    else{
        if(isset($_GET['job_ref'])) {
        $job_ref = mysqli_real_escape_string($conn, $_GET['job_ref']);
        $sql = "SELECT * FROM jobs WHERE job_ref = '$job_ref'";        
        $result = mysqli_query($conn, $sql);
        if($result && mysqli_num_rows($result) > 0){
            while($row = mysqli_fetch_assoc($result)){
                $job_ref = htmlspecialchars($row['job_ref']);
                $job_title = htmlspecialchars($row['job_title']);
                $salary = htmlspecialchars($row['salary']);
                $reports_to = htmlspecialchars($row['reports_to']);
                $description = htmlspecialchars($row['description']);
                $essential_requirements = htmlspecialchars($row['essential_requirements']);
                $pref_requirements = htmlspecialchars($row['pref_requirements']);
                $essentials_array = explode(", ", $essential_requirements);
                $pref_array = explode(", ", $pref_requirements);

                echo "<section class ='job_entry'>";
                echo "<h2>$job_title</h2>"; 
                echo "<p><strong>Job ref: </strong>$job_ref</p>";
                echo "<p><strong>Salary: $</strong>$salary</p>";
                echo "<p><strong>Reporting to: </strong>$reports_to</p>";
                echo "<p><strong>Description: </strong>$description</p>";
                    
                echo "<ol>";
                    echo "<li>Essential Requirements";
                        echo "<ul>";
                         foreach ($essentials_array as $ess_item) {
                            echo "<li>" . htmlspecialchars($ess_item) . "</li>";
                        };
                        echo "</ul>";
                    echo "</li>";
                    echo "<li>Preferred Requirements";
                        echo "<ul>";
                        foreach ($pref_array as $pref_item) {
                             echo "<li>" . htmlspecialchars($pref_item) . "</li>";
                        }
                        echo "</ul>";
                echo "</ol>";
                echo "</section>";
            } 
           
        }
        }
    }
mysqli_close($conn);
?>

<div class="search-container">
    <a href="apply.php?job_ref=<?php echo $job_ref; ?>" class="btn-primary">Apply Now!</a>
</div>
    <?php include 'footer.inc'; ?>
</body>
</html>