$(document).ready(function() {
    let email = localStorage.getItem("user");
    let token = localStorage.getItem("token");
    if (!email || !token) {
        window.location = "login.html";
        return;
    }

    $(\"#displayEmail\").text(email);

    $.get("/api/profile_get.php", { email: email, token: token }, function(data) {
        if (!data) return;
        try {
            let profile = JSON.parse(data);
            if (profile && !profile.error && !profile.new_user) {
                if (profile.status === "error") {
                    alert(profile.message);
                    window.location = "login.html";
                    return;
                }
                $(\"#displayName\").text(profile.fullname || "User");
                $(\"#fullname\").val(profile.fullname);
                $(\"#skills\").val(profile.skills);
                $(\"#gender\").val(profile.gender);
                $(\"#country\").val(profile.country);
                $(\"#age\").val(profile.age);
                $(\"#dob\").val(profile.dob);
                $(\"#contact\").val(profile.contact);
                $(\"#city\").val(profile.city);
                $(\"#bio\").val(profile.bio);
            }
        } catch (e) {
            console.error("Error parsing profile data:", data);
        }
    });
});

function saveProfile() {
    let email = localStorage.getItem("user");
    let token = localStorage.getItem("token");

    let profileData = {
        token: token,
        email: email,
        fullname: $(\"#fullname\").val(),
        skills: $(\"#skills\").val(),
        gender: $(\"#gender\").val(),
        country: $(\"#country\").val(),
        age: $(\"#age\").val(),
        dob: $(\"#dob\").val(),
        contact: $(\"#contact\").val(),
        city: $(\"#city\").val(),
        bio: $(\"#bio\").val()
    };

    $.post("/api/profile.php", profileData, function(res) {
        alert(res);
        if (res.trim() === "Profile Saved Successfully") {
            // Save profile details to localStorage
            localStorage.setItem("profile", JSON.stringify({
                fullname: profileData.fullname,
                skills:   profileData.skills,
                gender:   profileData.gender,
                country:  profileData.country,
                age:      profileData.age,
                dob:      profileData.dob,
                contact:  profileData.contact,
                city:     profileData.city,
                bio:      profileData.bio
            }));
            $(\"#displayName\").text(profileData.fullname || "User");
        } else if (res.trim() === "Unauthorized" || res.trim() === "Invalid session") {
            window.location = "login.html";
        }
    });
}

function logout() {
    let token = localStorage.getItem('token');
    $.post('/api/logout.php', { token: token }, function() {
        localStorage.removeItem('user');
        localStorage.removeItem('token');
        localStorage.removeItem('profile');
        window.location = 'login.html';
    });
}
