<?php

$email = "admin@olgaosadchiy.ru";
$subject = "Заявка с сайта";
function validate_phone($phone) {
    return preg_match('/^\+?[0-9\s\-]{7,15}$/', $phone);
}

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    // Получение и фильтрация данных
    $name = filter_input(INPUT_POST, 'name', FILTER_SANITIZE_STRING);
    $phone = filter_input(INPUT_POST, 'phone', FILTER_SANITIZE_STRING);

    // Проверка данных
    if (!$name || !$phone) {
        die("Ошибка: Все поля обязательны для заполнения.");
    }

    if (!validate_phone($phone)) {
        die("Ошибка: Неверный формат телефона.");
    }

    // Сбор сообщения
    $message = "Новая заявка:\n\n";
    $message .= "Имя: " . htmlspecialchars($name) . "\n";
    $message .= "Телефон: " . htmlspecialchars($phone) . "\n";

    // Отправка письма
    $headers = [
        'From' => 'no-reply@yourdomain.com',
        'Reply-To' => 'no-reply@yourdomain.com',
        'Content-Type' => 'text/plain; charset=utf-8'
    ];
    $headers_formatted = '';
    foreach ($headers as $key => $value) {
        $headers_formatted .= $key . ": " . $value . "\r\n";
    }

    if (mail($email, $subject, $message, $headers_formatted)) {
        echo "Заявка успешно отправлена.";
    } else {
        echo "Ошибка при отправке заявки.";
    }
} else {
    echo "Неверный метод запроса.";
}


?>