var User = new function __User() {
    
}



User.form = new function __UserForm() {

    this.create = function () {
        var first_name = $('#firstname').val();
        var last_name = $('#lastname').val();
        var email = $('#email').val();
        var password = $('#password').val();
        var confirm_password = $('#confirm-password').val();
        if (password != confirm_password) {
            alert("NOPE");
        } else {
            $.ajax({
                url: "/onlinejudge/register/user_register",
                method: "POST",
                data: {
                    first_name: first_name,
                    last_name: last_name,
                    email: email,
                    password: password,
                    confirm_password: confirm_password
                },
                success: function (response) {
                    if (response == true) {
                        window.location.replace("/onlinejudge/home");
                    } else {
                        alert("Something went wrong!");
                    }
                }
            })
        }
    }

    this.login = function() {
        var email = $('#email').val();
        var password = $('#password').val();
        $.ajax({
            url: "/onlinejudge/login/user_login",
            method: "POST",
            data: {
                email: email,
                password: password,
            },
            success: function (response) {
                if (response == true) {
                    window.location.replace("/onlinejudge/home");
                } else {
                    alert("Wrong email or password!");
                }
            }
        })
    }
}