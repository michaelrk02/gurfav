<html>
    <head>
        <title>Program Guru Favorit SMAGA</title>
        <link rel="stylesheet" href="<?php echo site_url('content/file_css/public/css/spectre.min.css'); ?>">
        <script src="<?php echo site_url('content/file_js/public/js/vue.min.js'); ?>"></script>
        <style>
            body {
                display: flex;
                min-height: 100vh;
                flex-direction: column;
            }

            main {
                flex: 1 0 auto;
            }
        </style>
    </head>
    <body>
        <div id="loading" v-bind:class="['modal', active ? 'active' : '']">
            <span class="modal-overlay"></span>
            <div class="text-center modal-container" style="width: 50vw">
                <div class="m-2">
                    <h3>Loading...</h3>
                    <div class="loading loading-lg"></div>
                </div>
            </div>
        </div>
        <script>
        var loading = new Vue({
            el: '#loading',
            data: {
                active: true
            }
        });
        window.addEventListener('load', function() {
            loading.active = false;
        })
        </script>
        <header class="columns bg-primary p-2" style="display: table">
            <div class="column col-1 hide-sm" style="display: table-cell">
                <img class="img-responsive" src="<?php echo site_url('content/file_img_png/public/img/logo-mpk.png'); ?>">
            </div>
            <div class="column col-10 col-sm-12 text-center" style="display: table-cell; vertical-align: middle">
                <h3>Program Guru Favorit</h3>
                <h5>SMA Negeri 3 Surakarta</h5>
            </div>
            <div class="column col-1 hide-sm" style="display: table-cell">
                <img class="img-responsive" src="<?php echo site_url('content/file_img_png/public/img/logo-smaga.png'); ?>">
            </div>
        </header>
        <main class="container grid-lg" style="margin-top: 16px; margin-bottom: 16px">
