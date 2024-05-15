<?php
session_start();

// Provera da li je zahtev poslat metodom POST
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Prikupljanje podataka iz forme
    $username_input = $_POST['username'];
    $password_input = $_POST['password'];

    // Spajanje na bazu podataka
    $servername = "localhost";
    $db_username = "root";
    $db_password = "";
    $dbname = "dbstranice";

    $conn = new mysqli($servername, $db_username, $db_password, $dbname);
    // Provera konekcije
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    // Provjera postoji li korisnik s istim korisničkim imenom
    $sql = "SELECT * FROM logindb WHERE username='$username_input'";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        // Korisnik već postoji
        echo "Korisničko ime već postoji!";
    } else {
        // Korisnik ne postoji, dodajemo ga u bazu
        $sql = "INSERT INTO logindb (username, password) VALUES ('$username_input', '$password_input')";

        if ($conn->query($sql) === TRUE) {
          // Postavljanje korisničkog imena u sesiju
          $_SESSION['username'] = $username_input;
          header("Location: index.html?username=$username_input");
      } else {
          echo "Error: " . $sql . "<br>" . $conn->error;
      }
      
    }

    // Zatvaranje konekcije
    $conn->close();
}
?>