<!DOCTYPE html>
<?php
include 'Connection.php';
if(isset($_POST['signup_btn'])){
    $username=mysqli_real_escape_string($con,$_POST['username']);
    $email=mysqli_real_escape_string($con,$_POST['email']);
    $password=mysqli_real_escape_string($con,$_POST['password']);
    $c_password=mysqli_real_escape_string($con,$_POST['c_password']);

if(empty($username)){
    $error="username field is required";
}
elseif(empty($email)){
    $error="email field is required";
}
elseif(empty($password)){
    $error="password field is required";
}
elseif($password!=$c_password){
    $error="password does not match";
}
elseif(strlen($username) <3 || strlen($username) >30){
    $error="username must be between 3 to 30 Characters";
}
elseif(strlen($password)<6){
    $error="password must be atleat 6 characters";
}
else{
    $check_email="SELECT * FROM student WHERE email='$email'";
    $data=mysqli_query($con,$check_email);
    $result=mysqli_fetch_array($data);
    if($result >0){
        $error="Emial already exist";
    }
    else{
        $pass=md5($password);
        $insert="INSERT INTO student (username,email,password) Values('$username','$email','$pass')";
        $q=mysqli_query($con,$insert);
        if($q){
            $success="You account has been created successfully ";
        }
    }
}
}
?>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>signup</title>
    <meta name="description" content="Register your account">
    <link rel="stylesheet" type="text/css" href="signup.css">
    <meta name="viewport" content="width=device-width,initial-scale=1.0">
</head>
<body>
    <div class="signup">
        <form action="" method="POST">
        <p style="color:red">
            <?php
            if(isset($error)){
                echo $error; 
            }
            ?>
        </p>
        <p style="color:green">
            <?php
            if(isset($success)){
                echo $success; 
            }
            ?>
        </p>
        <h3>Create account?</h3>
            <input type="text" name="username" placeholder="Username" value="<?php
             if(isset($error)) {
                echo $username;
            } ?>">

            <input type="email" name="email" placeholder="email" value="<?php if(isset($error)) {echo $email;}?>">
    
            <input type="password" name="password" placeholder="Password">
         
            <input type="password" name="c_password" placeholder="Confirm password">
         
            <input type="submit" name="signup btn" value="Signup">
        </form>
</body>
</html>
