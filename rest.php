<?php
require_once 'Db.php';
require_once 'vendor/autoload.php';


header('Content-Type: application/json');

switch ($_SERVER['REQUEST_METHOD']) {
    case 'GET':
        echo GetRequest();
        break;
    case 'POST':
        echo addGlaases();
        break;
    case 'PUT':
        echo updateGlass();
        break;
    case 'DELETE':
        echo deleteGlass();
        break;
    default:
        http_response_code(405);
        echo "Method not supported";
        break;
}



function GetRequest()
{   $dbase = new Db();

    $urlParts = explode('/', $_SERVER['REQUEST_URI']);

    $resource = $urlParts[2];

    $glassesid = (isset($urlParts[3]) && is_numeric($urlParts[3])) ? (int) $urlParts[3] : 0;

    if ($resource === 'Allglasses') {
        if ($glassesid == 0) {
            return json_encode($dbase->get_All_Glasses());
        } else {
            return json_encode(["message" => "Invalid API"]);
        }
    } elseif ($resource === 'glasses') {
        if ($glassesid != 0) {
            return json_encode($dbase->get_Single_Glass( $glassesid));
        } else {
            http_response_code(400);
            return json_encode(["error" => "No resource ID provided"]);
        }
    } else {
        http_response_code(404);
        return json_encode(["error" => "Resource not found"]);
    }
}


function addGlaases()
{   $dbase = new Db();
    $urlParts = explode('/', $_SERVER['REQUEST_URI']);

    if (isset($urlParts[2])) {
        $resource = $urlParts[2];


        if ($resource === 'Addglasses') {
            if (empty($_POST)) {
                http_response_code(400);
                return json_encode(["error" => "No data sent"]);
            }

            $file = $_FILES['Photo'];
            $uploadDirectory = "./Resources/images/";
            $targetFile = $uploadDirectory . basename($file['name']);

            $data = $_POST;
            $data['Photo'] = $targetFile;

            return json_encode($dbase->add_Glass( $data));
        }
    }
    http_response_code(404);
    return json_encode(["error" => "Resource not found"]);
}


function deleteGlass()
{   $dbase = new Db();

    $urlParts = explode('/', $_SERVER['REQUEST_URI']);

    $resource = $urlParts[2];

    $glassesid = (isset($urlParts[3]) && is_numeric($urlParts[3])) ? (int) $urlParts[3] : 0;

    if($resource === 'glasses'){
        return json_encode($dbase->delete_Glass($glassesid));
    }

http_response_code(404);
return json_encode(["error" => "Resource not found"]);
}

function updateGlass()
{   $dbase = new Db();

    $urlParts = explode('/', $_SERVER['REQUEST_URI']);

    $resource = $urlParts[2];

    $glassesid = (isset($urlParts[3]) && is_numeric($urlParts[3])) ? (int) $urlParts[3] : 0;

    if($resource === 'glasses'){

    return json_encode($dbase->update_Glasses($glassesid));
}
http_response_code(404);
return json_encode(["error" => "Resource not found"]);
} 
