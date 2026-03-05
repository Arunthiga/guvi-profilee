function saveProfile() {

    $.post("php/profile.php", {

        email: localStorage.getItem("user"),
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
    });

}