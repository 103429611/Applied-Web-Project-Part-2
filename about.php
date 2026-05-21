<!DOCTYPE html>
<html lang="en">

<head> <!-- Contains metadata as well as the title of the page -->

    <meta charset="UTF-8">
    <meta name="description" content="About page">
    <meta name="keywords" content="HTML, Doctype, Head, Body, Meta, Paragraph, Headings">
    <meta name="author" content="William Lloyd">

    <title>InfraWatch - About</title> 
    <link rel="stylesheet" href="styles/styles.css"> <!-- Gets the styles.css data for the webpage -->

     <!-- Gets local css data for this webpage -->
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
    include 'header.inc'; ?> <!-- gets header data for this page -->

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
        require_once("settings.php"); // Gets the settings.php for db connection
        $conn = mysqli_connect($host, $username, $password, $database); // Starts connection to db
        if(!$conn) {
            echo "<p> Database connection failed". mysqli_connect_error(). "</p>"; // if there is no connection, then say connection failed and print out what went wrong
        }
        else {
            $sql = "SELECT firstname, lastname, studentid, part_1_contributions, part_2_contributions, quote, quote_in_different_lang FROM contributions"; //else, get the selection of these elements as a variable
            $result = mysqli_query($conn, $sql); //get the query of the selection
            if($result && mysqli_num_rows($result) > 0){ //runs if the database has a result and that the number of rows is not 0
                while($row = mysqli_fetch_assoc($result)){ //runs for each row
                    $firstname = htmlspecialchars($row['firstname']);
                    $lastname = htmlspecialchars($row['lastname']);
                    $studentid = htmlspecialchars($row['studentid']);
                    $part_1_contributions = htmlspecialchars($row['part_1_contributions']);
                    $part_2_contributions = htmlspecialchars($row['part_2_contributions']);
                    $quote = htmlspecialchars($row['quote']);
                    $quote_in_different_lang = htmlspecialchars($row['quote_in_different_lang']); //gets all values to variables
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
                    "; //makes a unsorted list based off of the queries
                };
            };
            mysqli_close($conn); //closes the connection to not cause errors
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
        <?php include 'footer.inc'; ?> <!-- Adds a footer from footer.inc -->
</body>