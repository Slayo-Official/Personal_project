<?php
session_start();

// Provjera je li korisnik prijavljen
if(isset($_SESSION['username'])) {
    // Spajanje na bazu podataka
    $servername = "localhost";
    $username = "root";
    $password = "";
    $dbname = "dbstranice";

    $conn = new mysqli($servername, $username, $password, $dbname);

    // Provjera konekcije
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    // Brisanje korisnika iz baze podataka
    $username = $_SESSION['username'];
    $sql = "DELETE FROM logindb WHERE username='$username'";

    if ($conn->query($sql) === TRUE) {
        echo "Korisnik $username je uspješno obrisan.";
        // Nakon brisanja, uništavamo sesiju i preusmjeravamo korisnika na početnu stranicu ili gdje god želite.
        session_unset();
        session_destroy();
        header("Location: index.html"); // Možete promijeniti putanju ovisno o tome kamo želite preusmjeriti korisnika nakon brisanja.
        exit();
    } else {
        echo "Error deleting record: " . $conn->error;
    }

    $conn->close();
}
?>
