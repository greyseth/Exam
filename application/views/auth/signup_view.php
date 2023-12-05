    <section class="login-body">
        <div class="signup-stock"></div>
        <form method="post" action="<?=base_url()?>index.php/auth/auth_signup">
            <h2>COME JOIN US</h2>
            <p>And start travelling</p>
            <div class="form-gap medium"></div>

            <input type="text" placeholder="Username" name="usernameInput" required/>
            <input type="text" placeholder="Full Name" name="nameInput" required/>
            <input type="text" placeholder="Email Address" name="emailInput" required/>
            <input type="text" placeholder="Phone Number" name="numberInput" required/>
            <div class="form-gap medium"></div>

            <div class="password-input">
                <input id="passwordInput" type="password" placeholder="Create a Password" name="passwordInput" required/>
                <img id="passwordToggle" src="<?=base_url();?>assets/img/icons/view.svg" onclick="togglePassword()" class="svg-white hover scale pointer" />
            </div>
            <div class="password-input">
                <input id="confirmPasswordInput" type="password" placeholder="Confirm Password" name="confirmPasswordInput" required/>
                <img id="confirmPasswordToggle" src="<?=base_url();?>assets/img/icons/view.svg" onclick="togglePassword('confirmPassword')" class="svg-white hover scale pointer" />
            </div>
            <div class="form-gap big"></div>

            <input type="submit" value="Sign Up" name="signup" class="hover pointer invert-secondary" />
            <p
            style="text-align:center; font-size:1rem;">
            Already have an account? <a href="<?=base_url()?>index.php/auth/login">Log In!</a></p>
        </form>
    </section>