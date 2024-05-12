<?php
$servername = 'localhost';
$username = 'starry';
$password = 'starry';
$dbname = 'starry';
$conn = new mysqli($servername, $username, $password, $dbname);
if ($conn->connect_error) {
    die("Connection failed: ". $conn->connect_error);
}

// Проверка наличия данных в форме
if (!isset($_POST['phone_number'], $_POST['login'], $_POST['password'], $_POST['confirm_password'])) {
    exit;
}

// Получение данных из формы
$phone_number = $_POST['phone_number'];
$login = $_POST['login'];
$password = $_POST['password'];
$confirm_password = $_POST['confirm_password'];

// Проверка, совпадают ли пароли
if ($password!== $confirm_password) {
    echo "Пароли не совпадают.";
    exit;
}

// Хеширование пароля
$hashed_password = password_hash($password, PASSWORD_DEFAULT);

// Подготовка SQL запроса
$sql = "INSERT INTO users (phone_number, login, password) VALUES (?,?,?)";
$stmt = $conn->prepare($sql);
$stmt->bind_param("sss", $phone_number, $login, $hashed_password);

// Выполнение запроса
if ($stmt->execute()) {
            // Перенаправление на главную страницу
            header('Location: index.php');
            exit;
    echo "Регистрация успешна.";
} else {
    echo "Ошибка регистрации: ". $stmt->error;
}

$conn->close();
?>