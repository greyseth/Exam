    <?php 
        if (!isset($userdata)) redirect(base_url().'index.php/auth/login');
    ?>
    
    <section class="login-body">
        <div class="no-img">
            <img src="<?=base_url()?>assets/img/icons/account.svg" alt="thing" class="hover scale svg-primary-color"/>

            <a href="<?=base_url()?>index.php/account/admin" class="hover pointer invert">Back to User List</a>
        </div>
        <form method="post" action="<?=base_url()?>index.php/account/auth_update/<?=$userdata->user_id?>">
            <h2><?=$userdata->username?>'s Account</h2>
            <p>Account id: <?=$userdata->user_id?></p>
            <div class="form-gap big"></div>

            <input type="text" name="usernameInput" placeholder="Username" value="<?=$userdata->username?>"/>
            <input type="text" name="nameInput" placeholder="Full Name" value="<?=$userdata->name?>"/>
            <input type="text" name="emailInput" placeholder="Email Address" value="<?=$userdata->email?>"/>
            <input type="text" name="numberInput" placeholder="Phone Number" value="<?=$userdata->number?>"/>
            <select name="levelInput" class="hover pointer">
                <option value="1" <?=(($userdata->level==='1')?'selected':'')?> >Admin</option>
                <option value="0" <?=(($userdata->level==='0')?'selected':'')?>>User</option>
            </select>

            <div class="form-gap medium"></div>

            <input type="hidden" name="adminEdit" value="<?=$userdata->user_id?>">
            <input type="submit" value="Update Data" name="updAcc" class="hover pointer invert"/>
        </form>
    </section>