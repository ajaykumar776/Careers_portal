<?php
	function get_cat_count(){
	  
        include('.././config.php');
		$count = "";
		$query = "select count(*) as count from category";
		$query_run = mysqli_query($con,$query);
		while($row = mysqli_fetch_assoc($query_run)){
			$cat = $row['count'];
		}
		return($cat);
	}
    function get_skills_count(){
		include('.././config.php');
		$count = "";
		$query = "select count(*) as count from skills";
		$query_run = mysqli_query($con,$query);
		while($row = mysqli_fetch_assoc($query_run)){
			$skills = $row['count'];
		}
		return($skills);
	}
    function get_candidate_count(){
        include('.././config.php');
		$count = "";
		$query = "select count(*) as count from candidates";
		$query_run = mysqli_query($con,$query);
		while($row = mysqli_fetch_assoc($query_run)){
			$candidate = $row['count'];
		}
		return($candidate);
	}
    function get_registrations_count(){
		include('.././config.php');
		$count = "";
		$query = "select count(*) as count from registration";
		$query_run = mysqli_query($con,$query);
		while($row = mysqli_fetch_assoc($query_run)){
			$registrations= $row['count'];
		}
		return$registrations;
	}

?>