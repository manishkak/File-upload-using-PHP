# File-upload-using-PHP
upload a CSV file using PHP file upload functionality and insert the data into a DB

For simplicity, I have everything including the PHP code, Bootstrap and DB connection 
all in one file: **csv_upload.php**


Bootstrap- submit type input field to upload the file
```
<p> Upload CSV: <input type="file" name="file"></p>
<p> <input type="submit" name="submitfile" value="Import"></p>
```

PHP-  1. check if file extension is csv
```php
if($_FILES['file']['name'])
	{
		$filename = explode(".", $_FILES['file']['name']);
		if($filename[1]=='csv')
```

2) check if the size is under 1MB (or anything else user can specify)
```php
if ($_FILES['file']['size'] < 1000000)  //filesize is always in kb
```

3) insert csv file data into the DB table called csv_data
```php
$sql = "insert into csv_data(id, name, email, phone, street_address, city, state, postal_code) values('','$item1'
,'$item2','$item3','$item4','$item5','$item6','$item7')";
mysqli_query($db, $sql) or die(mysqli_error($db)."...at line- ". __LINE__);
```

4) close Mysql connection
```php
mysqli_close($db);
```
