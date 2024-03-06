<?php


use Illuminate\Database\Capsule\Manager as Capsule;

class Db implements DbHandler {

    protected $capsule;
    protected $current_page ;
    protected $current_skip ;

    public function __construct() {
        $this->capsule = new Capsule;
        $this->current_page = (isset($_GET["page"]) && is_numeric($_GET["page"]) ) ? $_GET["page"] :1;
    }

    public function connect() {
        
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

            $items = $this->capsule->table("items")->select()->take(__RECORDS_PER_PAGE__)->get();
            error_log("Connection to the database successful.");

            
            return $items;
        }catch (\PDOException $ex){
            error_log("PDO Exception: " . $ex->getMessage());
            echo "An error occurred while connecting to the database.";
            return null;
        }catch (\Exception $ex) {
            error_log("Error!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!:" . $ex->getMessage());
            return null;
        }
        
    }


    public function get_data($fields = array()){
        $start = 0;
        $this->capsule->table("items")->insert(
            ['id' => $fields[$start],'PRODUCT_code' => $fields[$start+1],'product_name' => $fields[$start+2],'Photo' => $fields[$start+3] ,'list_price' => $fields[$start+4] ,
            'reorder_level' => $fields[$start+5] ,'Units_In_Stock' => $fields[$start+6] ,'category' => $fields[$start+7] , 'CouNtry' => $fields[$start+8] , 
            'Rating' => $fields[$start+10] , 'discontinued' => $fields[$start+11] ,'date' => $fields[$start+12] ]
        );
        
        echo "Added to DataBase successfuly.";

    }

    public function delete_item($product_id_) {
        $this->capsule->table("items")->where('id', $product_id_)->delete();

        echo "Item got deleted from database.";
    }
    public function disconnect() {
        $this->capsule->getConnection()->disconnect();
    }
    
    
    public function get_record_name($product_name) {
        $item = $this->capsule->table("items")->where("product_name", "like", "%{$product_name}%")->get();
        return $item;
    }
    

    public function passThroughItems($current_skip) {
            $items = $this->capsule->table("items")->select()->skip($current_skip)->take(__RECORDS_PER_PAGE__)->get ();
            return $items;
        }
    
    
    public function get_record_details( $product_id) {
        $item_details = $this->capsule->table("items")->where("id", $product_id)->first();
        return $item_details; 
    }
}
