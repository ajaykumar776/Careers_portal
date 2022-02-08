<?php
include('config.php');

 if(isset($_GET['id'])){
    $id  = $_GET['id'];
    $status = $_GET['st'];
    if($status == 0)
    {
        $query = "update candidates set status = '1' where id ='$id'";
    }
    else
    {
        $query = "update candidates set status = '2' where id ='$id'";
    }
    $query_run = mysqli_query($con,$query);

 };

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <?php include('head.php')?>
    <title>Registered Candidates</title>
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
                        <div class="mt-5 mb-3 clearfix">
                        <h2  class="pull-left">Registered Candidates</h2>
                            <span ><a href="candidate.php?s=0" data-toggle="tooltip" data-placement="bottom" title="Applied" class="btn btn-danger" style="color:black; font-size:15px;margin-left:500px;padding:10px">Applied...</a><a href="candidate.php?s=1" data-toggle="tooltip" data-placement="bottom" title="Enrolled" class="btn btn-warning" style="color:black; font-size:15px;margin-left:20px;padding:10px">Process...</a><a href="candidate.php?s=2" data-toggle="tooltip" data-placement="bottom" title="Enrolled" class="btn btn-success" style="color:black; font-size:15px;margin-left:20px;padding:10px">Enrolled...</a> <a href="candidate.php" data-toggle="tooltip" data-placement="bottom" title="Enrolled" class="btn btn-info" style="color:black; font-size:15px;margin-left:20px;padding:10px">All Candidates</a></span>
<!--                            <a href="cand_create.php" class="btn btn-success pull-right"><i class="fa fa-plus"></i> Add New Candidate</a>-->
                        </div>
                        <!-- <form action="">
                            
                            <div class="form-group">

                                <label for="name" style="margin-right:500px" name="name">Search by Name or Email</label>
                                <input style="width:300px" type="text" class="form-control" placeholder="Search by Name or Email" id="email" name="name"><span><br>
                                <input style="text-align: right;" type="submit"class="btn btn-success"></span>
                            </div>
                        </form> -->
                        <?php

                        // Attempt select query execution
                        if(isset($_GET['s']))
                        {
                            $status = $_GET['s'];
                            $sql = "SELECT * FROM `candidates` WHERE status = $status";

                        }else
                        {
                            $sql = "SELECT * FROM `candidates` ORDER BY id ASC";
                        }

                        $i=1;
                        if($result = mysqli_query($con, $sql)){
                            if(mysqli_num_rows($result) > 0){
                                ?>
                                <table class="table table-bordered table-striped">
                                    <thead>
                                    <tr>
                                        <th>#</th>
                                        <th>Candidate name</th>
                                        <th>Email</th>
                                        <th>Phone</th>
                                        <th>Status</th>
                                        <th>Action</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    <!--starting while loop-->
                                    <?php while($row = mysqli_fetch_array($result)){ ?>
                                        <tr>
                                            <td><?php echo $i++?> </td>
                                            <td><?php echo $row['name'] ?> </td>
                                            <td><?php echo $row['email'] ?> </td>
                                            <td><?php echo $row['phone'] ?> </td>
                                            <td>
												<?php if($row['status']=='0'){?>
													<a href="candidate.php?id=<?php echo $row['id'];?>&st= <?php echo $row['status']?>" data-toggle="tooltip" data-placement="bottom" title="Applied" class="btn btn-danger" style="color:black; font-size:15px">Applied...</a>
												<?php }?>
                                                <?php if($row['status'] == '1'){?>
													<a href="candidate.php?id=<?php echo $row['id'];?>&st= <?php echo $row['status']?>" data-toggle="tooltip" data-placement="bottom" title="Process" class="btn btn-warning" style="color:black">Process...</a>
												<?php }?>
                                                <?php if($row['status'] == '2'){?>
													<a href="#" data-toggle="tooltip" data-placement="bottom" title="Enrolled" class="btn btn-success" style="color:black">Enrolled...</a>
												<?php }?>
                                            </td>
                                            <td>
                                                <a href="cand_read.php?id=<?php echo $row['id'] ?>" class="mr-3" title="Update Record" data-toggle="tooltip"><span class="fa fa-eye"></span></a>
                                                <a href="cand_delete.php?id=<?php echo $row['id'] ?>" title="Delete Record" data-toggle="tooltip"><span class="fa fa-trash"></span></a>
                                            </td>
                                            
                                            
                                        </tr>
                                        
                                        <?php
                                       
                                    } // ending while loop
                                    ?>
                                    </tbody>
                                </table>
                                <?php
                                // Free result set
                                mysqli_free_result($result);
                            } else{
                                echo '<div class="alert alert-danger"><em>No records were found.</em></div>';
                            }//else of second IF condition
                        } else{
                            echo "Oops! Something went wrong. Please try again later.";
                        }//else of first IF condition

                        // Close connection
                        mysqli_close($con);
                        ?>
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

