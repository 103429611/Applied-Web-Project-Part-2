<!DOCTYPE html>
<html lang="en">
 
<!-- TASKS ASSIGNED -->
<!-- Need to add Company logo, name, slogan, description, and image -->
<!-- Need to add common navigation menu used across all pages -->
<!-- Need to add a footer (Jira project link, GitHub repository link, Email link) -->
<!-- Need to add at least one table using cell merging -->
<!-- Need to add a search box with a button -->
<!-- Need to add Acknowledgement of Country section -->
<!-- AI USE ACKNOWLEDGEMENT: The InfraWatch logo (logo.png) was generated using Canva AI.
     Prompt used: "a camera lens inside a circuit"
     Source: https://www.canva.com -->

<head>
    <meta charset="UTF-8"> <!-- Character set -->
    <meta name="description" content="InfraWatch - Smart City Infrastructure Monitoring"> <!-- Page description -->
    <meta name="keywords" content="smart city, infrastructure, AI cameras, government, monitoring"> <!-- Keywords will help in SEO -->
    <meta name="author" content="Noor Fatima Nisar"> <!-- Taking credit of my work hehe -->
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="styles/styles.css"> 
    
    <style>
       .hero-section {
          position: relative;
          overflow: hidden;
        }

        .hero-section::before {
          content: "";
          position: absolute;
          inset: 0;
          background-image: url("images/smartcity.jpg");
          background-size: cover;
          background-position: center;
          opacity: 0.15;   /* lower = more transparent */
          z-index: 0;
        }

        .hero-section > * {
          position: relative;
          z-index: 1;   /* keeps text above the background */
        }
    </style>
    <?php
    $page_title = "Index"; // Set the specific title for this page
    include 'header.inc'; 
?>
</head>
<body>

<main>
    <section class="hero-section">
        <h2>Who Are We?</h2>
        <p>Cities are complex, but we make them readable. InfraWatch partners with councils and industries to build digital platforms that turn the noise of urban infrastructure into clear, actionable data across smart transport, energy monitoring, and urban services management.</p>
        <img src="images/smartcity.jpg" alt="smart city infrastructure monitoring" style="width: 50%; border-radius: 10px;">
        <hr>
    </section>

    <section class="stats-bar">
     <h2 class="visually-hidden">Key Statistics</h2>
        <article class="stat-item">
          <h3 class="visually-hidden">Council & Industry Partners</h3>
          <strong class="stat-number">15+</strong>
          <span class="stat-label">Council & Industry Partners</span>
        </article>
        <article class="stat-item">
          <h3 class="visually-hidden">Digital Platforms Delivered</h3>
          <strong class="stat-number">5+</strong>
          <span class="stat-label">Digital Platforms Delivered</span>
        </article>
        <article class="stat-item">
          <h3 class="visually-hidden">Real-time Monitoring</h3>
          <strong class="stat-number">24/7</strong>
          <span class="stat-label">Real-time Monitoring</span>
        </article>
        <article class="stat-item">
          <h3 class="visually-hidden">States Reached</h3>
          <strong class="stat-number">3</strong>
          <span class="stat-label">States Reached</span>
        </article>
   </section>

    <section>
        <h2>What Do We Do?</h2>
        <table>
            <caption>InfraWatch Service Overview</caption>
            <tr>
                <th colspan="2">Our Monitoring Solutions</th> <!-- will merge the this in the 2 columns top -->
            </tr>
            <tr>
                <th>Service</th>
                <th>Description</th>
            </tr>
            <tr>
                <td>Smart Transport</td>
                <td>Digital platforms that monitor traffic flow and road networks to improve safety and planning</td>
            </tr>
            <tr>
                <td>Energy Monitoring</td>
                <td>Real-time data tools tracking energy use and infrastructure performance</td>
            </tr>
            <tr>
                <td>Strategic Planning Support</td>
                <td>Data-driven insights to guide better infrastructure and policy decisions</td>
            </tr>
            <tr>
                <td>Urban Services Management</td>
                <td>Integrated systems helping councils manage and optimise city services</td>
            </tr>
        </table>
    </section>

    <section>
        <h2>Search Our Site</h2>
        <div class="search-container">
            <label for="site-search" class="visually-hidden">Search</label>
            <input type="text" id="site-search" placeholder="Search"> <!-- the type text makes it a text input box and placeholder is just the hint inside the box-->
            <button>Search</button> <!-- this is the clickable button -->
        </div>
    </section>

    <section>
        <h2>Acknowledgement of Country</h2>
        <div class="aoc-box">
            <p>InfraWatch respectfully acknowledges Aboriginal and Torres Strait Islander peoples as the Traditional Custodians of the lands, waters, and skies across Australia, including every community where we live, work, and build. Their deep knowledge of Country is not just history; it is living wisdom that has shaped this land for tens of thousands of years. As an organisation working across Australian infrastructure, we are committed to listening, partnering, and ensuring our work contributes to better outcomes for First Nations communities. We pay our respects to Elders past, present, and emerging, and strongly encourage Aboriginal and Torres Strait Islander peoples to apply and grow with us.</p>
        </div>
    </section>

</main>

    <?php include 'footer.inc'; ?>

</body>
</html>