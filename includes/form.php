<?php
    class Form {
        public $fieldArray;
        public function __construct(){
            $this->fieldArray = ['lastname' => 'Last Name','firstname' => 'First Name','contact' => 'Contact Number','email' => 'Email Address','passport' => 'NRIC/Passport Number','address' => 'Address','zipcode' => 'Zip Code', 'city' => 'City' ,'state' => 'State','country' => 'Country',];
        }
        public function getFormFields(){
            return $this->fieldArray;
        }
    }