<?php
include('includes/dbcon.php');

class UploadtoDB extends Dbcon {
    public $received;
    public function __construct($rawarray){
        $this->received = $rawarray;
    }   
    public function goUpload(){
        
        $sql = "INSERT INTO users (";

        foreach($this->received as $key => $value){
            $sql .= $key . ", ";
        }

        $sql .= "photo) VALUES (";

        foreach($this->received as $key => $value){
            $sql .= "'".$value."', ";
        }

        $timewithfilename = time().'-'.$_FILES['photoup']['name'];
        $sql .= "'uploads/".$timewithfilename."')";
        
        if(move_uploaded_file($_FILES['photoup']['tmp_name'],'uploads/'.$timewithfilename)){
            $this->connect()->query($sql);
        }
    }
}