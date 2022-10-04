var Contest = new function __Contest() {

    this.get_admin_tbl_row_color = function(id) {
        if (id % 2 == 0) {
            return '#f8f9fa';
        } else {
            return '#ffffff'
        }
    }
}

Contest.display = new function __ContestDisplay() {

    this.edit_details = function (contest) {
        html = `<div class="container">
                    <div class="page-label">${contest.name}</div>
                    <div class="administration-tab-list">
                        <div class="administration-tab-item administration-active">Details</div>
                        <div class="administration-tab-item url" onclick="window.location.href='/onlinejudge/administration/contests/edit/problems/${contest.id}'">Problems</div>
                    </div>
                </div>`;
        $('#js-contest-details').html(html); 
    }

    this.edit_problems = function(contest) {
        html = `<div class="container">
                    <div class="page-label">${contest.name}</div>
                    <div class="administration-tab-list">
                        <div class="administration-tab-item url" onclick="window.location.href='/onlinejudge/administration/contests/edit/details/${contest.id}'">Details</div>
                        <div class="administration-tab-item administration-active">Problems</div>
                    </div>
                </div>`;
        $('#js-contest-problems').html(html);
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
}