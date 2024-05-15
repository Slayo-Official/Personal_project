<?php
session_start();

$servername = "localhost";
$username = "root";
$password = "";
$dbname = "dbstranice";

// Provjera je li zahtjev poslan metodom POST
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Prikupljanje podataka iz obrasca
    $username_input = $_POST['username'];
    $password_input = $_POST['password'];

    // Spajanje na bazu podataka
    $conn = new mysqli($servername, $username, $password, $dbname);
    // Provjera konekcije
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    // SQL upit za unos podataka
    $sql = "INSERT INTO logindb (username, password) VALUES ('$username_input', '$password_input')";

    if ($conn->query($sql) === TRUE) {
        // Postavljanje korisničkog imena u sesiju
        $_SESSION['username'] = $username_input;
        // Preusmjeravanje na index.html
        header("Location: index.html");
        exit();
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }

    // Zatvaranje konekcije
    $conn->close();
}
?>
