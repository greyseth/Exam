<?php

class notifs extends CI_Model {
    public function send($title, $message) {
        require __DIR__ . './vendor/autoload.php';

        $options = array(
            'cluster' => 'ap1',
            'useTLS' => true
        );
        $pusher = new Pusher\Pusher(
            '954b257e1acd8a2a3fed',
            '50f39e2191546dea1dc7',
            '1714808',
            $options
        );

        $data['title'] = $title;
        $data['message'] = $message;
        $pusher->trigger('my-channel', 'my-event', $data);
    }
}

?>