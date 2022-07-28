<?php
    session_start();   
    include '../config.php';
    include '../lib/login.php';
    include '../loginGoogle.php';   
//the function in logingoogle to get page name  and return
$google_client=googleapi("index");
$login_button = '';
//This $_GET["code"] variable value received after user has login into their Google Account redirct to PHP script then this variable value has been received
if(isset($_GET["code"]))
{ //It will Attempt to exchange a code for an valid authentication token.
    $token = $google_client->fetchAccessTokenWithAuthCode($_GET["code"]);
    //This condition will check there is any error occur during geting authentication token. If there is no any error occur then it will execute if block of code/
    if(!isset($token['error']))
    {//Set the access token used for requests
     $google_client->setAccessToken($token['access_token']);
     //Store "access_token" value in $_SESSION variable for future use.
     $_SESSION['access_token'] = $token['access_token'];
     //Create Object of Google Service OAuth 2 class
     $google_service = new Google_Service_Oauth2($google_client);
     //Get user profile data from google
     $data = $google_service->userinfo->get();
     //Below you can find Get profile data and store into $_SESSION variable
     if(!empty($data['email']))
     {
      $login = new login($data['email']);
            if ($login->checkLoginWithGoogle()){
                $_SESSION['Email']=$data['email'];
                header('Location:dashboard.php');
                exit();
            } else {
                echo"The User is Not Found ";
            }
     }else{
         
     }
  }
}
?>
<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<title>login</title>
	<!-- Mobile Specific Metas -->
	<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
	<!-- Main Style Css -->
        <link rel="stylesheet" href="template/css/style.css"/>
</head>
<body>
    <?php
    if (isset($_POST["login"])){
        $email = $_POST['email'];
        $hasspass = $_POST['password'];
        $password = sha1($hasspass);
        $login = new login($email, $password);
            if($login->validation()){
                if ($login->checkLogin()){
                    $_SESSION['Email']=$email;
                    header('Location:dashboard.php');
                    exit();
                } else {
                    echo"The User is Not Found ";
                }
            }
    }
    ?>
    <div class="form-v8">
	<div class="page-content">
		<div class="form-v8-content">
			<div class="form-right">
				<div class="tab">
					<div class="tab-inner">
						<button class="tablinks" onclick="openCity(event, 'admin')" id="defaultOpen">Login</button>
					</div>
				</div>
				<form class="form-detail" action="<?php echo $_SERVER['PHP_SELF'];?>" method="post">
					<div class="tabcontent" id="admin">
						<div class="form-row">
							<label class="form-row-inner">
								<input type="text" name="email" id="your_email" class="input-text" required>
								<span class="label">E-Mail</span>
		  						<span class="border"></span>
							</label>
						</div>
						<div class="form-row">
							<label class="form-row-inner">
								<input type="password" name="password" id="password" class="input-text" required>
								<span class="label">Password</span>
								<span class="border"></span>
							</label>
						</div>
						<div class="form-row ">
                                                    <a style=" " href="<?php echo$google_client->createAuthUrl(); ?>" class="connect-bottom">Google</a>
						</div>
						<div class="form-row-last">
                                                    <input type="submit" name="login" class="register"style="width:100%" value="Sign in">
                                                        <a class="" href="RegistrationStudent.php" style="float: right; padding:2px; ">Sign Up Student</a>
                                                        <a class="" href="registrationInstructor.php" style="float: left; padding:2px;">Sign Up Instructor </a>
						</div>
					</div>
				</form>
			</div>
		</div>
	</div>
    </div>
    <script src="template/_js/script.js"></script>
</body>
</html>