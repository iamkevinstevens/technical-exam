<?php
    include('includes.php');
    $form = new Form();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>ViewQwest exam - Kevin James Stevens</title>
    <link href="https://fonts.googleapis.com/css?family=Roboto:400,400i,500,500i,700,700i,900,900i" rel="stylesheet">
    <script src="http://code.jquery.com/jquery-3.3.1.min.js" integrity="sha256-FgpCb/KJQlLNfOu91ta32o/NMZxltwRo8QtmkMRdAu8=" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="assets/style.css">
</head>
<body>
    <div class="main-container">
        <div class="reg-heading">
            <h2>Enter Your Personal Information Below</h2>
            <p>Please fill up the fields below correctly</p>
        </div>
        <div class="reg-form-wrap">
            <form method="post" enctype="multipart/form-data">
                <div class="form-wrap">
                    <div class="form-entries">

                        <?php
                            foreach($form->getFormFields() as $field => $label){
                        ?>
                            <div class='input-wrap' id='<?= $field ?>-wrap'>
                                <label for="<?= $field ?>"><?= $label ?></label>
                                <?php if ($field == "country") { ?>
                                    <select name="<?= $field ?>" id="<?= $field ?>">
                                        <option selected disabled value="">Select country</option>
                                        <option value="Philippines">Philippines</option>
                                        <option value="Malaysia">Malaysia</option>
                                        <option value="Singapore">Singapore</option>
                                    </select>
                                <?php } else { 
                                        $length = ($field == "address") ? "maxlength='250'" : '';
                                    ?>
                                    <input <?= $length ?> name='<?= $field ?>' id='<?= $field ?>' type="text" placeholder='Enter here'/>
                                <?php } ?>
                                <p class='msg' id='<?= $field ?>-msg'></p>
                            </div>
                        <?php } ?>
                    </div>

                    <div class="form-photo">
                        <div class="input-wrap" id='photoup-wrap'>
                            <div class="image-wrap">
                                <img src="assets/camera.png" alt="">
                            </div>
                            <input type="file" id='photoup' name='photoup'>
                            <p class='msg' id='photoup-msg'></p>																															
                        </div>
                    </div>
                    
                </div>
                <button type="submit" id="submit">Next</button>
			</form>
        </div>
    </div>

    <div id="lightbox">
        <div class="lb-content">
            <div class="lb-confirm">
                <div class="lb-confirm-wrap">
                    <div class='lb-header'>
                        <h2>Review Your Personal Information Below</h2>
                        <p>Please check if all details are correct.</p>
                    </div>
                    <div class="lb-body">
                        <div class="lb-entries">
                            <?php
                                $addrblock = ["address","zipcode","city","state","country"];
                                foreach($form->fieldArray as $key => $label){
                                    if(!in_array($key,$addrblock)){
                            ?>
                                <div class="lb-entry">
                                    <p class="label"><?= $label; ?></p>
                                    <p id="<?= $key ?>-confirm" class="value"></p>
                                </div>
                            <?php } } ?>
                                 <div class="lb-entry">
                                    <p class="label">Address</p>
                                    <p id="address-confirm" class="value"></p>
                                    <p>
                                        <span class="value" id="zipcode-confirm"></span>&nbsp;
                                        <span class="value" id="city-confirm"></span>&nbsp;
                                        <span class="value" id="state-confirm"></span>
                                    </p>
                                    <p><span class="value" id="country-confirm"></span></p>
                                </div>
                        </div>
                        <div class="lb-img">
                            <img src="" alt="">
                            <p>
                                <strong>Your photo</strong><br />
                                <span>You may change this by reselecting from the form. (press 'Back')</span>
                            </p>
                        </div>
                    </div>
                    <div class='lb-footer'>
                        <div class="confirm-box">
                            <input type="checkbox" id="confirm_checkbox" name='confirm_checkbox'/>
                            <label for='confirm_checkbox'>I have read and accept the terms and conditions of XYZ company.</label for>
                        </div>
                        <button class="back enabled">Back</button>
                        <button class="submit disabled">Submit</button>
                    </div>
                </div>
            </div>
            <div class="lb-complete">
                <div class="lb-complete-wrap">
                    <img src="assets/greencheck.png" alt="">
                    <div class="msg-wrap">
                        <h2>Thank you for your submission</h2>
                        <p>We will process your application shortly.</p>
                        <p>Page will reload in 5 seconds.</p>
                    </div>
                </div>
            </div>
        </div>
    </div>

	<script src="assets/main.js"></script>
</body>
</html>
