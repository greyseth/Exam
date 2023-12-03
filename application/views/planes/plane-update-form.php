    <form method="post" action="<?=base_url()?>index.php/planes/auth_edit/<?=$ogData->plane_id?>" enctype="multipart/form-data">
        <h1>UPDATING PLANE <?=strtoupper($ogData->name)?></h1>
        <div class="form-gap medium"></div>

        <input type="text" placeholder="Plane Name" name="nameInput" value="<?=$ogData->name?>"/>
        <select class="hover pointer" name="typeInput" required>
            <option value="">Plane Type:</option>
            <option value="Economy" <?=(($ogData->type==='Economy')?'selected':'')?> >Economy Class</option>
            <option value="Business" <?=(($ogData->type==='Business')?'selected':'')?> >Business Class</option>
            <option value="First Class" <?=(($ogData->type==='First Class')?'selected':'')?> >First Class</option>
        </select>
        <input type="number" placeholder="Capacity" name="capacityInput" value="<?=$ogData->capacity?>" />
        <div class="form-gap medium"></div>

        <p>Update image</p>
        <input type="file" accept="image/*" name="planePicture" class="hover pointer"/>
        <div class="form-gap big"></div>

        <input type="submit" value="Update" name="editPlane" class="hover pointer invert" />

        <?php if ($this->session->flashdata('msg')) : ?>
            <p style="color:red"><?=$this->session->flashdata('msg')?></p>
        <?php endif ?>
    </form>