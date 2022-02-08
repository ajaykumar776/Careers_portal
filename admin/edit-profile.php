<?php
$id = $_SESSION['id'];
$error   = "";
$message = "";
$query= "select *from users where id =$_SESSION[id]";
$query_run = mysqli_query($con,$query);
$data = mysqli_fetch_assoc($query_run);

if($_SERVER['REQUEST_METHOD']=="POST")
{
    try{
        $email = trim($_POST['email']);
        if(!$email) throw new Exception("email is required");
        $id = $_SESSION['id'];
        $query = "update users set  email = '$email'where id ='$id'";
        $query_run = mysqli_query($con,$query);
        if($query_run)
        {
            $_SESSION['email'] = $email;
            $_SESSION['id']    = $id;
            $message ="you have successfully updated profile";
        }else
        {
            $error = "database error .....";
        }

    }catch(Exception $e){
        $error = $e->getmessage();
    }
}

?>

<div class="row">
    <div class="col-sm-4"></div>
    <div class="col-sm-4">
        <form action=""method="POST">
            <div class="card" style="width: 25rem; padding:5px">
                <div class="card-title" style="text-align:center;padding:2px;font-size:40px;">profile  <hr class="sidebar-divider"></div>
                <div class="card-body">
                    <span><label for="">Email</label></span><input type="text" name="email"id="" class="card-text form-control" value="<?php echo $_SESSION['email']; ?>"><br>
                    <input id="prodId" name="$_SESSION['id']" type="hidden" value="">
                </div>
                <input class="btn btn-info" type="submit" value="Edit">
            </div>
        </form>
    </div>
    <div class="col-sm-4">
    <?php if($error){
        echo '<div class ="alert alert-danger">'.$error.'</div>';
    }?>
    <?php if($message):?>
        <div class="alert alert-success"><?php echo $message ?></div>
    <?php endif;?>
    </div>
</div>
