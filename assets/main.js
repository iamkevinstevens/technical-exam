(function(){

    
    var confirmArray = [];
    var fsubmit = $("button.submit");
    var formData = "";

    $("input[type='text']").keyup(function(){
        clearMsg($(this));
    });
    $("select").click(function(){
        clearMsg($(this));
    });
    $("input[type='file']").click(function(){
        clearMsg($(this));
    });
    $(".lb-footer .back").click(function(){
        $('#lightbox').removeClass('show');
        $('#lightbox .lb-confirm').hide();
    });

    const clearMsg = (elem) => {
        var elemid = elem.attr("id");
        elem.parent().removeClass('fail').removeClass('pass');
        $("#"+elemid+"-msg").empty();
    }

    const imagePreview = (input) => {
        if(input.files && input.files[0]){
            var file = input.files[0];
            var imgElement = $("#photoup-wrap img, .lb-content .lb-img img");
            var invalidImage = "assets/nopreview.png"
            var fileType = file["type"];
            var validImageTypes = ["image/jpg", "image/png", "image/jpeg"];
            if (jQuery.inArray(fileType, validImageTypes) < 0) {
                imgElement.attr('src',invalidImage);
            } else {
                var reader = new FileReader();
                reader.onload = function(e){
                    imgElement.attr('src',e.target.result);
                }
                reader.readAsDataURL(input.files[0]);
            }
        }
    }

    $("#photoup").change(function(){
        if($(this).val() == ""){
            $("#photoup-wrap img").attr('src',"");
        }  
        else {
            imagePreview(this);
        }
    });

    const formConfirm = (res) => {
        var stringifyRes = JSON.stringify(res);
        $.ajax({
            url: 'ajax.formconfirm.php',
            type: 'POST',
            data: {entries : stringifyRes},
            success: function(data){
                confirmArray = JSON.parse(data);
                $.each(confirmArray , function(index, value) {
                    $("#"+ index + "-confirm.value").empty().append(value.val);;
                });
            }
        });
    }

    const formComplete = (confirm) => {
        $.ajax({
            url: 'ajax.formcomplete.php',
            type: 'POST',
            data: formData,
            async: true,
            contentType: false,
            processData:false,
            success: function(data){
                $("#lightbox .lb-confirm").hide();
                $("#lightbox .lb-complete").show();
                setTimeout(function(){
                    window.location.reload(true);
                }, 5000);
            }
        });
    }

    fsubmit.click(function(){
        if($("#confirm_checkbox").is(":checked")){
            formComplete(confirmArray);
        }
    });

    $("form").submit(function(e){
        e.preventDefault();
        var thisForm = this;
        formData = new FormData(thisForm);
        formData.append('lastname',$('#lastname').val());
        formData.append('firstname',$('#firstname').val());
        formData.append('contact',$('#contact').val());
        formData.append('email',$('#email').val());
        formData.append('passport',$('#passport').val());
        formData.append('address',$('#address').val());
        formData.append('city',$('#city').val());
        formData.append('state',$('#state').val());
        formData.append('country',$('#country').val());
        formData.append('zipcode',$('#zipcode').val());
        formData.append('photoup',$('#photoup').val());

        $.ajax({
            url: 'ajax.php',
            type: "POST",
            data: formData,
            contentType: false,
            processData:false,
            success: function(data){
                var resArray = [];
                resArray = JSON.parse(data);
                console.clear();
                $.each(resArray , function(index, val) {
                    var thisField = $('#' + index + '-wrap');
                    
                    thisField.removeClass('fail').removeClass('pass')
                    .addClass(val.result);

                    thisField.find('.msg')
                    .empty()
                    .append('<span>' + val.msg + '</span>');
                    
                    if(val.result == 'proceed'){
                        $('#lightbox').addClass('show');
                        $('#lightbox .lb-confirm').show();
                        formConfirm(resArray);
                    }
                });
            }
        });
    });
    $("#confirm_checkbox").click(function() {
        if($(this).is(':checked')) {
            fsubmit.removeAttr('disabled');
            fsubmit.removeClass("disabled");
        } else {
            fsubmit.attr("disabled","disabled");
            fsubmit.toggleClass("disabled");
        }
    });

    

})(jQuery);