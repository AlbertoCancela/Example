<!DOCTYPE html>
<html>
<head>
<title>Inicio de sesión</title>
<link rel="stylesheet" href="css/login.css">
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.3/jquery.min.js"></script>
    <script>
        $(document).ready(function( ){
                $('#btnIniciarSesion').click(function( ){
                    event.preventDefault();
                    if($('#username').val().length<1){
                        alert("El nombre de usuario es requerido");
                    }
                    else{
                            if($("#password").val().length<1){
                                alert("la contraseña es requerida");
                            }
                            else{
                                var nombreUsuario = $('#username').val();
                                var passUsuario = $('#password').val();
                                $.post("validacionDeSesion.php",{usuario:nombreUsuario,pass:passUsuario}, function(resultado){
                                    if(resultado==1){
                                        location.href="dataTables/index.php?nombre="+nombreUsuario;
                                        // location.href="https://www.google.com?nombre=hola";
                                    }
                                    else{
                                        $.post("validacionError.php",{usuario:nombreUsuario}, function(resultado){
                                        if(resultado==1){
                                                $("#advertencia").html("<br>contraseña incorrecta")
                                            // $.post("validacionDeSesion.php",{usuario:nombreUsuario,pass:passUsuario}, function(resultado){
                                            //     if(resultado==1){
                                            //     }
                                            //     else{}
                                            //})
                                        }
                                        else{
                                            $("#advertencia").html("<br>usuario incorrecto")
                                            }
                                        })
                                    }
                                })
                            }
                        }
                })                    
            })
    </script>
</head>
<body>
    <div class="login-container">
        <h1>Inicio de sesión</h1>
        <form action="">
        <label for="username">Nombre de usuario:</label>
        <input type="text" id="username" name="username">
        <label for="password">Contraseña:</label>
        <input type="password" id="password" name="password">
        <button type="submit" id="btnIniciarSesion">Ingresar</button>
        <span id="advertencia"></span>
        </form>
    </div>
</body>
</html>
