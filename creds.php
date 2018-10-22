<?php
session_start();
$error='';
if(isset($_POST['login'])){
	if(empty($_POST['user']) || empty($_POST['pass']) || empty($_POST['userType'])){
		$error="User or password invalid";
	}
	else
	{
		$user=$_POST['user'];
		$pass=$_POST['pass'];
        $userType= $_POST['userType'];
		$conn=mysqli_connect("localhost","root","");

		$db=mysqli_select_db($conn,"clinicmanagement");

		$query = mysqli_query($conn,"SELECT * FROM login WHERE pass='$pass' AND user='$user' AND userType='$userType'");

		$rows = mysqli_num_rows($query);
		if($rows==1)
        {
            while($rows = mysqli_fetch_assoc($query))
            {
                if($rows['userType']=='admin')
                {
			     header("location:/ClinicManagement/pages/Admin/index.php");
                }else{
                    header("location:index.php");
                }
            }
        }
		else
		{
			$error="Username or password invalid";
		}
		mysqli_close($conn);
    }
}
?>