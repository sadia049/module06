<?php
session_name('myapp');

session_start();

  if(file_exists("users.csv")){
	 
	  $fp=fopen("users.csv","r");
	  
	  //$cookie_name = $user_name;*/
	  
	  
  }
 if(isset($_POST['back_to_login']))
	   header('location:form_cookies.php');
 

  




?>



<html>
<head>
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-BmbxuPwQa2lc/FVzBcNJ7UAyJxM6wuqIj61tLrc4wSX0szH/Ev+nYRRuWlolflfl" crossorigin="anonymous">
    <link href="https://fonts.googleapis.com/css2?family=Playfair+Display:ital,wght@0,400;0,500;0,600;0,700;0,800;0,900;1,400;1,500;1,600;1,700;1,800;1,900&display=swap" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js">
	<link href="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js">
	<link rel="stylesheet" href="profile.css">
	 
	<title>Profile Page</title>
	 
</head>

<body>

<!--<div class="container mt-5">
    
    <div class="row d-flex justify-content-center">
        
        <div class="col-md-7">
            
            <div class="card p-3 py-4">
                
                <div class="text-center">
                    <img src="https://i.imgur.com/bDLhJiP.jpg" width="100" class="rounded-circle">
					<img src= width="100" class="rounded-circle">
                </div>
                
                <div class="text-center mt-3">
                    <span class="bg-secondary p-1 px-4 rounded text-white"></span>
                    <h5 class="mt-2 mb-0"></h5>
                    <span>Password:</span>
                    
                    <div class="px-4 mt-1">
                        <p class="fonts">Consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. </p>
                    
                    </div>
                    
                     <ul class="social-list">
                        <li><i class="fa fa-facebook"></i></li>
                        <li><i class="fa fa-dribbble"></i></li>
                        <li><i class="fa fa-instagram"></i></li>
                        <li><i class="fa fa-linkedin"></i></li>
                        <li><i class="fa fa-google"></i></li>
                    </ul>
                    
                    <div class="buttons">
                        
                        <button class="btn btn-outline-primary px-4">Message</button>
                        <button class="btn btn-primary px-4 ms-3">Contact</button>
                    </div>
                    
                    
                </div>
                
               
                
                
            </div>
            
        </div>
        
    </div>
    
</div>-->


<table class="table">
  <thead class="thead-dark">
    <tr>
      <th scope="col">Name</th>
      <th scope="col">Email</th>
      <th scope="col">Password</th>
      <th scope="col">Image</th>
    </tr>
  </thead>
  <tbody>
  <!--set the values from users.csv file and set the cookies-->
   <?php while($file=fgetcsv($fp)){?>
    <tr>
	
      <td><?php echo $name=$file[1]; $cookie_name =$name; ?></td>
      <td><?php echo $email=$file[2]; ?></td>
      <td><?php echo $password=$file[3]; ?></td>
      <td><img src="<?php  $image=$file[4];
                     $image_path="uploads/".$image;
                     echo $image_path;?>" alt="" width="200" height="150">
	  </td>
    </tr>
	 <?php }?>
    
   
  </tbody>
</table>
<?php fclose($fp);?>

<form method="POST" action="profile.php">
<div class="form-group"><button class="btn btn-success btn-block" type="submit" name="back_to_login">Back to Login Form</button>
</div>
</form>

</body>

</html>