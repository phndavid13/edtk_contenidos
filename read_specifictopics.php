<?php 
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=latin1_swedish_ci");

//include database and object files
include_once 'config/database.php';
include_once 'objects/specifictopic.php';

//instatiante database and area object
$database = new Database();
$db = $database->getConnection();

//initialize object
$specifictopic = new SpecificTopic($db);
$general_id = $_GET["general_id"];
//query areas
$stmt = $specifictopic -> readAll($general_id);
$num = $stmt -> rowCount();

// check if more than 0 record found
if($num>0){
      
    $data="";
    $x=1;
  
    // retrieve our table contents
    // fetch() is faster than fetchAll()
    // http://stackoverflow.com/questions/2770630/pdofetchall-vs-pdofetch-in-a-loop
    while ($row = $stmt->fetch(PDO::FETCH_ASSOC)){
        // extract row
        // this will make $row['name'] to
        // just $name only
        extract($row);
          
        $data .= '{';
            $data .= '"id":"'  . $idTemasEsp . '",';
            $data .= '"name":"' . $nombreTemasEsp . '",';
            $data .= '"url":"' . $url . '"';
        $data .= '}'; 
          
        $data .= $x<$num ? ',' : ''; $x++; } 
} 
 
// json format output 
echo '{"specifictopics":[' . $data . ']}';

?>