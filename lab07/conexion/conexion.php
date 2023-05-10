<?php
function conectar(){
    $conn = mysqli_connect('localhost', 'root', 'usbw', 'lab06');
    return $conn;
}

function desconectar($conn){
    mysqli_close($conn);
}