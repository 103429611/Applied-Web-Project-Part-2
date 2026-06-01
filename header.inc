        <title>
           <?php echo isset($page_title) ? $page_title . " | InfraWatch" : "InfraWatch"; ?>
        </title>
</head>
<body>
<div class = "main_header">
    <header class = "sidebar">
        <input type="checkbox" id="menu-toggle" hidden>
    <label for="menu-toggle" class="hamburger-btn">&#8801;</label>
        <ul class="menu-items">
            <li class="menu-text"><a href="about.php">About</a></li>
            <li class="menu-text"><a href="apply.php">Apply</a></li>
            <li class="menu-text"><a href="index.php">Index</a></li>
            <li class="menu-text"><a href="jobs.php">Jobs</a></li>
            <li class="menu-text"><a href="login.php">Login</a></li>
        </ul>
    </header>   

    <div class = "nav_bar">

    <header class = "header">
        <a href="images/logo.png"> <img src="images/logo_small.png" class = "header"  id="logo"  alt="InfraWatch Logo"></a> <!-- the alt is just added for acessibility-->
            <!-- AI USE ACKNOWLEDGEMENT: The InfraWatch logo (logo.png) was generated using Canva AI.
            Prompt used: "a camera lens inside a circuit"
            Source: https://www.canva.com -->
        <!-- Title -->
        <div class = "header_content">

        <h1 class = "header"> 
            <?php 
            // If $page_title is set, show it; otherwise, just show "InfraWatch"
            echo isset($page_title) ? "InfraWatch - " . $page_title : "InfraWatch"; 
            ?>
        </h1>
        

        <p class= "header">Powering Smarter Infrastructure.</p>
            <nav id="desktop_header" >
            <a  class = "desktop_header_text" href="about.php">About</a>
            <a  class = "desktop_header_text" href="apply.php">Apply</a>
            <a  class = "desktop_header_text" href="index.php">Index</a>
            <a  class = "desktop_header_text" href="jobs.php">Jobs</a>
            <a  class = "desktop_header_text" href="login.php">Login</a>
        </nav>
        </div>
    </header>
    
    </div>
    </div>
    <div class = "page_content"> <!-- This is the div that links up to the footer, putting everything in a giant flexbox -->

