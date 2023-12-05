    <?php 
        if (!isset($userdata)) redirect(base_url().'index.php/auth/login');
    ?>
    
    <section class="login-body">
        <div class="no-img">
            <img src="<?=base_url()?>assets/img/icons/account.svg" alt="thing" class="hover scale svg-primary-color"/>

            <?php if ($this->session->userdata('login_level') === '1') : ?>
                <a href="<?=base_url()?>index.php/account/admin" class="hover pointer invert">View All Users</a>
            <?php endif ?>
        </div>
        <form method="post" action="<?=base_url()?>index.php/account/auth_update/<?=$userdata->user_id?>">
            <h2>Your Account</h2>
            <div class="form-gap big"></div>

            <input type="text" name="usernameInput" placeholder="Username" value="<?=$userdata->username?>"/>
            <input type="text" name="nameInput" placeholder="Full Name" value="<?=$userdata->name?>"/>
            <input type="text" name="emailInput" placeholder="Email Address" value="<?=$userdata->email?>"/>
            <input type="text" name="numberInput" placeholder="Phone Number" value="<?=$userdata->number?>"/>
            <?php if ($this->session->userdata('login_level') === '1') : ?>
                <select name="levelInput" class="hover pointer">
                    <option value="1" <?=(($userdata->level==='1')?'selected':'')?> >Admin</option>
                    <option value="0" <?=(($userdata->level==='0')?'selected':'')?>>User</option>
                </select>
            <?php endif ?>

            <div class="form-gap medium"></div>

            <input type="submit" value="Update Data" name="updAcc" class="hover pointer invert"/>
        </form>
    </section>