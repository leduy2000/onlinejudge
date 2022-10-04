<div class="container">
    <div class="page-label">Administration</div>
    <div class="administration-tab-list">
        <div class="administration-tab-item administration-active">Manage Contests</div>
        <div class="administration-tab-item url" onclick="window.location.href='/onlinejudge/administration/problems'">Manage Problems</div>
    </div>
    <div class="administration-clearfix flex1 mlB">
        <div>Contests you can edit are below. For more info, visit our FAQ or join our discussion forum.</div>
        <button class="btn-green height-100" onclick="window.location.href='/onlinejudge/contests/create'">Create Contest</button>
    </div>
    <div class="administration-tbl-header">
        <p class="span">Contest Name</p>
        <p class="span center">Contest Owner</p>
        <p class="span center">Start date</p>
        <p class="span center">Signups</p>
    </div>
    <!-- <div class="administration-tbl-row url" style="background-color:#f8f9fa">
        <p class="span slug">Contest1</p>
        <p class="span center">admin</p>
        <p class="span center">Jul 30, 2022</p>
        <p class="span center">1</p>
    </div>
    <div class="administration-tbl-row url" style="background-color:#fff">
        <p class="span slug">New Contest</p>
        <p class="span center">admin</p>
        <p class="span center">Jul 13, 2022</p>
        <p class="span center">1</p>
    </div> -->
    <div id="js-contests"></div>
</div>

<script>
    var contests = JSON.parse('<?php echo $data['contests'] ?>');
    Contest.board.admin(contests);
</script>