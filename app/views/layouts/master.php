<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <link rel="stylesheet" href="/onlinejudge/public/asset/css/style.css">
    <link href="//cdn.quilljs.com/1.3.6/quill.snow.css" rel="stylesheet">
    <link href="//cdn.quilljs.com/1.3.6/quill.bubble.css" rel="stylesheet">

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <script src="/onlinejudge/public/asset/js/user.js"></script>
    <script src="/onlinejudge/public/asset/js/utils.js"></script>
    <script src="/onlinejudge/public/asset/js/problem.js"></script>
    <script src="/onlinejudge/public/asset/js/contest.js"></script>
    <script src="/onlinejudge/public/asset/js/testcase.js"></script>
    <script src="/onlinejudge/public/asset/js/submission.js"></script>
    <script src="/onlinejudge/public/asset/js/ace/ace.js"></script>
    <script src="/onlinejudge/public/asset/js/ace/theme-monokai.js"></script>
    <script src="//cdn.quilljs.com/1.3.6/quill.js"></script>
    <script src="//cdn.quilljs.com/1.3.6/quill.min.js"></script>

    <title>Document</title>
</head>

<body>
    <?php require_once "../app/views/layouts/header.php"; ?>
    <?php require_once "../app/views/" . $data['page'] . ".php"; ?>
</body>

</html>