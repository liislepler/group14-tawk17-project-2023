<?php

require_once __DIR__ . "/../models/UserModel";

class Template
{
    public static function header($title, $error = false) {

        $home_path = getHomePath();
        $user = getUser();
        ?>
        <!DOCTYPE html>
        <html lang="en">

        <head>
            <meta charset="UTF-8">
            <meta http-equiv="X-UA-Compatible" content="IE=edge">
            <meta name="viewport" content="width=device-width, initial-scale=1.0">
            <title><?= $title ?> - Trackersaurus</title>

            <link rel="stylesheet" href="<?= $home_path ?>/assets/css/style.css">

            <script src="<?= $home_path ?>/assets/js/script.js"></script>
        </head>

        <body>
            <header>
                <nav>
                    <a href="<?= $home_path ?>">Trackersaurus</a>
                    <?php if ($user) : ?>
                        <a href="<?= $home_path ?>/auth/profile">Profile</a>
                    <?php else : ?>
                        <a href="<?= $home_path ?>/auth/login">Log in</a>
                    <?php endif; ?>
                </nav>
            </header>

            <main>

            <?php if ($error) : ?>
                <div class="error">
                    <p><?= $error ?></p>
                </div>
            <?php endif; ?>

        <?php 
    }
}