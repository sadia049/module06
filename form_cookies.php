
<?php


















































//index.php

$error = '';
$name = '';
$email = '';
$password = '';



function clean_text($string)
{
 $string = trim($string);
 $string = stripslashes($string);
 $string = htmlspecialchars($string);
 return $string;
}

if(isset($_POST["login"]))
{
 if(empty($_POST["user_name"]))
 {
  $error .= '<p><label class="text-danger">Please Enter your Name</label></p>';
 }
 else
 {
  $name = clean_text($_POST["user_name"]);
  if(!preg_match("/^[a-zA-Z ]*$/",$name))
  {
   $error .= '<p><label class="text-danger">Only letters and white space allowed</label></p>';
  }
 }
 if(empty($_POST["user_email"]))
 {
  $error .= '<p><label class="text-danger">Please Enter your Email</label></p>';
 }
 else
 {
  $email = clean_text($_POST["user_email"]);
  if(!filter_var($email, FILTER_VALIDATE_EMAIL))
  {
   $error .= '<p><label class="text-danger">Invalid email format</label></p>';
  }
 }
 if(empty($_POST["password"]))
 {
  $error .= '<p><label class="text-danger">Password is required</label></p>';
 }
 else
 {
  $password = clean_text($_POST["password"]);
  $password=md5($password);
 }
 
 
 
 
 //saving the image to the server
date_default_timezone_set('ASIA/DHAKA');
$current_time = date('Y-m-d H:i:s');
$target_dir = "uploads/";
$target_file = $target_dir.basename($_FILES["fileToUpload"]["name"]);



$uploadOk = 1;
$imageFileType = strtolower(pathinfo($target_file,PATHINFO_EXTENSION));

// Check if image file is a actual image or fake image
if(isset($_POST["submit"])) {
  $check = getimagesize($_FILES["fileToUpload"]["tmp_name"]);
  if($check !== false) {
    echo "File is an image - " . $check["mime"] . ".";
    $uploadOk = 1;
  } else {
    echo "File is not an image.";
    $uploadOk = 0;
  }
}

 //Check if file already exists
if (file_exists($target_file)) {
  echo "Sorry, file already exists.";
  $uploadOk = 0;
}

// Check file size
/*if ($_FILES["fileToUpload"]["size"] > 500000) {
  echo "Sorry, your file is too large.";
  $uploadOk = 0;
}*/

// Allow certain file formats
if($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg"
&& $imageFileType != "gif" ) {
  echo "Sorry, only JPG, JPEG, PNG & GIF files are allowed.";
  $uploadOk = 0;
}

// Check if $uploadOk is set to 0 by an error
if ($uploadOk == 0) {
  echo "Sorry, your file was not uploaded.";
// if everything is ok, try to upload file
} else {
  if (move_uploaded_file($_FILES["fileToUpload"]["tmp_name"], $target_file)) {
	$name_of_the_file=htmlspecialchars( basename( $_FILES["fileToUpload"]["name"]));
	
    echo "The file ".$name_of_the_file." has been uploaded";
  } else {
    echo "Sorry, there was an error uploading your file.";
  }
}


 
 
 
 
if($error == '')
 {
  
  $file_open = fopen("users.csv", "r");
  if(file_exists("users.csv")){
  //echo "<h3>YES</h3>";
  $file_open = fopen("users.csv", "a");
  $no_rows = count(file("users.csv"));
  
  
  if($no_rows > 1)
  {
   $no_rows = ($no_rows - 1) + 1;
  }
  $form_data = array(
   'sr_no'  => $no_rows,
   'name'  => $name,
   'email'  => $email,
   'password' => $password,
   'path'=>$name_of_the_file
  );
  fputcsv($file_open, $form_data);
  fclose($file_open);
  $error = '<label class="text-success">Thank you for login</label>';
  $name = '';
  $email = '';
  $password = '';
  }
  
 }
 
 header('location:profile.php');
}






?>
























<html>
<head>
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-BmbxuPwQa2lc/FVzBcNJ7UAyJxM6wuqIj61tLrc4wSX0szH/Ev+nYRRuWlolflfl" crossorigin="anonymous">
    <link href="https://fonts.googleapis.com/css2?family=Playfair+Display:ital,wght@0,400;0,500;0,600;0,700;0,800;0,900;1,400;1,500;1,600;1,700;1,800;1,900&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="style.css">
	 
	<title>HTML FORM WITH SESSION</title>
	 

</head>
<body>


<div class="register-photo">
        <div class="form-container">
            <div class="image-holder"></div>
            <form method="post" action="form_cookies.php" enctype="multipart/form-data">
                <h2 class="text-center"><strong>Login</strong> Stranger!!.</h2>
                <div class="form-group">
				<input class="form-control" type="text" name="user_name" placeholder="your name" required></div>
				<div class="form-group">
				<input class="form-control" type="email" name="user_email" placeholder="email" required></div>
				
                <div class="form-group">
				<input class="form-control" type="password" name="password" placeholder="Password" required></div>
            
				<br>
				Select image to upload:
				<br>
			   <div class="form-group">
               <input class="form-control" type="file" name="fileToUpload" id="fileToUpload">
               <input class="form-control" type="submit" value="Upload Image" name="submit">
			   </div>
                
                <div class="form-group"><button class="btn btn-success btn-block" type="submit" name="login">Login</button>
				</div>
				
				</form>
        </div>
    </div>
	
</body>
	
</html>