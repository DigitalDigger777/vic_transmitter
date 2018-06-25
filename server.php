<?php
header('Content-Type: application/json');
$dsn = "mysql:dbname=victory;host=127.0.0.1";
$user = "root";
$password = "";

try{
	$conn = new PDO($dsn, $user, $password, [PDO::MYSQL_ATTR_INIT_COMMAND => 'SET NAMES \'UTF8\'']);

	$statement = $conn->prepare("select t2.id,t2.post_title, t2.post_content, t2.post_date  
		        	from ua_term_relationships t1
		        	join ua_posts t2 on t1.object_id=t2.id 
		        	where term_taxonomy_id=:categoryId  order by id desc limit 1, 1");
	$statement->execute([':categoryId' => 34]);
	
	if ($item = $statement->fetch(PDO::FETCH_ASSOC)) {
	
		echo json_encode($item);

	} else {
		throw new PDOException("empty result", 1000);
	}

} catch(PDOException $e){
	
	echo json_encode([
		'error' => [
			'code' => $e->getCode(),
			'message' => $e->getMessage()
		]
	]);
}
