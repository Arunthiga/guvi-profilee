function register() {

    let name = $("#name").val();
    let email = $("#email").val();
    let password = $("#password").val();

    $.ajax({
        url: "/api/register.php",
        type: "POST",
        data: {
            name: name,
            email: email,
            password: password
        },
        success: function(res){
            alert(res);
            if(res.toLowerCase().includes("success")) {
                window.location = "login.html";
            }
        }
    });

}