<?php include "admin/config.php"?>
<?php
$error="";
$message="";

if($_SERVER['REQUEST_METHOD'] == "POST")
{
    try{
      if (empty($_POST["skills"])) {
        $data="";
      } else {
        $data=$_POST['skills'];
      }
      
       $name= trim($_POST['name']);

       if (empty($_POST["gender"])) {
         $gender="";
     } else {
        $gender = trim($_POST['gender']);
     }

       $email= trim($_POST['email']);
       $adress = trim($_POST['adress']);
       $phone = trim($_POST['phone']);
       $gradyear= trim($_POST['gradyear']);
       $college = trim($_POST['college']);
       $degree= trim($_POST['degree']);
       $experience= trim($_POST['experience']);
       $availability = trim($_POST['availability']);
       if (empty($_POST["fromhome"])) {
        $fromhome="";
      } else {
         $fromhome = trim($_POST['fromhome']);
      }
       $portfolio= trim($_POST['portfolio']);
       $project = trim($_POST['project']);
       if (empty($_POST["category"])) {
        $category="";
      } else {
         $category = trim($_POST['category']);
      }
        
       if(!$name) throw new Exception ("Name is required");
       if(!$gender) throw new Exception ("gender is required");
       if(!$email) throw new Exception ("Email is Reqired");
       if(!$adress) throw new Exception ("adress is required");
       if(!$phone) throw new Exception ("phone name is required");
       if(!$gradyear) throw new Exception ("gradyear is required");
       if(!$college) throw new Exception ("college is required");
       if(!$degree) throw new Exception ("degree is required");
       if(!$data) throw new Exception ("skills is required");
       if(!$category) throw new Exception ("category is required");
       if(!$_FILES["resume"]["name"]) throw new Exception ("resume is required");
    //   if(!$experience) throw new Exception ("Experience is Reqired");
    //   if(!$availability) throw new Exception ("availability is required");
      if(!$fromhome) throw new Exception ("work from home section is required");
    //   if(!$portfolio) throw new Exception ("portfolio is required");
    //   if(!$project) throw new Exception ("project is required");

    // checking email duplicacy

    $sql = "SELECT * FROM candidates WHERE email='$email'" ;
  
         $result = mysqli_query($con, $sql ) ;
  
         if( mysqli_num_rows( $result ) > 0 )
         {
          $error="email already exists";
         
         }
         else{
        
            // uploading resume file
            $filename= rand(10,1000)."-".$_FILES["resume"]["name"];
            $target_dir = "uploads/";
            $target_file = $target_dir . $filename;
            $uploadOk = 1;
            $imageFileType = strtolower(pathinfo($target_file,PATHINFO_EXTENSION));
                      
                       
                        // Check if image file is a actual image or fake image
                        if(isset($_POST["submit"])) {
                        $check = getimagesize($_FILES["resume"]["tmp_name"]);
                        if($check !== false) {
                            echo "File is an image - " . $check["mime"] . ".";
                            $uploadOk = 1;
                        } else {
                            echo "File is not an image.";
                            $uploadOk = 0;
                        }
                        }

                       

                       // Check file size
                        if ($_FILES["resume"]["size"] > 2000000) {
                        echo "Sorry, your file is too large.";
                        $uploadOk = 0;
                        }

                     // Check if $uploadOk is set to 0 by an error
                      if ($uploadOk == 0) {
                           echo "Sorry, your file was not uploaded.";
                    // if everything is ok, try to upload file
                      } else {
                         if (move_uploaded_file($_FILES["resume"]["tmp_name"], $target_file)) {
                            //echo "The file ". htmlspecialchars( basename( $_FILES["resume"]["name"])). " has been uploaded.";
                          } 
                                  
        }

        $sql= "INSERT into candidates VALUES ('','$name','$email','$gender','$phone','$category','$adress','$gradyear','$college','$degree','$experience','$availability','$fromhome','$portfolio','$project','$filename','0',current_timestamp())";
        if(mysqli_query($con,$sql))
        {
          $result = mysqli_query($con,"select id from candidates where email = '$email'");
          $user = mysqli_fetch_assoc($result);
          $id= $user['id'];
          // inserting candidate skills
          foreach ($data as $dt)
          {
              $query= "INSERT INTO cand_skills VALUES ('','$id','$dt')";     
              mysqli_query($con,$query);
          }
         $message= "You have successfully registered for internship";
        
        }else
        {
         $error= "Something Went Wrong.";
        }
        
      }
    }catch(Exception $e){
        $error= $e->getMessage();
    }
}

