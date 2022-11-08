<div class="container">
    <div class="page-label" style="margin-top: 50px">Administration</div>
    <div class="administration-tab-list">
        <div class="administration-tab-item administration-active">Manage Contests</div>
        <div class="administration-tab-item url" onclick="window.location.href='/onlinejudge/administration/problems'">Manage Problems</div>
    </div>
    <div class="administration-clearfix flex1 mlB">
        <div>Contests you can edit are below. For more info, visit our FAQ or join our discussion forum.</div>
        <button class="btn-green height-100" onclick="window.location.href='/onlinejudge/administration/create_contest'">Create Contest</button>
    </div>
    <div class="administration-tbl-header">
        <p class="span">Contest Name</p>
        <p class="span center">Contest Owner</p>
        <p class="span center">Start date</p>
        <p class="span center">Signups</p>
    </div>
    <div id="js-contests"></div>
</div>

<script>
    var contests = JSON.parse('<?php echo $data['contests'] ?>');
    Contest.board.admin(contests);
</script>