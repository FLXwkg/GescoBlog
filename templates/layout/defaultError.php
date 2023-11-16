<!DOCTYPE html>
<html lang="en" data-bs-theme="light">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="manifest" href="/site.webmanifest">
    <link href="/assets/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="/assets/css/error.css">
    <script src="/assets/js/bootstrap.min.js"></script>

    <title>
        <?=$helpers->title()?>
    </title>
</head>
<body>
    <main role="main">
        <?= $content ?? '' ?>
    </main>
</body>
</html>