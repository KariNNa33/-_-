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

<h1 class='pay_gl_text'>Оформление покупки билетов</h1><br>
<div class='pay_block'>
        <main>
            <form action="index.php" method="post" class="ticket-form"> 
                <div class='form_pay'>
                    <label class='text_label' for="name">Имя:</label><br>
                    <input class='pole_vvoda' type="text" id="name" name="name" required><br>
                    <label class='text_label' for="email">Email:</label><br>
                    <input class='pole_vvoda' type="email" id="email" name="email" required><br>
                    <label class='text_label' for="phone">Телефон:</label><br>
                    <input class='pole_vvoda' type="tel" id="phone" name="phone" required><br>
                    <label class='text_label' for="phone">Номер карты:</label><br>
                    <input class='pole_vvoda' type="tel" id="phone" name="phone" required><br>
                </div>
                    <button class='pay_btn' type="submit">Оформить покупку</button>
                
            </form>
        </main>
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