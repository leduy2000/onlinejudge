<div class="breadcrumb">
    <div class="container">
        <div class="mlT mlB">
            <div id="name" class="page-label" style="margin-top: 30px; margin-bottom: 30px"></div>
        </div>
    </div>
</div>
<div class="content">
    <div class="container">
        <div class="problem-tab-list">
            <div class="problem-tab-item problem-active url">Problem</div>
            <div id="submissions" class="problem-tab-item url">Submissions</div>
        </div>
        <div id="js-problem"></div>
        <div class="problem-editor-wrap">
            <div class="problem-editor-toolbar flex1">
                <div></div>
                <div class="problem-editor-toolbar-right">
                    <!-- <div class="problem-editor-toolbar-select-theme txt-link url">Change Theme</div> -->
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
            <button id="submit-btn" class="btn-normal ui-btn btn-green msT mlB">Submit</button>
        </div>
        <div id="js-result"></div>
    </div>

</div>

<script>
    var contest = JSON.parse('<?php echo $data['contest'] ?>');
    var problem = JSON.parse('<?php echo $data['problem'] ?>');
    Problem.display.contest(contest, problem);
</script>