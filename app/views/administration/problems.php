<div class="container">
    <div class="page-label" style="margin-top: 50px">Administration</div>
    <div class="administration-tab-list">
        <div class="administration-tab-item url" onclick="window.location.href='/onlinejudge/administration/contests'">Manage Contests</div>
        <div class="administration-tab-item administration-active">Manage Problems</div>
    </div>
    <div class="administration-clearfix flex1 mlB">
        <div>Problems you can edit are below. For more info, visit our FAQ or join our discussion forum.</div>
        <button class="btn-green height-100" onclick="window.location.href='/onlinejudge/administration/create_problem'">Create Problem</button>
    </div>
    <div class="administration-tbl-header">
        <p class="span">Problem Name</p>
        <p class="span center">Problem Owner</p>
    </div>
    <div id="js-problems"></div>
</div>

<script>
    var problems = JSON.parse('<?php echo $data['problems'] ?>');
    Problem.board.admin(problems);
</script>