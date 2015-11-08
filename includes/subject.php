<?php
require_once(LIB_PATH.DS.'database.php');

class Subject{
    protected static $table_name="subjects";
	protected static $db_fields = array('sub_id','sub_name', 'year', 'sem_id','staff_id','credits');
    
    public $sub_id;
	public $sub_name; 
	public $year;
	public $sem_id;
    public $course;
	public $staff_id;
	public $credits;
    
    
    public function create() {
		global $database;

	    $sql = "INSERT INTO ".self::$table_name." (";
		$sql .= "sub_id, sub_name, year, sem_id, course, credits";
	    $sql .= ") VALUES ('";
		$sql .= $database->escape_value($this->sub_id)."', '";
		$sql .= $database->escape_value($this->sub_name)."', '";
		$sql .= $database->escape_value($this->year)."', '";
		$sql .= $database->escape_value($this->sem_id)."', '";
		$sql .= $database->escape_value($this->course)."', '";
		$sql .= $database->escape_value($this->credits)."')";
	$result1=$database->query($sql);
	
	
	if($result1){
	    return true;
	  } else {
	    return false;
	  }
	  
	}
	
	
	public static function find_all(){
		global $database;
	    $sql = "SELECT * FROM subjects";
		$arr=self::find_by_sql($sql);
		return $arr;
	}
	public static function find_by_course($course){
		global $database;
	    $sql = "SELECT * FROM subjects WHERE course='{$course}'";
		$arr=self::find_by_sql($sql);
		return $arr;
	}
	
	public static function find_sub_by_lec($staff_id){
		global $database;
	    $sql = "SELECT * FROM lecturer_subject WHERE staff_id='{$staff_id}' ";
		$arr=self::find_by_sql($sql);
		return $arr;
	}
	
	public static function find_lec_by_sub($sub_id){
		global $database;
	    $sql = "SELECT staff_id FROM lecturer_subject WHERE sub_id='{$sub_id}'";
		$arr=self::find_by_sql($sql);
		return $arr;
	}
  
  public static function find_by_id($sub_id=0) {
    $result_array = self::find_by_sql("SELECT * FROM ".self::$table_name." WHERE sub_id='{$sub_id}' LIMIT 1");
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
  public function allocate_lec(){
	global $database;

	    $sql = "INSERT INTO lecturer_subject (";
		$sql .= "sub_id, staff_id ";
	    $sql .= ") VALUES ('";
		$sql .= $database->escape_value($this->sub_id)."', '";
		$sql .= $database->escape_value($this->staff_id)."')";
	$result1=$database->query($sql);
	
	
	if($result1){
	    return true;
	  } else {
	    return false;
	  }
  }
  public static function unallocate_lec($staff_id,$sub_id){
	global $database;
	 $sql = "DELETE FROM lecturer_subject";
	  $sql .= " WHERE sub_id='{$sub_id}' AND staff_id='{$staff_id}'";
	  $sql .= " LIMIT 1";
	  $database->query($sql);
	  return ($database->affected_rows() == 1) ? true : false;
  }
  
  private static function instantiate($record) {
		// Could check that $record exists and is an array
    $object = new self;
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
	
	
	public function update() {
	  global $database;

		$sql = "UPDATE ".self::$table_name." SET ";
		$sql .="sub_name='{$this->sub_name}', ";
		$sql .="year='{$this->year}', ";
		$sql .="sem_id='{$this->sem_id}', ";
		$sql .="course='{$this->course}', ";
		$sql .="credits='{$this->credits}' ";
		$sql .= " WHERE sub_id='{$this->sub_id}'";
		
	  $database->query($sql);
	  
	  return ($database->affected_rows() == 1) ? true : false;
	}
	
	
	
	public static function del_subject($s_id){
	 global $database;

	  $sql = "DELETE FROM ".self::$table_name;
	  $sql .= " WHERE sub_id='{$s_id}'";
	  $sql .= " LIMIT 1";
	  $database->query($sql);
	  return ($database->affected_rows() == 1) ? true : false;
  }
	
}

?>