<?php
if (isset($_POST['email'])) {
    // валидация email
    $email = filter_var($_POST['email'], FILTER_SANITIZE_EMAIL);
    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $response = array(
            'success' => false,
            'message' => 'Please enter a valid email address.'
        );
        echo json_encode($response);
        exit();
    }
    // добавление email в базу данных
    $db = new SQLite3('subscribers.db');
    $stmt = $db->prepare("INSERT INTO subscribers (email) VALUES (:email)");
    $stmt->bindValue
