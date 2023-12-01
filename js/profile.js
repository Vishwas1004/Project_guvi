$(document).ready(function () {
    var userEmail = localStorage.getItem('userEmail');

    if (userEmail) {
        $.ajax({
            type: 'GET',
            url: '/guvi_project_vishwas/php/profile.php',
            data: { email: userEmail },
            success: function (response) {
                if (response.status === 'success') {
                    var user = response.user;

                    $('#id').text(user.id);
                    $('#username').text(user.username);
                    $('#Name').text(user.Name);
                    $('#gender').text(user.gender);
                    $('#dob').text(user.dob);
                    $('#address').text(user.address);
                    $('#email').text(user.email);
                    $('#phoneNumber').text(user.phoneNumber);
                    $('#password').text(user.password);
                    $('#currentStatus').text(user.currentStatus);
                } else {
                    console.error('Error:', response.message);
                }
            },
            error: function (xhr, status, error) {
                console.error('AJAX Error:', status, '-', error);
            }
        });
    } else {
        console.error('User email not found in local storage.');
    }
});