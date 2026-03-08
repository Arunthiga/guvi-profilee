function login() {
    let email = $("#email").val();
    let password = $("#password").val();

    $.post("/api/login.php", {
        email: email,
        password: password
    }, function(res) {
        if(res.trim() === "success") {
            localStorage.setItem("user", email);
            window.location = "profile.html";
        } else {
            alert("Invalid login");
        }
    });
}
