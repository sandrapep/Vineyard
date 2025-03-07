<?php
include 'db.php';
session_start();

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $ime = $_POST['ime'];
    $prezime = $_POST['prezime'];
    $email = $_POST['email'];
    $telefon = $_POST['telefon'];
    $lozinka = password_hash($_POST['lozinka'], PASSWORD_DEFAULT);
    $tipNaloga = 'korisnik';  // Svi registrisani korisnici su korisnici
    $slika = $_POST['slika'];
    $linkZaPodatkeNaslovna = $_POST['linkZaPodatkeNaslovna'];

    $db = new Database();
    $conn = $db->getConnection();

    $query = "INSERT INTO korisnici (ime, prezime, eMail, telefon, lozinka, tipNaloga, slika, linkZaPodatkeNaslovna) 
              VALUES (:ime, :prezime, :email, :telefon, :lozinka, :tipNaloga, :slika, :linkZaPodatkeNaslovna)";
    $stmt = $conn->prepare($query);
    $stmt->bindParam(':ime', $ime);
    $stmt->bindParam(':prezime', $prezime);
    $stmt->bindParam(':email', $email);
    $stmt->bindParam(':telefon', $telefon);
    $stmt->bindParam(':lozinka', $lozinka);
    $stmt->bindParam(':tipNaloga', $tipNaloga);
    $stmt->bindParam(':slika', $slika);
    $stmt->bindParam(':linkZaPodatkeNaslovna', $linkZaPodatkeNaslovna);

    if ($stmt->execute()) {
        echo "Uspješna registracija!";
    } else {
        echo "Greška pri registraciji.";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registracija</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #668846; /* Zelena dingley kao pozadinska boja */
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            margin: 0;
        }
        .container {
            background-color: #fff;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            text-align: center;
            max-width: 400px;
            width: 100%;
        }
        h1 {
            color: #668846; /* Zelena dingley za naslov */
        }
        form {
            display: flex;
            flex-direction: column;
        }
        input {
            margin-bottom: 15px;
            padding: 10px;
            font-size: 16px;
            border: 1px solid #ddd;
            border-radius: 4px;
            transition: border-color 0.3s;
        }
        input:focus {
            border-color: #143a51; /* Plava elephant za fokus na input polja */
        }
        button {
            padding: 10px;
            font-size: 16px;
            color: #fff;
            background-color: #143a51; /* Plava elephant za dugme */
            border: none;
            border-radius: 4px;
            cursor: pointer;
            transition: background-color 0.3s;
        }
        button:hover {
            background-color: #0e2a3a; /* Tamnija plava za hover efekat na dugme */
        }
        .links {
            margin-top: 15px;
        }
        .links a {
            color: #143a51; /* Plava elephant za linkove */
            text-decoration: none;
            transition: color 0.3s;
        }
        .links a:hover {
            color: #668846; /* Zelena dingley za hover na linkove */
            text-decoration: underline;
        }
    </style>
</head>
<body>
<div class="container">
    <h1>Registracija</h1>
    <form method="post" action="registracija.php">
        <input type="text" name="ime" placeholder="Ime" required>
        <input type="text" name="prezime" placeholder="Prezime" required>
        <input type="email" name="email" placeholder="Email" required>
        <input type="text" name="telefon" placeholder="Telefon" required>
        <input type="password" name="lozinka" placeholder="Lozinka" required>
        <input type="text" name="slika" placeholder="URL slike" optional>
        <input type="text" name="linkZaPodatkeNaslovna" placeholder="Link za podatke naslovna" optional>
        <button type="submit">Registruj se</button>
    </form>
    <div class="links">
        <p>Već imate nalog? <a href="prijava.php">Prijavite se ovdje.</a></p>
    </div>
</div>
</body>
</html>
