<?php

  require 'connection.php';
  require __DIR__ . '/vendor/autoload.php';

  $options = array(
    'cluster' => 'eu',
    'useTLS' => true
  );
  $pusher = new Pusher\Pusher(
    '717103058a8b091a45b7',
    '8b3e68270b90e2cc1ea4',
    '982184',
    $options
  );

  $user_id = $_POST['user_id'];
  $message = $_POST['message'];

  $data['message'] = $message;
  $data['user_id'] = $user_id;


  $stmt = $db->prepare('INSERT INTO messages (messages, user_id) VALUES (:message, :user_id)');
  $stmt->execute(['message' => $message,'user_id'=>$user_id]);

  $pusher->trigger('my-channel', 'my-event', $data);
