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

// Check to make sure the id parameter is specified in the URL
if (isset($_GET['id'])) {
    // Prepare statement and execute, prevents SQL injection
    $stmt = $pdo->prepare('SELECT * FROM items WHERE id = ?');
    $stmt->execute([$_GET['id']]);
    // Fetch the product from the database and return the result as an Array
    $product = $stmt->fetch(PDO::FETCH_ASSOC);
    // Check if the product exists (array is not empty)
    if (!$product) {
        // Simple error to display if the id for the product doesn't exists (array is empty)
        exit('Product does not exist!');
    }
} else {
    // Simple error to display if the id wasn't specified
    exit('Product does not exist!');
}
?>


function template_header("Product") {
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


<div class="product content-wrapper">
    <img src="imgs/<?=$product['image']?>" width="500" height="500" alt="<?=$product['name']?>">
    <div>
        <h1 class="name"><?=$product['name']?></h1>
        <span class="price">
            &dollar;<?=$product['price']?>

        </span>
        <form action="index.php?page=cart" method="post">
            <input type="number" name="quantity" value="1" min="1" max="<?=$product['quantity']?>" placeholder="Quantity" required>
            <input type="hidden" name="product_id" value="<?=$product['id']?>">
            <input type="submit" value="Add To Cart">
        </form>

    </div>
</div>