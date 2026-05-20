<!DOCTYPE html>
<html lang="en">

<!-- Need to: -->

<!-- Member contributions and quotes using a definition list -->
<!-- Include a quote from each member in their first language, along with an English translation. If you are a native English speaker, use a quote in another language you like. -->
<!-- Group photo - Not individual (< 300KB) using <figure> and caption -->
<!-- Fun facts table with caption (e.g. dream job, coding snack, hometown) -->


<head> <!-- Contains metadata as well as the title of the page -->

    <meta charset="UTF-8">
    <meta name="description" content="About page">
    <meta name="keywords" content="HTML, Doctype, Head, Body, Meta, Paragraph, Headings">
    <meta name="author" content="William Lloyd">

    <title>InfraWatch - About</title> 
    <link rel="stylesheet" href="styles/styles.css"> 

    <style>
        .studentid {
            color: gold;
            font-weight: bold;
            font-family: arial, sans-serif; 
        }
        table, td, tr {
            border: 1px dotted #ffffff;
            background-color: #202020;
        }

        td:hover, tr:hover {
            background-color: #606060;
        }
        #groupphoto {
            border: 3px double #ffff00;
            float: left;
            max-height: 64vw;
            max-width: auto;
            width: 64vw;
            height: auto;
            margin: 1em;
        }
    </style>
</head>

<body>
<?php $page_title = "About"; // Set the specific title for this page
    include 'header.inc'; ?>

    <h1>We are...</h1>
    <ul>
        <li>Group 2</li>
        <ul>
            <li>COS10026 at 12:30 - 2:30 on a Thursday</li> <!--Nested list-->
        </ul>
    </ul>

    <h2>Contributions of the team:</h2>
    <dl> <!--Definition list-->

        <?php
        require_once("settings.php");
            $conn = mysqli_connect($host, $username, $password, $database);
        if(!$conn) {
            echo "<p> Database connection failed". mysqli_connect_error(). "</p>";
        }
        else {
            $sql = "SELECT firstname, lastname, studentid, part_1_contributions, part_2_contributions, quote, quote_in_different_lang FROM contributions";
            $result = mysqli_query($conn, $sql);
            if($result && mysqli_num_rows($result) > 0){
                while($row = mysqli_fetch_assoc($result)){
                    $firstname = htmlspecialchars($row['firstname']);
                    $lastname = htmlspecialchars($row['lastname']);
                    $studentid = htmlspecialchars($row['studentid']);
                    $part_1_contributions = htmlspecialchars($row['part_1_contributions']);
                    $part_2_contributions = htmlspecialchars($row['part_2_contributions']);
                    $quote = htmlspecialchars($row['quote']);
                    $quote_in_different_lang = htmlspecialchars($row['quote_in_different_lang']);
                    echo "
                        <dt>$firstname $lastname: <span class=\"studentid\">$studentid</span></dt>
                        <dd>
                        <ul>
                            <li>Part 1 Contributions: $part_1_contributions</li>
                            <li>Part 2 Contributions: $part_2_contributions</li>
                            <li>\"$quote\"</li>
                            <li>\"$quote_in_different_lang\"</li>
                        </ul>
                    <dd>
                    ";
                };
            };
            mysqli_close($conn);
        }
        ?>
    </dl>
    
    <figure> <!--For group photo-->
        <img src = "images/groupphoto.png" alt="Group Photo" width="400" height="300" id="groupphoto">
        <figcaption>
            <table>
                <caption>Fun Facts about the team:</caption>
                <tr>
                    <td>
                        Alex: My hometown is in Gold Coast, Australia
                    </td>
                    <td>
                        Ashley: I like pistachios as my coding snack
                    </td>
                    <td>
                        William: Likes programming and is also a furry
                    </td>
                    <td>
                        Noor: My dream job is to have my own social media marketing company
                    </td>
                </tr>
            </table>
        </figcaption>
    </figure>
        <?php include 'footer.inc'; ?>
</body>