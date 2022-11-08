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

    this.get_admin_tbl_row_color = function (id) {
        if (id % 2 == 0) {
            return '#f8f9fa';
        } else {
            return '#ffffff'
        }
    }

    this.get_difficulty_color = function(val) {
        if (val == 1) {
            return '#1ba94c';
        } else if (val == 2) {
            return '#db7100';
        } else {
            return '#d11534';
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
        $('#submissions').click(function() {
            window.location.href = `/onlinejudge/problemset/submissions/${problem.id}`;
        });

        var html = `
                    <div class="problem-tab-list-content">
                        <div class="msB" style="font-weight: bold">Statement</div>
                        <div class="mlB">
                            ${atob(problem.statement)}
                        </div>
                        <div class="msB" style="font-weight: bold">Sample Input</div>
                        <div class="problem-sample-io mlB">
                            ${atob(problem.sample_input)}
                        </div>
                        <div class="msB" style="font-weight: bold">Sample Output</div>
                        <div class="problem-sample-io mlB">
                            ${atob(problem.sample_output)}
                        </div>
                    </div>
                    `;
        $('#js-problem').html(html);
        $('#name').html(problem.name);
    }

    this.contest = function (contest, problem) {
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
        $('#submissions').click(function() {
            window.location.href = `/onlinejudge/contests/submissions/${contest.id}/${problem.id}`;
        });

        var html = `
                    <div class="problem-tab-list-content">
                        <div class="msB" style="font-weight: bold">Statement</div>
                        <div class="mlB">
                            ${atob(problem.statement)}
                        </div>
                        <div class="msB" style="font-weight: bold">Sample Input</div>
                        <div class="problem-sample-io mlB">
                            ${atob(problem.sample_input)}
                        </div>
                        <div class="msB" style="font-weight: bold">Sample Output</div>
                        <div class="problem-sample-io mlB">
                            ${atob(problem.sample_output)}
                        </div>
                    </div>
                    `;
        $('#js-problem').html(html);
        $('#name').html(problem.name);
        $('#submit-btn').click(function() {
            Submission.form.from_contest(contest, problem);
        });
    }

    this.edit_details = function (problem) {
        var html = `<div class="container">
                        <div class="page-label" style="margin-top: 50px">${problem.name}</div>
                        <div class="administration-tab-list">
                            <div class="administration-tab-item administration-active">Details</div>
                            <div class="administration-tab-item url" onclick="window.location.href='/onlinejudge/administration/problems/edit/testcases/${problem.id}'">Test cases</div>
                        </div>
                        <div class="input-row">
                            <div class="input-label">Problem Name</div>
                            <input id="name" class="normal-input" type="text" value='${problem.name}'>
                        </div>
                        <div class="input-row">
                            <div class="input-label">Difficulty</div>
                            <select id="difficulty" class="problem-input-difficulty">
                                <option value="1">Easy</option>
                                <option value="2">Medium</option>
                                <option value="3">Hard</option>
                                <option value="4">Advanced</option>
                                <option value="5">Expert</option>
                            </select>
                        </div>
                        <div class="input-row">
                            <div class="input-label">Time Limit</div>
                            <input id="time-limit" class="normal-input" type="text" value='${problem.time_limit}'>
                        </div>
                        <div class="input-row">
                            <div class="input-label">Memory Limit</div>
                            <input id="memory-limit" class="normal-input" type="text" value='${problem.memory_limit}'>
                        </div>
                        <div class="input-row flex" style="margin-bottom:60px">
                            <div class="input-label">Statement</div>
                            <div class="editor-wrap">
                                <div id="statement"></div>
                            </div>
                        </div>
                        <div class="input-row flex" style="margin-bottom:60px">
                            <div class="input-label">Sample Input</div>
                            <div class="editor-wrap">
                                <div id="sample-input"></div>
                            </div>
                        </div>
                        <div class="input-row flex" style="margin-bottom:60px">
                            <div class="input-label">Sample Output</div>
                            <div class="editor-wrap">
                                <div id="sample-output"></div>
                            </div>
                        </div>
                        <button id="save-btn" class="btn-green ui-btn btn-normal url">Save Changes</button>
                    </div>`;
        $('#js-problem-details').html(html);
        var toolbar_options = [
            ['bold', 'italic', {
                'list': 'ordered'
            }, {
                'list': 'bullet'
            }, 'image', 'link', 'code-block'],
        ];
    
        var statement_input = new Quill('#statement', {
            modules: {
                toolbar: toolbar_options,
            },
            theme: 'snow',
        });
        statement_input.root.innerHTML = atob(problem.statement);
    
        var sample_input_input = new Quill('#sample-input', {
            modules: {
                toolbar: toolbar_options,
            },
            theme: 'snow'
        });
        sample_input_input.root.innerHTML = atob(problem.sample_input);

        var sample_output_input = new Quill('#sample-output', {
            modules: {
                toolbar: toolbar_options,
            },
            theme: 'snow'
        });
        sample_output_input.root.innerHTML = atob(problem.sample_output);

        $('#save-btn').click(function () {
            Problem.form.edit_details(problem);
        });
    }

    this.edit_testcases = function(problem, testcases) {
        var testcases_html = ``;
        for (var i = 0; i < testcases.length; i++) {
            testcases_html += `<div class="administration-tbl-row" style="background-color:'#f8f9fa'">
                                    <p class="span">${i + 1}</p>
                                    <p class="span center txt-link">input${testcases[i].id}.txt</p>
                                    <p class="span center txt-link">output${testcases[i].id}.txt</p>
                                    <button class="btn-edit">Edit</button>
                                    <button class="btn-remove">Remove</button>
                                </div>`;
        }
        var html = `<div class="container">
                        <div class="page-label" style="margin-top: 50px">${problem.name}</div>
                        <div class="administration-tab-list">
                            <div class="administration-tab-item url" onclick="window.location.href='/onlinejudge/administration/problems/edit/details/${problem.id}'">Details</div>
                            <div class="administration-tab-item administration-active">Test cases</div>
                        </div>
                        <button id="pop-up-btn" class="btn-grey ui-btn btn-normal url mlB">Add Test Case</button>
                        <div class="administration-tbl-header">
                            <p class="span">No.</p>
                            <p class="span center">Input</p>
                            <p class="span center">Output</p>
                        </div>
                        <div id="js-testcases"></div>
                    </div>
                    <div id="pop-up" style="display: block;">
                        <div id="pop-up-content">
                            <div class="pop-up-container"></div>
                            <div class="pop-up">
                                <div class="pop-up-header">
                                    <div class='mlB' style='font-weight: 550'>Add Test Case</div>
                                </div>
                                <div>Input</div>
                                <textarea id="input" class="test-case-input"></textarea>
                                <div>Output</div>
                                <textarea id="output" class="test-case-input"></textarea>
                                <div class='flex1'>
                                    <button id='add-btn' class="btn-grey btn-normal ui-btn url msT">Add Test Case</button>
                                    <button id='close-btn' class="btn-grey btn-normal ui-btn url msT">Close</button>
                                </div>
                            </div>
                            <div id="pop-up-result"></div>
                        </div>
                    </div>`;
        $('#js-problem-testcases').html(html);
        $('#js-testcases').html(testcases_html);
        $('#pop-up').hide();
        $('#pop-up-btn').click(function() {
            $('#pop-up').show();
        });
        $('#close-btn').click(function() {
            $('#pop-up').hide();
        });
        $('#add-btn').click(function() {
            Testcase.form.create();
        });
    }

    this.submissions = function(problem, submissions) {
        var html = `<div class="ui-card problem-submission-row"> 
                        <div class="result" style="color: #1ba94c"> 
                            <span class="-ap icon-tick"></span>
                            <span>Accepted</span>
                        </div> 
                        <div class="score">139</div> 
                        <div class="language">C++</div> 
                        <div class="time">94 days ago</div> 
                        <div class="link txt-link url">View Results</div>
                    </div>`;
        html += `<div class="ui-card problem-submission-row"> 
                    <div class="result" style="color: #d11534"> 
                        <span class="-ap icon-tick"></span>
                        <span>Wrong Answer</span>
                    </div> 
                    <div class="score">139</div> 
                    <div class="language">C++</div> 
                    <div class="time">94 days ago</div> 
                    <div class="link txt-link url">View Results</div>
                </div>`;
        $('#name').html(problem.name);
        $('#problem').click(function() {
            window.location.href=`/onlinejudge/problemset/problem/${problem.id}`
        });
        $('#js-submissions').html(html);
    }

    this.submission = function(problem, submission) {
        Problem.editor = ace.edit("js-editor");
        Problem.editor.setTheme("ace/theme/monokai");
        Problem.editor.session.setMode("ace/mode/c_cpp");
        Problem.editor.setOptions({
            fontSize: "12pt",
            enableBasicAutocompletion: true,
            enableLiveAutocompletion: true,
        });
        Problem.editor.setShowPrintMargin(false);
        $('#name').html(problem.name);
    }
}

