<div id="js-contest-problems"></div>

<script>
    var contest = JSON.parse('<?php echo $data['contest'] ?>');
    Contest.display.edit_problems(contest);
</script>