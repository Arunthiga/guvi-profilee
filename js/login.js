function login() {
    let email = $("#email").val();
    let password = $("#password").val();

    $.post("/api/login.php", {
        email: email,
        password: password
    }, function(res) {
        try {
            let response = JSON.parse(res);
            if(response.status === "success") {
                localStorage.setItem("user", response.email);
                localStorage.setItem("token", response.token);
                window.location = "profile.html";
            } else {
                alert(response.message || "Invalid login");
            }
        } catch (e) {
            console.error("Login error:", res);
            alert("An error occurred during login.");
        }
    });
}
