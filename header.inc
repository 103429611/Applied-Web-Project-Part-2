    <header>
        <a href="images/logo.png"> <img src="images/logo_small.png" class="header" id="logo"  alt="InfraWatch Logo"></a> <!-- the alt is just added for acessibility-->
            <!-- AI USE ACKNOWLEDGEMENT: The InfraWatch logo (logo.png) was generated using Canva AI.
            Prompt used: "a camera lens inside a circuit"
            Source: https://www.canva.com -->
       
        <!-- Title -->
        <title>
           <?php echo isset($page_title) ? $page_title . " | InfraWatch" : "InfraWatch"; ?>
        </title>
        
        <h1 class="header"> 
            <?php 
            // If $page_title is set, show it; otherwise, just show "InfraWatch"
            echo isset($page_title) ? "InfraWatch - " . $page_title : "InfraWatch"; 
            ?>
        </h1>

        <p class="header hero-slogan">Powering Smarter Infrastructure.</p>
         <!--Navigation-->
        <nav class="header" id="nav">
            <a id="about" href="about.php">About</a>
            <a id="apply" href="apply.php">Apply</a>
            <a id="index" href="index.php">Index</a>
            <a id="jobs" href="jobs.php">Jobs</a>
            <a id="login" href="login.php">Login</a>
        </nav>
    </header>