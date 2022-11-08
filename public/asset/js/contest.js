var Contest = new function __Contest() {

    this.get_admin_tbl_row_color = function (id) {
        if (id % 2 == 0) {
            return '#f8f9fa';
        } else {
            return '#ffffff'
        }
    }
}

Contest.display = new function __ContestDisplay() {

    this.edit_details = function (contest) {
        var html = `<div class="container">
                        <div class="page-label" style="margin-top: 50px">${contest.name}</div>
                        <div class="administration-tab-list">
                            <div class="administration-tab-item administration-active">Details</div>
                            <div class="administration-tab-item url" onclick="window.location.href='/onlinejudge/administration/contests/edit/problems/${contest.id}'">Problems</div>
                        </div>
                        <div class="input-row">
                            <div class="input-label">Contest Name</div>
                            <input id="name" class="normal-input" type="text" value='${contest.name}'>
                        </div>
                        <div class="input-row">
                            <div class="input-label">Start Time</div>
                            <input id="start-time" class="normal-input" type="datetime-local">
                        </div>
                        <div class="input-row">
                            <div class="input-label">End Time</div>
                            <input id="end-time" class="normal-input" type="datetime-local">
                        </div>
                        <button id="save-btn" class="btn-green ui-btn btn-normal url">Save Changes</button>
                    </div>`;
        $('#js-contest-details').html(html);
        $('#save-btn').click(function () {
            Contest.form.edit_details(contest);
        });
    }

    this.edit_problems = function (contest, problems) {
        var html = `<div class="container">
                        <div class="page-label" style="margin-top: 50px">${contest.name}</div>
                        <div class="administration-tab-list">
                            <div class="administration-tab-item url" onclick="window.location.href='/onlinejudge/administration/contests/edit/details/${contest.id}'">Details</div>
                            <div class="administration-tab-item administration-active">Problems</div>
                        </div>
                        <button id="pop-up-btn" class="btn-grey ui-btn btn-normal url mlB">Add Problem</button>
                        <div class="administration-tbl-header">
                            <p class="span">No.</p>
                            <p class="span center">Problem Name</p>
                            <p class="span center">Problem Score</p>
                            <p class="span center">Problem Owner</p>
                        </div>
                        <div id="js-problems"></div>
                    </div>
                    <div id="pop-up" style="display: block;">
                        <div id="pop-up-content">
                            <div class="pop-up-container"></div>
                            <div class="pop-up">
                                <div class="pop-up-header">
                                    <div class='mlB' style='font-weight: 550'>Add Problem</div>
                                </div>
                                <div class="mlB">
                                    <div class="input-label">Name</div>
                                    <input id="name" type="text" placeholder="Problem name">
                                </div>
                                <div>
                                    <div class="input-label">Score</div>
                                    <input id="score" type="text" placeholder="Problem score">
                                </div>
                                <div class='flex1'>
                                    <button id='add-btn' class="btn-grey btn-normal ui-btn url msT">Add Problem</button>
                                    <button id='close-btn' class="btn-grey btn-normal ui-btn url msT">Close</button>
                                </div>
                            </div>
                            <div id="pop-up-result"></div>
                        </div>
                    </div>`;

        $('#js-contest-problems').html(html);
        $('#pop-up').hide();
        $('#add-btn').click(function () {
            Contest.form.add_problem();
        });
        $('#close-btn').click(function () {
            $('#pop-up').hide();
        });
        $('#pop-up-btn').click(function () {
            $('#pop-up').show();
        });
        $('#name').on("input", function () {
            if ($(this).val().length) {
                Problem.board.by_name($(this).val());
            }
        });
        $('#add-btn').click(function () {
            Contest.form.add_problem(contest.id);
        })
        var html_problems = ``;
        for (var i = 0; i < problems.length; i++) {
            var color = Contest.get_admin_tbl_row_color(i);
            html_problems += `<div class="administration-tbl-row" style="background-color:${color}">
                                <p class="span">${i + 1}</p>
                                <p class="span center txt-link url" onclick="window.location.href='/onlinejudge/problemset/problem/${problems[i].id}'">${problems[i].name}</p>
                                <p class="span center">${problems[i].score}</p>
                                <p class="span center">${problems[i].username}</p>
                                <button class="btn-edit" onclick="window.location.href='/onlinejudge/administration/problems/edit/details/${problems[i].id}'">Edit</button>
                                <button class="btn-remove">Remove</button>
                            </div>`
        }
        $('#js-problems').html(html_problems);
    }

}

