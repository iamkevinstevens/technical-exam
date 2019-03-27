<?php
include('includes/dbcon.php');

class Validator extends Dbcon{
    public $key;
    public $val;
    public $msg = "";
    public $result = "pass";
    private $targetfile;
    private $filetype;
    
    public function __construct($key,$val){
        $this->val = $val;
        $this->key = $key;
    }
    public function validatePhoto() {
        $this->targetfile = "uploads/" . basename($_FILES[$this->key]["name"]);
        $this->filetype = strtolower(pathinfo($this->targetfile,PATHINFO_EXTENSION));
        if($this->filetype != "jpg" && $this->filetype != "png" && $this->filetype != "jpeg") {
            $this->msg = "Sorry. We only allow jpg and png file types";
            $this->result = "fail";
        }
        if($_FILES[$this->key]['size'] == 0){
            $this->msg = "Sorry. We only allow files lower than 2 MB";
            $this->result = "fail";
        }
    }
    public function atleastTwo(){
        if(strlen($this->val) < 2){
            $this->msg = "Must at least have 2 characters.";
            $this->result = "fail";
        }
    }
    public function checkRequire() {
        if($this->val != true || $this->val == "" || $this->val == "null"){
            $this->msg = "This is required";
            $this->result = "fail";
        } else {
            $this->atleastTwo();
        }
    }
    public function isValidEmail(){
        if (!filter_var($this->val, FILTER_VALIDATE_EMAIL)) {
            $this->msg = "This is not a valid email";
            $this->result = "fail";
        }
    }
    public function ifAlphabet() {
        if(preg_match('/^[a-zA-Z ]*$/', $this->val) === 0){
            $this->msg = "Alphabetic characters only";
            $this->result = "fail";
        }
    }
    public function ifNumeric() {
        if(preg_match('/^[0-9]+$/', $this->val) === 0){
            $this->msg = "Numeric characters only. Pls check spaces and special chars.";
            $this->result = "fail";
        }
    }
    public function ifAlphanumeric(){
        if(preg_match('/^[[:alnum:]_]+$/', $this->val) === 0){
            $this->msg = "Alphanumeric characters only. Pls check spaces and special chars.";
            $this->result = "fail";
        }
    }
    public function validateField() {
        $this->checkRequire();
        if($this->result == "pass"){
            if($this->key == "photoup"){
                $this->validatePhoto();
            }
            if($this->key == "firstname" || $this->key == "lastname"){
                $this->ifAlphabet();
            }
            if($this->key == "passport" || $this->key == "zipcode"){
                $this->ifAlphanumeric();
            }
            if($this->key == "contact"){
                $this->ifNumeric();
            }
            if($this->key == "email"){
                $this->isValidEmail();
            }
        }
    }
}