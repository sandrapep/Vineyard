<?php
include 'db.php';
session_start();

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $token = $_POST['token'];
    $new_password = password_hash($_POST['new_password'], PASSWORD_DEFAULT);

    $db = new Database();
    $conn = $db->getConnection();

    $query = "UPDATE Korisnici SET lozinka = :new_password, reset_token = NULL WHERE reset_token = :token";
    $stmt = $conn->prepare($query);
    $stmt->bindParam(':new_password', $new_password);
    $stmt->bindParam(':token', $token);
    if ($stmt->execute()) {
        echo "Lozinka je uspješno resetovana. <a href='prijava.php'>Prijavite se</a>";
    } else {
        echo "Greška pri resetovanju lozinke.";
    }
} else if (isset($_GET['token'])) {
    $token = $_GET['token'];
} else {
    echo "Nevažeći token.";
    exit();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Resetovanje lozinke</title>
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
    </style>
</head>
<body>
<div class="container">
    <h1>Resetovanje lozinke</h1>
    <form method="post" action="resetuj_lozinku.php">
        <input type="hidden" name="token" value="<?php echo htmlspecialchars($token); ?>">
        <input type="password" name="new_password" placeholder="Nova lozinka" required>
        <button type="submit">Resetuj lozinku</button>
    </form>
</div>
</body>
</html>
