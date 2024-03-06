<?php
require_once "../vendor/autoload.php";

$dataBase = new Db();
$item = $dataBase->connect();

$current_page = (isset($_GET["page"]) && is_numeric($_GET["page"]) ) ? $_GET["page"] :1;
$current_skip = ($current_page - 1) *__RECORDS_PER_PAGE__;
$next = "glasses_table.php?page=".$current_page+1;
$prev = $current_page-1>1 ? "glasses_table.php?page=".$current_page-1 : "glasses_table.php?page=1";

$item = $dataBase->passThroughItems($current_skip);

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (isset($_POST["submit"])) {
        if ($_POST["product_name"]) {
            $product_name = $_POST["product_name"];
            $item = $dataBase->get_record_name($product_name);
            
        }
    } 
}

if(isset($_GET['product_id'])) {
    $product_id = $_GET['product_id'];
    //echo "Product ID: " . $product_id . "<br>"; // Debugging information
    //var_dump((int) $product_id);
    $dataBase->delete_item((int) $product_id);
    
} 

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Glasses Page</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <style>
        .navbar {
            padding: 15px 0;
            background-color: #f8f9fa;
            border-bottom: 1px solid #dee2e6;
        }

        .navbar button {
            margin-right: 10px;
        }
        .table-wrapper {
            font-family: Arial, sans-serif;
            border-radius: 10px;
            overflow: hidden; 
        }

        .table {
            width: 100%;
            border-collapse: collapse;
        }

        .table td, .table th {
            padding: 8px;
            text-align: left;
            border-bottom: 1px solid #ddd;
        }

        .table tr:hover {
            background-color: #f2f2f2;
        }

    </style>
</head>

<body>
    <div class="container" style="background-color:lightgray; padding-top: 30px; margin-top: 100px;">
        <div style=" margin-left:800px;  margin-bottom:20px;  ">
            <form class=" input-group" method="POST">
                <input class="" style="border-color:lightgray;" type="text" placeholder="Search" name="product_name">
                <button herf="" type="submit" class="btn btn-outline-secondary" name="submit">Search</button>
            </form>
        </div>


        <div class="table-wrapper">
            <table class="table table-light table-hover">
                <tr>
                    <td>ID</td>
                    <td>Name</td>
                    <td>Details</td>
                    <td></td>
                </tr>
                <?php foreach ($item as $itemd): ?>
                    <tr>
                        <td><?php echo $itemd->id; ?></td>
                        <td><?php echo $itemd->product_name; ?></td>
                        <td>
                            <a href='details.php?product_id=<?php echo $itemd->id; ?>' class='link'>More Details</a>
                        </td>
                        <td>
                        <a href='glasses_table.php?product_id=<?php echo $itemd->id; ?>' class='link'>Delete</a>
                        </td>
                    </tr>
                <?php endforeach; ?>
            </table>
        </div>

        <div>
            <a href="<?php echo $prev; ?>" > < Previous</a> | <a href="<?php echo $next; ?>"> Next ></a>
            
        </div>


        <a href='additem.php' type="button" class="btn col-lg-4 " style="margin-top: 20px; background-color: rgb(116, 116, 116); margin-bottom: 20px;" >ADD</a>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
</body>

</html>