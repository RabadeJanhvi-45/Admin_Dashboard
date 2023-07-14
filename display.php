<?php 
include'connect.php';

if(isset($_POST['displaySend'])){
    $table='
    <table class="table">
    <tr>
  <thead class="table-dark">
  <th scope="col"> Sr no </th>
  <th scope="col"> Name </th>
  <th scope="col"> Email </th>
  <th scope="col"> Mobile </th>
  <th scope="col"> Place </th>
<th scope="col"> Operations </th>
  </tr>
  </thead>';
  $sql="Select * from `users`";

$number=1;

  $result=mysqli_query($con,$sql);
  while($row=mysqli_fetch_assoc($result)){
    $id=$row['id'];
    $name=$row['name'];
    $email=$row['email'];
    $mobile=$row['mobile'];
    $place=$row['place'];
    $table.='<tr>
    <td scope="row">'.$number.'</td>
    <td>'.$name.'</td>
    <td>'.$email.'</td>
    <td>'.$mobile.'</td>
    <td>'.$place.'</td>
    <td><button class="btn btn-success" onclick="updateUser('.$id.')">Update</button>
<button class="btn btn-danger" onclick=deleteUser('.$id.') >Delete</button></td>
  </tr>';
  $number++;
  }
  $table.='</table>';

  echo $table;
}?>
