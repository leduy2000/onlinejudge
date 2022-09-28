var Problem = new function __Problem() {

    this.get_difficulty = function(val) {
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

}

Problem.display = new function __ProblemDisplay() {
    this.init = function () {
        Problem.editor = ace.edit("js-editor");
        Problem.editor.setTheme("ace/theme/monokai");
        Problem.editor.session.setMode("ace/mode/c_cpp");
        Problem.editor.setOptions({
            fontSize: "11pt",
            enableBasicAutocompletion: true,
            enableLiveAutocompletion: true
        });

        $('#languages').on('change', function () {
            var language = $('#languages').val();
            if (language == 'c' || language == 'cpp') {
                Problem.editor.session.setMode("ace/mode/c_cpp");
            } else if (language == 'php') {
                Problem.editor.session.setMode("ace/mode/php");
            } else if (language == 'python') {
                Problem.editor.session.setMode("ace/mode/python");
            } else if (language == 'node') {
                Problem.editor.session.setMode("ace/mode/javascript");
            }
        });
    }
}

Problem.board = new function __ProblemBoard() {

    this.practice = function(problems) {
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
}

Problem.form = new function __ProblemForm() {

    this.create = function() {
        var name = $('#name').val();
        var difficulty = $('#difficulty').val();
        var time_limit = $('#time-limit').val();
        var memory_limit = $('#memory-limit').val();
        var statement = $('#statement').val();
        var sample_input = $('#sample-input').val();
        var sample_output = $('#sample-output').val();
        console.log(name, difficulty, time_limit, memory_limit, statement, sample_input, sample_output);
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
        $.ajax({
            url: "/onlinejudge/home/user_submit",
            method: "POST",
            data: {
                language: language,
                code: code
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