<div class="container">
    <div class="page-label" style="margin-top: 50px">Submissions</div>
    <div class="table-wrap">
        <div class="submission-list-header">
            <p class="span">Problem</p>
            <p class="span center">Language</p>
            <p class="span center">Time</p>
            <p class="span center">Result</p>
            <p class="span center">Username</p>
        </div>
        <div id="js-submissions">
            <!-- <div class="submission-list-row">
                <p class="span txt-link url" data-url="contests/25/challenges/1/problem">Solve Me First 1</p>
                <p class="span center">C++</p>
                <p class="span center">72 days ago</p>
                <div class="span center"> <span class="center" style="color: #1ba94c">Accepted</span> <span class="-ap icon-tick" style="color: #1ba94c"></span> </div>
                <p class="span center">139</p>
                <p class="span center txt-link url" data-url="contests/25/challenges/1/submissions/code/211">View Results</p>
            </div>
            <div class="submission-list-row">
                <p class="span txt-link url" data-url="contests/25/challenges/1/problem">Solve Me First 1</p>
                <p class="span center">C++</p>
                <p class="span center">74 days ago</p>
                <div class="span center"> <span class="center" style="color: #1ba94c">Accepted</span> <span class="-ap icon-tick" style="color: #1ba94c"></span> </div>
                <p class="span center">139</p>
                <p class="span center txt-link url" data-url="contests/25/challenges/1/submissions/code/210">View Results</p>
            </div> -->
        </div>
    </div>
</div>

<script>
    var submissions = JSON.parse('<?php echo $data['submissions'] ?>');
    Submission.board.home(submissions);
</script>