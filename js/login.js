function login() {
    var formData = {
        email: document.getElementById('email').value,
        password: document.getElementById('password').value
    };

    if (!validateForm(formData)) {
        return;
    }

    fetch('/guvi_project_vishwas/php/login.php', {
        method: 'POST',
        headers: {
            'Content-Type': 'application/json', 
        },
        body: JSON.stringify(formData), 
    })
        .then(response => response.json())
        .then(data => {
            if (data.status === 'success') {
                localStorage.setItem('userEmail', formData.email);
                window.location.href = 'profile.html';
            } else {
                alert(data.message);
            }
        })
        .catch(error => {
            console.error('Fetch error:', error.message);
        });
}

function validateForm(formData) {
    for (var key in formData) {
        if (!formData[key]) {
            alert('All fields are required.');
            return false;
        }
    }

    return true;
}
