<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Звездный зал</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz"
        crossorigin="anonymous"></script>
    <link rel="stylesheet" href="styles.css">
</head>

<body>
    <header>
    <nav class="nav_2">     
            <ul>
                <li><a href="index.php" class="menu logo"><img src="images/logo.png" class="logotip">
                        <p>Звездный зал</p>
                    </a></li>
                <li><a href="index.php" class="menu">Главная</a></li>
                <li><a href="katalog.php" class="menu">Фильмы</a></li>
                <li><a href="contact.php" class="menu">Контакты</a></li>
                <li><a href="register.php" class="menu">Зарегистрироваться</a></li>
                <li><a href="login.php" class="menu">Войти</a></li>
            </ul>
        </nav>
        <div class="burger">
            <span></span>
        </div>
    </header>


    <div class='filtr_block'>
        <form action="filter_movies.php" method="get">
            <label for="genre" class='filter_text'>Выберите жанр:</label>
            <select class='d' name="genre" id="genre">
                <option value="">Все жанры</option>
                <option value="Драма">Драма</option>
                <option value="Комедия">Комедия</option>
                <option value="Сказка">Сказка</option>
                <option value="Приключения">Приключения</option>
                <option value="Мелодрама">Мелодрама</option>
                <option value="Боевик">Боевик</option>
                <!-- Добавьте больше опций по мере необходимости -->
            </select>
            <input class='filter_btn' type="submit" value="Искать">
        </form>
    </div>


    <?php
// Подключение к базе данных
$servername = 'localhost';
$username = 'starry';
$password = 'starry';
$dbname = 'starry';

$conn = new mysqli($servername, $username, $password, $dbname);
if ($conn->connect_error) {
    die('Connection failed: '. $conn->connect_error);
}

// Получаем значение жанра из URL
$genre = isset($_GET['genre'])? $_GET['genre'] : '';

// Формируем SQL запрос с учетом выбранного жанра
$sql = 'SELECT * FROM movies';
if (!empty($genre)) {
    $sql.= ' WHERE LOWER(genre) = LOWER(?)';
}

$stmt = $conn->prepare($sql);
if ($stmt === false) {
    die('Error preparing statement: '. $conn->error);
}

// Привязываем параметр, если жанр выбран
if (!empty($genre)) {
    $stmt->bind_param('s', $genre); // 's' означает, что тип параметра - строка
}

$stmt->execute();
$result = $stmt->get_result();

// Проверяем, есть ли фильмы с выбранным жанром
if ($result->num_rows > 0) {
    // Вывод данных каждого фильма
    $groupCount = 0;
    while ($row = $result->fetch_assoc()) {
        if ($groupCount % 3 == 0) {
            echo "<div class='movie-row'>";
        }
        echo "<div class='movie-container'>";
        echo '<h2>'. htmlspecialchars($row['title']). '</h2>';
        // Предполагаем, что изображение уже сохранено или загружено заранее
        echo "<img src='images/{$row['title']}.jpg' alt='". htmlspecialchars($row['title']). "'>";
        echo "<a href='select_time.php?movie_id=". $row['id']. "' class='info-button'>Информация о фильме</a>";
        echo '</div>';

        $groupCount++;
        if ($groupCount % 3 == 0) {
            echo '</div>';
        }
    }
} else {
    echo "<div class='no_film'>";
    echo "Фильмы с выбранным жанром не обнаружены";
    echo "</div>";
}

$stmt->close();
$conn->close();
?>


<footer class='footer'>
        <nav>
            <ul>
                <li><a href="index.php" class="menu logo"><img src="images/logo.png" class="logotip">
                        <p>Звездный зал</p>
                    </a></li>
                <li><a href="index.php" class="menu">Главная</a></li>
                <li><a href="katalog.php" class="menu">Фильмы</a></li>
                <li><a href="contact.php" class="menu">Контакты</a></li>
                <button class='btn_menu' id="openModal1">Зарегистрироваться</button>
                <button class='btn_menu' id="openModal2">Войти</button>
            </ul>
        </nav>
        <br>
        <p>&copy; 2024 Звездный зал. Все права защищены.</p>
    </footer>
    <script>
        document.querySelector('.burger').addEventListener('click', function() {
            this.classList.toggle('active');
            document.querySelector('.nav_2').classList.toggle('open');
        })
    </script>
</body>
</html>
<!-- Модальное окно регистрации -->
<div id="modal1" class="modal">
    <div class="modal-content modal-content_size">
    <span class="close" id="closeModal1">&times;</span>
        <form action="register.php" method="post" onsubmit="closeModal(); return true;">
        <div class='modal_reg'>  
            <div class="poles">     
            <h2  class='text_reg'>Регистрация</h2>
                <label for="phone_number">Номер телефона:</label><br>
                <input class='pole_vvoda' type="tel" id="phone_number" name="phone_number" required><br>
                <label for="login">Логин:</label><br>
                <input class='pole_vvoda' type="text" id="login" name="login" required><br>
                <label for="password">Пароль:</label><br>
                <input class='pole_vvoda' type="password" id="password" name="password" required><br>
                <label for="confirm_password">Подтвердите пароль:</label><br>
                <input class='pole_vvoda' type="password" id="confirm_password" name="confirm_password" required><br>
            </div>
                <input class='reg_btn' type="submit" value="Зарегистрироваться">
        </div>
        </form>
    </div>
</div>
<!-- Модальное окно входа -->
<div id="modal2" class="modal">
    <div class="modal-content modal-content_size">
    <span class="close" id="closeModal2">&times;</span>
        <form action="login.php" method="post" onsubmit="closeModal(); return true;">
            <div class='modal_reg'> 
                <div class="poles">  
                <h2 class='text_vhod'>Вход</h2>
                    <label for="phone_number">Номер телефона:</label><br>
                    <input class='pole_vvoda' type="tel" id="phone_number" name="phone_number" required><br>
                    <label for="password">Пароль:</label><br>
                    <input class='pole_vvoda' type="password" id="password" name="password" required><br>
                </div>
                    <input class='reg_btn' type="submit" value="Войти">
            </div>
        </form>
    </div>
</div>
<script>
var modal1 = document.getElementById("modal1");
var modal2 = document.getElementById("modal2");
var btn1 = document.getElementById("openModal1");
var btn2 = document.getElementById("openModal2");

btn1.onclick = function() {
    modal1.style.display = "block";
}

btn2.onclick = function() {
    modal2.style.display = "block";
}

// Закрытие модального окна при нажатии на кнопку закрытия или вне области модального окна
window.onclick = function(event) {
    if (event.target == modal1 || event.target == modal2) {
        modal1.style.display = "none";
        modal2.style.display = "none";
    }
}
</script>