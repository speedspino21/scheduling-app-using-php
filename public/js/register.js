$(document).ready(function(){
    $('#registrationForm').submit(function(event){
        event.preventDefault();
        var formData = $(this).serialize();
        $.ajax({
            url:"api/users/new_user.php", 
            type:'POST',
            data:formData,
            dataType:'json',
            beforeSend:function(){
                $('#registerSubmitBtn').html('Loading...');
            },
            success:function(data){
                $('#registerSubmitBtn').html('Register');
                if(data.message == "success"){
                    $('#alertMessage').html('<p class="text-success">Successfully registered an account</p>');
                    window.location.href ="login.php";
                }
                if(data.message == "errorPass"){
                    $('#alertMessage').html('<p class="text-success">Password do not match please check</p>');
                    return false;
                }
            }

        });
    });
});