?>

<!DOCTYPE html>
<html>
<head>
        <meta charset="utf-8" />
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
        <meta name="description" content="" />
        <meta name="author" content="" />
        <title>Redgates|Carriers</title>
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
        <!-- Favicon-->
        <link rel="icon" type="image/x-icon" href="css/l.png">
        <!-- Font Awesome icons (free version)-->
        <script src="https://use.fontawesome.com/releases/v5.15.3/js/all.js" crossorigin="anonymous"></script>
        <!-- Simple line icons-->
        <link href="https://cdnjs.cloudflare.com/ajax/libs/simple-line-icons/2.5.5/css/simple-line-icons.min.css" rel="stylesheet" />
        <!-- Google fonts-->
        <link href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,700,300italic,400italic,700italic" rel="stylesheet" type="text/css" />
        <!-- Core theme CSS (includes Bootstrap)-->
        <link href="css/styles.css" rel="stylesheet" />
        <link href="css/style.css" rel="stylesheet" />
        <!-- JS & CSS library of MultiSelect plugin -->
        <script src="https://phpcoder.tech/multiselect/js/jquery.multiselect.js"></script>
        <link rel="stylesheet" href="https://phpcoder.tech/multiselect/css/jquery.multiselect.css">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link href="https://fonts.googleapis.com/css?family=Raleway" rel="stylesheet">
</head>
<body>
<?php include('nav_c.php'); ?>
<form id="regForm" method="POST" enctype="multipart/form-data" action="">
<?php if($error){
               echo '<div  class="alert alert-danger">'.$error.'</div>';
           }?>
           <?php if($message){
            echo '<div class="alert alert-success">'.$message.'</div>';
           }?>
 <h1>Apply for Internship</h1><hr style="color: blue;height:10px">
  <!-- One "tab" for each step in the form: -->
  <div class="tab">Basic details:
    <p><input type="text" placeholder="Name..." oninput="this.className = ''" name="name"></p>
    <p><div class="form-group row">
              <!-- <label class="col-sm-1 " for="address">Gender:</label> -->
              <div class="col-sm-12">            
                <select class="browser-default custom-select" name="gender" >
                    <option value="0" disabled selected>Choose Gender</option>
                    <option value="Male" required>Male</option>
                    <option value="Female" required>Female</option>
                    <option value="Others" required>Others</option>
                    <?php
                    ?>
                  </select>
              </div>
          </div></p>
    <p><input type="number" placeholder="Phone..." oninput="this.className = ''" name="phone"></p>
    <p><input type="email" placeholder="E-mail..." oninput="this.className = ''" name="email"></p>
    
    
  </div>
  <div class="tab">Education:
  <p><input type="text" placeholder="Adress..." oninput="this.className = ''" name="adress"></p>
    <p><input type="text" placeholder="college name" oninput="this.className = ''" name="college"></p>
     <p><input type="text" placeholder="degree" oninput="this.className = ''" name="degree"></p>
    <p><input type="number" placeholder="graduation year" oninput="this.className = ''" name="gradyear"></p>
  
     
  </div>
  <div class="tab">Additional details: <br>
  <p><input type="text" placeholder="experience..." oninput="this.className = ''" name="experience"></p>
   <p><input type="text" placeholder="availability..." oninput="this.className = ''" name="availability"></p>
   <p><div class="form-group row">
              <div class="col-sm-12">            
                <select class="browser-default custom-select" name="fromhome" >
                    <option value="0" disabled selected>Are you available for Work from Home</option>
                    <option value="Yes" required>Yes</option>
                    <option value="No" required>No</option>
                    <?php
                    ?>
                  </select>
              </div>
          </div></p>
   <p><input type="text" placeholder="Portfolio link...(if any)" oninput="this.className = ''" name="portfolio"></p>
    <p><input type="text" placeholder="Projects...(if any)" oninput="this.className = ''" name="project"></p>

  
  
  </div>
  <div class="tab">Choose:<br>

  <div class="form-group row">
              <div class="col-sm-1"></div>
              <label class="col-sm-2 " for="address">Skills:</label>
              <div class="col-sm-7" id="skillselect">            
                <select class="browser-default custom-select" multiple data-mdb-filter="true"  name="skills[]" id="skillOpt">
                    
                    <?php 
                      include"config.php";
                      $sql=mysqli_query($con,"SELECT * FROM skills");
                      
                        while($row=mysqli_fetch_assoc($sql)){
                          
                      
                      ?>
                    <option value="<?=$row['id']?>" required><?=$row['Skill_Disc']?></option>
                    <?php
                        }
                    ?>
                  </select>
                
                 <script>
                 $('#skillOpt').multiselect({
                  columns: 1,
                  placeholder: 'Choose Skills',
                  search: true
                  });
                  </script>             
              </div>
              
          </div>

           <!-- category -->

          <div class="form-group row">
              <div class="col-sm-1"></div>
              <label class="col-sm-2 " for="address">Category:</label>
              <div class="col-sm-7">            
                <select class="browser-default custom-select" name="category" >
                    <option value="0" disabled selected>Choose category</option>
                    <?php 
                      include"config.php";
                      $sql=mysqli_query($con,"SELECT * FROM category");
                      
                        while($row=mysqli_fetch_assoc($sql)){
                          
                      
                      ?>
                    <option value="<?=$row['id']?>" required><?=$row['Cat_Disc']?></option>
                    <?php
                        }
                    ?>
                  </select>

                  
              </div>
              
          </div>
  <p>
       Attach your resume below (less than 2 mb)
       <input type="file" placeholder="resume..." oninput="this.className = ''" name="resume"></p>
  </div>
  <div style="overflow:auto;">
    <div style="float:right;">
      <button type="button" id="prevBtn" onclick="nextPrev(-1)"class="btn btn-lg btn-primary">Previous</button>
      <button type="button" id="nextBtn" onclick="nextPrev(1)"class="btn btn-lg btn-warning">Next</button>
    </div>
  </div>
  <!-- Circles which indicates the steps of the form: -->
  <div style="text-align:center;margin-top:40px;">
    <span class="step" style="background-color: green;"></span>
    <span class="step" style="background-color: green;"></span>
    <span class="step" style="background-color: green;"></span>
    <span class="step" style="background-color: green;"></span>
  
  </div>

