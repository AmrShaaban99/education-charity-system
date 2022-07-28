<?php
class login {  
    private $email;
    private $password;
    function __construct($email,$password="") {
        $this->email = $email;
        $this->password = $password;
    }
    function validation() {
        if($this->email == null){
            echo "please insert the value of name";
        }elseif(is_numeric($this->email)){
            echo "the value of name must be letters";
        }elseif ($this->password == null){
            echo "please insert the password";
        }else{
            return true;
        }
    }
    function Login(){
        // get connection 
        global $dbh;
        // prepare query
        $sql=$dbh->prepare("SELECT pages.PhysicalName,usertype.Name AS NameOfUserType,user.FullName,pages.FriendlyName FROM user "
                . " INNER JOIN usertype ON usertype.Id = user.UserTypeId "
                . " INNER JOIN usertypepage ON usertypepage.UserTypeId = usertype.Id "
                . " INNER JOIN  pages ON pages.Id  = usertypepage.PageId "
                . " WHERE user.Email= '$this->email' ");
        //execute sql query
         $sql->execute(array());
        $fetch=$sql->fetchAll(PDO::FETCH_ASSOC);
        return $fetch;   
    }   
    function checkLogin(){
       global $dbh;
        // prepare query
        $sql=$dbh->prepare("SELECT * FROM user WHERE Email='$this->email'AND Password='$this->password'");
        //execute sql query
        $sql->execute();
        $count=$sql->rowCount();;
        if($count==1){
            return True;
        }else {
            return false;
        }   
    }
    function checkLoginWithGoogle(){
         global $dbh;
        // prepare query
        $sql=$dbh->prepare("SELECT * FROM user WHERE Email='$this->email'");
        //execute sql query
        $sql->execute();
        $count=$sql->rowCount();;
        if($count==1){
            return True;
        }else {
            return false;
        }   
        
    }
    
}