    <form method="post" action="<?=base_url()?>index.php/routes/auth_edit/<?=$ogData->route_id?>" enctype="multipart/form-data">
        <h1>UPDATING ROUTE <?=strtoupper($ogData->origin)?> TO <?=strtoupper($ogData->destination)?></h1>
        <div class="form-gap medium"></div>

        <input type="text" placeholder="Origin City" name="originInput" value="<?=$ogData->origin?>"/>
        <input type="text" placeholder="Destination City" name="destinationInput" value="<?=$ogData->destination?>"/>
        <input type="number" placeholder="Distance" name="distanceInput" value="<?=$ogData->distance?>"/>
        <div class="form-gap medium"></div>

        <select class="hover pointer" name="planeInput">
            <option value="">Plane Type:</option>
            <?php 
            if (isset($planes)) {
                foreach ($planes as $plane) {
                    echo '
                        <option 
                            value="'.$plane->plane_id.'"
                            '.(($ogData->plane_id===$plane->plane_id)?'selected':'').'>
                            '.$plane->name.'
                        </option>
                    ';
                }
            }
            ?>
        </select>        
        <select class="hover pointer" name="availabilityInput" >
            <option value="available" <?=(($ogData->available==='available')?'selected':'')?> >Available</option>
            <option value="unavailable" <?=(($ogData->available==='unavailable')?'selected':'')?>>Unavailable</option>
        </select>
        <div class="form-gap medium"></div>

        <input type="submit" value="Update Route" name="editRoute" class="hover pointer invert" />
    </form>