    <section class="planes-header">
        <h1>WHERE WE DROPPING?</h1>
        <p>View our ongoing and available routes</p>
        <?php if (isset($showAdd)) : ?>
            <a href="<?=base_url()?>index.php/routes/add">
                <button class="hover pointer scale invert">Add New Route</button>
            </a>
        <?php endif ?>
    </section>
    
    <section class="routes-body">
        <?php 
        
        if (isset($routes)) {
            foreach ($routes as $route) {
                echo '
                    <div class="route-card '.(($route->available==='unavailable')?'card-red':'').'">
                        <div class="route-card-location">
                            <p>FROM</p>
                            <p>'.$route->origin.'</p>
                        </div>

                        <div class="route-card-details">
                            <div>
                                <p>'.$route->name.'</p> <p>|</p> <p>'.$route->distance.' km</p>
                            </div>
                            <div class="route-card-visual"></div>
                            <div>
                                <p>'.$route->type.'</p> <p>|</p> <p>'.$route->capacity.' persons</p>
                            </div>
                            '.
                                (isset($showAdd)?
                                '<div>
                                    <a href="'.base_url().'index.php/routes/edit/'.$route->route_id.'">
                                        <button class="hover pointer scale">Edit</button>
                                    </a>
                                    <a href="'.base_url().'index.php/routes/auth_delete/'.$route->route_id.'">
                                        <button class="hover pointer scale" style="background-color: red">Delete</button>
                                    </a>
                                </div>'
                                :null)
                            .'

                            <img src="'.base_url().'assets/img/icons/plane.svg" class="svg-primary-color" 
                                style="transition: '.($route->distance/1000).'s"/>
                        </div>

                        <div class="route-card-location">
                            <p>TO</p>
                            <p>'.$route->destination.'</p>
                        </div>
                    </div>
                ';
            }
        }
        
        ?>
    </section>