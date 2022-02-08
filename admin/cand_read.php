<?php
$error = "";
require('config.php');

//candidates
$id = $_GET['id'];
$query = "select * from candidates where id = $id";
$query_run = mysqli_query($con,$query);
$row = mysqli_fetch_assoc($query_run);
if(mysqli_num_rows($query_run) > 0){
    //category
    $category_id  = $row['category'];
    $category = "select * from category where id = $category_id";
    $query_run2 = mysqli_query($con,$category);
    $cat = mysqli_fetch_assoc($query_run2);
    //skills
    $skills ="SELECT c.id, c.name, s.Skill_Disc FROM `cand_skills` cs left join candidates c on cs.Cand_ID = c.id left join skills s on cs.Skill_ID = s.id WHERE c.id =$id";
    $query_run1 = mysqli_query($con,$skills);
    while($row1 = mysqli_fetch_array($query_run1)){
        $data [] = $row1['Skill_Disc'];
    }
}else
{
$error = "data not found";
}
       
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <?php include('head.php')?>
    <title>View Details</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
<style>
    .container-fluid{
            width: 600px;
            margin: 0 auto;
        }
.user_card {
  box-shadow: 0 4px 8px 0 rgba(0, 0, 0, 0.2);
  max-width: 900px;
  margin: auto;
  text-align: center;
  font-family: arial;
}

.user_title {
  color: grey;
  font-size: 18px;
}

/* button {
  border: none;
  outline: 0;
  display: inline-block;
  padding: 8px;
  color: white;
  background-color: #000;
  text-align: center;
  cursor: pointer;
  width: 100%;
  font-size: 18px;
} */

/* a {
  text-decoration: none;
  font-size: 22px;
  color: black;
} */

/* button:hover, a:hover {
  opacity: 0.7;
} */
</style>
</head>
<body id="page-top">
<div id="wrapper">
    <?php include('./sidebar.php')?>
    <div id="content-wrapper" class="d-flex flex-column">
        <div id="content">
            <?php include('nav.php')?>
     <!-- profile card -->
            <!-- <h2 style="text-align:center">User Profile card</h2> -->

            <div  class="card user_card">
                <h1 style="color: red;"><?php echo $error ? $error :""?></h1>
                <p style="text-align: right;padding:5px;margin-top:0px"><a href="candidate.php" class="btn btn-danger" style="text-align: left;padding:7px;margin-right:700px">Back</a><a href="cand_read.php?id=<?php echo $row['id'] ? $row['id']-1:"4" ?>" class="btn btn-success">prev</a> <a href="cand_read.php?id=<?php echo $row['id'] ? $row['id']+1:"4" ?>" class="btn btn-success">Next</a></p>
                <p style="text-align: left;padding:5px"></p>
                <?php
                
                if($error)
                {
                    '<p style="text-align: left;padding:5px"><a href="candidate.php" class="btn btn-secondary">Back</a></p>';
                    die;
                } ?>
                
                <h1><?php echo $row["name"]; ?></h1>
                <p style="color: black; font-size:20px" class="title user_title"><?php echo $row["degree"].",".$row["college"].",".$row["gradyear"]; ?></p>
                <p></p>
                <div class="row">
                    <div class="col-sm-2" ></div>
                    <div class="col-sm-4" style=" text-align: left;"><b>Phone: </b><?php echo $row["phone"]; ?></div>
                    <div class="col-sm-6" style=" text-align: left;"><b>Email: </b><?php echo $row["email"]; ?></div>
                </div>
                <div class="row">
                     <div class="col-sm-2" ></div>
                    <div class="col-sm-4" style=" text-align: left;"><b>Gender: </b><?php echo $row["gender"]; ?></div>
                    <div class="col-sm-6" style=" text-align: left;" ><b>Adress: </b><?php echo $row["adress"]; ?></div>
                </div>
                <div class="row">
                    <div class="col-sm-2" ></div>
                    <div class="col-sm-4" style=" text-align: left;"><b>Experience: </b><?php echo $row["experience"]; ?></div>
                    <div class="col-sm-6" style=" text-align: left;"><b>Availability: </b><?php echo $row["availability"]; ?></div>
                </div>
                <div class="row">
                    <div class="col-sm-2" ></div>
                    <div class="col-sm-4" style=" text-align: left;"><b>Portfolio: </b> <a href="<?php echo $row["portfolio"]; ?>" target=""><?php echo $row["portfolio"] ?></a></div>
                    <div class="col-sm-6" style=" text-align: left;"><b>Project: </b><?php echo $row["project"]; ?></div>
                </div>
                <p></p>
                <div class="row">

                    <div class="col-sm-6">
                        <div class="form-group">
                            <p></p>
                            <iframe src="../uploads/<?php echo $row["resume"]; ?>" width="90%" height="500px">
                            </iframe>
                            <a href="../uploads/<?php echo $row["resume"]; ?>" class="btn btn-primary">Download Resume</a>
                        </div>
                    </div>
                    <div class="col-sm-5" style="margin-top: 20px;">
                        <div class="card" width="30px">
                            <div class="card-header">
                                    <h2>Skills</h1>
                            </div>
                            <div class="card-body">
                                <ul style="text-align: left;">
                                    <u><p style="font-size: 20px;"><?php echo  $cat['Cat_Disc'] ?></p></u>
                                    <?php foreach($data as $dt) {?>.
                                    <li><?php echo $dt ?></li>
                                    <?php }?>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
                <br>
                <br>
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