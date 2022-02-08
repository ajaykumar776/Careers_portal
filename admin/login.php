<?php
include "config.php";
if(isset($_SESSION['email'])){
    header('Location: index.php');
}

$error   = "";
$message = "";
if($_SERVER['REQUEST_METHOD']=="POST")
{
    try{
        $useremail = trim($_POST['email']);
        $userpass  = trim($_POST['password']);
        if(!$useremail) throw new Exception("email is required");
        if(!$userpass) throw new Exception("password is required");
        
        $result = mysqli_query($con,"select * from admin where adm_email = '$useremail' and adm_pass = '$userpass'");
        $user = mysqli_fetch_assoc($result);

        if(!$user) throw new Exception("Correct Email And password is required !");
        if($user)
        {
            $_SESSION['email'] = $user['adm_email'];
            $_SESSION['id']    =  $user['id'];
            header('Location: index.php');

        }else
        {
            $error = "database error .....";
        }

    }catch(Exception $e){
        $error = $e->getmessage();
    }
}

?>


<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>login</title>

    <!-- Custom fonts for this template-->
    <link href="vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
    <link
        href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i"
        rel="stylesheet">

    <!-- Custom styles for this template-->
    <link href="css/sb-admin-2.min.css" rel="stylesheet">

</head>

<body class="bg-gradient-primary">

    <div class="container">

        <!-- Outer Row -->
        <div class="row justify-content-center">

            <div class="col-xl-10 col-lg-12 col-md-9">

                <div class="card o-hidden border-0 shadow-lg my-5">
                    <div class="card-body p-0">
                        <!-- Nested Row within Card Body -->
                        <div class="row">
                            <!-- <div class="col-lg-6 d-none d-lg-block bg-login-image"></div> -->
                            <div class="col-lg-6">
                                <div class="p-5">
                                    <div class="text-center">
                                        <h1 class="h4 text-gray-900 mb-4">Welcome!</h1>
                                    </div>
                                    <?php if($error){
                                            echo '<div class ="alert alert-danger">'.$error.'</div>';
                                        }?>
                                        <?php if($message):?>
                                            <div class="alert alert-success"><?php echo $message ?></div>
                                    <?php endif;?>
                                    <form class="user" method="POST" action="">
                                        <div class="form-group">
                                            <input type="email" class="form-control form-control-user"
                                                id="exampleInputEmail" aria-describedby="emailHelp"
                                                placeholder="Enter Email Address..." name="email">
                                        </div>
                                        <div class="form-group">
                                            <input type="password" class="form-control form-control-user"
                                                id="exampleInputPassword" placeholder="Password" name="password">
                                        </div>
                                        <input type="submit" class="btn btn-lg btn-info form-control" value="Login" name="login" href="index.html">
                                    </form>
                                    <hr>
                                    <div class="text-center">
                                        <a class="small" href="forgot-password.html">Forgot Password?</a>
                                    </div>
                                    <div class="text-center">
                                        <a class="large" href="../index.php">go back</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

            </div>

        </div>

    </div>

    <!-- Bootstrap core JavaScript-->
    <script src="vendor/jquery/jquery.min.js"></script>
    <script src="vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

    <!-- Core plugin JavaScript-->
    <script src="vendor/jquery-easing/jquery.easing.min.js"></script>

    <!-- Custom scripts for all pages-->
    <script src="js/sb-admin-2.min.js"></script>

</body>

</html>