<div class="content">
    <div class="container">
        <div class="problem-tab-list">
            <div class="problem-tab-item problem-active url">Problem</div>
            <div class="problem-tab-item url">Submissions</div>
            <div class="problem-tab-item url">Discussions</div>
        </div>
        <div id="js-problem"></div>
        <div class="problem-editor-wrap">
            <div class="problem-editor-toolbar flex1">
                <div></div>
                <div class="problem-editor-toolbar-right">
                    <div class="problem-editor-toolbar-select-theme txt-link url">Change Theme</div>
                    <div class="problem-editor-toolbar-select-language-label">Language</div>
                    <div>
                        <select id="languages" class="problem-editor-toolbar-select-languages">
                            <option value="cpp"> C++ </option>
                            <option value="c"> C </option>
                            <option value="php"> PHP </option>
                            <option value="python"> Python </option>
                        </select>
                    </div>
                </div>
            </div>
            <div class="problem-editor" id="js-editor"></div>
        </div>
        <div class="flex1">
            <div></div>
            <button class="btn-normal ui-btn btn-green msT" onclick="Problem.form.submit_code()">Submit</button>
        </div>

        <!-- <div class="problem-output"></div> -->
    </div>

</div>

<script>
    var problem = JSON.parse('<?php echo $data['problem'] ?>');
    Problem.display.init(problem);
</script>