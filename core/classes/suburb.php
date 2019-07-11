<?php 
class Suburb
{
 	
	private $db;

	public function __construct($database) 
	{
	    $this->db = $database;
	}	
	
	public function add_suburb()
	{
		$query 	= $this->db->prepare("INSERT INTO `suburb` (`suburb_id`, `city_name`, `suburb_name`) VALUES (?, ?, ?) ");
		
		$query->bindValue(1, $suburb_id);
		$query->bindValue(2, $city_name);
		$query->bindValue(3, $suburb_name);

		try
		{
			$query->execute();
		}
		catch(PDOException $e)
		{
			die($e->getMessage());
		}
	}

	
}

?>