<?php
//Include Google Client Library for PHP autoload file

require_once 'vendor/autoload.php';
function googleapi($page){
    //Make object of Google API Client for call Google API
    $google_client = new Google_Client();

    //Set the OAuth 2.0 Client ID
    $google_client->setClientId('715266156566-eoreghm3d1vvbjuq0v7g2c2n21sfb9ca.apps.googleusercontent.com');

    //Set the OAuth 2.0 Client Secret key
    $google_client->setClientSecret('P7It0sa2Mk7oDmFDvezKTEIu');
    //Set the OAuth 2.0 Redirect URI
    $google_client->setRedirectUri('http://localhost/education_charity_system/cpanel/'.$page.'.php');


    //
    $google_client->addScope('email');

    $google_client->addScope('profile');
    return $google_client;
}

?>