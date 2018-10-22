<?php
    include("nav.php");
    include("conn.php");
    $app_id=$_GET['app_id'];
    $patient_id=$_GET['patient_id'];
    $doc_id = $_GET['doc_id'];
    echo "doc id".$doc_id."<br>";
    echo $patient_id;
    echo "<br>";
    echo $app_id;
    $calAge='';
    if(!empty($app_id)&&(!empty($patient_id))&&(!empty($doc_id))){
    $sql = "SELECT doctors.fname,
    doctors.lname,
    patients.fname,
    patients.lname,
    patients.dob,
    patients.gender
    FROM doctors,patients,appointment WHERE doctors.doc_id=appointment.doc_id and patients.patient_id=appointment.patient_id AND app_id=$app_id";
    echo $sql;
    $result = mysqli_query($conn,$sql );
    while($row=mysqli_fetch_array($result))
    {
        $calAge=$row[4];
        $dateOfBirth = "$calAge";
        $today = date("Y-m-d");
        $diff = date_diff(date_create($dateOfBirth), date_create($today));
?>
<!DOCTYPE html>
<html>
<head>
    <title>Patient History</title>
    <link rel="stylesheet" type="text/css" href="/ClinicManagement/style.css">
    <link rel="stylesheet" type="text/css" href="/ClinicManagement/nav-style.css">
    <!--<style type="text/css">
        .pt-hist-div {
            border: 2px solid #ccc;
            border-radius: 10px;
            margin-top: 20px;
            margin-left: 20px;
            margin-right: 20px;
            width: 800px;
        }
        .pt-hist-div form {
            margin-top: 20px;
            margin-left: 20px;
            margin-right: 20px;
        }

        .pt-hist-div input[type="date"],input[type="text"] {
            width: 30%;
            margin-left: 20px;
            height: 40px;
            border: none;
            border-bottom: 2px solid #ccc;
        }
        .pt-hist-div textarea {
            margin-left: 20px;
            align-self: auto;
        }
    </style>-->
</head>
<body>
    <div class="pt-hist-div">
        <form name='pt-hist-form' action='pt-history.php' method="post">
            <div class="left">
                <label>Patient Id</label><input type="text" name="ptid" value="<?php echo $patient_id;?>"><br><br>
                <label>Dr Name:</label><input type="text" name="drname" value="<?php echo ucwords($row[0]." ".$row[1]);?>"><br><br>
                <label>First Name:</label><input type="text" name="ptfname" value="<?php echo ucwords($row[2]." ".$row[3]);?>"><br><br>
            </div>
            <div class="right">
            <label>Date:</label><input type="date" name="date"><br><br>
            <label>Age:</label><input type="text" name="ptage" value="<?php echo $diff->format('%y');?>"><br><br>
            <label>Gender:</label><input type="text" name="ptgender" value="<?php echo $row[5];?>"><br><br>
            </div>
            <label>Diagnosis:</label><br><textarea name="ptdiag" cols="80" rows="20"></textarea><br><br>
            <label>Prescription:</label><br><textarea name="ptpres" cols="80" rows="20"></textarea><br><br>
            <input type="hidden" name="app_id" value="<?php echo $app_id;?>">
            <input type="hidden" name="doc_id" value="<?php echo $doc_id;?>">
            <input type="submit" name="submit" value="submit">
        </form>
    </div>
</body>
</html>
<?php
    }
    }
    if(isset($_POST['submit'])){
        $patient_id=$_POST['ptid'];
        $app_id=$_POST['app_id'];
        $date = $_POST['date'];
        $diagnosis = $_POST['ptdiag'];
        $prescription = $_POST['ptpres'];
        $doc_id = $_POST['doc_id'];
        $app_id = $_POST['app_id'];
        
        $sql1 = "INSERT INTO patient_history(patient_id,app_id,doc_id,pt_diag,pt_presc,date) VALUES ($patient_id,$app_id,$doc_id,'$diagnosis','$prescription','$date')";
        mysqli_query($conn,$sql1);
        echo $sql1;
        header("location:pt-history.php?app_id=$app_id&patient_id=$patient_id&doc_id=$doc_id");
    }

?>