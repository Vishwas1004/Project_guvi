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
                if (response.includes("success")) {
                    setTimeout(function () {
                        window.location.href = "login.html";
                    }, 3000);
                }
            },
            error: function (error) {
                console.log(error);
            }
        });
    }
});
