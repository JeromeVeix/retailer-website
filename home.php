<?php
// Selecting the 'most popular' products from the database
mysqli_report(MYSQLI_REPORT_ERROR | MYSQLI_REPORT_STRICT);
include("connect.php");
$dbname = "myDB";

$conn = mysqli_connect($servername, $username, $password, $dbname);

function pdo_connect_mysql() {
    $DATABASE_HOST = 'localhost';
    $DATABASE_USER = 'root';
    $DATABASE_PASS = '';
    $DATABASE_NAME = 'myDB';
try {
    	return new PDO('mysql:host=' . $DATABASE_HOST . ';dbname=' . $DATABASE_NAME . ';charset=utf8', $DATABASE_USER, $DATABASE_PASS);
    } catch (PDOException $exception) {
    	// If there is an error with the connection, stop the script and display the error.
    	exit('Connection failed');
    }
}

$pdo = pdo_connect_mysql();
$stmt = $pdo->prepare('SELECT * FROM items ORDER BY popularity DESC LIMIT 3');
$stmt->execute();
$most_popular_products = $stmt->fetchAll(PDO::FETCH_ASSOC);

?>


//Making a Home page
function template_header($title) {
echo <<<EOT
<!DOCTYPE html>
<html>
<title> Jerome Veix's Personal Homepage </title>
<head>
<link rel="stylesheet" type="text/css" href="style1.css">
</head>

<body>

<marquee align="middle "behavior="scroll" scrolldelay="2" scrollamount="1" >*** INTERNATIONAL SHIPPING NOW AVAILABLE! ***</marqurr><br></marquee>


<header>
	<div class="content-wrapper">
          <h1>Jerome's Streetwear Clothing</h1>
<nav>
<table style="width:100%">
<h1><font color: #OOOOOO><b>
<tr>
<th><a href="index.php">Home</a></th>
<th><a href="index.php?page=products">Products for Sale</a></th>
<th><a href="index.php?page=products/collections">Spring 2023 Collection</a></th>
<div class="link-icons">
    <th><a href="index.php?page=cart">Cart</a></th>
        <i class="fas fa-shopping-cart"></i>
    </a>
</div>
</th>
</tr>
</table>
</nav>

</div>
</header>
EOT;
}

<div class="featured">
    <h2>Everyday clothing that pops out!</h2>
</div>
<div class="mostpopular content-wrapper"> 
    <h2>Most Popular Products</h2>
    <div class="products">
        <?php foreach ($most_popular_products as $product): ?>
        <a href="index.php?page=product&id=<?=$product['id']?>" class="product">

<img src="imgs/<?=$product['image']?>" width="200" height="200" alt="<?=$product['name']?>">

            <span class="name"><?=$product['name']?></span>
            <span class="price">
                &dollar;<?=$product['price']?>
            </span>
        </a>
        <?php endforeach; ?>
    </div>
</div>