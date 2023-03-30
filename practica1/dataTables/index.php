<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Prueba con modales</title>
    <link rel="stylesheet" href="../css/main.css">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.3/jquery.min.js"></script>    
    <script src="datatables/js/datatables.min.js"></script>
    <script src="datatables/js/bootstrap.min.js"></script>
    <link href="datatables/css/datatables.min.css" rel="stylesheet"/>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <!--Script para traer todos los datos a los modales y al dataTable  -->
    <script>
        $(document).ready(function() {
            $('#example').DataTable( {
                fixedHeader: true,
                language: {
                    "emptyTable": "No se encontraron registros", // Cuando la tabla no posee registros inicialmente
                    "search": "Buscar:",  // Leyenda del buscador 
                    "info" : "Mostrando _START_ de _END_ las _TOTAL_ entradas", // Parte inferior izquierda de la tabla
                    "infoEmpty": "Ningún registro encontrado", // Leyenda que se muestra 
                    "zeroRecords":      "No se encontraron registros con esa búsqueda.",
                    "infoFiltered":"( De los _MAX_  registros disponibles )",
                    "lengthMenu" : "Mostrando _MENU_ entradas",
                    "paginate": {
                        "first": "Primera",
                        "last": "Última",
                        "next": "Siguiente",
                        "previous": "Anterior"
                    },
                }
            } );
        } );
        $(document).on("click", ".botonDetallesProducto", function( ){
                var idDelProducto = $(this).attr("idProducto");
                $.post("consultaDetallesProducto.php", { idProducto : idDelProducto }, function( detalles ) {
                    $('#cuerpoModalProducto').html( detalles );
                }); 
            });
        $(document).on("click", ".botonActualizarProducto",function( ){
            var idDelProductoAct = $(this).attr("idProductoAct");
            $.post("../queryS.php", { opcionCase:'actualizar', datos:idDelProductoAct }, function( resultado ) {
                $('#cuerpoModalProducto').html( resultado );
            });
        });
    </script>
    <!-- Script para hacer las diferentes funcionalidades CRUD -->
    <script>
        $(document).ready(function(){
        
        })
    </script>
</head>
<body>
    <?php
    include("../connection.php");
    ?>
    <div id="contenedorPrincipal">
        <div class="contenedorBanner cont">
            <div class="logo"><img src="../images/hipocrates.png" alt=""></div>
            <div class="usuarioSesion">
                <?php
                    $nombre = $_GET['nombre'];
                    $selectUsuarioDatos = "SELECT * FROM usuarios WHERE usuario = '$nombre'";
                    $resultado = $conn->query($selectUsuarioDatos);
                    $usuario=$resultado->fetch_assoc();
                ?>
                <label for="" class="labelUsuario">ID</label>
                    <p id="idUsuario" class="pUser"><?php echo $usuario['idUsuario']?></p>
                <label for="" class="labelUsuario">Usuario</label>
                    <p id="userUsuario" class="pUser"><?php echo $usuario['usuario']?></p>
                <label for="" class="labelUsuario">Nombre</label>
                    <p id="nombreUsuario" class="pUser"><?php echo $usuario['nombre']?></p>
            </div>
            <div class="datosVarios">
                <label for="" class="labelFecha">
                    <?php
                        echo "<p>".date("d-m-Y")."</p>";
                    ?>
                </label>
            </div>
            <div class="terminarSesion">
                <button type="submit" class="btn btn-primary">Terminar Sesión</button>
            </div>
        </div>

        <div class="contenedorTabla cont">
            <table id="example" class="display" style="width:100%">
                <thead>
                    <tr>
                        <td>Id</td>
                        <td>Nombre</td>
                        <td>Detalles</td>
                        <td>actualizar</td>
                    </tr>
                </thead>
                <tbody>
                    <?php
                        $consultarProductos = "SELECT id, nombre, existencias FROM PRODUCTOS WHERE existencias > 0 ";
                        $resultadoConsultarProductos = $conn->query( $consultarProductos );
                        while( $productos = $resultadoConsultarProductos->fetch_assoc() ){
                            echo "  <tr>
                            <td>" . $productos['id'] . "</td>
                            <td>" . $productos['nombre'] . "</td>
                            <td><button idProducto='" . $productos['id'] . "' class='btn btn-success botonDetallesProducto glyphicon glyphicon-question-sign' data-toggle='modal' data-target='#modalProducto' id='botonDetallesProducto'></button></td>
                            <td><button idProductoAct='" . $productos['id'] . "' class='btn btn-info botonActualizarProducto glyphicon glyphicon-pencil' data-toggle='modal' data-target='#modalProducto' id='botonActualizarProducto'></button></td>
                                    </tr>";
                        }
                    ?>
                </tbody>
            </table>
            <!-- Modales -->
                <!-- Modal de consultar existencias -->
            <div id="modalProducto" class="modal fade" role="dialog">
                <div class="modal-dialog">
                    <!-- Modal content-->
                    <div class="modal-content">
                        <div class="modal-header">
                            <button type="button" class="close" data-dismiss="modal">&times;</button>
                            <h4 class="modal-title text-center">Detalles del producto</h4>
                        </div>
                        <div class="modal-body" id="cuerpoModalProducto">
                            <p>Some text in the modal.</p>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="contenedorAgregar cont">
            <h4>Agregar nuevo registro</h4>
            <div class="input-group">
                <span class="input-group-addon"><i class="glyphicon glyphicon-modal-window"></i></span>
                <input id="nombreProd" type="text" class="form-control nombreProd" name="nombreProd" placeholder="Nombre del Producto">
            </div>
            <div class="input-group">
                <span class="input-group-addon"><i class="glyphicon glyphicon-equalizer"></i></span>
                <input id="existencias" type="number" class="form-control existencias" name="existencias" placeholder="Existencia del producto">
            </div>
            <div class="input-group">
                <span class="input-group-addon"><i class="glyphicon glyphicon-align-left"></i></span>
                <input id="descripcion" type="text" class="form-control descripcion" name="descripcion" placeholder="Descripción del producto">
            </div>
            <div id="unidadMedidaContent" class="input-group unidadMedidaContent">
                <span class="input-group-addon" id="spanUM"><i class="glyphicon glyphicon-barcode"></i></span>
                <input id="unidadMedida" type="number" class="form-control unidadMedida" name="unidadMedida" placeholder="ID unidad de medida">
            <button id="añadirRegistro"class=" glyphicon glyphicon-plus-sign btn btn-success"> Agregar</button>
            </div>
        </div>
        <div class="contenedorEliminar cont">
            <h4>Eliminar registro</h4>
            <div class="input-group">
                <span class="input-group-addon"><i class="glyphicon glyphicon-asterisk"></i></span>
                <input id="eliminar" type="number" class="form-control descripcion" name="eliminar" placeholder="ID del producto a eliminar">
            </div><br>
            <button id="eliminarRegistro"class=" glyphicon glyphicon-minus-sign btn btn-danger"> Eliminar</button>
        </div>
    </div>
</body>
</html>