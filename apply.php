<?php 
    session_start();
    if (isset($_SESSION["errors"])){
    $errors = $_SESSION["errors"];
    }
    if (isset($_SESSION["id"])){
    $id = $_SESSION["id"];
    }
?>
<!DOCTYPE html>
<html lang="en">
    <head>
    <meta charset="UTF-8"> <!-- Character set -->
    <meta name="description" content="Apply page">
    <meta name="keywords" content="Application, Smart City, Energy, Employment, Infrastructure">
    <meta name="author" content="Alexandra Stanford">
    <link rel="stylesheet" href="styles/styles.css">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <style>
        /* Internal Css */
        legend{
            font-size: 1.5em;
            text-align:left;
        }
    </style>
<?php
    $page_title = "Apply"; // Set the specific title for this page
    include 'header.inc';
    ?>


   
    <div id="applydiv">
    <h2>Apply for a position at InfraWatch</h2>

    <form action="process_eoi.php" method="post">
        <!--Reference number fieldset-->
        <fieldset>
        <legend>&nbsp;Reference Number:&nbsp;</legend>
            <label for="reference">Reference number:</label><br>

             <?php 
             $job_ref_value = isset($_GET['job_ref']) ? $_GET['job_ref'] : '';
             if (isset($_SESSION['reference'])){
             $job_ref_value = $_SESSION['reference'];
             }
             require_once("settings.php"); 
            $conn = mysqli_connect($host, $username, $password, $database );
            if(!$conn) {
                echo "<p>Database connection failed: ". mysqli_connect_error()."</p>";
            }
            else{
                $sql = "SELECT job_ref, job_title FROM jobs";
                $result = mysqli_query($conn, $sql);
                if($result && mysqli_num_rows($result) > 0){
                    echo "<select name='reference' id='reference' size = 1>";
                    echo "<option value=''>--Please select your job--</option>";
                while($row = mysqli_fetch_assoc($result)){
                        $job_ref = htmlspecialchars($row['job_ref']);
                        $job_title = htmlspecialchars($row['job_title']);
                        $value = $job_ref . "-" . $job_title;
                        $selected = ($job_ref == $job_ref_value) ? "selected='selected'" : "";
                        echo "<option value='$job_ref' $selected>($job_ref) - $job_title</option>";
                    };
                    echo "</select>";
                };
            mysqli_close($conn);
            };
            ?>
        </fieldset>
        <!--Personal details fieldset-->
        <fieldset>
        <legend>&nbsp;Personal details:&nbsp;</legend>
            <label for="firstname">First Name:</label><br>                          
            <input class="alphanumerical20" type="text" id="firstname" name="firstname" placeholder="Max 20 characters"
            value="<?php echo isset($_SESSION['firstname']) ? htmlspecialchars($_SESSION['firstname']) : ''; ?>"><br> 

            <label for="lastname">Last Name:</label><br>
            <input class="alphanumerical20" type="text" id="lastname" name="lastname" placeholder="Max 20 characters"
            value="<?php echo isset($_SESSION['lastname']) ? htmlspecialchars($_SESSION['lastname']) : ''; ?>"><br>

            <label for="dob">Date Of Birth:</label><br>
            <input type="date" id="dob" name="dob"
            value="<?php echo isset($_SESSION['dob']) ? htmlspecialchars($_SESSION['dob']) : ''; ?>">

            <!--Gender fieldset-->
            <fieldset>
                <!--Gender radio fieldset-->
            <legend>&nbsp;Gender:&nbsp;</legend>

                <input type="radio" name="gender" value="female" id="female"
                <?php if (isset($_SESSION['gender'])){
                    if (preg_match("/female/", $_SESSION['gender'])){
                    echo "checked = checked";
                    }
                }
                ?>>
                        <label for="female">Female</label><br>

                <input type="radio" name="gender" value="male" id="male"
               <?php if (isset($_SESSION['gender'])){
                    if (preg_match("/male/", $_SESSION['gender'])){
                    echo " checked = checked";
                    }
                }
                ?>>
                        <label for="male">Male</label><br>

                <input type="radio" name="gender" value="non-binary" id="non-binary"
                <?php if (isset($_SESSION['gender'])){
                    if (preg_match("/non-binary/", $_SESSION['gender'])){
                    echo " checked = checked";
                    }
                }
                ?>>
                        <label for="non-binary">Non-Binary</label><br>

                <input type="radio" name="gender" value="prefer_not_to_say" id="prefer_not_to_say"
                <?php if (isset($_SESSION['gender'])){
                    if (preg_match("/prefer_not_to_say/", $_SESSION['gender'])){
                    echo " checked = checked";
                    }
                }else
                ?>>
                <label for="prefer_not_to_say">Prefer not to say</label><br>

                <input type="radio" name="gender" value="other" id="other"
                <?php if (isset($_SESSION['gender'])){
                    if (!preg_match("/female|male|non-binary|prefer_not_to_say/", $_SESSION['gender'])){
                    echo "checked = checked";
                    }
                }
                ?>>
                <label for="other">Other:</label><br>
                <input type="text" name="other_gender" id="other_gender" placeholder="Please specify:"
                <?php if (isset($_SESSION['gender'])){
                    if (!preg_match("/female|male|non-binary|prefer_not_to_say/", $_SESSION['gender'])){
                    echo "value =", htmlspecialchars($_SESSION['gender']);
                    }
                }
                ?>>
            </fieldset>
        </fieldset>
        <!--Contact details fieldset-->
        <fieldset>
        <legend>&nbsp;Contact details:&nbsp;</legend>
            <!--Contact details-->
            <label for="address">Street Address:</label><br>
            <input class="char40" type="text" id="address" name="address" placeholder="Max 40 characters" 
            value="<?php echo isset($_SESSION['address']) ? htmlspecialchars($_SESSION['address']) : ''; ?>"><br>
            <!--Max 40 characters-->  

            <label for="suburb">Suburb/Town:</label><br>
            <input class="char40" type="text" id="suburb" name="suburb" placeholder="Max 40 characters" 
            value="<?php echo isset($_SESSION['suburb']) ? htmlspecialchars($_SESSION['suburb']) : ''; ?>"><br>  
            <!--Max 40 characters-->

            <label for="postcode">Postcode:</label><br>
            <input type="text" id="postcode" name="postcode" placeholder="0000" 
            value="<?php echo isset($_SESSION['postcode']) ? htmlspecialchars($_SESSION['postcode']) : ''; ?>"><br>  
            <!--4 digits 0-9-->
            <!--Add functionality for people applying from other countries?-->
            <label for="state">State:</label>
            <br>
            
            <select name="state" id="state" size = 1>
                <option value="">--Please select your state--</option>
                <option value="VIC" <?php if (isset($_SESSION['state']) && preg_match("/VIC/", $_SESSION['state'])){
                    echo "selected";
                }?>
                >Victoria</option>
                <option value="NSW"<?php if (isset($_SESSION['state']) && preg_match("/NSW/", $_SESSION['state'])){
                    echo "selected";
                }?>
                >New South Wales</option>
                <option value="QLD" <?php if (isset($_SESSION['state']) && preg_match("/QLD/", $_SESSION['state'])){
                    echo "selected";
                }?>
                >Queensland</option>
                <option value="NT"<?php if (isset($_SESSION['state']) && preg_match("/NT/", $_SESSION['state'])){
                    echo "selected";
                }?>
                >Nothern Territory</option>
                <option value="WA"<?php if (isset($_SESSION['state']) && preg_match("/WA/", $_SESSION['state'])){
                    echo "selected";
                }?>
                >Western Australia</option>
                <option value="SA"<?php if (isset($_SESSION['state']) && preg_match("/SA/", $_SESSION['state'])){
                    echo "selected";
                }?>
                >South Australia</option>
                <option value="TAS"<?php if (isset($_SESSION['state']) && preg_match("/TAS/", $_SESSION['state'])){
                    echo "selected";
                }?>
                >Tasmania</option>
                <option value="ACT"<?php if (isset($_SESSION['state']) && preg_match("/ACT/", $_SESSION['state'])){
                    echo "selected";
                }?>
                >Australian Capital Territory</option>
            </select>
            <br>

            <label for="email">Email:</label><br>
            <input type="email" id="email" name="email" placeholder="example@example.com"
            value="<?php echo isset($_SESSION['email']) ? htmlspecialchars($_SESSION['email']) : ''; ?>"><br>  
            <!--Email input type-->

            <label for="phone">Phone number:</label><br>
            <input type="text" id="phone" name="phone" placeholder="8-12 digits" 
            value="<?php echo isset($_SESSION['phone']) ? htmlspecialchars($_SESSION['phone']) : ''; ?>"><br>  
            <!--8-12 digits-->
            <!-- add functionaility for international phone numbers? -->

        </fieldset>
        <!--Skills/qualifications fieldset-->
        <fieldset>

        <legend>&nbsp;Skills / Qualifications:&nbsp;</legend>
                
            <input type="checkbox" name="skills[]" value="AI infrastructure" id="ai"
            <?php if (isset($_SESSION['skills']) && preg_match("/AI infrastructure/", $_SESSION['skills'])){
                    echo "checked";
                }?>>
            <label for="ai">A stong and up to date understanding of AI infrustructure</label><br>

            <input type="checkbox" name="skills[]" value="3 Years of Senior Leadership" id="leadership"
            <?php if (isset($_SESSION['skills']) && preg_match("/3 Years of Senior Leadership/", $_SESSION['skills'])){
                    echo "checked";
                }?>>
            <label for="leadership">3 Years of Senior Leadership</label><br>

            <input type="checkbox" name="skills[]" value="A can do attitude" id="attitude"
            <?php if (isset($_SESSION['skills']) && preg_match("/A can do attitude/", $_SESSION['skills'])){
                    echo "checked";
                }?>>
            <label for="attitude">A can do attitude that is able to work around a dynamic team enviroment</label><br>

            <input type="checkbox" name="skills[]" value="valid driving license" id="licence"
            <?php if (isset($_SESSION['skills']) && preg_match("/valid driving license/", $_SESSION['skills'])){
                    echo "checked";
                }?>>
            <label for="licence">A current and valid driving license</label><br>

            <input type="checkbox" name="skills[]" value="A working vehicle" id="car"
            <?php if (isset($_SESSION['skills']) && preg_match("/A working vehicle/", $_SESSION['skills'])){
                    echo "checked";
                }?>>
            <label for="car">A working vehicle capable of carrying light equipment such as cameras</label><br>

            <input type="checkbox" name="skills[]" value="3 years in a public facing role" id="public"
            <?php if (isset($_SESSION['skills']) && preg_match("/3 years in a public facing role/", $_SESSION['skills'])){
                    echo "checked";
                }?>>
            <label for="public">3 years in a public facing role</label><br>

            <input type="checkbox" name="skills[]" value="Customer service management" id="customer"
            <?php if (isset($_SESSION['skills']) && preg_match("/Customer service management/", $_SESSION['skills'])){
                    echo "checked";
                }?>>
            <label for="customer">Customer service management</label><br>

            <input type="checkbox" name="skills[]" value="Adobe suite experience" id="adobe"
            <?php if (isset($_SESSION['skills']) && preg_match("/Adobe suite experience/", $_SESSION['skills'])){
                    echo "checked";
                }?>>
            <label for="adobe">Adobe suite experience</label><br>
           
            <input type="checkbox" name="skills[]" value="Office 365 experience" id="office"
            <?php if (isset($_SESSION['skills']) && preg_match("/Office 365 experience/", $_SESSION['skills'])){
                    echo "checked";
                }?>>
            <label for="office">Office 365 experience</label><br>

            <input type="checkbox" name="skills[]" value="A taste for good jokes and coffee" id="coffee"
            <?php if (isset($_SESSION['skills']) && preg_match("/A taste for good jokes and coffee/", $_SESSION['skills'])){
                    echo "checked";
                }?>>
            <label for="coffee">A taste for good jokes and coffee</label><br>
            <br>
            <label for="other_skills">Other Skills:</label>
            <br>
            <textarea name="other_skills" id="other_skills" cols="50" rows="5"
            style="resize:vertical; width: 98%;"
            ><?php echo isset($_SESSION['other_skills']) ? htmlspecialchars($_SESSION['other_skills']) : ''; ?></textarea>
            <!--^ inline CSS-->
            <br>

  

    </fieldset>


        <!--Book and reset form-->
        <input class="book" type="submit" value="Submit form">
        <input class="book" type="reset" value="Reset form" onClick="window.location.reload()">
        


    </form>
    <div id="results">
    <?php
    if (isset($errors)){
         foreach ($errors as $error) {
            echo "<p style='color:red;'>" . htmlspecialchars($error) . "</p>";
         }
        echo "<p><strong>Please go back and fix the errors.</strong></p>";
    }
    if (isset($id)){
        echo "<p style='color:green;'><strong>Submitted, your EOI number is: " . htmlspecialchars($id) ."</strong></p>";
    }
        ?>
    </div>
</div>
    <?php include 'footer.inc'; 
            session_unset();      // Unset all session variables
        session_destroy();    // Destroy the session>
?>
</body>
</html>