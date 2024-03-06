<?php
require "../vendor/autoload.php";

$data = new Db();
$item = $data->connect();

if(isset($_GET['product_id'])) {
    $product_id = $_GET['product_id'];
    //echo "Product ID: " . $product_id . "<br>"; // Debugging information
    
    $item = $data->get_record_details((int) $product_id);
    
} 


?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Details Page</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">

    <style>
        
        .item-image {
            width: 400px; 
            height: auto; 
        }
    </style>
</head>
<body>
    <div class="container" style="background-color: lightgrey; padding-top: 30px;">
        <div class="card" style="width: 18rem; margin-left: 500px;">
            <?php echo "<img src='../images/" . $item->Photo . "' alt='Item Photo' class='item-image'>"; ?>
            <div class="card-body">
            <h2 class="card-text"><?php echo $item->product_name; ?></h2>
            <h2 class="card-text"><?php echo $item->list_price; ?></h2>
            </div>
        </div >
    </div  >
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
    </body>
</html>

