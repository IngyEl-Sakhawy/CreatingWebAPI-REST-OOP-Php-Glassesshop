<?php
require_once "../vendor/autoload.php";

$dataBase = new Db();
$item = $dataBase->connect();
$arrayOfData = array ();

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (isset($_POST["submit"])) {
        foreach($_POST as $key=>$value){
           // echo "$key:$value";
            array_push($arrayOfData,$value);
        }
        $dataBase->get_data($arrayOfData);
    } 
}

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add Page</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
</head>
<body>
    <div class="container" style="background-color: lightgray; margin-top: 80px; padding-top: 30px;">
        <h2 style="text-align: center; margin-bottom: 30px; ">Add new item</h2>
        <form method="POST" class="container">
            <div class="row">
                <div class="col-md-6">
                    <div class="input-group mb-3">
                        <span class="input-group-text">ID</span>
                        <input type="text" class="form-control" name="id">
                    </div>
                    <div class="input-group mb-3">
                        <span class="input-group-text">Code</span>
                        <input type="text" class="form-control" name="PRODUCT_code">
                    </div>
                    <div class="input-group mb-3">
                        <span class="input-group-text">Name</span>
                        <input type="text" class="form-control" name="product_name">
                    </div>
                    <div class="input-group mb-3">
                        <span class="input-group-text">Photo</span>
                        <input type="file" class="form-control" name="Ph0to">
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="input-group mb-3">
                        <span class="input-group-text">Price</span>
                        <input type="text" class="form-control" name="list_price">
                    </div>
                    <div class="input-group mb-3">
                        <span class="input-group-text">Reorder Level</span>
                        <input type="text" class="form-control" name="reorder_level">
                    </div>
                    <div class="input-group mb-3">
                        <span class="input-group-text">Units Available</span>
                        <input type="text" class="form-control" name="Units_In_Stock">
                    </div>
                    <div class="input-group mb-3">
                        <span class="input-group-text">Category</span>
                        <input type="text" class="form-control" name="category">
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-6">
                    <div class="input-group mb-3">
                        <span class="input-group-text">Country</span>
                        <input type="text" class="form-control" name="CouNtry">
                    </div>
                    <div class="input-group mb-3">
                        <span class="input-group-text">Rating</span>
                        <input type="text" class="form-control" name="Rating">
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="input-group mb-3">
                        <span class="input-group-text">Discontinued</span>
                        <input type="text" class="form-control" name="discontinued">
                    </div>
                    <div class="input-group mb-3">
                        <span class="input-group-text">Date</span>
                        <input type="date" class="form-control" name="date">
                    </div>
                </div>
            </div>
            <div style="text-align: center;">
                <button type="submit" class="btn btn-danger col-md-3 " style="margin-bottom: 30px;" name="submit">Submit</button>
            </div>
        </form>
        
        
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
</body>
</html>