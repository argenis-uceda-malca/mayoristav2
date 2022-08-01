<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <!-- Tell the browser to be responsive to screen width -->
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">
    <!-- Favicon icon -->
    <!--<link rel="icon" type="/build/admin/image/png" sizes="16x16" href="/build/admin/assets/images/favicon.png">-->
    <link rel="apple-touch-icon" sizes="180x180" href="/apple-touch-icon.png">
    <link rel="icon" type="image/png" sizes="32x32" href="/build/img/favicon/favicon-32x32.png">
    <link rel="icon" type="image/png" sizes="16x16" href="/build/img/favicon//favicon-16x16.png">
    <link rel="manifest" href="/build/img/favicon//site.webmanifest">
    <link rel="mask-icon" href="/build/img/favicon/safari-pinned-tab.svg" color="#5bbad5">
    <meta name="msapplication-TileColor" content="#da532c">
    <meta name="theme-color" content="#ffffff">
    <title>HIN Inversiones</title>
    <!-- Custom CSS -->
    <link href="/build/admin/assets/extra-libs/c3/c3.min.css" rel="stylesheet">
    <link href="/build/admin/assets/libs/chartist/dist/chartist.min.css" rel="stylesheet">
    <link href="/build/admin/assets/extra-libs/jvector/jquery-jvectormap-2.0.2.css" rel="stylesheet" />
    <!-- Custom CSS -->
    <link href="/build/admin/dist/css/style.min.css" rel="stylesheet">
    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
    <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
    <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
<![endif]-->
</head>

<body>

    <?php echo $contenido; ?>

    <?php
    echo $script ?? '';
    ?>

</body>

</html>