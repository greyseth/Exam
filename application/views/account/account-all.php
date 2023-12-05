    <section class="admin-account">
        <h2>TRAVELPEDIA USER LIST</h2>
        <table>
            <tr class="header-row">
                <th>User Id</th>
                <th>Username</th>
                <th>Full Name</th>
                <th>Email</th>
                <th>Phone Number</th>
                <th>Privilege</th> 
                <th>Actions</th>
            </tr>
            <?php 
            
                foreach ($users as $user) {
                    echo '<tr>';
                        echo '<td>'.$user->user_id.'</td>';
                        echo '<td>'.$user->username.'</td>';
                        echo '<td>'.$user->name.'</td>';
                        echo '<td>'.$user->email.'</td>';
                        echo '<td>'.$user->number.'</td>';
                        echo '<td>'.(($user->level==='1')?'ADMIN':'USER').'</td>';
                        echo '
                                <td class="actions">
                                    <a
                                        href="'.base_url().'index.php/account/update/'.$user->user_id.'">
                                        <img src="'.base_url().'assets/img/icons/view.svg" class="svg-white hover pointer scale"/>
                                    </a>
                                    <a
                                        href="'.base_url().'index.php/account/auth_delete/'.$user->user_id.'">
                                        <img src="'.base_url().'assets/img/icons/delete.svg" class="svg-red hover pointer scale"/>
                                    </a>
                                </td>';
                    echo '</tr>';
                }
            
            ?>
        </table>
    </section>