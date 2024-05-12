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


    <div id="carouselExample" class="carousel slide">
  <div class="carousel-inner">
    <div class="carousel-item active">
      <img src="images/slider_1.png" class="d-block w-100" alt="...">
    </div>
    <div class="carousel-item">
      <img src="images/slider_2.png" class="d-block w-100" alt="...">
    </div>
    <div class="carousel-item">
      <img src="images/slider_3.png" class="d-block w-100" alt="...">
    </div>
  </div>
  <button class="carousel-control-prev" type="button" data-bs-target="#carouselExample" data-bs-slide="prev">
    <span class="carousel-control-prev-icon" aria-hidden="true"></span>
    <span class="visually-hidden">Предыдущий</span>
  </button>
  <button class="carousel-control-next" type="button" data-bs-target="#carouselExample" data-bs-slide="next">
    <span class="carousel-control-next-icon" aria-hidden="true"></span>
    <span class="visually-hidden">Следующий</span>
  </button>
</div>

    <section class="content">
        <?php include 'movies.php'; ?>
    </section>

    <footer>
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
var closeBtn1 = document.getElementById("closeModal1");
var closeBtn2 = document.getElementById("closeModal2");

btn1.onclick = function() {
    modal1.style.display = "block";
}

btn2.onclick = function() {
    modal2.style.display = "block";
}

closeBtn1.onclick = function() {
    closeModal("modal1");
}

closeBtn2.onclick = function() {
    closeModal("modal2");
}

window.onclick = function(event) {
    if (event.target == modal1 || event.target == modal2) {
        modal1.style.display = "none";
        modal2.style.display = "none";
    }
}

function closeModal(modalId) {
    var modal = document.getElementById(modalId);
    modal.style.display = "none";
}
</script>


