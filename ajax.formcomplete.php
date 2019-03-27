<?php
    include('includes/uploadtodatabase.php');
    include('includes/form.php');
    
    $goget = New Form();
    $keys = $goget->getFormFields();
    $sent = [];
    foreach($keys as $key => $value){
        $sent[$key] = $_POST[$key];
    }
    $commence = new UploadtoDB($sent);
    $commence->goUpload();