<?php 
  include("includes/connection.php");
  if(isset($_GET['hid'])&&isset($_GET['bg']))
  {
  	
     $hid = $_GET['hid'];
     $bg = $_GET['bg'];
     $ntype = "EB"; // emergency bloodgroup

     $hosp_query = "SELECT * FROM `hospital` WHERE `h_id` = '".$hid."' ";
     $hosp_result = mysqli_query($conn,$hosp_query);
     $hosp_row = mysqli_fetch_array($hosp_result);
     $hospital = $hosp_row['hname'];
     $hospital_number = $hosp_row['hphone'];

     $query = "SELECT * FROM `users` WHERE `bloodgroup` = '".$bg."' ";
     $result = mysqli_query($conn,$query);
     if($result)
     {   
	     while($row = mysqli_fetch_array($result))
	     {   
	     	 $phone = $row['phone'];
	         $insert_query = "INSERT INTO `notifications` (`uid`,`ntype`,`notified_by`) VALUES ( '".$row['id']."' , '".$ntype."' , '".$hid."') ";
	         if( !mysqli_query($conn,$insert_query))
	         {
                 echo "Try Again Later";

	         }
	         else
	         {
	         	$msg = "Urgently Required:".$bg." BloodGroup  Hospital:".$hospital." Contact:".$hospital_number." ";
	         	$msg1 = "hello";
	           
                 header('Location: blood.php?sent=1');
	         }
	     }

       header('Location: blood.php?sent=1');
    }
    else
    {
    	echo "Check Your Query";
    }
  }


?>