</form><br><br><br>


<script>
var currentTab = 0; // Current tab is set to be the first tab (0)
showTab(currentTab); // Display the current tab

function showTab(n) {
  // This function will display the specified tab of the form...
  var x = document.getElementsByClassName("tab");
  x[n].style.display = "block";
  //... and fix the Previous/Next buttons:
  if (n == 0) {
    document.getElementById("prevBtn").style.display = "none";
  } else {
    document.getElementById("prevBtn").style.display = "inline";
  }
  if (n == (x.length - 1)) {
    document.getElementById("nextBtn").innerHTML = "Submit";
  } else {
    document.getElementById("nextBtn").innerHTML = "Next";
  }
  //... and run a function that will display the correct step indicator:
  fixStepIndicator(n)
}

function nextPrev(n) {
  // This function will figure out which tab to display
  var x = document.getElementsByClassName("tab");
  // Exit the function if any field in the current tab is invalid:
  if (n == 1 && !validateForm()) return false;
  // Hide the current tab:
  x[currentTab].style.display = "none";
  // Increase or decrease the current tab by 1:
  currentTab = currentTab + n;
  // if you have reached the end of the form...
  if (currentTab >= x.length) {
    // ... the form gets submitted:
    document.getElementById("regForm").submit();
    return false;
  }
  // Otherwise, display the correct tab:
  showTab(currentTab);
}

    function validateForm() {
      // This function deals with validation of the form fields
      var x, y, i, valid = true;
      x = document.getElementsByClassName("tab");
      y = x[currentTab].getElementsByTagName("input");
     
  // If the valid status is true, mark the step as finished and valid:
  if (valid) {
    document.getElementsByClassName("step")[currentTab].className += " finish";
  }
  return valid; // return the valid status
}

function fixStepIndicator(n) {
  // This function removes the "active" class of all steps...
  var i, x = document.getElementsByClassName("step");
  for (i = 0; i < x.length; i++) {
    x[i].className = x[i].className.replace(" active", "");
  }
  //... and adds the "active" class on the current step:
  x[n].className += " active";
}


</script>

</body>
</html>
