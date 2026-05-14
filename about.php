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
        <dt>Alex: <span class="studentid">106340883</span></dt>
        <dd>
        <ul>
            <li>CSS files, apply.html</li>
            <li>"We must choose between champagne for a few or drinking water for all"</li>
            <li>"Il faut choisir entre le champagne pour quelques-uns ou l'eau potable pour tous"</li>
        </ul>
        <dd>
        <dt>Ashley: <span class="studentid">103429611</span></dt>
        <dd>
        <ul>
            <li>CSS files, jobs.html, submitting assignment</li>
            <li>"I choose a lazy person to do a hard job. Because a lazy person will find an easy way to do it."</li>
            <li>"「私は難しい仕事には怠け者を選ぶ。なぜなら、怠け者は楽な方法を見つけるからだ。"</li>
        </ul>
        <dd>
        <dt>William: <span class="studentid">105913190</span></dt>
        <dd>
        <ul>
            <li>CSS files, about.html</li>
            <li>"Good morning China. Now I have ice cream"</li>
            <li>"早上好中国.现在我有冰淇淋"</li>
        </ul>
        <dd>
        <dt>Noor: <span class="studentid">106216609</span></dt>
        <dd>
        <ul>
            <li>CSS files, index.html</li>
            <li>"It is very difficult to keep a lamp lit in the middle of the storm"</li>
            <li>"بہت مشکل ہے، آندھیوں میں چراغ جلانا"</li>
        </ul>
        <dd>
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