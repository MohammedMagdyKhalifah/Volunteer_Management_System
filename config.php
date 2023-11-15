<?php

$conn = mysqli_connect('localhost','root','','ex-project');
if(!$conn){
    echo "Error".mysqli_connect_error();
}
?>