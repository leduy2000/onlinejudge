<div class="container">
    <div class="page-label">Administration</div>
    <div class="administration-tab-list">
        <div class="administration-tab-item administration-active">Details</div>
        <div class="administration-tab-item url" onclick="window.location.href='/onlinejudge/administration/problems'">Problems</div>
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
    <div id="js-contests"></div>
</div>

<script>
    var contest = JSON.parse('<?php echo $data['contest'] ?>');
    Contest.display.edit(contest)
</script>