var Problem = new function __Problem() {

    this.get_difficulty = function (val) {
        if (val == 1) {
            return 'Easy';
        } else if (val == 2) {
            return 'Medium';
        } else if (val == 3) {
            return 'Hard';
        } else if (val == 4) {
            return 'Advanced';
        } else {
            return 'Expert';
        }
    }

    this.get_admin_tbl_row_color = function(id) {
        if (id % 2 == 0) {
            return '#f8f9fa';
        } else {
            return '#ffffff'
        }
    }

}

Problem.display = new function __ProblemDisplay() {

    this.init = function (problem) {
        Problem.editor = ace.edit("js-editor");
        Problem.editor.setTheme("ace/theme/monokai");
        Problem.editor.session.setMode("ace/mode/c_cpp");
        Problem.editor.setOptions({
            fontSize: "12pt",
            enableBasicAutocompletion: true,
            enableLiveAutocompletion: true,
        });
        Problem.editor.setShowPrintMargin(false);

        $('#languages').on('change', function () {
            var language = $('#languages').val();
            if (language == 'c' || language == 'cpp') {
                Problem.editor.session.setMode("ace/mode/c_cpp");
            } else if (language == 'php') {
                Problem.editor.session.setMode("ace/mode/php");
            } else if (language == 'python') {
                Problem.editor.session.setMode("ace/mode/python");
            }
        });

        var html = `
                    <div class="problem-tab-list-content">
                        <div class="msB" style="font-weight: bold">Statement</div>
                        <div class="mlB">
                            ${problem.statement}
                        </div>
                        <div class="msB" style="font-weight: bold">Sample Input</div>
                        <div class="problem-sample-io mlB">
                            ${problem.sample_input}
                        </div>
                        <div class="msB" style="font-weight: bold">Sample Output</div>
                        <div class="problem-sample-io mlB">
                            ${problem.sample_output}
                        </div>
                    </div>
                    `;
        $('#js-problem').html(html);
    }
}

Problem.board = new function __ProblemBoard() {

    this.practice = function (problems) {
        var html = ``;
        for (var problem of problems) {
            html += `<div class="ui-card">
                        <div class="flex1">
                            <div>
                                <div class="problem-title psB">${problem.name}</div>
                                <div><span id="difficulty" style="color: #d11534">${Problem.get_difficulty(problem.difficulty)}</span></div>
                            </div>
                            <button class="btn-normal ui-btn btn-white msL" onclick="window.location.href='/onlinejudge/problemset/problem/${problem.id}'">Solve Challenge</button>
                        </div>
                    </div>`;
        }
        $('#js-problems').html(html);
    }

    this.admin = function (problems) {
        var html = ``;
        for (var i = 0; i < problems.length; i++) {
            var color = Problem.get_admin_tbl_row_color(i);
            html += `<div class="administration-tbl-row" style="background-color:${color}">
                        <p class="span txt-link url">${problems[i].name}</p>
                        <p class="span center">${problems[i].user_id}</p>
                    </div>`;
        }
        $('#js-problems').html(html);
    }
}

Problem.form = new function __ProblemForm() {

    this.create = function () {
        var name = $('#name').val();
        var difficulty = $('#difficulty').val();
        var time_limit = $('#time-limit').val();
        var memory_limit = $('#memory-limit').val();
        var statement = statement_input.root.innerHTML;
        var sample_input = sample_input_input.root.innerHTML;
        var sample_output = sample_output_input.root.innerHTML;
        $.ajax({
            url: "/onlinejudge/problemset/user_create",
            method: "POST",
            data: {
                name: name,
                difficulty: difficulty,
                time_limit: time_limit,
                memory_limit: memory_limit,
                statement: statement,
                sample_input: sample_input,
                sample_output: sample_output
            },
            success: function (response) {
                console.log(response)
                // if (response == true) {
                // } else {
                //     alert("Something went wrong!");
                // }
            }
        })
    }

    this.submit_code = function () {
        var language = $('#languages').val();
        var code = Problem.editor.getValue();
        console.log(problem);
        $.ajax({
            url: "/onlinejudge/problemset/user_submit",
            method: "POST",
            data: {
                language: language,
                code: code,
                problem_id: problem.id,
                time_limit: problem.time_limit,
                memory_limit: problem.memory_limit
            },
            success: function (response) {
                console.log(response);
                // if (response == true) {
                //     $('.problem-output').html('xxx');
                // } else {
                //     alert("Something went wrong!");
                // }
            }
        })
    }
}