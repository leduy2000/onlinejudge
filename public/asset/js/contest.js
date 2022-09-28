var Contest = new function __Contest() {
    
}

Contest.form = new function __ContestForm() {

    this.create = function() {
        var name = $('#name').val();
        var start_time = Utils.datetime_to_int($('#start-time').val());
        var end_time = Utils.datetime_to_int($('#end-time').val());
        console.log(name, start_time, end_time);
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