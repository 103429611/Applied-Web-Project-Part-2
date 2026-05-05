<!DOCTYPE html>
<html lang="en">

<!-- TO-DO  -->

<!-- Convert relevant HTML pages to PHP and modularise shared components using PHP includes. -->
<!-- Implement database connectivity and manage application data using server‑side scripting. -->
<!-- Apply server‑side validation, sanitisation, and security practices for all user input. -->
<!-- Dynamically render job listings, form submissions, and database content.-->
<!-- Implement authentication and controlled access for management functionality.-->
<!-- Demonstrate your implemented features during the Week 11 interview with your tutor.-->
<!-- Participate in the Week 12 group presentation and complete the Peer & Self Evaluation individually.-->
<!--Move shared HTML (header, nav, footer, etc.,...) into .inc files (e.g., header.inc, nav.inc, footer.inc). -->
<!-- Convert pages to .php and include these files.
-->
<!-- Create settings.php with host, user, password, and database name. Note: Do not set any password
-->
<!-- Use it for all DB connections on the local server.
-->
<!-- Jobs table and jobs.php
Create a jobs table. Fields and data types of jobs table must match with the project 1 jobs page. 
Render job descriptions and details (everything) dynamically with PHP in jobs.php page 
(or other pages if relevant). Jobs page should have a search bar that retrieves data from the database.-->
<!-- -->
<!-- -->
<!-- -->


<!-- DONE  -->

<!-- -->
<!-- -->
<!-- -->
<!-- -->
<!-- -->
<!-- -->
<!-- -->





<head> <!-- Head containing nesseccary info on Character set, Description, Keywords and Author -->

    <title>Infrawatch - Jobs</title>
    <meta charset="UTF-8">
    <meta name="description" content="Job listings page">
    <meta name="keywords" content="HTML, Doctype, Head, Body, Meta, Paragraph, Headings">
    <meta name="author" content="Ashley Butler">

    <!-- CSS linking file -->
    <link rel="stylesheet" href="styles/styles.css">
    <!-- embeded CSS adds a box around both jobs individually, and then changes the color of the text of the headings and content -->
    <style>
        .job_entry {
            border: 4px solid purple;
            border-radius: 14px;
            margin: 1em;
            margin-bottom: 4em;
            padding: 1em;
            background-color: #0b3b51 ;
            width: 60%;
            box-shadow: 10px 10px 5px #aaaaaa;
        }

        #job_descriptions h4 {color: #EBC0AD;}
        #job_descriptions p {color: #FFD6F8;}
        #job_descriptions ol li {color: #EBC0AD;}
        #job_descriptions ol li ul li {color: #FFD6F8;}

    </style>

</head>

<body>
    <?php include 'header.inc'; ?>

    <!-- INLINE CSS to change font-size to 2x and color of the text to plum-->
    <h2 style="font-size: 2em; color: plum;">Current Open Jobs</h2>

    <!-- aside, main adjacent content, in this case showing employee reviews  -->
    <aside>
        <h3>Notes from our current team</h3>
        <h4>Mark - Accounting</h4>
        <p>I love working here at Infrawatch, the pay is great, the team are awesome and the management let you work at your pace</p>
        <h4>Debra - Marketing</h4>
        <p>With unlimited tea, coffee and biscuits who wouldn't want to work here</p>
        <h4>Grace - CFO</h4>
        <p>I've never worked somewhere with a CEO whos more down to earth and treats their staff with such respect</p>
        <h4>Emma - squatter on 5th floor</h4>
        <p>Don't tell them I'm hiding here!!</p>
    </aside>

    <!--  Job descriptions of current open jobs -->
    <section id="job_descriptions">
        <h3>Job Descriptions</h3>
        <hr>

        <?php require_once("settings.php"); 
        $conn = mysqli_connect($host, $username, $password, $database );
        if(!$conn) {
            echo "<p> Database connection failed: ". mysqli_connect_error()."</p>";
        }
        else{
            $sql = "SELECT job_ref, job_title, salary, reports_to, description, essential_requirements, pref_requirements FROM jobs";
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
                    echo "<h4>$job_title</h4>"; 
                    echo "<p><strong>Job ref: </strong>$job_ref</p>";
                    echo "<p><strong>Salary: </strong>$salary</p>";
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
                };
            };
        mysqli_close($conn);
        };
        ?>
    </section> <!-- job_descriptions section end -->
    <?php include 'footer.inc'; ?>
</body>
    