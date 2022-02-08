<?php
// Include config file
require_once "config.php";

// Define variables and initialize with empty values
$skill = "";
$skill_err = "";

// Processing form data when form is submitted
if($_SERVER["REQUEST_METHOD"] == "POST"){

    // Validate skill
    $input_name = trim($_POST["skill"]);
    if(empty($input_name)){
        $skill_err = "Please enter a skill.";
    } elseif(!filter_var($input_name, FILTER_VALIDATE_REGEXP, array("options"=>array("regexp"=>"/^[a-zA-Z\s]+$/")))){
        $skill_err = "Please enter a valid skill.";
    } else{
        $skill = $input_name;
    }

    // Check input errors before inserting in database
    if(empty($skill_err)){
        // Prepare an insert statement
        $sql = "INSERT INTO skills (Skill_Disc) VALUES (?)";

        if($stmt = mysqli_prepare($con, $sql)){
            // Bind variables to the prepared statement as parameters
            mysqli_stmt_bind_param($stmt, "s", $param_name);

            // Set parameters
            $param_name = $skill;

            // Attempt to execute the prepared statement
            if(mysqli_stmt_execute($stmt)){
                // Records created successfully. Redirect to landing page
                header("location: skills.php");
                exit();
            } else{
                echo "Oops! Something went wrong. Please try again later.";
            }
        }

        // Close statement
        mysqli_stmt_close($stmt);
    }

    // Close connection
    mysqli_close($con);
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <?php include('head.php')?>
    <title>Create Record</title>
<!--    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">-->


    <style>
        .container-fluid{
            width: 600px;
            margin: 0 auto;
        }
    </style>
</head>
<body id="page-top">
<div id="wrapper">
    <?php include('./sidebar.php')?>
    <div id="content-wrapper" class="d-flex flex-column">
        <div id="content">
            <?php include('nav.php')?>
            <div class="container-fluid">
                <div class="row">
                    <div class="col-md-12">
                        <h2 class="mt-5">Create Record</h2>
                        <p>Please fill this form and submit to add skill record to the database.</p>
                        <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
                            <div class="form-group">
                                <label>Name</label>
                                <input type="text" name="skill" class="form-control <?php echo (!empty($skill_err)) ? 'is-invalid' : ''; ?>" value="<?php echo $skill; ?>">
                                <span class="invalid-feedback"><?php echo $skill_err;?></span>
                            </div>

                            <input type="submit" class="btn btn-primary" value="Submit">
                            <a href="skills.php" class="btn btn-secondary ml-2">Cancel</a>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
</div>
</div>
<?php include('footer.php')?>

<a class="scroll-to-top rounded" href="#page-top">
    <i class="fas fa-angle-up"></i>
</a>

<?php include('logout_model.php')?>

<?php include('script.php')?>

</body>
</html>