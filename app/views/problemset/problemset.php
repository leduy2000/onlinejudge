<div class="content">
    <div class="container">
        <div class="problem-title plT plB">Problems</div>
        <div id="js-problems"></div>
        <!-- <div class="ui-card url">
            <div class="flex1">
                <div>
                    <div class="problem-title psB">Hello World Contest #1: The Third Three Number Problem</div>
                    <div> <span id="difficulty" style="color: #d11534">Expert, </span> <span>Max Score: 150</span> </div>
                </div>
                <button class="btn-normal ui-btn btn-white msL">Solve Challenge</button>
            </div>
        </div>
        <div class="ui-card url">
            <div class="flex1">
                <div>
                    <div class="problem-title psB">Hello World Contest #1: The Third Three Number Problem</div>
                    <div> <span id="difficulty" style="color: #d11534">Expert, </span> <span>Max Score: 150</span> </div>
                </div>
                <button class="btn-normal ui-btn btn-white msL">Solve Challenge</button>
            </div>
        </div>
        <div class="ui-card url">
            <div class="flex1">
                <div>
                    <div class="problem-title psB">Hello World Contest #1: The Third Three Number Problem</div>
                    <div> <span id="difficulty" style="color: #d11534">Expert, </span> <span>Max Score: 150</span> </div>
                </div>
                <button class="btn-normal ui-btn btn-white msL">Solve Challenge</button>
            </div>
        </div>
    </div> -->
</div>

<script>
    var problems = JSON.parse('<?php echo $data['problems'] ?>');
    Problem.board.practice(problems);
</script>