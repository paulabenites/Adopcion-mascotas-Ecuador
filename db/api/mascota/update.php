<?php
// required headers
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");
header("Access-Control-Allow-Methods: POST");
header("Access-Control-Max-Age: 3600");
header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");
  
// include database and object files
include_once '../config/database.php';
include_once '../objects/mascota.php';
  
// get database connection
$database = new Database();
$db = $database->getConnection();
  
// prepare pet object
$mascota = new Mascota($db);
  
// get id of pet to be edited
$data = json_decode(file_get_contents("php://input"));
  
// set ID property of pet to be edited
$mascota->id = $data->id;
  
// set pet property values
$mascota->nombre = $data->nombre;
$mascota->raza = $data->raza;
$mascota->contacto = $data->contacto;
$mascota->sexo = $data->sexo;
$mascota->especie = $data->especie;
$mascota->foto = $data->foto;
  
// update the pet
if($mascota->update()){
  
    // set response code - 200 ok
    http_response_code(200);
  
    // tell the user
    echo json_encode(array("mensaje" => "La mascota fue actualizada."));
}
  
// if unable to update the pet, tell the user
else{
  
    // set response code - 503 service unavailable
    http_response_code(503);
  
    // tell the user
    echo json_encode(array("mensaje" => "No se puede actualizar la mascota."));
}
?>