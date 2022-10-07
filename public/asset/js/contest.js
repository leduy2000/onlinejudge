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
                    <div class="page-label">${contest.name}</div>
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

    this.edit_problems = function (contest) {
        var html = `<div class="container">
                        <div class="page-label">${contest.name}</div>
                        <div class="administration-tab-list">
                            <div class="administration-tab-item url" onclick="window.location.href='/onlinejudge/administration/contests/edit/details/${contest.id}'">Details</div>
                            <div class="administration-tab-item administration-active">Problems</div>
                        </div>
                        <button id="pop-up-btn" class="btn-grey ui-btn btn-normal url mlB">Add Problem</button>
                        <div class="administration-tbl-header">
                            <p class="span">No.</p>
                            <p class="span center">Name</p>
                            <p class="span center">Max Score</p>
                        </div>
                        <div id="js-problems"></div>
                    </div>
                    <div id="pop-up" style="display: block;">
                        <div id="pop-up-content">
                            <div class="pop-up-container"></div>
                            <div class="pop-up">
                                <div class="pop-up-header">
                                    <div class='mlB' style='font-weight: 550'>Add Challenge</div>
                                </div>
                                <div class='mlB'>You can add a challenge from our public library, a challenge that you have created, or a challenge that you have moderator access to. </div>
                                <div class="mlB">
                                    <div class="input-label">Name</div>
                                    <input id="name" type="text" placeholder="Challenge name or challenge slug">
                                </div>
                                <div class="mlB">
                                    <div class="input-label">Max Score</div>
                                    <input id="score" type="text" placeholder="Score">
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
        $('#add-btn').click(function() {
            Contest.form.add_problem();
        });
        $('#close-btn').click(function() {
            $('#pop-up').hide();
        });
        $('#pop-up-btn').click(function() {
            $('#pop-up').show();
        });
        $('#name').on("input", function() {
            if ($(this).val().length) {
                Problem.board.by_name($(this).val());
            } 
        });
    }

}

Contest.board = new function __ContestBoard() {

    this.admin = function (contests) {
        var html = ``;
        for (var i = 0; i < contests.length; i++) {
            var color = Contest.get_admin_tbl_row_color(i);
            html += `<div class="administration-tbl-row" style="background-color:${color}">
                        <p class="span txt-link url" onclick="window.location.href='/onlinejudge/administration/contests/edit/details/${contests[i].id}'">${contests[i].name}</p>
                        <p class="span center">${contests[i].user_id}</p>
                        <p class="span center">${contests[i].start_time}</p>
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
            url: "/onlinejudge/contests/user_create",
            method: "POST",
            data: {
                name: name,
                start_time: start_time,
                end_time: end_time
            },
            success: function (response) {
                console.log(response);
            }
        })
    }

    this.edit_details = function (contest) {
        var name = $('#name').val();
        var start_time = Utils.datetime_to_int($('#start-time').val());
        var end_time = Utils.datetime_to_int($('#end-time').val());
        $.ajax({
            url: "/onlinejudge/contests/user_edit_details",
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

    this.add_problem = function(contest) {
        var problem_name = $('#name').val();
        var problem_score = $('#score').val();
        if (!name || !score) {
            return;
        }
        $.ajax({
            url: "/onlinejudge/administration/add_problem_to_contest",
            method: "POST",
            data: {
                id: contest.id,
                problem_name: problem_name,
                problem_score: problem_score,
            },
            success: function (response) {
                console.log(response);
                location.reload();
            }
        })
    }
}