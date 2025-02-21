<?php
include("connect.php");
$dbname = "myDB";

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


// The amounts of products to show on each page
$num_products_on_each_page = 4;
// The current page - in the URL, will appear as index.php?page=products&p=1, index.php?page=products&p=2, etc...
$current_page = isset($_GET['p']) && is_numeric($_GET['p']) ? (int)$_GET['p'] : 1;
// Select products ordered by the date added
$stmt = $pdo->prepare('SELECT * FROM items ORDER BY price DESC LIMIT ?,?');
// bindValue will allow us to use an integer in the SQL statement, which we need to use for the LIMIT clause
$stmt->bindValue(1, ($current_page - 1) * $num_products_on_each_page, PDO::PARAM_INT);
$stmt->bindValue(2, $num_products_on_each_page, PDO::PARAM_INT);
$stmt->execute();
// Fetch the products from the database and return the result as an Array
$items = $stmt->fetchAll(PDO::FETCH_ASSOC);


$total_products = $pdo->query('SELECT * FROM items')->rowCount();
?>


//Products template 

function template_header("Products") {
echo <<<EOT
<!DOCTYPE html>
<html>
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





<div class="products content-wrapper">
    <h1>Products on Sale</h1>
    <p><?=$total_products?> Products on Sale</p>
    <div class="products-wrapper">
        <?php foreach ($items as $product): ?>
        <a href="index.php?page=product&id=<?=$product['id']?>" class="product">
            <img src="imgs/<?=$product['img']?>" width="200" height="200" alt="<?=$product['name']?>">
            <span class="name"><?=$product['name']?></span>
            <span class="price">

            </span>
        </a>
        <?php endforeach; ?>
    </div>
    <div class="buttons">
        <?php if ($current_page > 1): ?>
        <a href="index.php?page=products&p=<?=$current_page-1?>">Prev</a>
        <?php endif; ?>
        <?php if ($total_products > ($current_page * $num_products_on_each_page) - $num_products_on_each_page + count($items)): ?>
        <a href="index.php?page=products&p=<?=$current_page+1?>">Next</a>
        <?php endif; ?>
    </div>
</div>

