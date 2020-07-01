<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="<?php base_url() ?>assets/css/bootstrap.min.css">
    <link rel="stylesheet" href="<?php base_url() ?>assets/css/style.css">
    <link rel="stylesheet" href="<?php base_url() ?>assets/css/jquery.mCustomScrollbar.min.css">
    <link rel="stylesheet" href="<?php base_url() ?>assets/css/datatables.min.css">
    <title>Halaman Utama</title>
</head>

<body>
    <div class="wrapper">
        <nav id="sidebar">
            <? $this->load->view('sidemenu/v_sidemenu')?>
        </nav>
        
        <div id="content">
            <div class="topbar container">
                <? $this->load->view('topbar/v_topbar') ?>    
            </div>

            <div class="main">