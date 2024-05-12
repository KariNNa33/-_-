<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Звездный зал</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="styles.css">
</head>
<body>
<header>
<nav class="nav_2">     
            <ul>
                <li ><a href="index.php" class="menu logo"><img src="images/logo.png" class="logotip"><p>Звездный зал</p></a></li>
                

                <li><a href="index.php" class="menu">Главная</a></li>
                <li><a href="katalog.php" class="menu">Фильмы</a></li>
                <li><a href="contact.php" class="menu">Контакты</a></li>
                <button class='btn_menu' id="openModal1">Зарегистрироваться</button>
                <button class='btn_menu' id="openModal2">Войти</button>
            </ul>
        </nav>
        <div class="burger">
            <span></span>
        </div>
    </header>


<?php
    // Подключение к базе данных
    $conn = new mysqli('localhost', 'starry', 'starry', 'starry');

    // Получение идентификатора фильма из URL
    $movie_id = $_GET['movie_id'];

    // SQL-запрос для получения информации о фильме
    $sql = "SELECT * FROM movies WHERE id =?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("i", $movie_id);
    $stmt->execute();
    $result = $stmt->get_result();

    // Проверка, есть ли результаты
    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();

        // Сохранение изображения на сервере
        $imagePath = 'images/'. $row["title"]. '.jpg';
        file_put_contents($imagePath, $row["image"]);
    } else {
        echo "Фильм не найден.";
    }

    // SQL-запрос для получения всех времён показа для данного фильма
    $sqlTimes = "SELECT show_time FROM movie_times WHERE movie_id =?";
    $stmtTimes = $conn->prepare($sqlTimes);
    $stmtTimes->bind_param("i", $movie_id);
    $stmtTimes->execute();
    $resultTimes = $stmtTimes->get_result();
    $conn->close();
   ?>

<div class="container">
    <div class="left-column">
        <img class='img_info' src="<?php echo $imagePath;?>" alt="<?php echo $row["title"];?>">
    </div>
    <div class="right-column">
        <h2><?php echo $row["title"];?></h2>
        <p><?php echo $row["description"];?></p>
        <div class="left-column_2">
            <p>Жанр: <?php echo htmlspecialchars($row["genre"]);?></p>
            <p>Продолжительность: <?php echo htmlspecialchars($row["duration"]);?></p>
            <p>Режиссер: <?php echo htmlspecialchars($row["director"]);?></p>
            <p>Стоимость билета: <?php echo htmlspecialchars($row["price"]);?></p>
        </div>
        <!-- Вывод времени показа -->
        <div class='btn_time'>
        <?php
        if ($resultTimes->num_rows > 0) {
            while ($rowTime = $resultTimes->fetch_assoc()) {
                echo "<button class='show-time-btn' data-show-time='". htmlspecialchars($rowTime["show_time"]). "'>". htmlspecialchars($rowTime["show_time"]). "</button>";
            }
        } else {
            echo "<p>Время показа не указано</p>";
        }
       ?>
       </div>
    </div>
</div>

<!-- Модальное окно мест-->
<div id="myModal" class='modal'>
    <div class='modal-content'>
        <span class='close'>&times;</span>
        <div class='grid-container'>
            <div class='cinema-seats'>
                <div class="grid-item">
                    <button class='seat'>1</button>
                    <button class='seat'>2</button>
                    <button class='seat'>3</button>
                    <button class='seat'>4</button>
                    <button class='seat'>5</button>
                </div>
                <div class="grid-item">
                    <button class='seat'>1</button>
                    <button class='seat'>2</button>
                    <button class='seat'>3</button>
                    <button class='seat'>4</button>
                    <button class='seat'>5</button>
                </div>
                <div class="grid-item">
                    <button class='seat'>1</button>
                    <button class='seat'>2</button>
                    <button class='seat'>3</button>
                    <button class='seat'>4</button>
                    <button class='seat'>5</button>
                </div>
                <div class="grid-item">
                    <button class='seat'>1</button>
                    <button class='seat'>2</button>
                    <button class='seat'>3</button>
                    <button class='seat'>4</button>
                    <button class='seat'>5</button>
                </div>
                <div class="grid-item">
                    <button class='seat'>1</button>
                    <button class='seat'>2</button>
                    <button class='seat'>3</button>
                    <button class='seat'>4</button>
                    <button class='seat'>5</button>
                </div>
                <div class="grid-item">
                    <button class='seat'>1</button>
                    <button class='seat'>2</button>
                    <button class='seat'>3</button>
                    <button class='seat'>4</button>
                    <button class='seat'>5</button>
                </div>
            </div>
            <div><button class='payment'><a href="payment.php" class='payment_2'>Купить билеты</a></button></div>
        </div>
    </div>
</div>

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

<script>
    document.addEventListener('DOMContentLoaded', function() {
    // Получение элементов
    var modal = document.getElementById("myModal");
    var span = document.getElementsByClassName("close")[0];

    // Функция для открытия модального окна
    function openModal() {
        modal.style.display = "block";
    }

    // Функция для закрытия модального окна
    span.onclick = function() {
        modal.style.display = "none";
    }

    // Закрытие модального окна при нажатии вне его области
    window.onclick = function(event) {
        if (event.target == modal) {
            modal.style.display = "none";
        }
    }

    // Добавление обработчика событий для кнопок времени показа
    var showTimeBtns = document.querySelectorAll('.show-time-btn');
    showTimeBtns.forEach(function(btn) {
        btn.onclick = function() {
            openModal();
        };
    });
});
    </script>

<script>
document.addEventListener('DOMContentLoaded', function() {
    var seats = document.querySelectorAll('.seat');
    seats.forEach(function(seat) {
        seat.addEventListener('click', function() {
            this.style.backgroundColor = '#6d6d6d'; // Изменяем цвет фона на другой
        });
    });
});
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
