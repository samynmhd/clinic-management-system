<?php
    include("conn.php");
    include("nav.php");
    $staff_id = $_GET['staff_id'];
    $error ='';
    if(isset($_POST['edit']))
    {
        $txtid= $_POST['txtId'];
        $txttype= $_POST['txtType'];
        $txtfname= $_POST['txtFname'];
        $txtlname= $_POST['txtLname'];
        $txtdob= $_POST['txtDob'];
        $txtgender= $_POST['txtGender'];
        $txtcountry= $_POST['txtCountry'];
        $txtcity= $_POST['txtCity'];
        $txtadd= $_POST['txtAdd'];
        $txtphone=$_POST['txtPhone'];
        $update = "UPDATE staff SET staff_type='$txttype',
        staff_fname='$txtfname',
        staff_lname='$txtlname',
        staff_dob='$txtdob',
        staff_gender='$txtgender',
        staff_country='$txtcountry',
        staff_city='$txtcity',
        staff_add='$txtadd',
        staff_phone='$txtphone' WHERE staff_id=$txtid";
        if($txtgender=="M" || $txtgender=="F")
        {
            if(mysqli_query($conn,$update))
            {
                header("location:/./ClinicManagement/pages/Admin/userReg.php");
            }
            else
            {
                header("update_staff.php?staff_id=$txtid");
            }
        }
        else
        {
            header("location:update_staff.php?staff_id=$txtid");
            $error = "Gender can be M or F";
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
        <form name="edit" action="update_staff.php" method="post">
            <?php
             
                $sql = "Select * from staff where staff_id=$staff_id";
                $results = mysqli_query($conn,$sql);
                echo "<table>";
                echo "<caption><pre>Edit Staff</pre></caption>";
                echo "<tr>";
                echo "<th>id</th>";
                echo "<th>Type</th>";
                echo "<th>FName</th>";
                echo "<th>LName</th>";
                echo "<th>Dob</th>";
                echo "<th>Gender</th>";
                echo "<th>Country</th>";
                echo "<th>City</th>";
                echo "<th>Address</th>";
                echo "<th>Phone</th>";
                echo "</tr>";
                while($row = mysqli_fetch_assoc($results))
                {
                ?>
                <tr>
                <td><input type='text' name='txtId' value='<?php echo $row['staff_id'];?>'</td>
                <td><input type='text' name='txtType' value='<?php echo $row['staff_type'];?>' readonly></td>
                <td><input type='text' name='txtFname' value='<?php echo $row['staff_fname'];?>'></td>    
                <td><input type='text' name='txtLname' value='<?php echo $row['staff_lname'];?>'></td>    
                <td><input type='text' name='txtDob' value='<?php echo $row['staff_dob'];?>'></td>    
                <td><input type='text' name='txtGender' value='<?php echo $row['staff_gender'];?>'></td>    
                <td><input type='text' name='txtCountry' value='<?php echo $row['staff_country'];?>'></td>    
                <td><input type='text' name='txtCity' value='<?php echo $row['staff_city'];?>'></td>    
                <td><input type='text' name='txtAdd' value='<?php echo $row['staff_add'];?>'></td>    
                <td><input type='text' name='txtPhone' value='<?php echo $row['staff_phone'];?>'></td> 
                </tr>    
                <?php 
                }echo "</table>";?>
                <br><br>
                <input type="submit" name="edit" value="update">    
        </form>
        </div>
    </body>
</html>