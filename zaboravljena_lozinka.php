<?php
include 'db.php';
session_start();

$message = '';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $email = $_POST['email'];

    $db = new Database();
    $conn = $db->getConnection();

    $query = "SELECT * FROM korisnici WHERE eMail = :email";
    $stmt = $conn->prepare($query);
    $stmt->bindParam(':email', $email);
    $stmt->execute();
    $user = $stmt->fetch(PDO::FETCH_ASSOC);

    if ($user) {
        $token = bin2hex(random_bytes(50));
        $query = "UPDATE korisnici SET reset_token = :token WHERE eMail = :email";
        $stmt = $conn->prepare($query);
        $stmt->bindParam(':token', $token);
        $stmt->bindParam(':email', $email);
        $stmt->execute();

        $resetLink = "http://localhost/vineyard-app/resetuj_lozinku.php?token=$token";
        // Ovdje biste poslali email korisniku sa reset linkom
        $message = "Kliknite ovde za resetovanje lozinke: <a href='$resetLink'>Kliknite ovde</a>";
    } else {
        $message = "Nema korisnika sa tim emailom.";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Zaboravljena lozinka</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f4;
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
            color: #333;
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
        }
        button {
            padding: 10px;
            font-size: 16px;
            color: #fff;
            background-color: #333;
            border: none;
            border-radius: 4px;
            cursor: pointer;
        }
        button:hover {
            background-color: #555;
        }
        .message {
            margin-top: 15px;
            color: #333;
        }
        .message a {
            color: #007BFF;
            text-decoration: none;
        }
        .message a:hover {
            text-decoration: underline;
        }
    </style>
</head>
<body>
<div class="container">
    <h1>Zaboravljena lozinka</h1>
    <form method="post" action="zaboravljena_lozinka.php">
        <input type="email" name="email" placeholder="Email" required>
        <button type="submit">Pošalji link za resetovanje lozinke</button>
    </form>
    <?php if ($message): ?>
        <div class="message">
            <?php echo $message; ?>
        </div>
    <?php endif; ?>
</div>
</body>
</html>
