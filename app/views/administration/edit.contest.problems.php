<div id="js-contest-problems"></div>

<script>
    var contest = JSON.parse('<?php echo $data['contest'] ?>');
    var problems = JSON.parse('<?php echo $data['problems'] ?>');
    Contest.display.edit_problems(contest, problems);
</script>