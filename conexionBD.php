<?php
function conectaDb()
{
    $host = 'localhost';
    $dbname = 'bdhoteles';
    $user = 'root';
    $pass = '';
    try {
        $pdo = new PDO("mysql:host=$host;port=3306;dbname=$dbname;charset=utf8", $user, $pass);
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        return $pdo;
    } catch (PDOException $e) {
        echo $e->getMessage();
    }
}
?>