Problem.board = new function __ProblemBoard() {

    this.set_name = function (name) {
        $('#name').val(name);
        $('#pop-up-result').html('');
    }

    this.practice = function (problems) {
        var html = ``;
        for (var problem of problems) {
            var color = Problem.get_difficulty_color(problem.difficulty);
            html += `<div class="ui-card mlT">
                        <div class="flex1">
                            <div>
                                <div class="problem-title psB">${problem.name}</div>
                                <div><span id="difficulty" style="color: ${color}">${Problem.get_difficulty(problem.difficulty)}</span></div>
                            </div>
                            <button class="btn-normal ui-btn btn-white msL" onclick="window.location.href='/onlinejudge/problemset/problem/${problem.id}'">Solve Problem</button>
                        </div>
                    </div>`;
        }
        $('#js-problems').html(html);
    }

    this.contest = function (contest, problems) {
        var html = ``;
        for (var i = 0; i < problems.length; i++) {
            var color = Problem.get_difficulty_color(problems[i].difficulty);
            html += `<div class="ui-card mlT">
                        <div class="flex1">
                            <div>
                                <div class="problem-title psB">${problems[i].name}</div>
                                <div>
                                    <span id="difficulty" style="color: ${color}">${Problem.get_difficulty(problems[i].difficulty) + ','}</span>
                                    <span>${" Max Score: " + problems[i].score}</span>
                                </div>
                            </div>
                            <button class="btn-normal ui-btn btn-white msL" onclick="window.location.href='/onlinejudge/contests/problem/${contest.id}/${problems[i].id}'">Solve Problem</button>
                        </div>
                    </div>`;
        }
        console.log(html);
        $('#contest-name').html(contest.name);
        $('#js-problems').html(html);
    }

    this.admin = function (problems) {
        
        var html = ``;
        for (var i = 0; i < problems.length; i++) {
            var color = Problem.get_admin_tbl_row_color(i);
            html += `<div class="administration-tbl-row" style="background-color:${color}">
                        <p class="span txt-link url" onclick="window.location.href='/onlinejudge/administration/problems/edit/details/${problems[i].id}'">${problems[i].name}</p>
                        <p class="span center">${problems[i].username}</p>
                    </div>`;
        }
        $('#js-problems').html(html);
    }

    this.by_name = function (name) {
        $.ajax({
            url: "/onlinejudge/problemset/by_name",
            method: "POST",
            data: {
                name: name,
            },
            success: function (response) {
                var problems = JSON.parse(response);
                var html = ``;
                for (var problem of problems) {
                    html += `<div class="pop-up-result-row url" onclick="Problem.board.set_name('${problem.name}')">${problem.name}</div>`;
                }
                $('#pop-up-result').html(html);
            }
        })
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
            url: "/onlinejudge/administration/user_create_problem",
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
                console.log(response);
                window.location.href = '/onlinejudge/administration/problems';
            }
        })
    }

    this.submit_code = function (contest_id = 0) {
        var language = $('#languages').val();
        var code = Problem.editor.getValue();
        $.ajax({
            url: "/onlinejudge/problemset/user_submit",
            method: "POST",
            data: {
                language: language,
                code: code,
                problem_id: problem.id,
                contest_id: contest_id,
                time_limit: problem.time_limit,
                memory_limit: problem.memory_limit
            },
            success: function (response) {
                console.log(response);
            }
        })
    }

    this.edit_details = function() {
        alert('clicked');
    }
}