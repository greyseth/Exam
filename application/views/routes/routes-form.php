    <form method="post" action="<?=base_url()?>index.php/routes/auth_add" enctype="multipart/form-data">
        <h1>ADD NEW ROUTE</h1>
        <div class="form-gap medium"></div>

        <input type="text" placeholder="Origin City" name="originInput" required />
        <input type="text" placeholder="Destination City" name="destinationInput" required />
        <input type="number" placeholder="Distance (in km)" name="distanceInput" required />
        <div class="form-gap medium"></div>

        <select class="hover pointer" name="planeInput" required>
            <option value="">Plane Type:</option>
            <?php 
            if (isset($planes)) {
                foreach ($planes as $plane) {
                    echo '
                        <option value="'.$plane->plane_id.'">'.$plane->name.'</option>
                    ';
                }
            }
            ?>
        </select>        
        <select class="hover pointer" name="availabilityInput" required>
            <option value="available">Available</option>
            <option value="unavailable">Unavailable</option>
        </select>
        <div class="form-gap big"></div>

        <input type="submit" value="Add Route" name="addRoute" class="hover pointer invert" />        
    </form>