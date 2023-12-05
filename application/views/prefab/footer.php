    <script src="https://js.pusher.com/8.2.0/pusher.min.js"></script>
    <script src="<?php echo base_url() ?>assets/js/script.js"></script>
    <script>
        let notifs = [];
    </script>

    <?php if($this->session->userdata('login_id') && $this->session->userdata('login_level') === '1') : ?>
    
        <!-- Pusher functionality-->
        <script>
            // Enable pusher logging - don't include this in production
            Pusher.logToConsole = true;

            var pusher = new Pusher('954b257e1acd8a2a3fed', {
            cluster: 'ap1'
            });

            var channel = pusher.subscribe('my-channel');
            channel.bind('my-event', function(data) {
                notifs.push(data);
                document.querySelector('#notif-alert').style.opacity = 1;
            });            
        </script>

    <?php endif ?>
    
    <?php
        if(isset($customJS)) {
            foreach ($customJS as $js) {
                echo '<script src="'.base_url().'assets/js/'.$js.'"></script>';
            }
        }
    ?>
</body>
</html>