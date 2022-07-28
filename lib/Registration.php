<?php
class register{
    private $email;
    private $fullname;
    private $password;
    private $comfirm_password;
    function __construct($email, $fullname, $password, $comfirm_password) {
        $this->email = $email;
        $this->fullname = $fullname;
        $this->password = $password;
        $this->comfirm_password = $comfirm_password;
    }
    function validation() {
        if (empty($this->email)){
            echo'<div><h3 style="font-weight:bold; text-align:center;">Please fill email!</h3><div>';
        }elseif (empty($this->fullname)){
            echo'<div><h3 style="font-weight:bold; text-align:center;">Please fill full name!</h3><div>';
        }elseif(empty($this->password)){
            echo'<div><h3 style="font-weight:bold; text-align:center;">Please fill password!</h3><div>';
        }elseif(empty($this->comfirm_password))  {
            echo'<div><h3 style="font-weight:bold; text-align:center;">Please fill comfirm password!</h3><div>';
        }elseif ($this->password !== $this->comfirm_password) {
            echo'<div><h3 style="font-weight:bold; text-align:center;">Password and Confirm password should match!</h3><div>';
        }else{
            return TRUE;
        } 
    }
    function insertuser($Usertype){
        global $dbh;
        $encPassword = sha1($this->password);
        echo $Usertype;
        $sql=$dbh->prepare("INSERT INTO user (Email,Password,FullName,UserTypeId) "
                . "VALUES('$this->email','$encPassword','$this->fullname','$Usertype')");
        if($sql->execute()){
            return true;
        }else{
            return FALSE;
        }
    }
    static function checkIsEmailFound($select,$form,$value){
        global $dbh;
        $sql =$dbh->prepare("SELECT $select FROM $form WHERE $select= ?");
        $sql->execute(array($value));
        $count=$sql->rowCount();
        if($count==1){
            return false;
        }else {
            return true;
        }        
    }
}
?>