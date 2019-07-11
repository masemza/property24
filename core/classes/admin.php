<?php 
class Admin{
 	
	private $db;

	public function __construct($database) {
	    $this->db = $database;
	}

	public function insert_admin($id, $email, $password){

		global $db;

		$query 	= $this->db->prepare("INSERT INTO `admin` (`id`, `email`, `password`) VALUES (?, ?, ?) ");

		$query->bindValue(1, $id);
		$query->bindValue(2, $email);
		$query->bindValue(3, $password);	

		try{
			$query->execute();

			//mail($email, 'Welcome to Tello Business', "Hello " . $username. ",\r\nThank you for registering with us. \r\n\r\n-- Tello Business Team");
		}catch(PDOException $e){
			die($e->getMessage());
		}	
	}

	public function update_admin($id, $email, $password){

		$query = $this->db->prepare("UPDATE `admin` SET
								`email`			= ?,
								`password`			= ?
							
								WHERE `id` 		= ? 
								");

		$query->bindValue(1, $id);
		$query->bindValue(2, $email);
		$query->bindValue(3, $password);

		try{
			$query->execute();
		}catch(PDOException $e){
			die($e->getMessage());
		}	
	}

	public function admin_data($id) {

		$query = $this->db->prepare("SELECT * FROM `admin` WHERE `id`= ?");
		$query->bindValue(1, $id);

		try{

			$query->execute();

			return $query->fetchAll();

		} catch(PDOException $e){

			die($e->getMessage());
		}

	}
	  	  	 
	public function get_admin() {

		$query = $this->db->prepare("SELECT * FROM `admin` ORDER BY `email` DESC");
		
		try{
			$query->execute();
		}catch(PDOException $e){
			die($e->getMessage());
		}

		return $query->fetchAll();

	}

	public function admin_exists($email) {
	
		$query = $this->db->prepare("SELECT COUNT(`id`) FROM `admin` WHERE `email`= ?");
		$query->bindValue(1, $email);
	
		try{

			$query->execute();
			$rows = $query->fetchColumn();

			if($rows == 1){
				return true;
			}else{
				return false;
			}

		} catch (PDOException $e){
			die($e->getMessage());
		}

	}
	 
	public function email_exists($email) {

		$query = $this->db->prepare("SELECT COUNT(`id`) FROM `admin` WHERE `email`= ?");
		$query->bindValue(1, $email);
	
		try{

			$query->execute();
			$rows = $query->fetchColumn();

			if($rows == 1){
				return true;
			}else{
				return false;
			}

		} catch (PDOException $e){
			die($e->getMessage());
		}

	}

	public function register($password, $email){

		global $bcrypt; // making the $bcrypt variable global so we can use here

		$password   = $bcrypt->genHash($password);

		$query 	= $this->db->prepare("INSERT INTO `admin` (`password`, `email`) VALUES (?, ?) ");

		$query->bindValue(1, $password);
		$query->bindValue(2, $email);

		try{
			$query->execute();

			//mail($email, 'Welcome to Tello', "Hello " . $username. ",\r\nThank you for registering with us. \r\n\r\n-- Tello Team");
		}catch(PDOException $e){
			die($e->getMessage());
		}	
	}

	public function login($email, $password) {

		global $bcrypt;  // Again make get the bcrypt variable, which is defined in init.php, which is included in login.php where this function is called

		$query = $this->db->prepare("SELECT `password`, `id` FROM `admin` WHERE `email` = ?");
		$query->bindValue(1, $email);

		try{
			
			$query->execute();
			$data 				= $query->fetch();
			$stored_password 	= $data['password']; // stored hashed password
			$id   				= $data['id']; // id of the user to be returned if the password is verified, below.
			
			if($bcrypt->verify($password, $stored_password) === true){ // using the verify method to compare the password with the stored hashed password.
				return $id;	// returning the user's id.
			}else{
				return false;	
			}

		}catch(PDOException $e){
			die($e->getMessage());
		}
	
	}


}