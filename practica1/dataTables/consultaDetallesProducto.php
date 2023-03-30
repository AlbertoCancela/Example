<?php
    include("../connection.php");
    $idProducto = $_POST['idProducto'];

    $consultarDetallesProducto = "  SELECT descripcion, existencias, u.unidad as unidad
                                    FROM productos p
                                    INNER JOIN unidades u ON u.idunidad =  p.idunidad 
                                    WHERE id = $idProducto ";
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
?>