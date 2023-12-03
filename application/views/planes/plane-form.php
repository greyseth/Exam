    <form method="post" action="<?=base_url()?>index.php/planes/auth_add" enctype="multipart/form-data">
        <h1>ADD NEW PLANE</h1>
        <div class="form-gap medium"></div>

        <input type="text" placeholder="Plane Name" name="nameInput" required />
        <select class="hover pointer" name="typeInput" required>
            <option value="">Plane Type:</option>
            <option value="Economy">Economy Class</option>
            <option value="Business">Business Class</option>
            <option value="First Class">First Class</option>
        </select>
        <input type="number" placeholder="Capacity" name="capacityInput" required />
        <div class="form-gap medium"></div>

        <input type="file" accept="image/*" name="planePicture" class="hover pointer" required />
        <div class="form-gap big"></div>

        <input type="submit" value="Add Plane" name="addPlane" class="hover pointer invert" />

        <?php if ($this->session->flashdata('msg')) : ?>
            <p style="color:red"><?=$this->session->flashdata('msg')?></p>
        <?php endif ?>
    </form>