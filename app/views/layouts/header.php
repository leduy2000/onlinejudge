<div class="header">
    <div class="container flex1">
        <div class="header-button">
            <a href="/onlinejudge/home">HOME</a>
            <a href="/onlinejudge/contests">CONTESTS</a>
            <a href="/onlinejudge/problemset">PROBLEMSET</a>
            <a href="/onlinejudge/leaderboard">LEADERBOARD</a>
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
    if (username) {
        $('#js-btn').html(`<a href="">${username}</a>`);
    } else {
        $('#js-btn').html(`<button class="btn-ui btn-normal mT5"
             onclick="window.location.href='login';">Log In</button>`);
    }
</script>