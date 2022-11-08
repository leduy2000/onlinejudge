<div class="header">
    <div class="container flex1">
        <div class="header-button">
            <img class="logo url" src="https://usth.edu.vn/wp-content/uploads/2021/11/logo.png">
            <a href="/onlinejudge/home">HOME</a>
            <a href="/onlinejudge/contests">CONTESTS</a>
            <a href="/onlinejudge/problemset">PROBLEMSET</a>
            <a href="/onlinejudge/administration">ADMINISTRATION</a>
        </div>
        <div class="header-button">
            <div id="js-btn"></div>
        </div>
    </div>
</div>

<script>
    var username = '<?php
                    if (isset($_SESSION['username'])) {
                        echo $_SESSION['username'];
                    } else {
                        echo '';
                    }
                    ?>';
    var user_id = '<?php
                    if (isset($_SESSION['user_id'])) {
                        echo $_SESSION['user_id'];
                    } else {
                        echo '';
                    }
                    ?>';
    if (username) {
        $('#js-btn').html(`<a href="">${username}</a>
                            <button class="btn-ui btn-green btn-normal mT5" onclick="User.form.logout()">Log Out</button>
        `);
    } else {
        $('#js-btn').html(`<button class="btn-ui btn-green btn-normal mT5"
             onclick="window.location.href='/onlinejudge/login';">Log In</button>`);
    }
</script>