<?php
include('form.php');

public $formEntries = [];

class FormConfirm extends Form {
    public function formFetch(){
        foreach($this->getFormFields() as $key => $thisfield){
             $this->formEntries[$key] = array(
                 'label' => $thisfield,
                 'value' => $_POST[$key]
             );
        }
    }
}