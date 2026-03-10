$(document).ready(function() {
    let email = localStorage.getItem("user");
    let token = localStorage.getItem("token");
    if (!email || !token) {
        window.location = "login.html";
        return;
    }

    // Show email in header
    $("#displayEmail").text(email);

    // Load cached profile from localStorage first (instant display)
    let cachedProfile = localStorage.getItem("profile");
    if (cachedProfile) {
        try {
            let p = JSON.parse(cachedProfile);
            $("#displayName").text(p.fullname || "Your Name");
            $("#fullname").val(p.fullname);
            $("#skills").val(p.skills);
            $("#gender").val(p.gender);
            $("#country").val(p.country);
            $("#age").val(p.age);
            $("#dob").val(p.dob);
            $("#contact").val(p.contact);
            $("#city").val(p.city);
            $("#bio").val(p.bio);
        } catch(e) {}
    }

    // Also fetch from server (to get latest data)
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
                // Update display with server data
                $("#displayName").text(profile.fullname || "Your Name");
                $("#fullname").val(profile.fullname);
                $("#skills").val(profile.skills);
                $("#gender").val(profile.gender);
                $("#country").val(profile.country);
                $("#age").val(profile.age);
                $("#dob").val(profile.dob);
                $("#contact").val(profile.contact);
                $("#city").val(profile.city);
                $("#bio").val(profile.bio);

                // Update localStorage with fresh server data
                localStorage.setItem("profile", JSON.stringify({
                    fullname: profile.fullname,
                    skills:   profile.skills,
                    gender:   profile.gender,
                    country:  profile.country,
                    age:      profile.age,
                    dob:      profile.dob,
                    contact:  profile.contact,
                    city:     profile.city,
                    bio:      profile.bio
                }));
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
        token:    token,
        email:    email,
        fullname: $("#fullname").val(),
        skills:   $("#skills").val(),
        gender:   $("#gender").val(),
        country:  $("#country").val(),
        age:      $("#age").val(),
        dob:      $("#dob").val(),
        contact:  $("#contact").val(),
        city:     $("#city").val(),
        bio:      $("#bio").val()
    };

    $.post("/api/profile.php", profileData, function(res) {
        console.log("Save response:", res);
        alert(res);
        if (res.toLowerCase().includes("saved successfully")) {
            // Save to localStorage
            let stored = {
                fullname: profileData.fullname,
                skills:   profileData.skills,
                gender:   profileData.gender,
                country:  profileData.country,
                age:      profileData.age,
                dob:      profileData.dob,
                contact:  profileData.contact,
                city:     profileData.city,
                bio:      profileData.bio
            };
            localStorage.setItem("profile", JSON.stringify(stored));

            // Update displayed values on screen
            $("#displayName").text(profileData.fullname || "Your Name");
            $("#displayEmail").text(profileData.email);

        } else if (res.toLowerCase().includes("unauthorized") || res.toLowerCase().includes("invalid session")) {
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
