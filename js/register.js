
function register() {
    $.ajax({
        url: "php/register.php",
        method: "POST",
        data: {
            name: $("#name").val(),
            email: $("#email").val(),
            password: $("#password").val()
        },
        success: function(res) {
            alert(res);
            window.location = "login.html";
        }
    });
}
