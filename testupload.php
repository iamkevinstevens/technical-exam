<?php
    if(isset($_FILES['photoup'])){
        echo $_FILES['photoup']['tmp_name'];
        move_uploaded_file($_FILES['photoup']['tmp_name'],'uploads/'.$_FILES['photoup']['name']);
    }