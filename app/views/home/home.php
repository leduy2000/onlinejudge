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
    <button class="btn-submit" onclick="Problem.form.submitCode()">Submit</button>
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