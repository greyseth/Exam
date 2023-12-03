    <section class="planes-header">
        <h1>OUR PRIZED AND GLORIOUS PLANES</h1>
        <p>View our collection of top tier planes, that give you the best service</p>
        <?php if ($showAdd) : ?>
            <a href="<?=base_url()?>index.php/planes/add">
                <button class="hover pointer scale invert">Add Plane Data</button>
            </a>
        <?php endif ?>
    </section>
    
    <section class="planes-body">
        <?php 
        
        if (isset($planeData)) {
            foreach ($planeData as $plane) {
                echo 
                '<div class="plane-card-container">
                    <div class="plane-card">
                        <img src="'.base_url().'uploads/'.$plane->img.'"/>
                        <div class="plane-card-details">
                            <h3>'.$plane->name.'</h3>
                            <div>
                                <p>Type: '.$plane->type.'</p>
                                <p>Capacity: '.$plane->capacity.' persons</p>
                            </div>
                            '.
                            ($showAdd?
                                '<div class="plane-card-admin">
                                    <a class="hover pointer scale"
                                        href="'.base_url().'index.php/planes/edit/'.$plane->plane_id.'"><button>Edit</button></a>
                                    <a class="hover pointer scale"
                                        href="'.base_url().'index.php/planes/auth_delete/'.$plane->plane_id.'"><button>Delete</button></a>
                                </div>'
                            :null)
                            .'
                        </div>
                    </div>
                </div>';
            }
        }

        ?>
    </section>