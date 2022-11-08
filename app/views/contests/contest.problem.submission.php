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
            <div id="problem" class="problem-tab-item url">Problem</div>
            <div class="problem-tab-item problem-active url">Submissions</div>
        </div>
        <div class="ui-card mlB">
            <div id="time" class="submission-submitted-at"></div>
            <div>
                <span id="score" class="submission-score"></span>
                <span class="submission-status">Status: </span>
                <span id="res" class="submission-status"></span>
            </div>
            <div style="font-weight: bold; font-size:18px; margin-top: 30px">Submitted Code</div>
            <div class="submission-code-header">
                <div id="language">Language: C++</div>
                <div class="txt-link url">Open in editor</div>
            </div>
            <div class="problem-editor" id="js-editor"></div>
        </div>
        <div id="js-result"></div>
    </div>
    
</div>

<script>
    var problem = JSON.parse('<?php echo $data['problem'] ?>');
    var submission = JSON.parse('<?php echo $data['submission'] ?>');
    var contest = JSON.parse('<?php echo $data['contest'] ?>');
    Submission.display.contest(contest, problem, submission);
</script>