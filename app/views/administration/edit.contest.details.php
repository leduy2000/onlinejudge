<div id="js-contest-details"></div>

<script>
    var contest = JSON.parse('<?php echo $data['contest'] ?>');
    Contest.display.edit_details(contest)
</script>