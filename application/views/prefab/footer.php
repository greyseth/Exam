    <script src="<?php echo base_url() ?>assets/js/script.js"></script>
    
    <?php
        if(isset($customJS)) {
            foreach ($customJS as $js) {
                echo '<script src="'.base_url().'assets/js/'.$js.'"></script>';
            }
        }
    ?>
</body>
</html>