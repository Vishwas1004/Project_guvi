$(document).ready(function () {
    $("#registerButton").on("click", function () {
        register();
    });

    function register() {
        $.ajax({
            type: "POST",
            url: "php/register.php",
            data: $("#registerForm").serialize(),
            success: function (response) {
                $("#registrationResult").html(response);
            },
            error: function (error) {
                console.log(error);
            }
        });
    }
});
