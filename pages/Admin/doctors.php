<?php 
    include("conn.php");
    include("nav.php");
?>
<!DOCTYPE html>
<html>
<head>
	<title>Index</title>
	<link rel="stylesheet" type="text/css" href="/ClinicManagement/style.css">
    <link rel="stylesheet" type="text/css" href="/ClinicManagement/nav-style.css"> 
</head>
<body>
    <div class="heading-doc">DOCTORS</div>
    <div class="sel-doctors">    
    <form name="doc-form" action="doctors.php" method="post">
        <div class="inside-heading-doc">SELECT WHO IS AVAILABLE</div>
        <?php
            $sql = "select * from doctors";
            $result = mysqli_query($conn,$sql);
                foreach($result as $x)
                {
        ?>
                <input type="checkbox" name="ckbox-doc[]" value="<?php $x['doc_id'];?>"><?php echo "Dr"." ".ucwords($x['fname'])." ".ucwords($x['lname']);?><br>
        <?php
                }
        ?>
    </form>
    </div>
</body>
</html>