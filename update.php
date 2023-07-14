<?php 
include 'connect.php';
if(isset($_POST['updateid'])){
    $user_id=$_POST['updateid'];
    $sql="Select * from `users` where id =$user_id";

    $result=mysqli_query($con,$sql);
    $response=array();
    while($row=mysqli_fetch_assoc($result)){
        $response=$row;

    }
    echo json_encode($response);   
}
else{
    $response['status']=200;
    $response['message']="Invalid or data not found!";
}

//update query
if (isset($_POST['hiddenData'])){

    $uniqueData=$_POST['hiddenData'];
    $name=$_POST['upname'];
    $email=$_POST['upemail'];
    $mobile=$_POST['upmobile'];
    $place=$_POST['upplace'];

    $sql="update `users` set name='$name', email='$email', mobile='$mobile', place='$place' where id=$uniqueData";
    $result=mysqli_query($con,$sql);
    if ( $result) {
        echo "Record updated successfully";
      } else {
        echo "Error updating record: " . mysqli_error($conn);
      }

}
?>