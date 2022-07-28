<?php
session_start();
    include '../config.php';
    include '../lib/Registration.php';
    include '../loginGoogle.php';   
$login_button = '';
$google_client=googleapi("RegistrationStudent");
//This $_GET["code"] variable value received after user has login into their Google Account redirct to PHP script then this variable value has been received
if(isset($_GET["code"]))
{
    echo $_GET["code"];
 //It will Attempt to exchange a code for an valid authentication token.
    $token = $google_client->fetchAccessTokenWithAuthCode($_GET["code"]);

    //This condition will check there is any error occur during geting authentication token. If there is no any error occur then it will execute if block of code/
    if(!isset($token['error']))
    {
     //Set the access token used for requests
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
      $_SESSION['Email'] = $data['email'];
     }
      if(!empty($data['given_name']))
     {
       $register = new register($data['email'],$data['given_name'],'','');
       if($register->checkIsEmailFound('Email','user',$data['email'] )){
            if($register->insertuser("3")){
                //header('Location:dashboard.php');
           }else{
               echo 'filled';
           }
       }else{
           echo 'The Email is Already registered ';
           
       }
     }
  }
}
?>

<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
        <title>Student Registration</title>
	<!-- Mobile Specific Metas -->
	<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
	<!-- Main Style Css -->
    <link rel="stylesheet" href="template/css/style.css"/>
</head>
<body>
    <h1 class="titleOfPage">Registration Student</h1>
    <?php
    if(isset($_POST['register'])){
        $register = new register($_POST['email'],$_POST['full_name'],$_POST['password'], $_POST['comfirm_password']);
           if($register->validation()){
               if($register->checkIsEmailFound('Email','user',$_POST['email'] )){
                if($register->insertuser($_POST['Usertype'])){
                    header('Location:index.php');
                }else{
                    echo 'filled';
                }

            }else{
                echo '<div><h2 style="font-weight:bold; text-align:center;">The User is already Found </h2><div>';
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
                                        <button class="tablinks" onclick="openCity(event, 'student')">Student</button>
                                </div>
                            </div>
                        <form class="form-detail" action="<?php $_SERVER['PHP_SELF'] ?>" method="post">
                                <div class="tabcontent" id="student">
                                        <div class="form-row">
                                                <label class="form-row-inner">
                                                        <input type="text" name="full_name" id="full_name" class="input-text" required>
                                                        <span class="label">Full Name</span>
                                                        <span class="border"></span>
                                                </label>
                                        </div>
                                        <div class="form-row">
                                                <label class="form-row-inner">
                                                        <input type="email" name="email" id="your_email" class="input-text" required>
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
                                        <div class="form-row">
                                            <label class="form-row-inner">
                                                    <input type="password" name="comfirm_password" id="comfirm_password" class="input-text" required>
                                                    <span class="label">Comfirm Password</span>
                                                    <span class="border"></span>
                                            </label>
                                        </div>
                                        <div class="form-row-last ">
                                                <a href="<?php echo$google_client->createAuthUrl(); ?>" class="register connect-bottom">Google</a>
                                        </div>
                                        <div class="form-row-last">
                                                <input type="hidden" name="Usertype" value="3"  />
                                                <input type="submit" name="register"style="width:35%!important;" class="register connect-bottom-face" value="Sign up">
                                                <a class=""style="" href="index.php">Sign in</a>
                                                <a class=""style="width: 100%;" href="registrationInstructor.php">Instructor</a>
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
