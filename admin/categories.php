<?php
include('config.php');
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <?php include('head.php')?>
    <title>Category</title>
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
                            <h2 class="pull-left">Category Present</h2>
                            <a href="cat_create.php" class="btn btn-success pull-right"><i class="fa fa-plus"></i> Add New Category</a>
                        </div>
                        <?php
                        // Attempt select query execution
                        $sql = "SELECT * FROM category";
                        $i=1;
                        if($result = mysqli_query($con, $sql)){
                            if(mysqli_num_rows($result) > 0){

                                ?>
                                <table class="table table-bordered table-striped">
                                    <thead>
                                    <tr>
                                        <th>#</th>
                                        <th>Categories</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    <!--starting while loop-->
                                    <?php while($row = mysqli_fetch_array($result)){?>
                                    <tr>
                                        <td><?php echo $i++?> </td>
                                        <td><?php echo $row['Cat_Disc'] ?> </td>
                                        <td>
                                            <a href="cat_update.php?id=<?php echo $row['ID'] ?>" class="mr-3" title="Update Record" data-toggle="tooltip"><span class="fa fa-pencil-alt"></span></a>
                                            <a href="cat_delete.php?id=<?php echo $row['ID'] ?>" title="Delete Record" data-toggle="tooltip"><span class="fa fa-trash"></span></a>
                                        </td>
                                    </tr>
                                    <?php
                                    }
                                    // ending while loop
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


