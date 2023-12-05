    <section class="login-body">
        <div></div>
        <form method="post" action="<?=base_url();?>index.php/auth/auth_login">
            <h2>Log In</h2>
            <p>We're glad to have you back with us</p>
            <div class="form-gap medium"></div>
            <input type="text" placeholder="Email address" name="emailInput" required/>
            <div class="password-input">
                <input id="passwordInput" type="password" placeholder="Password" name="passwordInput" required/>
                <img id="passwordToggle" src="<?=base_url();?>assets/img/icons/view.svg" onclick="togglePassword()" class="svg-white hover scale pointer" />
            </div>
            <div class="form-gap big"></div>
            <input type="submit" value="Log In" name="login" class="hover pointer invert-secondary" />
            <p
            style="text-align:center; font-size:1rem;">
            New here? <a href="<?=base_url()?>index.php/auth/signup">Sign Up!</a></p>

            <?php if ($this->session->flashdata('notif')) : ?>
                <p><?=$this->session->flashdata('notif')?></p>
            <?php endif ?>
        </form>
    </section>