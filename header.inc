
<div class = "main_header">
    <header>
        <input type="checkbox" id="menu-toggle" hidden>
    <label for="menu-toggle" class="hamburger-btn">
            <h1>&#8801; Menu</h1>
    </label>
        <ul class="menu-items">
            <a id="about" href="about.php"><li><h2>About</h2></li></a>
            <a id="apply" href="apply.php"><li><h2>Apply</h2></li></a>
            <a id="index" href="index.php"><li><h2>Index</h2></li></a>
            <a id="jobs" href="jobs.php"><li><h2>Jobs</h2></li></a>
            <a id="login" href="login.php"><li><h2>Login</h2</li></a>
        </ul>
    </header>   
    <div class = "page_content"> <!-- This is the div that links up to the footer, putting everything in a giant flexbox -->

    <div class = "header_image">

    <header class = "header">
        <a href="images/logo.png"> <img src="images/logo_small.png" class = "header"  id="logo"  alt="InfraWatch Logo"></a> <!-- the alt is just added for acessibility-->
            <!-- AI USE ACKNOWLEDGEMENT: The InfraWatch logo (logo.png) was generated using Canva AI.
            Prompt used: "a camera lens inside a circuit"
            Source: https://www.canva.com -->
        <!-- Title -->
        <div class = "header_content">
        <title>
           <?php echo isset($page_title) ? $page_title . " | InfraWatch" : "InfraWatch"; ?>
        </title>
        <h1 class = "header"> 
            <?php 
            // If $page_title is set, show it; otherwise, just show "InfraWatch"
            echo isset($page_title) ? "InfraWatch - " . $page_title : "InfraWatch"; 
            ?>
        </h1>

        <p class= "header">Powering Smarter Infrastructure.</p>
        </div>
    </header>
    </div>

