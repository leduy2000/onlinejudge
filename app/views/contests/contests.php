<div class="content">
    <div class="container">
        <div class="contest-title plT psB">Active Contests</div>
        <div class="plT">
            <div class="ui-card contest-item" data-url="contests/1/challenges">
                <div class="flex1 align-center">
                    <div class="contest-title url">Hello World Contest</div>
                    <div class="flex align-center">
                        <div class="contest-status msR">Jan 15 2027, 21:00 pm</div>
                        <div class="txt-link url msR">View details</div>
                        <div class="btn-white ui-btn url">Enter</div>
                    </div>
                </div>
            </div>
        </div>
        <div class="plT">
            <div class="ui-card contest-item" data-url="contests/1/challenges">
                <div class="flex1 align-center">
                    <div class="contest-title url">Hello World Contest</div>
                    <div class="flex align-center">
                        <div class="contest-status msR">Jan 15 2027, 21:00 pm</div>
                        <div class="txt-link url msR">View details</div>
                        <div class="btn-white ui-btn url">Enter</div>
                    </div>
                </div>
            </div>
        </div>
        <div class="plT">
            <div class="ui-card contest-item" data-url="contests/1/challenges">
                <div class="flex1 align-center">
                    <div class="contest-title url">Hello World Contest</div>
                    <div class="flex align-center">
                        <div class="contest-status msR">Jan 15 2027, 21:00 pm</div>
                        <div class="txt-link url msR">View details</div>
                        <div class="btn-white ui-btn url">Enter</div>
                    </div>
                </div>
            </div>
        </div>
        <div class="contest-title plT">Archived Contests</div>
    </div>
</div>

<script>
    $(document).ready(function() {
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
    });
</script>