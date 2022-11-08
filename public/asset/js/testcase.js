var Testcase = new function __Testcase() {

}

Testcase.board = new function __TestcaseBoard() {
    
}

Testcase.form = new function __TestcaseForm() {
    
    this.create = function() {
        var input = $('#input').val();
        var output = $('#output').val();
        $.ajax({
            url: "/onlinejudge/administration/create_testcase",
            method: "POST",
            data: {
                problem_id: problem.id,
                input: input,
                output: output
            },
            success: function (response) {
                console.log(response);
                location.reload();
            }
        })
    }
}