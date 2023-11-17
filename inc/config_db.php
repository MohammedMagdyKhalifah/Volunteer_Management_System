<?php
$conn = mysqli_connect('localhost','root','','ex_project');
if(!$conn){
    echo "Error".mysqli_connect_error();
}
?>