$(document).ready(function(){
    $('#loginForm').submit(function(event){
        event.preventDefault();
        var formData = $(this).serialize();
        $.ajax({
            url:"api/users/login.php", 
            type:'POST',
            data:formData,
            dataType:'json',
            beforeSend:function(){
                $('#loginSubmitBtn').html('Loading...');
            },
            success:function(data){
                $('#loginSubmitBtn').html('Login');
                if(data.message == "success"){
                    window.location.href ="index.php";
                }
                if(data.message == "failed"){
                    $('#alertMessage').html('<p class="text-danger">Wrong email or password</p>');
                    return false;
                }
            }

        });
    });
});