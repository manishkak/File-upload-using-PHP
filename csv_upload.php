<?php

$db=mysqli_connect("localhost","root","","db1");   //connect to database

if(isset($_POST['submitfile']))
{
	if($_FILES['file']['name'])
	{
		$filename = explode(".", $_FILES['file']['name']);
		if($filename[1]=='csv')
		{
			if ($_FILES['file']['size'] > 1000000)  //filesize greater than 1MB
			{
				$size = $_FILES['file']['size'];
				$calc = ($size/1000);
				echo 'Sorry, the file '.$_FILES['file']['name'].' is too large! ('.$calc.'MB)<br><br>';
				break;
			}
		
			$handle = fopen($_FILES['file']['tmp_name'], "r");
			$first_name=$middle_name=$last_name='';
			while($data = fgetcsv($handle))
			{
				$item1 = mysqli_real_escape_string($db, $data[0]);
				$item2 = mysqli_real_escape_string($db, $data[1]);
				$item3 = mysqli_real_escape_string($db, $data[2]);
				$item4 = mysqli_real_escape_string($db, $data[3]);
				$item5 = mysqli_real_escape_string($db, $data[4]);
				$item6 = mysqli_real_escape_string($db, $data[5]);
				$item7 = mysqli_real_escape_string($db, $data[6]);
				$sql = "insert into csv_data(id, name, email, phone, street_address, city, state, postal_code) values('','$item1','$item2','$item3','$item4','$item5','$item6','$item7')";
				echo "<br>$sql";
				mysqli_query($db, $sql) or die(mysqli_error($db)."...at line- ". __LINE__);
			}
			fclose($handle);
			echo "IMPORT DONE!!!!!!!!!!!!!!!!!!!!!!!!!!!!";
		}
		else
		{
			echo 'Kindly upload csv file only!';
		}
	}
}
mysqli_close($db);
?>

<!DOCTYPE html>
<html>
<head>
  <title>File upload using PHP</title>
</head>
<body>

<form method="POST" enctype="multipart/form-data">

<p> Upload CSV: (upto 1MB) <input type="file" name="file"></p>
<p> <input type="submit" name="submitfile" value="Import"></p>

</form>

</body>
</html>