var Submission = new function __Submission() {

    this.get_language = function (language) {
        if (language == 'cpp') {
            return 'C++';
        }
    }

    this.get_verdict_color = function (verdict) {
        if (verdict == "Accepted") {
            return "#1ba94c";
        } else {
            return "#d11534";
        }
    }

    this.show_tc_content = function (i) {
        $('#verdict').html(Submission.testcases[i].verdict);
        $('#input').html(atob(Submission.testcases[i].input));
        $('#output').html(atob(Submission.testcases[i].output));
    }
}

Submission.display = new function __SubmissionDisplay() {

    this.contest = function (contest, problem, submission) {
        Submission.editor = ace.edit("js-editor");
        Submission.editor.setTheme("ace/theme/monokai");
        Submission.editor.session.setMode("ace/mode/c_cpp");
        Submission.editor.setOptions({
            fontSize: "12pt",
            enableBasicAutocompletion: true,
            enableLiveAutocompletion: true,
        });
        var result = JSON.parse(atob(submission.result));
        Submission.editor.setShowPrintMargin(false);
        $('#name').html(problem.name);
        $('#time').html("When: " + Utils.int_to_datetime(contest.since));
        $('#score').html("Score: " + submission.score);

        var color = Submission.get_verdict_color(result.verdict);
        $('#res').css("color", color);
        $('#res').html(result.verdict);
        var language = Submission.get_language(submission.language);
        $('#language').html("Language: " + language);
        Submission.editor.setValue(atob(submission.code));
        Submission.testcases = result.testcases;
        var result_html = ``;
        var idx = 1;
        for (var i in Submission.testcases) {
            var color = Submission.get_verdict_color(Submission.testcases[i].verdict);
            result_html += `<div id="tc-btn-${idx}" class="submission-result-btn url" style="color: ${color}" onclick=Submission.show_tc_content(${i})>Test case ${idx++}</div>`;
        }
        result_html = `<div class="submission-result-wrap">
                            <div class="submission-result flex ui-card">
                                <div class="submission-result-rows">
                                    ${result_html}
                                </div>
                                <div class="submission-result-content">
                                    <div class="submission-result-content-label">Compiler Message</div>
                                    <div id="verdict" class="submission-result-io"></div>
                                    <div class="submission-result-content-label">Input (stdin)</div>
                                    <div id="input" class="submission-result-io"></div>
                                    <div class="submission-result-content-label">Expected Output</div>
                                    <div id="output" class="submission-result-io"></div>
                                </div>
                            </div>
                        </div>`;
        $('#js-result').html(result_html);
        $("#tc-btn-1").trigger("click");
        $('#problem').click(function () {
            window.location.href = `/onlinejudge/contests/problem/${contest.id}/${problem.id}`;
        });
    }
}

Submission.board = new function __SubmissionBoard() {

    this.home = function (submissions) {
        var html = ``;
        for (var submission of submissions) {
            var result = JSON.parse(atob(submission.result));
            var since = Utils.int_to_datetime(submission.since);
            var language = Submission.get_language(submission.language);
            var color = Submission.get_verdict_color(result.verdict);
            html += `<div class="submission-list-row">
                        <p class="span txt-link url" onclick="window.location.href='/onlinejudge/problemset/problem/${submission.problem_id}'">${submission.problem_name}</p>
                        <p class="span center">${language}</p>
                        <p class="span center">${since}</p>
                        <div class="span center"> <span class="center" style="color: ${color}">${result.verdict}</span> <span class="-ap icon-tick" style="color: #1ba94c"></span> </div>
                        <p class="span center">${submission.username}</p>
                        <p class="span center txt-link url" onclick="window.location.href='/onlinejudge/contests/submission/${submission.contest_id}/${submission.problem_id}/${submission.id}'">View Results</p>
                    </div>`;
        }
        $('#js-submissions').html(html);
    }

    this.contest_problem = function (contest, problem, submissions) {
        var html = ``;
        for (var submission of submissions) {
            var result = JSON.parse(atob(submission.result));
            var since = Utils.int_to_datetime(submission.since);
            var language = Submission.get_language(submission.language);
            var color = Submission.get_verdict_color(result.verdict);
            html += `<div class="ui-card problem-submission-row"> 
                        <div class="result" style="color: ${color}"> 
                            <span>${result.verdict}</span>
                        </div> 
                        <div class="score">${submission.score}</div> 
                        <div class="language">${language}</div> 
                        <div class="time">${since}</div> 
                        <div class="link txt-link url" onclick="window.location.href='/onlinejudge/contests/submission/${submission.contest_id}/${submission.problem_id}/${submission.id}'">View Results</div>
                    </div>`;
        }
        $('#js-submissions').html(html);
        $('#name').html(problem.name);
        $('#problem').click(function () {
            window.location.href = `/onlinejudge/contests/problem/${contest.id}/${problem.id}`;
        });
    }
}

Submission.form = new function __SubmissionForm() {

    this.from_contest = function (contest, problem) {
        var language = $('#languages').val();
        var code = Problem.editor.getValue();
        $.ajax({
            url: "/onlinejudge/contests/user_submit",
            method: "POST",
            data: {
                language: language,
                code: code,
                problem_id: problem.id,
                contest_id: contest.id,
            },
            success: function (response) {
                response = JSON.parse(response);
                console.log(response);
                var html = ``;
                Submission.testcases = response.result.testcases;
                var idx = 1;
                for (var i in Submission.testcases) {
                    var color = Submission.get_verdict_color(Submission.testcases[i].verdict);
                    html += `<div id="tc-btn-${idx}" class="submission-result-btn url" style="color: ${color}" onclick=Submission.show_tc_content(${i})>Test case ${idx++}</div>`;
                }
                html = `
                            <div class="submission-status-heading" style="color: ${Submission.get_verdict_color(response.result.verdict)}">${response.result.verdict}!</div>
                            <div class="submission-result-wrap">
                                <div class="submission-result flex ui-card">
                                    <div class="submission-result-rows">
                                        ${html}
                                    </div>
                                    <div class="submission-result-content">
                                        <div class="submission-result-content-label">Compiler Message</div>
                                        <div id="verdict" class="submission-result-io"></div>
                                        <div class="submission-result-content-label">Input (stdin)</div>
                                        <div id="input" class="submission-result-io"></div>
                                        <div class="submission-result-content-label">Expected Output</div>
                                        <div id="output" class="submission-result-io"></div>
                                    </div>
                                </div>
                            </div>`;
                $('#js-result').html(html)
                $("#tc-btn-1").trigger("click");
                $('html, body').animate({scrollTop:$(document).height()}, 'slow');
            }
        });
    }
}