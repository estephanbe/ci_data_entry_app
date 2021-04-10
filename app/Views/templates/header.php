<?php
$link = [
    'href'  => 'assets/css/style.css',
    'rel'   => 'stylesheet',
    'type'  => 'text/css',
];


?>
<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.4.1/font/bootstrap-icons.css">
    <link href="https://fonts.googleapis.com/css?family=Nunito+Sans:300i,400,700&display=swap" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-eOJMYsd53ii+scO/bJGFsiCZc+5NDVN2yr8+0RDqr0Ql0h+rP48ckxlpbzKgwra6" crossorigin="anonymous">
    <title>الإستمارة الإلكترونية<?php echo !empty($title) ? ' - ' . $title : ''; ?></title>

    <?php echo link_tag($link); ?>
</head>

<body>
    <?php if ($segments[0] !== 'login') : ?>



        <nav id="aue-nav" class="navbar navbar-expand-lg navbar-light bg-light mb-5">
            <div class="container">
                <a class="navbar-brand" href="<?php echo base_url(); ?>">
                    نظام الإستمارة الإلكترونية
                </a>
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>
                <div class="collapse navbar-collapse" id="navbarNav">
                    <div class="d-flex justify-content-between align-items-center w-100">
                        <ul class="navbar-nav">
                            <li class="nav-item ms-2">
                                <a class="nav-link d-flex align-items-center" aria-current="page" href="<?php echo base_url(); ?>">
                                    <i class="bi bi-arrow-return-left ms-1"></i>
                                    الرئيسية
                                </a>
                            </li>
                            <li class="nav-item ms-2">
                                <a class="nav-link d-flex align-items-center" aria-current="page" href="<?php echo base_url('entries/new'); ?>">
                                    <i class="bi bi-arrow-return-left ms-1"></i>
                                    إضافة متعاونين
                                </a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link d-flex align-items-center" aria-current="page" href="<?php echo base_url('users'); ?>">
                                    <i class="bi bi-arrow-return-left ms-1"></i>
                                    المستخدمين
                                </a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link d-flex align-items-center" aria-current="page" href="<?php echo base_url(); ?>">
                                    <i class="bi bi-arrow-return-left ms-1"></i>
                                    خروج
                                </a>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
        </nav>

        <div class="container">

        <?php endif; ?>