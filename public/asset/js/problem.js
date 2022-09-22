var Problem = new function __Problem() {

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

Problem.form = new function __ProblemForm() {
    this.submitCode = function () {
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