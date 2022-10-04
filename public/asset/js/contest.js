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

}

Contest.board = new function __ContestBoard() {

    this.admin = function (contests) {
        var html = ``;
        for (var i = 0; i < contests.length; i++) {
            var color = Contest.get_admin_tbl_row_color(i);
            html += `<div class="administration-tbl-row" style="background-color:${color}">
                        <p class="span txt-link url">${contests[i].name}</p>
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
                // if (response == true) {
                //     $('.problem-output').html('xxx');
                // } else {
                //     alert("Something went wrong!");
                // }
            }
        })
        // var d = new Date(Date.parse($('#start-time').val()));
        // console.log(d);
        // console.log(Date.parse(d));
    }
}