// Add any necessary JavaScript here
// For example, you can add smooth scrolling for the navigation links
document.querySelectorAll('.top-right-buttons button').forEach(button => {
    button.addEventListener('click', function (e) {
        e.preventDefault();
        const targetId = this.getAttribute('onclick').match(/'(.*?)'/)[1];
        document.querySelector(targetId).scrollIntoView({
            behavior: 'smooth'
        });
    });
});



//function to call next page on button click
function goToPage(pageUrl) {
    window.location.href = pageUrl;
}



//login
document.getElementById('loginForm').addEventListener('submit', function (e) {
    e.preventDefault();

    var xhr = new XMLHttpRequest();
    xhr.open('POST', 'login.php', true);
    xhr.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');

    xhr.onreadystatechange = function () {
        if (xhr.readyState === 4 && xhr.status === 200) {
            var response = JSON.parse(xhr.responseText);
            if (response.success) {
                window.location.href = response.redirect;
            } else {
                alert('Invalid username or password.');
            }
        }
    };

    var username = document.getElementById('username').value;
    var password = document.getElementById('password').value;
    var role = document.getElementById('role').value;
    xhr.send('username=' + username + '&password=' + password + '&role=' + role);
});
