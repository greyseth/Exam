    <section class="book-body">
        <div class="book-header">
            <h2>BOOK YOUR DREAM FLIGHT</h2>
        </div>
        <div class="book-container">
            <ul class="book-controls">
                <li onclick="changePage(1)">Route</li>
                <li onclick="changePage(2)">Flight Class</li>
                <li onclick="changePage(3)">Passengers</li>
                <li onclick="changePage(4)">Confirm</li>
            </ul>
            <form method="post" action="<?=base_url()?>index.php/book/add" class="book-form">
                <div class="form-section" id="form-section-1">
                    <div class="form-section-header">
                        <h2>STEP 01</h2>
                        <p>When and where are we going?</p>
                    </div>
                    <div class="form-section-body">
                        <div class="route-pick-btn">
                            <input type="hidden" name="routeInput" id="routeInput" />
                            <button class="hover pointer invert-primary"
                                onclick="routeListVis(true)"
                                id="routeBtn">PICK ROUTE</button>
                            <p id="routeMsg">You must pick a travel route</p>
                        </div>
                        <div class="date-list">
                            <div>
                                <label for="departDateInput">Departure Date</label>
                                <input type="date" name="departDateInput" />
                            </div>
                            <div>
                                <img id="nav-2" src="<?=base_url()?>assets/img/icons/arrow.svg" 
                                    class="svg-primary-color hover pointer scale"
                                    onclick="changePage(2)"/>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="form-section" id="form-section-2" hidden>
                    <div class="form-section-header">
                        <h2>STEP 02</h2>
                        <p>Budget or luxury?</p>
                    </div>
                    <div class="form-section-body">
                        <div class="flight-class-list">
                            <div>
                                <input type="hidden" name="classInput" id="classInput"/>
                                <div id="class-first" 
                                    class="flight-class-btn first hover pointer scale"
                                    onclick="pickClass('first')">
                                    <h3>FIRST CLASS</h3>
                                    <p>$250/person | Luxurious Features</p>
                                </div>
                                <div id="class-business" 
                                    class="flight-class-btn business hover pointer scale"
                                    onclick="pickClass('business')">
                                    <h3>BUSINESS CLASS</h3>
                                    <p>$100/person | Extra Features</p>
                                </div>
                                <div id="class-economy" 
                                    class="flight-class-btn economy hover pointer scale"
                                    onclick="pickClass('economy')">
                                    <h3>ECONOMY CLASS</h3>
                                    <p>$50/person | Essential Features</p>
                                </div>
                            </div>
                            <div>
                                <img id="nav-3" src="<?=base_url()?>assets/img/icons/arrow.svg" 
                                    class="svg-primary-color hover pointer scale"
                                    onclick="changePage(3)"/>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="form-section" id="form-section-3" hidden>
                    <div class="form-section-header">
                        <h2>STEP 03</h2>
                        <p>Who's coming?</p>
                    </div>
                    <div class="form-section-body">
                        <div class="seats-form-container">
                            <input type="hidden" id="seatCountInput" name="seatCountInput" />
                            <div class="seats-form">
                                <div>
                                    <div class="seats-input">
                                        <p>Adults</p>
                                        <input type="number" id="adultSeatInput" value="0" 
                                            oninput="changeSeatValue('adultSeatInput')"/>
                                    </div>
                                    <div class="seats-input">
                                        <p>Children</p>
                                        <input type="number" id="childrenSeatInput" value="0" 
                                            oninput="changeSeatValue('childrenSeatInput')"/>
                                    </div>
                                </div>
                            </div>
                            <div class="seats-details">
                                <p>Total ordered seats: <span id="orderedSeats">0</span></p>
                                <p>Total Price: <span id="totalPrice">$0</span></p>

                            </div>
                            <div class="seats-next">
                                <img id="nav-3" src="<?=base_url()?>assets/img/icons/arrow.svg" 
                                    class="svg-primary-color hover pointer scale"
                                    onclick="changePage(4)"/>
                            </div>
                        </div>
                    </div>
                </div> 
                <div class="form-section" id="form-section-4" hidden>
                    <div class="form-section-header">
                        <h2>STEP 04</h2>
                        <p>Complete your payment</p>
                    </div>
                    <div class="form-section-body">
                        <div class="form-submit">
                            <input type="submit" name="newbook" value="Continue to payment" class="hover pointer invert">
                            <p>You will be sent to the payment gateway, where more details will be shown</p>
                        </div>
                    </div>
                </div>             
            </form>
        </div>
    </section>

    <section class="routes-list-container" hidden>
        <div class="routes-list">
            <?php 
            
            if (isset($routes)) {
                if (count($routes) > 0) {
                    foreach ($routes as $route) {
                        $clickFunc = "pickRoute('".$route->origin." to ".$route->destination."', ".$route->route_id.")";
                        echo '
                            <div class="route-card hover pointer"
                                onclick="'.$clickFunc.'">
                                <div class="route-card-location">
                                    <p>FROM</p>
                                    <p>'.$route->origin.'</p>
                                </div>
                                <div class="route-card-details">
                                    <div>
                                        <p>'.$route->name.'</p>
                                        <p>|</p>
                                        <p>'.$route->distance.' km</p>
                                    </div>
                                    <div class="route-card-visual"></div>
                                    <div>
                                        <p>'.$route->type.'</p>
                                        <p>|</p>
                                        <p>'.$route->capacity.' persons</p>
                                    </div>

                                    <img src="'.base_url().'assets/img/icons/plane.svg" alt="PLANE" class="svg-primary-color"
                                        style="transition: '.($route->distance/1000).'s"/>
                                </div>
                                <div class="route-card-location">
                                    <p>TO</p>
                                    <p>'.$route->destination.'</p>
                                </div>
                            </div>
                        ';
                    }
                }else echo '<p>No routes currently available</p>';
            }else echo '<p>No routes currently available</p>';
            
            ?>

            <img src="<?=base_url()?>assets/img/icons/cross.svg" 
                class="routes-close hover pointer scale svg-red"
                onclick="routeListVis(false)" />
        </div>          
    </section>