<?php
session_start();
if (!isset($_SESSION['user_id'])) {
    header("Location: prijava.php");
    exit();
}

$user_type = $_SESSION['user_type'];
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Upravljanje vinogradom</title>
    <style>
        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            background-color: #ebe3dd;
            margin: 0;
            padding: 0;
        }
        header {
            background-color: #143A51;
            padding: 15px 0;
            box-shadow: 0 4px 2px -2px gray;
        }
        header nav ul {
            list-style: none;
            display: flex;
            justify-content: center;
            margin: 0;
            padding: 0;
        }
        header nav ul li {
            margin: 0 20px;
        }
        header nav ul li a {
            color: #fff;
            text-decoration: none;
            font-size: 18px;
            font-weight: 600;
        }
        header nav ul li a:hover {
            color: #FFFFFF;
        }
        .hero {
            background-image: url('https://keyassets.timeincuk.net/inspirewp/live/wp-content/uploads/sites/34/2023/11/GettyImages-1425544469-credit-Alexander-Spatari-Moment-via-Getty-Images-920x609.jpg');
            background-size: cover;
            background-position: center;
            height: 400px;
            display: flex;
            align-items: center;
            justify-content: center;
            color: #FFFFFF;
            text-align: center;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
        }
        .hero h1 {
            font-size: 48px;
            margin: 0;
            text-shadow: 2px 2px 4px rgba(0, 0, 0, 0.5);
        }
        .content {
            max-width: 1200px;
            margin: 40px auto;
            padding: 20px;
            display: flex;
            justify-content: space-around;
            flex-wrap: wrap;
        }
        .card {
            background-color: #668846;
            border-radius: 8px;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
            overflow: hidden;
            margin: 20px;
            flex: 1;
            min-width: 250px;
            max-width: 300px;
            text-align: center;
            padding: 20px;
        }
        .card img {
            width: 100%;
            height: 200px;
            object-fit: cover;
            border-radius: 8px;
        }
        .card h3 {
            font-size: 24px;
            margin: 15px 0;
            color: #FFFFFF;
            
        }
        .card p {
            font-size: 16px;
            color: #FFFFFF;
            padding: 0 15px;
            margin-bottom: 20px;
        }
        .card a {
            display: block;
            padding: 15px;
            background-color: #FFFFFF;
            color: #FFFFFF;
            text-decoration: none;
            font-weight: 600;
            border-top: 1px solid #ddd;
            border-radius: 4px;
            margin-top: 15px;
        }
        .card a:hover {
            background-color: #FFFFFF;
            color: #FFFFFF;
        }
    </style>
</head>
<body>
<header>
    <nav>
        <ul>
            <li><a href="fenoloskefaze/ffindex.php">Fenološke faze</a></li>
            <li><a href="tretmani/tindex.php">Tretmani</a></li>
            <li><a href="sorte/sindex.php">Sorte</a></li>
            <li><a href="parcele/pindex.php">Parcele</a></li>
            <li><a href="prinosi/prindex.php">Prinosi</a></li>
            <li><a href="registarfenofaza/regindex.php">Registar feno faza</a></li>
            <li><a href="odjava.php">Odjava</a></li>
        </ul>
    </nav>
</header>

<div class="hero">
    <h1>Upravljanje vinogradom</h1>
</div>

<div class="content">
    <div class="card">
        <h3>Fenološke faze</h3>
        <p>Fenološke faze vinove loze obuhvataju ključne trenutke u njenom godišnjem ciklusu rasta, od buđenja pupoljaka do sazrijevanja grožđa.</p>
    </div>
    <div class="card">
        <h3>Tretmani</h3>
        <p>Tretmani vinove loze uključuju sve neophodne radnje za održavanje zdravlja i plodnosti, kao što su prskanje, orezivanje i zaštita.</p>
    </div>
    <div class="card">
        <h3>Sorte</h3>
        <p>Sorte vinove loze su različite vrste grožđa koje se uzgajaju za proizvodnju vina, soka, grožđica i drugih proizvoda.</p>
    </div>
    <div class="card">
        <h3>Parcele</h3>
        <p>Parcele vinograda su pojedinačne površine zemljišta na kojima se uzgajaju specifične sorte vinove loze.</p>
    </div>
    <div class="card">
        <h3>Prinosi</h3>
        <p>Prinosi predstavljaju količinu grožđa dobijenu sa određenih parcela tokom berbe, ključni faktor za proizvodnju vina.</p>
    </div>
</div>
</body>
</html>
