<?php
    include("conn.php");
    $error='';
    if(isset($_POST['searchbt'])){
        if(!empty('search')){
            $patient_id=$_POST['search'];
            $fname ='';
            $lname='';
            $id_no='';
            $gender='';
            $dob='';
            $country='';
            $city='';
            $address='';
            $phone_no='';
            $doc_id=$_POST['docsel'];
            $sql= "select * from patients where patient_id=$patient_id";
            //echo $sql;
            $result = mysqli_query($conn,$sql);
            while($row = mysqli_fetch_array($result)){
                $fname =$row['fname'];
                $lname=$row['lname'];
                $id_no=$row['id_no'];
                $gender=$row['gender'];
                $dob=$row['dob'];
                $country=$row['country'];
                $city=$row['city'];
                $address=$row['address'];
                $phone_no=$row['phone_no'];     
            }
        }
    }
    if(isset($_POST['make'])){
        if(!empty('search')&(!empty('fname'))&(!empty('lname'))&(!empty('id_no'))&(!empty('gender'))&(!empty('dob'))&(!empty('country'))&(!empty('city'))&(!empty('address'))&(!empty('phone_no'))){
            
            $patient_id=$_POST['search'];
            $fname =$_POST['fname'];
            $lname=$_POST['lname'];
            $id_no=$_POST['id_no'];
            $gender=$_POST['gender'];
            $dob=$_POST['dob'];
            $country=$_POST['country'];
            $city=$_POST['city'];
            $address=$_POST['address'];
            $phone_no=$_POST['phone_no'];
            $doc_id=$_POST['docsel'];
            $appdate=$_POST['appdate'];
            
            $ins = "INSERT INTO appointment (patient_id,fname,lname,id_no,gender,dob, country, city,address,phone_no,doc_id,appdate) values ($patient_id,'$fname', '$lname', '$id_no', '$gender', '$dob', '$country', '$city', '$address', $phone_no,$doc_id,'$appdate')";
            if(mysqli_query($conn,$ins)){
                echo "Appointment Done";
            }
            else{
                $error ="$ins <br>".mysqli_error($conn);
            }
        }
    }

?>

<html>
    <head>
        <title>APPOINTMENTS</title>
        <link rel="stylesheet" type="text/css" href="/ClinicManagement/style.css">
    </head>
    <body>
        <div class="app-h1">
            <h1>APPOINTMENT</h1>
        </div>
        <div class="ap-div">
            <form name="form-app" action="appointments.php" method="post" style="content:center">
                <p>
                <label>Patient Search :</label><br>
                <input type="text" name="search" value="<?php if(!empty($patient_id)) echo $patient_id; ?>"><br><br>
                    <input type="submit" name="searchbt" value="search"><br><br>
                    <span><?php echo $error;?></span>
                <label>First Name:</label>
                    <input type="text" name="fname" value="<?php if(!empty($fname)) echo $fname; ?>" readonly><br><br>
                <label>Last Name:</label>
                    <input type="text" name="lname" value="<?php if(!empty($lname)) echo $lname; ?>" readonly><br><br>
                <label>ID/Passport:</label>
                    <input type="text" name="id_no" value="<?php if(!empty($id_no)) echo $id_no; ?>" readonly><br><br>
                <label>Gender:</label>
                    <input type="text" name="gender" value="<?php if(!empty($gender)) echo $gender; ?>" readonly><br><br>
                <label>DOB:</label><br>
                    <input type="text" name="dob" value="<?php if(!empty($dob)) echo $dob; ?>" readonly><br><br>
                <label>Country:</label>
                    <input type="text" name="country" value="<?php if(!empty($country)) echo $country; ?>" readonly><br><br>
                <label>City:</label><br>
                    <input type="text" name="city" value="<?php if(!empty($city)) echo $city; ?>" readonly><br><br>                           
                <label>Address:</label><input type="text" name="address" value="<?php if(!empty($address)) echo $address; ?>" readonly><br><br>
                <label>Phone No:</label>
                    <input type="text" name="phone_no" value="<?php if(!empty($phone_no)) echo $phone_no; ?>" readonly><br><br>
                <label>Date:</label><br>
                    <input type="date" name="appdate"><br><br>
                <label>Doctor:</label><br>
                <select name="docsel">
                <?php
                    $sql2 = "select * from doctors";
                    $query = mysqli_query($conn,$sql2);
                    while($rows = mysqli_fetch_array($query)){
                ?>
                <option value="<?php echo $rows['doc_id'];?>"><?php echo "Dr ".$rows['fname']." ".$rows['lname'];?></option>";
                <?php
                    }
                ?>
                </select><br><br>
                </p>
                <input type="submit" name="make" value="make"><br><br>
                <?php echo $error; ?>
            </form>
        </div>
    </body>
</html>