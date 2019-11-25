<?php
use \Psr\Http\Message\ServerRequestInterface as Request;
use \Psr\Http\Message\ResponseInterface as Response;

$app = new \Slim\App;
//obtener todos los productos
$app->get('/api/productos',function(Request $request, Response $response){
    $consulta = 'SELECT * FROM productos';
    try {
        //instanciar base de datos
        $db = new db();
        //conexion
        $db = $db->conectar();
        $ejecutar = $db->query($consulta);
        $productos = $ejecutar->fetchALL(PDO::FETCH_OBJ);
        $db = null;
        //exportar y mostrar en gson
        echo json_encode($productos);
    }
    catch (PDOExceptio $e){
        echo '{"error":{"text":'.$e.getMessage().'}';
    }

});

$app->get('/api/productos/{id}',function(Request $request, Response $response){
    $id = $request->getAttribute('id');
    $consulta = "SELECT * FROM productos WHERE id ='$id'";
    try {
        //instanciar base de datos
        $db = new db();
        //conexion
        $db = $db->conectar();
        $ejecutar = $db->query($consulta);
        $producto = $ejecutar->fetchALL(PDO::FETCH_OBJ);
        $db = null;
        //exportar y mostrar en gson
        echo json_encode($producto);
    }
    catch (PDOExceptio $e){
        echo '{"error":{"text":'.$e.getMessage().'}';
    }

});

$app->0('/api/productos/agregar',function(Request $request, Response $response){
    $nombre = $request->getParam('nombre');
    $cantidad = $request->getParam('cantidad');
    $precio = $request->getParam('precio');
    $descripcion = $request->getParam('descripcion');
    $foto = $request->getParam('foto');
    $consulta = "INSERT INTO productos (nombre,cantidad,precio,descripcion,foto) values
    (:nombre, :cantidad, :precio, :descripcion, :foto)";
    try {
        //instanciar base de datos
        $db = new db();
        //conexion
        $db = $db->conectar();
        $stmt = $db->prepare($consulta);
        $stmt->bindParam(':nombre',$nombre);
        $stmt->bindParam(':cantidad',$cantidad);
        $stmt->bindParam(':precio',$precio);
        $stmt->bindParam(':descripcion',$descripcion);
        $stmt->bindParam(':foto',$foto);
        $stmt->execute();
        echo '{"notice":{"text":"producto agregado"}';

    }
    catch (PDOExceptio $e){
        echo '{"error":{"text":'.$e.getMessage().'}';
    }

});
?>