<?php
class Db{

	protected static $db = [];
	protected static $res = [];

	public function __construct()
	{
		try
		{
			$pdo = new PDO('mysql:host=127.0.0.1;dbname=ex','root',$pass);

		}catch(PDOException $e)
			{
				print $e->getMessage();
			}
		
			$sql = "SELECT * FROM `products`";

			$stmt = $pdo->query($sql);

			if($stmt === false)
			{
			  echo "Ошибка выборки!";
			  exit();
			}

			self::$db = $stmt->fetchAll();

	}




	static function getData(){
		return self::$db;
	}
}


