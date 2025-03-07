<?php
include 'db.php';
session_start();

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $email = trim($_POST['email']);
    $lozinka = $_POST['lozinka'];

    if (filter_var($email, FILTER_VALIDATE_EMAIL) && !empty($lozinka)) {
        $db = new Database();
        $conn = $db->getConnection();

        $query = "SELECT * FROM korisnici WHERE eMail = :email";
        $stmt = $conn->prepare($query);
        $stmt->bindParam(':email', $email);
        $stmt->execute();
        $user = $stmt->fetch(PDO::FETCH_ASSOC);

        if ($user && password_verify($lozinka, $user['lozinka'])) {
            $_SESSION['user_id'] = $user['korisnikID'];
            $_SESSION['user_type'] = $user['tipNaloga'];
            $_SESSION['user_name'] = $user['ime']; // Dodatno ako želite da prikažete ime korisnika

            if ($user['tipNaloga'] == 'admin') {
                header("Location: admin/aindex.php");
            } else {
                header("Location: index.php");
            }
            exit();
        } else {
            $_SESSION['login_error'] = "Neispravan email ili lozinka.";
        }
    } else {
        $_SESSION['login_error'] = "Unesite ispravne podatke.";
    }
    header("Location: prijava.php");
    exit();
}
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Prijava</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #143a51; /* Plava elephant kao pozadinska boja */
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
            color: #143a51; /* Plava elephant za naslov */
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
            border-color: #668846; /* Zelena dingley za fokus na input polja */
        }
        button {
            padding: 10px;
            font-size: 16px;
            color: #fff;
            background-color: #668846; /* Zelena dingley za dugme */
            border: none;
            border-radius: 4px;
            cursor: pointer;
            transition: background-color 0.3s;
        }
        button:hover {
            background-color: #556b35; /* Tamnija zelena za hover efekat na dugme */
        }
        .links {
            margin-top: 15px;
        }
        .links a {
            color: #668846; /* Zelena dingley za linkove */
            text-decoration: none;
            transition: color 0.3s;
        }
        .links a:hover {
            color: #143a51; /* Plava elephant za hover na linkove */
            text-decoration: underline;
        }
        .error-message {
            color: red;
            margin-bottom: 15px;
        }
    </style>
</head>
<body>
<div class="container">
    <h1>Prijava</h1>
    <?php if (isset($_SESSION['login_error'])): ?>
        <div class="error-message"><?php echo htmlspecialchars($_SESSION['login_error']); ?></div>
        <?php unset($_SESSION['login_error']); ?>
    <?php endif; ?>
    <form method="post" action="prijava.php">
        <input type="email" name="email" placeholder="Email" required>
        <input type="password" name="lozinka" placeholder="Lozinka" required>
        <button type="submit">Prijavi se</button>
    </form>
    <div class="links">
        <p>Nemate nalog? <a href="registracija.php">Registrujte se.</a></p>
    </div>
</div>
</body>
</html>
