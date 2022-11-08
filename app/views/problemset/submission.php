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
        <div id="js-submission"></div>
        <div class="ui-card">
            <div class="submission-submitted-at">You made this submission 94 days ago.</div>
            <div>
                <span class="submission-score">Score: 139</span>
                <span class="submission-status">Status: </span>
                <span class="submission-status" style="color: #1ba94c">Accepted</span>
            </div>
            <div style="font-weight: bold; font-size:18px; margin-top: 30px">Submitted Code</div>
            <div class="submission-code-header">
                <div>Language: C++</div>
                <div class="txt-link url">Open in editor</div>
            </div>
            <div class="problem-editor" id="js-editor"></div>
        </div>
    </div>
</div>

<script>
    var problem = JSON.parse('<?php echo $data['problem'] ?>');
    var submission = undefined;
    Problem.display.submission(problem, submission);
</script>