<div class="container">
    <div class="page-label">Submissions</div>
    <div class="table-wrap">
        <div class="submission-list-header">
            <p class="span">Problem</p>
            <p class="span center">Language</p>
            <p class="span center">Time</p>
            <p class="span center">Result</p>
            <p class="span center">Score</p>
        </div>
        <div id="js-submissions">
            <div class="submission-list-row">
                <p class="span txt-link url" data-url="contests/25/challenges/1/problem">Solve Me First 1</p>
                <p class="span center">C++</p>
                <p class="span center">72 ngày trước</p>
                <div class="span center"> <span class="center">Accepted</span> <span class="-ap icon-tick" style="color: #1ba94c"></span> </div>
                <p class="span center">139</p>
                <p class="span center txt-link url" data-url="contests/25/challenges/1/submissions/code/211">View Results</p>
            </div>
            <div class="submission-list-row">
                <p class="span txt-link url" data-url="contests/25/challenges/1/problem">Solve Me First 1</p>
                <p class="span center">C++</p>
                <p class="span center">74 ngày trước</p>
                <div class="span center"> <span class="center">Accepted</span> <span class="-ap icon-tick" style="color: #1ba94c"></span> </div>
                <p class="span center">139</p>
                <p class="span center txt-link url" data-url="contests/25/challenges/1/submissions/code/210">View Results</p>
            </div>
        </div>
    </div>
</div>

<div class="control-panel">
    Select Language:
    <select id="languages" class="languages">
        <option value="cpp"> C++ </option>
        <option value="c"> C </option>
        <option value="php"> PHP </option>
        <option value="python"> Python </option>
    </select>
</div>

<div class="problem-editor" id="js-editor"></div>

<div class="button-container">
    <button class="btn-submit" onclick="Problem.form.submit_code()">Submit</button>
</div>

<div class="problem-output"></div>

<script>
    var username = '<?php
                    if (isset($_SESSION['username'])) {
                        echo $_SESSION['username'];
                    } else {
                        echo '';
                    }
                    ?>';
    if (username) {
        $('#js-btn').html(`<a onclick="">${username}</a>`);
    } else {
        $('#js-btn').html(`<button class="btn-ui btn-normal mT5"
             onclick="window.location.href='login';">Log In</button>`);
    }
    Problem.display.init();
</script>