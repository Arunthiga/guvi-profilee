function login() {
    $.post("php/login.php", {
        email: $("#email").val(),
        password: $("#password").val()
    }, function(res) {

        if(res.trim() === "success") {
localStorage.setItem("user", email);
            window.location = "profile.html";
        } else {
            alert("Invalid login");
        }

    });
}