Contest.board = new function __ContestBoard() {

    this.contests = function (contests) {
        var active_html = ``;
        var archived_html = ``;
        var cur_time = Utils.datetime_to_int(new Date());
        for (var contest of contests) {
            if (contest.end_time < cur_time) {
                archived_html += `  <div class="plT">
                                        <div class="ui-card contest-item">
                                            <div class="flex1 align-center">
                                                <div class="contest-title url">${contest.name}</div>
                                                <div class="flex align-center">
                                                    <div class="contest-status msR">${Utils.int_to_datetime(contest.end_time)}</div>
                                                    <div class="txt-link url msR">View details</div>
                                                    <div class="btn-white ui-btn url" onclick=>Enter</div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>`;
            } else {
                active_html += `  <div class="plT">
                                        <div class="ui-card contest-item">
                                            <div class="flex1 align-center">
                                                <div class="contest-title url">${contest.name}</div>
                                                <div class="flex align-center">
                                                    <div class="contest-status msR">${Utils.int_to_datetime(contest.end_time)}</div>
                                                    <div class="txt-link url msR">View details</div>
                                                    <div class="btn-white ui-btn url" onclick="window.location.href='/onlinejudge/contests/problems/${contest.id}'">Enter</div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>`;
            }
            $('#js-active-contests').html(active_html);
            $('#js-archived-contests').html(archived_html);
        }

    }

    this.admin = function (contests) {
        var html = ``;
        for (var i = 0; i < contests.length; i++) {
            var color = Contest.get_admin_tbl_row_color(i);
            html += `<div class="administration-tbl-row" style="background-color:${color}">
                        <p class="span txt-link url" onclick="window.location.href='/onlinejudge/administration/contests/edit/details/${contests[i].id}'">${contests[i].name}</p>
                        <p class="span center">${contests[i].username}</p>
                        <p class="span center">${Utils.int_to_datetime(contests[i].start_time)}</p>
                        <p class="span center">1</p>
                    </div>`;
        }
        $('#js-contests').html(html);
    }

}

Contest.form = new function __ContestForm() {

    this.create = function () {
        var name = $('#name').val();
        var start_time = Utils.datetime_to_int($('#start-time').val());
        var end_time = Utils.datetime_to_int($('#end-time').val());
        $.ajax({
            url: "/onlinejudge/administration/user_create_contest",
            method: "POST",
            data: {
                name: name,
                start_time: start_time,
                end_time: end_time
            },
            success: function (response) {
                console.log(response);
                window.location.href = '/onlinejudge/administration/contests';
            }
        })
    }

    this.edit_details = function (contest) {
        var name = $('#name').val();
        var start_time = Utils.datetime_to_int($('#start-time').val());
        var end_time = Utils.datetime_to_int($('#end-time').val());
        $.ajax({
            url: "/onlinejudge/administration/user_edit_contest_details",
            method: "POST",
            data: {
                id: contest.id,
                name: name,
                start_time: start_time,
                end_time: end_time
            },
            success: function (response) {
                console.log(response);
                location.reload();
            }
        })
    }

    this.add_problem = function (contest_id) {
        var problem_name = $('#name').val();
        var score = $('#score').val();
        if (!problem_name) {
            return;
        }
        $.ajax({
            url: "/onlinejudge/administration/add_problem_to_contest",
            method: "POST",
            data: {
                id: contest_id,
                problem_name: problem_name,
                score: score
            },
            success: function (response) {
                console.log(response);
                location.reload();
            }
        })
    }
}