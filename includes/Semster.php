<?php
require_once(LIB_PATH.DS.'database.php');

class Semster{
	
	public $batch;
	public $sem_id;
	public $course;
    public $id;
	public $table;
	
	
	// protected static $table_name=$id;
	//protected static $db_fields = array('index_no', 'sub_id','grade');
    
    public function create() {
		global $database;
		$sql1="CREATE TABLE $this->id ( index_no int( 8 ) ,sub_id varchar( 50 ) ,grade CHAR( 2 ) , PRIMARY KEY ( index_no, sub_id ))";
        $result1=$database->query($sql1);
		$this->table= $this->batch.$this->course.$this->sem_id;
<<<<<<< HEAD
		//$sql2="INSERT INTO $this->table (index_no) SELECT index_no FROM students WHERE course='$this->course' AND batch='$this->batch' ";
		//$result2=$database->query($sql2);
		if($result1){
=======
		$sql2="INSERT INTO $this->table (index_no) SELECT index_no FROM students WHERE course='$this->course' AND batch='$this->batch' ";
		$result2=$database->query($sql2);
		if($result2 && $result1){
>>>>>>> 6aceb631899f9d7c7ec0936be4adab3034a70f60
			return true;
		}else{
			return false;
		}
        //$sql2="ALTER TABLE '2013CS6' ADD FOREIGN KEY ( 'index_no' ) REFERENCES 'ucsc_sms'.'students' ( 'id') ON DELETE RESTRICT ON UPDATE RESTRICT;";
		//$database->query($sql2);
        //$sql3="ALTER TABLE '$this->id' ADD FOREIGN KEY ( 'sub_id' ) REFERENCES 'ucsc_sms'.'subjects' ('sub_id') ON DELETE RESTRICT ON UPDATE RESTRICT;";
        //$database->query($sql3);
        /*
        if($database->query($sql1) && $database->query($sql2) && $database->query($sql3) ){
	    return true;
	  } else {
	    return false;
	  }
	  */
		
	}
	
	public function insert(){
		$sql="SELECT index_no FROM students WHERE course='$this->course' AND batch='$this->batch'";
		$results_array=self::find_by_sql($sql);
		return !empty($result_array) ? array_shift($result_array) : false;
	}
	
	public static function find_by_id($id=0) {
    $result_array = self::find_by_sql("SELECT * FROM ".self::$table_name." WHERE id={$id} LIMIT 1");
		return !empty($result_array) ? array_shift($result_array) : false;
  }
  
  public static function find_by_sql($sql="") {
    global $database;
    $result_set = $database->query($sql);
    $object_array = array();
    while ($row = $database->fetch_array($result_set)) {
      $object_array[] = self::instantiate($row);
    }
    return $object_array;
  }
  
  private static function instantiate($record) {
		// Could check that $record exists and is an array
    $object = new self;
		// Simple, long-form approach:
		// $object->id 				= $record['id'];
		// $object->username 	= $record['username'];
		// $object->password 	= $record['password'];
		// $object->first_name = $record['first_name'];
		// $object->last_name 	= $record['last_name'];
		
		// More dynamic, short-form approach:
		foreach($record as $attribute=>$value){
		  if($object->has_attribute($attribute)) {
		    $object->$attribute = $value;
		  }
		}
		return $object;
	}
	
	private function has_attribute($attribute) {
	  // We don't care about the value, we just want to know if the key exists
	  // Will return true or false
	  return array_key_exists($attribute, $this->attributes());
	}

	protected function attributes() { 
		// return an array of attribute names and their values
	  $attributes = array();
	  foreach(self::$db_fields as $field) {
	    if(property_exists($this, $field)) {
	      $attributes[$field] = $this->$field;
	    }
	  }
	  return $attributes;
	}
	
	
}

?>