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
    $message = "
    <html>
    <head>
        <style>
            body {
                font-family: Arial, sans-serif;
                line-height: 1.6;
                color: #333;
            }
            .container {
                width: 100%;
                max-width: 600px;
                margin: 0 auto;
                padding: 20px;
                border: 1px solid #ddd;
                border-radius: 5px;
                background-color: #f9f9f9;
            }
            .header {
                text-align: center;
                margin-bottom: 20px;
            }
            .content {
                font-size: 16px;
            }
            .footer {
                text-align: center;
                font-size: 14px;
                color: #777;
                margin-top: 20px;
            }
        </style>
    </head>
    <body>
        <div class='container'>
            <div class='header'>
                <h2>Новая заявка с сайта</h2>
            </div>
            <div class='content'>
                <p><strong>Имя:</strong> " . htmlspecialchars($name) . "</p>
                <p><strong>Телефон:</strong> " . htmlspecialchars($phone) . "</p>
            </div>
            <div class='footer'>
                <p>Это письмо отправлено автоматически, не отвечайте на него.</p>
            </div>
        </div>
    </body>
    </html>";


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