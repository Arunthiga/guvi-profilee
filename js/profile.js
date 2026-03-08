$(document).ready(function() {
    let email = localStorage.getItem("user");
    if (!email) {
        window.location = "login.html";
        return;
    }

    $("#displayEmail").text(email);

    $.get("/api/profile_get.php", { email: email }, function(data) {
        if (!data) return;
        try {
            let profile = JSON.parse(data);
            if (profile && !profile.error && !profile.new_user) {
                $("#displayName").text(profile.fullname || "User");
                $("#fullname").val(profile.fullname);
                $("#skills").val(profile.skills);
                $("#gender").val(profile.gender);
                $("#country").val(profile.country);
                $("#age").val(profile.age);
                $("#dob").val(profile.dob);
                $("#contact").val(profile.contact);
                $("#city").val(profile.city);
                $("#bio").val(profile.bio);
            }
        } catch (e) {
            console.error("Error parsing profile data");
        }
    });
});

function saveProfile() {
    let email = localStorage.getItem("user");
    $.post("/api/profile.php", {
        email: email,
        fullname: $("#fullname").val(),
        skills: $("#skills").val(),
        gender: $("#gender").val(),
        country: $("#country").val(),
        age: $("#age").val(),
        dob: $("#dob").val(),
        contact: $("#contact").val(),
        city: $("#city").val(),
        bio: $("#bio").val()
    }, function(res) {
        alert(res);
        $("#displayName").text($("#fullname").val() || "User");
    });
}