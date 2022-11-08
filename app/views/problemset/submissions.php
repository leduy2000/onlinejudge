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
        <div class="problem-submissions-header">
            <div class="result">RESULT</div>
            <div class="score">SCORE</div>
            <div class="language">LANGUAGE</div>
            <div class="time">TIME</div>
        </div>
        <div id="js-submissions"></div>
    </div>
</div>

<script>
    var problem = JSON.parse('<?php echo $data['problem'] ?>');
    var submissions = undefined;
    Problem.display.submissions(problem, submissions);
</script>