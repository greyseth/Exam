<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="<?php echo base_url().'assets/styles/index.css' ?>" />
    <link rel="stylesheet" href="<?php echo base_url().'assets/styles/svg-colors.css' ?>" />
    <?php if (isset($customCSS)) 
        foreach ($customCSS as $style) {
            echo '<link rel="stylesheet" href="'.base_url().'assets/styles/'.$style.'" />';
        }
    ?>

    <title><?php if(isset($title)) echo $title ?></title>
</head>
<body>
    <header>
        <div>
            <img src="<?php echo base_url().'assets/img/icons/menu.svg' ?>" class="svg-primary-color menu-btn hover pointer scale"
                onclick="openSidebar()"/>
            <h2>Travelpedia</h2>
        </div>
        <div>
            <button class="notif-btn hover pointer scale">
                <img src="<?=base_url()?>assets/img/icons/notif.svg" class="svg-white" />
                <!-- <p>!</p> -->
            </button>
            <?php if(!$this->session->userdata('login_id')) : ?>
                <a href="<?php echo base_url() ?>index.php/auth/login">
                    <button class="login-btn hover pointer invert-secondary">Log in</button>
                </a>
            <?php endif ?>
            <!-- Replace login button with account link if session exists -->
        </div>
    </header>

    <!-- TODO: Add flashdata notif display -->