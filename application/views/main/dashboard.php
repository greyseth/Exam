    <section class="dashboard">
        <h2 class="dash-title">Welcome to Travelpedia</h2>

        <div class="quick-nav">
            <div class="nav-button hover pointer" onclick="window.location='<?=base_url()?>index.php/book'">
                <p style="z-index:1;">Book a Flight</p>
                <div class="nav-bg" style="z-index:2;"></div>
                <div class="nav-bg layer-2" style="z-index:3;"></div>
                <img src="<?=base_url()?>assets/img/icons/order.svg" class="svg-white"
                    style="z-index:4;"/>
            </div>
            <div class="nav-button hover pointer" onclick="window.location='<?=base_url()?>index.php/planes'">
                <p style="z-index:1;">View Planes</p>
                <div class="nav-bg" style="z-index:2;"></div>
                <div class="nav-bg layer-2" style="z-index:3;"></div>
                <img src="<?=base_url()?>assets/img/icons/plane.svg" class="svg-white"
                    style="z-index:4;"/>
            </div>
            <div class="nav-button hover pointer" onclick="window.location='<?=base_url()?>index.php/routes'">
                <p style="z-index:1;">View Routes</p>
                <div class="nav-bg" style="z-index:2;"></div>
                <div class="nav-bg layer-2" style="z-index:3;"></div>
                <img src="<?=base_url()?>assets/img/icons/location.svg" class="svg-white"
                    style="z-index:4;"/>
            </div>
        </div>
    
        <?php if(!$this->session->userdata('login_id')) : ?>
            <div class="not-logged">
                <h2>Log in to view your bookings</h2>
                <a href="<?=base_url()?>index.php/auth/login" class="hover pointer invert">Log In</a>
            </div>
        <?php endif ?>

        <?php if($this->session->userdata('login_id') && $this->session->userdata('login_level') === '0') : ?>
            <h2>Your Bookings</h2>
            <form method="post" action="<?=base_url()?>index.php/main/re_filter_user" class="table-filter">
                <input type="text" name="originFilter" id="originFilter" placeholder="Filter by Origin">
                <input type="text" name="destinationFilter" id="destinationFilter" placeholder="Filter by Destination">
                <input type="text" name="planeFilter" id="planeFilter" placeholder="Filter by Plane">
                <input type="submit" value="Filter" name="filterBooks" class="hover pointer invert">
            </form>
            <table>
                <tr class="header-row">
                    <th>Booking Id</th>
                    <th>Route</th>
                    <th>Plane Type</th>
                    <th>Flight Class</th>
                    <th>Seat Count</th>
                    <th>Booked at</th>
                    <th>Departure Date</th>
                    <th>Paid Amount</th>
                </tr>
                <?php 
                    if (count($userBookings) > 0) {
                        foreach ($userBookings as $book) {
                            echo '<tr>';
                                echo '<td>'.$book->book_id.'</td>';
                                echo '<td>'.$book->origin.' to '.$book->destination.'</td>';
                                echo '<td>'.$book->name.'</td>';
                                echo '<td>'.$book->flight_class.' class</td>';
                                echo '<td>'.$book->seat_count.'</td>';
                                echo '<td>'.$book->booking_date.'</td>';
                                echo '<td>'.$book->depart_date.'</td>';
                                echo '<td>$'.$book->seat_price.'</td>';
                            echo '</tr>';
                        }
                    }else echo "
                        <tr>
                            <th class='table-message' colspan='8'>You don't have any bookings yet</th>
                        </tr>
                    ";
                ?>
            </table>
        <?php endif ?>

        <?php if($this->session->userdata('login_id') && $this->session->userdata('login_level') === '1') : ?>
            <h2>All User Bookings</h2>
            <form method="post" action="<?=base_url()?>index.php/main/re_filter" class="table-filter">
                <input type="text" name="nameFilter" id="nameFilter" placeholder="Filter by Name">                
                <input type="text" name="originFilter" id="originFilter" placeholder="Filter by Origin">
                <input type="text" name="destinationFilter" id="destinationFilter" placeholder="Filter by Destination">
                <input type="text" name="planeFilter" id="planeFilter" placeholder="Filter by Plane">
                <input type="submit" value="Filter" name="filterBooks" class="hover pointer invert">
            </form>
            <table>
                <tr class="header-row">
                    <th>Booking Id</th>
                    <th>Customer</th>
                    <th>Route</th>
                    <th>Plane Type</th>
                    <th>Flight Class</th>
                    <th>Seat Count</th>
                    <th>Booked at</th>
                    <th>Departure Date</th>
                    <th>Paid Amount</th>
                </tr>
                <?php 
                    if (count($bookings) > 0) {
                        foreach ($bookings as $book) {
                            echo '<tr>';
                                echo '<td>'.$book->book_id.'</td>';
                                echo '<td><a href="'.base_url().'index.php/account/update/'.$book->user_id.'">'.$book->bookername.'</a></td>';
                                echo '<td><a href="'.base_url().'index.php/routes/edit/'.$book->route_id.'">'.$book->origin.' to '.$book->destination.'</a></td>';
                                echo '<td><a href="'.base_url().'index.php/planes/edit/'.$book->plane_id.'">'.$book->name.'</a></td>';
                                echo '<td>'.$book->flight_class.' class</td>';
                                echo '<td>'.$book->seat_count.'</td>';
                                echo '<td>'.$book->booking_date.'</td>';
                                echo '<td>'.$book->depart_date.'</td>';
                                echo '<td>$'.$book->seat_price.'</td>';
                            echo '</tr>';
                        }
                    }else echo "
                        <tr>
                            <th class='table-message' colspan='8'>No one's booked aything :(</th>
                        </tr>
                    ";
                ?>
            </table>
        <?php endif ?>
    </section>