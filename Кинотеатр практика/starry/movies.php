<?php
// Подключение к базе данных
$servername = 'localhost';
$username = 'starry';
$password = 'starry';
$dbname = 'starry';

$conn = new mysqli( $servername, $username, $password, $dbname );
if ( $conn->connect_error ) {
    die( 'Connection failed: '. $conn->connect_error );
}

// Запрос к базе данных
$sql = 'SELECT * FROM movies';
$result = $conn->query( $sql );

// Вывод данных каждого фильма
$groupCount = 0;
// Вывод данных каждого фильма
while( $row = $result->fetch_assoc() ) {
    if ( $groupCount % 3 == 0 ) {
        // Если текущий элемент - первый в группе из трех
        echo "<div class='movie-row'>";
    }
    echo "<div class='movie-container'>";
    echo '<h2>'. $row[ 'title' ]. '</h2>';
    // Сохранение изображения на сервере
    $imagePath = 'images/'. $row[ 'title' ]. '.jpg';
    file_put_contents( $imagePath, $row[ 'image' ] );
    // Вывод изображения
    echo "<img src='". $imagePath. "' alt='". $row[ 'title' ]. "'>";
    echo "<a href='select_time.php?movie_id=". $row[ 'id' ]. "' class='info-button'>Информация о фильме</a>";
    echo '</div>';

    $groupCount++;
    // Увеличиваем счетчик
    if ( $groupCount % 3 == 0 ) {
        // Если текущий элемент - последний в группе из трех
        echo '</div>';
        // Закрываем контейнер группы
    }
}
?>