<!DOCTYPE html>
<html lang="en">
<!-- Apply server‑side validation, sanitisation, and security practices for all user input. -->

<!-- Demonstrate your implemented features during the Week 11 interview with your tutor.-->
<!-- Participate in the Week 12 group presentation and complete the Peer & Self Evaluation individually.-->


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

<main>
    <!-- INLINE CSS to change font-size to 2x and color of the text to plum-->
    <h2 style="font-size: 2em; color: plum;">Current Open Jobs</h2>

    <!-- aside, main adjacent content, in this case showing employee reviews  -->
    <aside class="aside">
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

<section id="job_search">
    <h2>Job Search</h2>
    <div class="search-container">
        <form action="job_search_result.php" method="GET">
            <label for="job_ref">Search Job Ref No.</label>
            <input type="search" id="job_ref" name="job_ref" placeholder="Search Job Ref No." required>
            <button type="submit">Search</button>
        </form> 
    </div>
</section>

    <!--  Job descriptions of current open jobs -->
    <section id="job_descriptions">
        <h2>Welcome to Infrawatch Jobs Page</h2>
        <p> We are seeking many experience and new to the field Team Members as we expand our network of smart camera Infrastructure, 
            If you have 10 years of experience or even 10 minutes of experience we want to hear from you.</p>
        <p> We are a company focused on city safety and better government spending, utilising our AI camera tech we aim to roll out multiple deployments locally and nationally to minimise crime, theft, murders and assist goverments spend there money smarter. 
            If this sounds like something you would be interested in then view the open jobs below, apply, or reach out to our hiring team with any questions at  <a href="mailto:careers@Infrawatch.com.au">careers@Infrawatch.com.au</a></p>
  
        <?php require_once("settings.php"); 
        $conn = mysqli_connect($host, $username, $password, $database );
        if(!$conn) {
            echo "<p> Database connection failed: ". mysqli_connect_error()."</p>";
        }
        else{
            $sql = "SELECT job_ref, job_title, salary, reports_to, description, essential_requirements, pref_requirements FROM jobs";
            $result = mysqli_query($conn, $sql);
            if($result && mysqli_num_rows($result) > 0){
                echo "<table>";
                echo "<tr><th>Job Ref</th><th>Title</th><th>Salary</th><th>Reports To</th></tr>";
            while($row = mysqli_fetch_assoc($result)){
                    $job_ref = htmlspecialchars($row['job_ref']);
                    $job_title = htmlspecialchars($row['job_title']);
                    $salary = '$' . number_format($row['salary'], 0, '.', ',');
                    $reports_to = htmlspecialchars($row['reports_to']);
                    $url = "./job_search_result.php?job_ref=" . $job_ref;
                    echo "<tr>";
                    echo "<td><a href='$url'>" . $job_ref . "</a></td>";
                    echo "<td>" . htmlspecialchars($row['job_title']) . "</td>";
                    echo "<td>" . $salary . "</td>"; // Display formatted salary
                    echo "<td>" . htmlspecialchars($row['reports_to']) . "</td>";
                    echo "</tr>";
                };
                echo "</table>";
            };
        mysqli_close($conn);
        };
        ?>
    </section> <!-- job_descriptions section end -->
</main>
    <?php include 'footer.inc'; ?>
</body>
</html>