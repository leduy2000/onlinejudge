<div class="breadcrumb">
    <div class="container">
        <div style="margin-top: 30px; margin-bottom: 30px">
            <div class="page-label">Problemset</div>
        </div>
    </div>
</div>
<div class="content">
    <div class="container">
        <div id="js-problems" style="padding-top: 30px"></div>
</div>

<script>
    var problems = JSON.parse('<?php echo $data['problems'] ?>');
    Problem.board.practice(problems);
</script>