<?php 
function sent_email($to,$fname,$lname){
	$subject = "Your Resume was uploaded!!  Thanks!";

	$message = "
	<p>Thanks $fname $lname Your Resume was uploaded.</p>
	<br /><br />
	<p>Carlos Lizaola</p>
	";

	// Always set content-type when sending HTML email
	$headers = "MIME-Version: 1.0" . "\r\n";
	$headers .= "Content-type:text/html;charset=UFT-8" . "\r\n";

	// More headers
	$headers .= 'From: <carloslizaola@gmail.com>' . "\r\n";
	if(mail($to,$subject,$message,$headers)){
		return 1;
	}else{
		return 0;
	}
}

// Get values 
$fname=$_POST['fname'];
$lname=$_POST['lname'];
$email=$_POST['email'];
if(!filter_var($email, FILTER_VALIDATE_EMAIL)){
  	header('Location: index.php?msg=2');
 }
	

include_once('config/database.php');
$tbl_name = 'contact';
$file_upload = 0;
$email_sent = 0;

// SQL 
$sql="INSERT INTO $tbl_name(fname, lname, email)VALUES('$fname', '$lname', '$email')";
$result=$mysqli -> query($sql);
$id = $mysqli->insert_id;

// close connection 
$mysqli->close();

if ($_FILES["file"]["error"] > 0){
	echo "Return Code: " . $_FILES["file"]["error"] . "<br>";
}else{
	$ext = end(explode(".", $_FILES["file"]["name"]));	
	$name = $id.'.'.$ext;
	if (file_exists("upload/".$name)){
	  	echo $_FILES["file"]["name"] . " already exists. ";
	}
	else{
		//the name of the file is change for the id
	  	move_uploaded_file($_FILES["file"]["tmp_name"],"upload/".$name);
	  	//echo "Stored in: " . "upload/".$name;
	  	$file_upload = 1;
	  	if(sent_email($email,$fname,$lname)){
	  		$email_sent=1;
	  	}
	  	
	}
}

if($result && ($file_upload == 1) && ($email_sent == 1)){
	// if successfully insert data into database and the file is upload"
	header('Location: index.php?msg=1');
}else {
	//if an error occurred
	header('Location: index.php?msg=2');
}
?>