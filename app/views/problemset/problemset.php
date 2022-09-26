<div class="content">
    <div class="container">
        <div class="problem-label plT plB">Problems</div>
        <div class="ui-card url">
            <div class="flex1">
                <div>
                    <div class="problem-title psB">Hello World Contest #1: The Third Three Number Problem</div>
                    <div> <span id="difficulty" style="color: #d11534">Expert, </span> <span>Max Score: 150</span> </div>
                </div>
                <button class="btn-normal ui-btn btn-white msL">Solve Challenge</button>
            </div>
        </div>
        <div class="ui-card url">
            <div class="flex1">
                <div>
                    <div class="problem-title psB">Hello World Contest #1: The Third Three Number Problem</div>
                    <div> <span id="difficulty" style="color: #d11534">Expert, </span> <span>Max Score: 150</span> </div>
                </div>
                <button class="btn-normal ui-btn btn-white msL">Solve Challenge</button>
            </div>
        </div>
        <div class="ui-card url">
            <div class="flex1">
                <div>
                    <div class="problem-title psB">Hello World Contest #1: The Third Three Number Problem</div>
                    <div> <span id="difficulty" style="color: #d11534">Expert, </span> <span>Max Score: 150</span> </div>
                </div>
                <button class="btn-normal ui-btn btn-white msL">Solve Challenge</button>
            </div>
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
        $('#js-btn').html(`<button class="btn-ui normal-btn mT5" onclick="window.location.href='login';">Log In</button>`);
    }
</script>