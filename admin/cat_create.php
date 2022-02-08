<?php
// Include config file
require_once "config.php";

// Define variables and initialize with empty values
$categ = "";
$categ_err = "";

// Processing form data when form is submitted
if($_SERVER["REQUEST_METHOD"] == "POST"){

    // Validate category
    $input_name = trim($_POST["category"]);
    if(empty($input_name)){
        $categ_err = "Please enter a Category.";
    } elseif(!filter_var($input_name, FILTER_VALIDATE_REGEXP, array("options"=>array("regexp"=>"/^[a-zA-Z\s]+$/")))){
        $categ_err = "Please enter a valid Category.";
    } else{
        $categ = $input_name;
    }

    // Check input errors before inserting in database
    if(empty($categ_err)){
        // Prepare an insert statement
        $sql = "INSERT INTO category (Dom_Disc) VALUES (?)";

        if($stmt = mysqli_prepare($con, $sql)){
            // Bind variables to the prepared statement as parameters
            mysqli_stmt_bind_param($stmt, "s", $param_name);

            // Set parameters
            $param_name = $categ;

            // Attempt to execute the prepared statement
            if(mysqli_stmt_execute($stmt)){
                // Records created successfully. Redirect to landing page
                header("location: categories.php");
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
    <title>Create Category</title>
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
                <p>Please fill this form and submit to add category record to the database.</p>
                <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
                    <div class="form-group">
                        <label>Name</label>
                        <input type="text" name="category" class="form-control <?php echo (!empty($categ_err)) ? 'is-invalid' : ''; ?>" value="<?php echo $categ; ?>">
                        <span class="invalid-feedback"><?php echo $categ_err;?></span>
                    </div>

                    <input type="submit" class="btn btn-primary" value="Submit">
                    <a href="categories.php" class="btn btn-secondary ml-2">Cancel</a>
                </form>
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