<div id="js-problem-testcases"></div>

<script>
    var problem = JSON.parse('<?php echo $data['problem'] ?>');
    var testcases = JSON.parse('<?php echo $data['testcases'] ?>');
    Problem.display.edit_testcases(problem, testcases);
</script>