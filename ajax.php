<?php
    include("validator.php");

    $raw['firstname'] = $_POST['firstname'];
    $raw['lastname'] = $_POST['lastname'];
    $raw['contact'] = $_POST['contact'];
    $raw['email'] =  $_POST['email'];
    $raw['passport'] =  $_POST['passport'];
    $raw['address'] = $_POST['address'];
    $raw['city'] = $_POST['city'];
    $raw['state'] = $_POST['state'];
    $raw['country'] =  $_POST['country'];
    $raw['zipcode'] = $_POST['zipcode'];
    $raw['photoup'] = $_POST['photoup'];
    $fail = 0;

    foreach($raw as $key => $value){
        $validate = new Validator($key,$value);
        $validate->validateField();

        $resArray[$key] = array(
            'val' => $validate->val,
            'msg' => $validate->msg,
            'result' => $validate->result,
        );
        if($validate->result == 'fail'){
            $fail += 1;
        }
    }

    if($fail > 0){
        $ovallArray = array(
            'msg' => 'Cannot proceed registration. Fields with errors are highlighted below',
            'result' => 'denied',
        );
    } else {
        $ovallArray = array(
            'msg' => 'Success! No errors!',
            'result' => 'proceed',
        );
    }

    $resArray['overall'] = $ovallArray;

    echo json_encode($resArray);



