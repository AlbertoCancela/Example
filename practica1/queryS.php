<?php
include('connection.php');
$opcionCase=$_POST['opcionCase'];
$datos=$_POST['datos'];


switch($opcionCase){
    case "agregar":
        $resultado = explode(":",$datos);
        $resultado[1]=(int)$resultado[1];
        $resultado[3]=(int)$resultado[3];
        $variableINSERTAR = "INSERT INTO productos(nombre,existencias,descripcion,idunidad) VALUES ('$resultado[0]', $resultado[1],'$resultado[2]',$resultado[3])";
        $resultadoQuery = $conn->query($variableINSERTAR);
        echo $resultadoQuery;
    break;
    case "eliminar":
        $variableELIMINAR = "DELETE FROM productos WHERE id=$datos";
        $resultadoQuery = $conn->query($variableELIMINAR);
        echo $resultadoQuery;
    break;
    case "actualizar":
        $consultarDetallesProducto = "  SELECT descripcion, existencias, u.unidad as unidad
                                    FROM productos p
                                    INNER JOIN unidades u ON u.idunidad =  p.idunidad 
                                    WHERE id = $datos";
        $resultadoConsultarDetallesProducto = $conn->query( $consultarDetallesProducto );
        $detalle = $resultadoConsultarDetallesProducto->fetch_assoc();

        $descripcion = $detalle['descripcion'];
        $existencias = $detalle['existencias'];
        $tipoUnidad = $detalle['unidad'];
        echo "  <table class='table table-striped'>
                    <thead>
                        <th>Descripcion</th>
                        <th>Existencias</th>
                        <th>Unidad</th>
                    </thead>
                    <tbody>            
                        <tr>
                            <td>$descripcion</td>
                            <td>$existencias</td>
                            <td>$tipoUnidad</td>
                        </tr>
                    </tbody>
                </table>";
    break;
}
?>