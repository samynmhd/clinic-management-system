<?php 
	
	include("conn.php");
    include("nav.php");
    if(isset($_POST['app-del'])){
        $app_id = $_POST['hidd-app-id'];
        echo $app_id;
        $del = "DELETE from appointment where app_id=$app_id";
        echo $del;
        mysqli_query($conn,$del);
    }
?>
<!DOCTYPE html>
<html>
<head>
	<title>Index</title>
	<link rel="stylesheet" type="text/css" href="/./ClinicManagement/style.css">
    <link rel="stylesheet" type="text/css" href="/./ClinicManagement/nav-style.css">
</head>
<body>
	<div class="names">
		<label id="doc">DOCTORS</label>
		<label id="app">APPOINTMENTS</label>
	</div>
	<div class="onDuty">
		<?php

			$sql = 'SELECT * FROM doctors';
			$result = mysqli_query($conn,$sql);
    	
			echo "<table>";	
			if(mysqli_num_rows($result) > 0)
			{
				echo "<th>ID</th>";
				echo "<th>Name</th>";
				echo "<th>Speciality</th>";
				while ($row = mysqli_fetch_assoc($result)) {

					echo "<tr>";
					echo "<td>".$row['doc_id']."</td>";
					echo "<td>".$row['fname']." ".$row['lname']."</td>";
					echo "<td>".$row['speciality']."</td>";
				}
			}else {
				echo "0 Results";
			}
			echo "</table>";
			#mysqli_close($conn);
		?>
	</div>
	<div class="appointments">
        <form name="app-disp-form" method="post" action="index.php">
        <?php
            $sql = 'SELECT doctors.doc_id,appointment.app_id,appointment.patient_id,appointment.fname,appointment.lname,appointment.id_no,appointment.gender,appointment.dob,appointment.country,appointment.city,appointment.address,appointment.phone_no,appointment.appdate,doctors.fname,doctors.lname FROM appointment,doctors WHERE appointment.doc_id=doctors.doc_id AND appointment.doc_id';
                $results = mysqli_query($conn,$sql);
                echo "<table>";
                if(mysqli_num_rows($results)>0)
                {
                    echo "<th>Appt Id</th>";
                    echo "<th>ID</th>";
                    echo "<th>NAME</th>";
                    echo "<th>ID_NO</th>";
                    echo "<th>GENDER</th>";
                    echo "<th>DOB</th>";
                    echo "<th>COUNTRY</th>";
                    echo "<th>CITY</th>";
                    echo "<th>ADDRESS</th>";
                    echo "<th>PHONE NO</th>";
                    echo "<th>DOCTOR</th>";
                    echo "<th>Date</th>";
                    echo "<th>Void</th>";
                    
                    while($row = mysqli_fetch_array($results))
                    {
                        echo "<tr>";
                        ?>
                        
                            <td><a href="/ClinicManagement/pages/Admin/pt-history.php?app_id=<?php echo $row['app_id'];?>&patient_id=<?php echo $row['patient_id'];?>&doc_id=<?php echo $row['doc_id'];?>"><?php echo $row['app_id'];?></a></td>
                        <?php
                            echo "<td>".$row['patient_id']."</td>";
                            echo "<td>".$row['3']." ".$row['4']."</td>";
                            echo "<td>".$row['id_no']."</td>";
                            echo "<td>".$row['gender']."</td>";
                            echo "<td>".$row['dob']."</td>";
                            echo "<td>".$row['country']."</td>";
                            echo "<td>".$row['city']."</td>";
                            echo "<td>".$row['address']."</td>";
                            echo "<td>".$row['phone_no']."</td>";
                            echo "<td>".$row['fname']." ".$row['lname']."</td>";
                            echo "<td>".$row['appdate']."</td>";
                            echo "<td><input type='submit' name='app-del' value='delete'></td>";
                        ?>
                            <input type="hidden" name="hidd-app-id" value="<?php echo $row['app_id'];?>">
                            <input type="hidden" name="hidd-pt-id" value="<?php echo $row['patient_id'];?>">
                        <?php
                        echo "</tr>";
                    }
                }else
                {
                    echo "0 results";
                }
                echo "</table>";
        ?>
        </form>    
    </div>
    <form class="b-app" target="_blank" onclick="window.open('/ClinicManagement/pages/appointments.php','newwindow','width=700,height=800'); return false;">
       <input type="submit" name="app" value="appointment"><br><br>
    </form>
</body>
</html>