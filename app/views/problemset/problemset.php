<div>This is problemset</div>

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
        $('#js-btn').html(`<button class="btn-ui normal-btn mT5" onclick="window.location.href='login';">Log In</button>`);
    }
</script>