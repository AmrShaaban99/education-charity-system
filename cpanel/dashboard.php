<?php
include '../config.php';
include '../lib/login.php';
include 'template/header.php';
session_start();
if(isset($_SESSION['Email'])){
    ?>
     <?php
        $data= new login($_SESSION['Email']);
        $userdetails=$data->Login();
        if(is_array($userdetails)){
            echo'<div class="w3-sidebar w3-bar-block w3-card w3-animate-left" style="display:none" id="mySidebar">
              <button class="w3-bar-item w3-button w3-large"
              onclick="w3_close()">Close &times;</button>';
            foreach ($userdetails as $userurl){
                echo'<a href="'.$userurl["PhysicalName"].'" class="w3-bar-item w3-button">'.$userurl["FriendlyName"].'</a>';       
         }
         echo'<a href="logout.php" class="w3-bar-item w3-button">logout</a>';
        echo'</div>';
            echo'<div id="main">
                    <div class="w3-teal">
                      <button id="openNav" class="w3-button w3-teal w3-xlarge" onclick="w3_open()">&#9776;</button>
                      <div class="w3-container">';
                        echo'<h1>Welcome '.$userdetails[0]["NameOfUserType"].' : '.$userdetails[0]["FullName"].' </h1>'
                        . ' </div>
                    </div>
                </div>';
            ?>
             
<?php
}else{
      echo'<div><h2 style="font-weight:bold; text-align:center;">The User is already Found </h2><div>';
    }
include 'template/footer.php';
}else{
    header('Location:index.php');
}
?>




