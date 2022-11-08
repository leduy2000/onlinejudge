<div class="breadcrumb">
    <div class="container">
        <div style="margin-top: 30px; margin-bottom: 30px">
            <div class="page-label">Contests</div>
        </div>
    </div>
</div>
<div class="content">
    <div class="container">
        <div class="contest-title plT psB">Active Contests</div>
        <div id="js-active-contests"> </div>
        <div class="contest-title plT">Archived Contests</div>
        <div id="js-archived-contests"> </div>
    </div>
</div>

<script>
    var contests = JSON.parse('<?php echo $data['contests'] ?>');
    Contest.board.contests(contests);
</script>