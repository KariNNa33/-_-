<?php
// Подключение к базе данных
$servername = "localhost";
$username = "starry";
$password = "starry";
$dbname = "starry";

$conn = new mysqli($servername, $username, $password, $dbname);
if ($conn->connect_error) {
    die("Connection failed: ". $conn->connect_error);
}

// Проверка наличия данных в форме
if (!isset($_POST['phone_number'], $_POST['password'])) {
    exit;
}

// Получение данных из формы
$phone_number = $_POST['phone_number'];
$password = $_POST['password'];

// Подготовка SQL запроса для поиска пользователя по номеру телефона
$sql = "SELECT * FROM users WHERE phone_number =?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("s", $phone_number);
$stmt->execute();
$result = $stmt->get_result();

// Проверка, найден ли пользователь
if ($result->num_rows > 0) {
    $user = $result->fetch_assoc();
    
    // Проверка пароля
    if (password_verify($password, $user['password'])) {
        // Пароль верный, можно войти
        session_start(); // Начало сессии
        $_SESSION['user_id'] = $user['id']; // Сохранение ID пользователя в сессию
        echo "Вход успешный.";
        
        // Перенаправление на главную страницу
        header('Location: index.php');
        exit;
    } else {
        echo "Неверный пароль.";
    }
} else {
    echo "Пользователь не найден.";
}

// Закрытие соединения
$conn->close();
?>