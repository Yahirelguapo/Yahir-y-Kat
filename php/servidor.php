<?php
    include "conexion.php";
    //recibimos la accion a realizar
    //enviado dede el formulario
    $accion=$_GET["accion"];
    //evaluamos la accion 
    switch($accion){
        case 'agregarUsuario':
            //recibimos los datos enviados por el formulario
            $clave=$_GET["Clave"];
            $nombre=$_GET["Nombre"];
            $edad=$_GET["Edad"];
            //se especifica el sql a realizar
            $sql="insert into datos values (0, '$Clave','$Nombre','$Edad')";
            //ejecutar la setencia
            $ejecutaSQL=$conexion->query($sql);
            //comprobamos si la ejecucion fue correcta
            if($ejecutaSQL){
                echo "1";
            }
            else
            {
                echo "0";
            }
            break;
        
        case 'eliminarUsuario':
                //recibimos los datos enviados por el formulario
                $id=$_GET["id"];
                //se especifica el sql a realizar
                $sql="delete from datos where id='$id'";
                //ejecutar la setencia
                $ejecutaSQL=$conexion->query($sql);
                //comprobamos si la ejecucion fue correcta
                if($ejecutaSQL){
                    echo "1";
                }
                else
                {
                    echo "0";
                }
                break;
        case 'editarUsuario':
                    //recibimos los datos enviados por el formulario
                    $clave=$_GET["Clave"];
                    $nombre=$_GET["Nombre"];
                    $edad=$_GET["Edad"];
                    //se especifica el sql a realizar
                    $sql="update datos set nombre='$Nombre', Edad='$Edad' where Clave='$Clave'";
                    //ejecutar la setencia
                    $ejecutaSQL=$conexion->query($sql);
                    //comprobamos si la ejecucion fue correcta
                    if($ejecutaSQL){
                        echo "1";
                    }
                    else
                    {
                        echo "0";
                    }
                    break;
    }

?>