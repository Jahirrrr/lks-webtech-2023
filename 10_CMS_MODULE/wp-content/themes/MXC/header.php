<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo bloginfo('title') ?></title>
    <link rel="stylesheet" href="<?= DIR ?>/style.css">
    <link rel="stylesheet" href="<?= get_template_directory_uri() ?>/style.css">
</head>

<body <?php body_class() ?>>

    <?php wp_head() ?>

    <div class="transition">
        <div></div>
    </div>

    <header>
        <div class="container">
            <nav>
                <ul class="menu">
                    <li><a href="<?= get_home_url() ?>">Home</a></li>
                    <li><a href="<?= get_home_url() ?>">Our Designer</a></li>
                </ul>
            </nav>
        </div>
    </header>