<!DOCTYPE html>
<html lang="en">
    <head>
    <meta charset="UTF-8"> <!-- Character set -->
    <meta name="description" content="Apply page">
    <meta name="keywords" content="Application, Smart City, Energy, Employment, Infrastructure">
    <meta name="author" content="Alexandra Stanford">
    <title>InfraWatch - Apply</title>
    <link rel="stylesheet" href="styles/styles.css">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <style>
        /* Internal Css */
        legend{
            font-size: 1.5em;
            text-align:left;
        }
    </style>

    </head>
<body>
<?php
    $page_title = "Apply"; // Set the specific title for this page
    include 'header.inc'; 
    ?>

    <div id="applydiv">
    <h2>Apply for a position at InfraWatch</h2>

    <form action="process_eoi.php" method="post">
        <!--Reference number fieldset-->
        <fieldset>
            <?php
            // Check if the job_ref is set in the URL
            $job_ref_value = isset($_GET['job_ref']) ? $_GET['job_ref'] : '';
            ?>
        <legend>&nbsp;Reference Number:&nbsp;</legend>
            <label for="reference">Reference number:</label><br>
            <input type="text" id="reference" name="reference" placeholder="Job Reference Number" value="<?php echo htmlspecialchars($job_ref_value); ?>"
            pattern="^[a-zA-Z1-9]{1,20}$"><br> 
            <!--Exactly 5 alphanumeric characters-->
        </fieldset>
        <!--Personal details fieldset-->
        <fieldset>
        <legend>&nbsp;Personal details:&nbsp;</legend>
            <label for="firstname">First Name:</label><br>                          
            <input class="alphanumerical20" type="text" id="firstname" name="firstname" placeholder="First Name"
            pattern="^[a-zA-Z]{1,20}$"><br> 
            <!--Max 20 alphanumerical characters-->
            <label for="lastname">Last Name:</label><br>
            <input class="alphanumerical20" type="text" id="lastname" name="lastname" placeholder="Last Name" 
            pattern="^[a-zA-Z]{1,20}$"><br>
            <!--Max 20 alphanumerical characters-->
            <label for="dob">Date Of Birth:</label><br>
            <input type="date" id="dob" name="dob">
            <!--dd/mm/yyyy regex format-->
            <!--Gender fieldset-->
            <fieldset>
                <!--Gender radio fieldset-->
            <legend>&nbsp;Gender:&nbsp;</legend>

                <input type="radio" name="gender" value="female" id="female">
                        <label for="female">Female</label><br>

                <input type="radio" name="gender" value="male" id="male">
                        <label for="male">Male</label><br>

                <input type="radio" name="gender" value="non-binary" id="non-binary">
                        <label for="non-binary">Non-Binary</label><br>

                <input type="radio" name="gender" value="prefer_not_to_say" id="prefer_not_to_say">
                <label for="prefer_not_to_say">Prefer not to say</label><br>
                <!-- Custom Gender field, probably needs more work to post the value of the
                text box instead of posting seperately, probably needs JS but that isn't allowed -->
                <input type="radio" name="gender" value="other" id="other">
                <label for="other">Other:</label><br>
                <input type="text" name="other_gender" id="other_gender" placeholder="Please specify:">
            </fieldset>
        </fieldset>
        <!--Contact details fieldset-->
        <fieldset>
        <legend>&nbsp;Contact details:&nbsp;</legend>
            <!--Contact details-->
            <label for="address">Street Address:</label><br>
            <input class="char40" type="text" id="address" name="address" placeholder="Max 40 characters" 
            pattern="^{1,40}$"><br>
            <!--Max 40 characters-->  

            <label for="suburb">Suburb/Town:</label><br>
            <input class="char40" type="text" id="suburb" name="suburb" placeholder="Max 40 characters" 
            pattern="^{1,40}$"><br>  
            <!--Max 40 characters-->

            <label for="postcode">Postcode:</label><br>
            <input type="text" id="postcode" name="postcode" placeholder="0000" 
            pattern="^[0-9]{4}$"><br>  
            <!--4 digits 0-9-->
            <!--Add functionality for people applying from other countries?-->
            <label for="state">State:</label>
            <br>
            <select name="state" id="state" size = 1>
                <option value="">--Please select your state--</option>
                <option value="VIC">Victoria</option>
                <option value="NSW">New South Wales</option>
                <option value="QLD">Queensland</option>
                <option value="NT">Nothern Territory</option>
                <option value="WA">Western Australia</option>
                <option value="SA">South Australia</option>
                <option value="TAS">Tasmania</option>
                <option value="ACT">Australian Capital Territory</option>
            </select>
            <br>

            <label for="email">Email:</label><br>
            <input type="email" id="email" name="email" placeholder="example@example.com"><br>  
            <!--Email input type-->

            <label for="phone">Phone number:</label><br>
            <input type="text" id="phone" name="phone" placeholder="8-12 digits" 
            pattern="^[0-9]{8,12}$"><br>  
            <!--8-12 digits-->
            <!-- add functionaility for international phone numbers? -->

        </fieldset>
        <!--Skills/qualifications fieldset-->
        <fieldset>

        <legend>&nbsp;Skills / Qualifications:&nbsp;</legend>
                
            <input type="checkbox" name="skills[]" value="AI infrustructure" id="ai">
            <label for="ai">A stong and up to date understanding of AI infrustructure</label><br>

            <input type="checkbox" name="skills[]" value="3 Years of Senior Leadership" id="leadership">
            <label for="leadership">3 Years of Senior Leadership</label><br>

            <input type="checkbox" name="skills[]" value="A can do attitude" id="attitude">
            <label for="attitude">A can do attitude that is able to work around a dynamic team enviroment</label><br>

            <input type="checkbox" name="skills[]" value="valid driving license" id="licence">
            <label for="licence">A current and valid driving license</label><br>

            <input type="checkbox" name="skills[]" value="A working vehicle" id="car">
            <label for="car">A working vehicle capable of carrying light equipment such as cameras</label><br>

            <input type="checkbox" name="skills[]" value="3 years in a public facing role" id="public">
            <label for="public">3 years in a public facing role</label><br>

            <input type="checkbox" name="skills[]" value="Customer service management" id="customer">
            <label for="customer">Customer service management</label><br>

            <input type="checkbox" name="skills[]" value="Adobe suite experience" id="adobe">
            <label for="adobe">Adobe suite experience</label><br>
           
            <input type="checkbox" name="skills[]" value="Office 365 experience" id="office">
            <label for="office">Office 365 experience</label><br>

            <input type="checkbox" name="skills[]" value="A taste for good jokes and coffee" id="coffee">
            <label for="coffee">A taste for good jokes and coffee</label><br>
            <br>
            <label for="other-skills">Other Skills:</label>
            <br>
            <textarea name="other_skills" id="other_skills" cols="50" rows="5"
            placeholder="Enter other applicable skills here"
            style="resize:vertical; width: 98%;"></textarea>
            <!--^ inline CSS-->
            <br>

  

    </fieldset>


        <!--Book and reset form-->
        <input class="book" type="submit" value="Submit form">
        <input class="book" type="reset" value="Reset form">    


    </form>
</div>
    <?php include 'footer.inc'; ?>
</body>
</html>