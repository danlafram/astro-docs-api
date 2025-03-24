<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <script src="https://code.jquery.com/jquery-3.7.1.js" integrity="sha256-eKhayi8LEQwp4NKxN+CfCh+3qOVUtJn3QNZ0TciWLP4="
        crossorigin="anonymous"></script>

    <link rel="stylesheet" type="text/css" href="<?= phpb_theme_asset('css/page.css') ?>" />

    <!-- TODO: This doesn't work because there is no $page value present? -->
    <title><?php echo $page->get('title') ?></title>

    <script src="https://cdn.jsdelivr.net/npm/@tailwindcss/browser@4"></script>
    <!-- <link rel="stylesheet" href="<?= phpb_universal_asset('css/style.css') ?>" /> -->
</head>
