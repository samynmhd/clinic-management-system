<?php
    include("nav.php");
    include("conn.php");
    $app_id=$_GET['app_id'];
    $patient_id=$_GET['patient_id'];
    $doc_id = $_GET['doc_id'];
    $calAge='';
    $error='';
    if(!empty($app_id)&&(!empty($patient_id))&&(!empty($doc_id))){
    $sql = "SELECT doctors.fname,
    doctors.lname,
    patients.fname,
    patients.lname,
    patients.dob,
    patients.gender
    FROM doctors,patients,appointment WHERE doctors.doc_id=appointment.doc_id and patients.patient_id=appointment.patient_id AND app_id=$app_id";
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
    <style>
        .view-hist {
            float: left;
            border: 2px solid #ccc;
            width: 40%;
            margin-left: 45%;
            margin-top: -70%;
            border: 2px solid #ccc;
            border-radius: 10px;
        }
        .view-hist form {
            margin-left: 1%;
            margin-right: 1%;
        }
        .view-hist table {
            border: 1px solid black;
            border-collapse: collapse;
        }
        .view-hist table th {
            background-color: #BCCDD1;
        }
        .view-hist table th,td {
            text-transform: uppercase;
            text-align: center;
        }
        .view-hist table tr:nth-child(odd){
            background-color: #D6E1DD;
        }
        .view-hist table tr:nth-child(even){
            background-color: #E3E4DE;
        }
        
    </style>
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
                <span><?php echo $error;?></span>
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
        <?php
            }
            }
            if(isset($_POST['submit'])){
                $error = $_GET['error'];
                $patient_id=$_POST['ptid'];
                $app_id=$_POST['app_id'];
                $date = $_POST['date'];
                $diagnosis = $_POST['ptdiag'];
                $prescription = $_POST['ptpres'];
                $doc_id = $_POST['doc_id'];
                $app_id = $_POST['app_id'];
                $sql1 = "INSERT INTO patient_history(patient_id,app_id,doc_id,pt_diag,pt_presc,date) VALUES ($patient_id,$app_id,$doc_id,'$diagnosis','$prescription','$date')";
                if(!empty($date)){
                    mysqli_query($conn,$sql1);
                    echo $sql1;
                    header("location:pt-history.php?app_id=$app_id&patient_id=$patient_id&doc_id=$doc_id");
                }else
                {
                     header("location:pt-history.php?app_id=$app_id&patient_id=$patient_id&doc_id=$doc_id&error='please select date'");
                }
                
            }

        ?>
    </div>
    <div class="view-hist">
        <form>
            <?php
            echo "<table>";
            echo "<caption><pre>Patient History</pre></caption>";
            echo "<tr>";
            echo "<th>History Id</th>";
            echo "<th>App Id</th>";
            echo "<th>Doc Name</th>";
            echo "<th>Diagnosis</th>";
            echo "<th>Prescription</th>";
            echo "<th>Date</th>";
            echo "</tr>";
            $views = "SELECT patient_history.pt_hist_id,patient_history.app_id,doctors.fname,doctors.lname,patient_history.pt_diag,patient_history.pt_presc,patient_history.date 
            FROM patient_history,doctors where patient_history.doc_id=doctors.doc_id and patient_history.patient_id=$patient_id";
            $res = mysqli_query($conn,$views);
            if(mysqli_num_rows($res)>0)
            {
                while($rows = mysqli_fetch_array($res))
                {
                    echo "<tr>";
                    echo "<td>".$rows[0]."</td>";
                    echo "<td>".$rows[1]."</td>";
                    echo "<td>Dr ".$rows[2]." ".$rows[3]."</td>";
                    echo "<td>".$rows[4]."</td>";
                    echo "<td>".$rows[5]."</td>";
                    echo "<td>".$rows[6]."</td>";
                    echo "</tr>";
                }
            }
            else
            {
                echo "No history";
            }
            echo "</table>";
            
            ?>
        </form>
    </div>
</body>
</html>