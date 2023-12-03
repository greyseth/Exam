    <section class="planes-header">
        <h1>OUR PRIZED AND GLORIOUS PLANES</h1>
        <p>View our collection of top tier planes, that give you the best service</p>
        <a href="<?=base_url()?>index.php/planes/add">
            <button class="hover pointer scale invert">Add Plane Data</button>
        </a>
    </section>
    
    <section class="planes-body">
        <div class="plane-card-container">
            <div class="plane-card">
                <img src="<?=base_url()?>assets/img/mike.jpg"/>
                <div class="plane-card-details">
                    <h3>Plane name</h3>
                    <div>
                        <p>Type: First Class</p>
                        <p>Capacity: 41 persons</p>
                    </div>
                    <!-- Admin controls -->
                    <div class="plane-card-admin">
                        <a class="hover pointer scale"><button>Edit</button></a>
                        <a class="hover pointer scale"><button>Delete</button></a>
                    </div>
                </div>
            </div>
        </div>
    </section>