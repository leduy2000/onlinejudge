<div class="container">
    <div class="page-label" style="margin-top: 50px">Create Problem</div>
    <div class="input-row">
        <div class="input-label">Problem Name</div>
        <input id="name" class="normal-input" type="text">
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
        <div class="input-label">Time Limit (s)</div>
        <input id="time-limit" class="normal-input" type="text">
    </div>
    <div class="input-row">
        <div class="input-label">Memory Limit (KB)</div>
        <input id="memory-limit" class="normal-input" type="text">
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
    <button class="btn-green ui-btn btn-normal url" onclick="Problem.form.create()">Save Changes</button>
</div>
<script>
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
        theme: 'snow'
    });

    var sample_input_input = new Quill('#sample-input', {
        modules: {
            toolbar: toolbar_options,
        },
        theme: 'snow'
    });

    var sample_output_input = new Quill('#sample-output', {
        modules: {
            toolbar: toolbar_options,
        },
        theme: 'snow'
    });
</script>