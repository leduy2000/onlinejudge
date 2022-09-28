<div class="container">
    <div class="page-label">Create Problem</div>
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
        <div class="input-label">Time Limit</div>
        <input id="time-limit" class="normal-input" type="text">
    </div>
    <div class="input-row">
        <div class="input-label">Memory Limit</div>
        <input id="memory-limit" class="normal-input" type="text">
    </div>
    <div class="input-row">
        <div class="input-label">Statement</div>
        <textarea id="statement" class="problem-input-statement"></textarea>
    </div>
    <div class="input-row">
        <div class="input-label">Sample Input</div>
        <textarea id="sample-input" class="problem-input-sample-io"></textarea>
    </div>
    <div class="input-row">
        <div class="input-label">Sample Output</div>
        <textarea id="sample-output" class="problem-input-sample-io"></textarea>
    </div>
    <button class="btn-green ui-btn btn-normal url" onclick="Problem.form.create()">Save Changes</button>
</div>
<script>
</script>