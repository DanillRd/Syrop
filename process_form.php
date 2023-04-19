<?php
if (isset($_POST['mc-email'])) { // проверяем, было ли отправлено значение поля email из формы
    $email = $_POST['mc-email'];
    // валидируем email, чтобы он соответствовал стандарту RFC 822
    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        echo "Invalid email format";
        exit; // прекращаем выполнение скрипта
    }
    // создаем подключение к базе данных SQLite
    $db = new SQLite3('subscribers.db');
    // подготавливаем запрос на добавление email в базу данных
    $stmt = $db->prepare("INSERT INTO subscribers (email) VALUES (:email)");
    // связываем переменную :email с значением $email и выполняем запрос
    $stmt->bindValue(':email', $email, SQLITE3_TEXT);
    $stmt->execute();
    // закрываем подключение к базе данных
    $db->close();
    // сообщаем пользователю об успешной подписке
    echo "Thank you for subscribing!";
} else {
    echo "Invalid request";
}
?>
