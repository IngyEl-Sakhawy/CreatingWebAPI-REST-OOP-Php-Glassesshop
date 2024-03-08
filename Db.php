<?php

require_once "vendor/autoload.php";

use Illuminate\Database\Capsule\Manager as Capsule;


class Db  {

    protected $capsule;


    public function __construct() {
        $this->capsule = new Capsule;
        try {
            $this->capsule->addConnection([
                "driver" => "mysql",
                "host" =>__HOST__,
                "database" => __DATABASE__,
                "username" => __USER__,
                "password" => __PASSWORD__
            ]);
            $this->capsule->setAsGlobal();
            $this->capsule->bootEloquent();

        }catch (\PDOException $ex){
            error_log("PDO Exception: " . $ex->getMessage());
            echo "An error occurred while connecting to the database.";
            return null;
        }catch (\Exception $ex) {
            error_log("Error!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!:" . $ex->getMessage());
            return null;
        }
    }

    public function get_All_Glasses()
    {
        return $this->capsule->table("items")->select()->get();
    }
    
    public function get_Single_Glass( $id)
    {
        $item = $this->capsule->table("items")->select()->where("id", $id)->first();
    
        if (empty($item)) {
            return ["error" => "No item found"];
        }
    
        return $item;
    }

    public function add_Glass($data){
        $item=$this->capsule->table("items")->insert($data);

        return $item;
    }

    public function delete_Glass($glassesid){
        if ($glassesid == 0) {
            http_response_code(400);
            return ["error" => "Not a vaid id"];
        }
    
        $deleted = $this->capsule->table("items")->where("id", $glassesid)->delete();
        if (!$deleted) {
            http_response_code(404);
            return ["error" => "Item not found with ID: $glassesid"];
        } 
    }

    public function update_Glasses($glassesid){
        
        if ($glassesid == 0) {
            http_response_code(400);
            return ["error" => "No resource ID provided"];
        }
    
        $rawData = file_get_contents("php://input");
    
        $data = json_decode($rawData, true);
    
        if (empty($data)) {
            http_response_code(400);
            return ["error" => "Invalid data sent"];
        }
    
        $existingItem = $this->capsule->table("items")->find($glassesid);
        if (!$existingItem) {
            http_response_code(404);
            return ["error" => "Item not found with ID: $glassesid"];
        }
    
        $this->capsule->table("items")->where("id", $glassesid)->update($data);
    
        return $data;
    }
    }

    

