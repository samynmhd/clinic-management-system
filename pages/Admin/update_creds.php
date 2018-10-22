<?php
    include("conn.php");
    include("nav.php");
    $login_id = $_GET['login_id'];
    $error ='';
    if(isset($_POST['edit']))
    {
        $txtid= $_POST['txtId'];
        $txttype= $_POST['txtType'];
        $txtuser= $_POST['txtUser'];
        $txtpass= $_POST['txtPass'];
        $update = "UPDATE login SET 
        user='$txtuser',
        pass='$txtpass',
        userType='$txttype'
        WHERE login_id=$txtid";
        echo $update;
            if(mysqli_query($conn,$update))
            {
                header("location:/./ClinicManagement/pages/Admin/userReg.php");
            }
            else
            {
                header("update_creds.php?login_id=$txtid");
            }
    }

?>
<html>
    <head>
        <link rel="stylesheet" href="/./ClinicManagement/nav-style.css">
        <link rel="stylesheet" href="/./ClinicManagement/style.css">
        <style type="text/css">
            table {
                border: 1px solid black;
                border-collapse: collapse;
            }
            table th  {
                background-color: #BCCDD1;
            }
            table th,td{
                border: 1px solid black;
                border-collapse: collapse;
                text-align: center;
            }
            input[type="text"]{
                width: inherit;
                text-align: center;
                background-color: #D6E1DD;
            }
            .edit-div {
                margin-left: 1%;
                margin-top: 1%;
                border: 1px solid black;
                border-radius: 10px;
                width: 78%;
            }
            .edit-div form {
                margin-left: 1%;
                margin-top: 1%;
            }
            .edit-div form input[type="submit"]{
                margin-left: 40%;
                width: 20%;
                height: 5%;
                border-radius: 10px;
                border: 1px solid black;
                background-color: #019375;
            }
        </style>
    </head>
    <body>
        <div class="edit-div">
        <form name="edit" action="update_creds.php" method="post">
            <?php
             
                $sql = "Select * from login where login_id=$login_id";
                $results = mysqli_query($conn,$sql);
                echo "<table>";
                echo "<caption><pre>Edit Staff</pre></caption>";
                echo "<tr>";
                echo "<th>Login Id</th>";
                echo "<th>User</th>";
                echo "<th>Pass</th>";
                echo "<th>Type</th>";
                echo "</tr>";
                while($row = mysqli_fetch_assoc($results))
                {
                ?>
                <tr>
                <td><input type='text' name='txtId' value='<?php echo $row['login_id'];?>'</td>
                <td><input type='text' name='txtUser' value='<?php echo $row['user'];?>' readonly></td>
                <td><input type='text' name='txtPass' value='<?php echo $row['pass'];?>'></td>    
                <td><input type='text' name='txtType' value='<?php echo $row['userType'];?>'></td>    
                </tr>    
                <?php 
                }echo "</table>";?>
                <br><br>
                <input type="submit" name="edit" value="update">    
        </form>
        </div>
    </body>
</html>