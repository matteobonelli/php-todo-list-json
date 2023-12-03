<?php
$filecontent = file_get_contents("todo-list.json");

// var_dump($filecontent);

$list = json_decode($filecontent, true);

// if (isset($_POST['newObj'])) {
//     $newObj = $_POST['newObj'];
//     var_dump($newObj);
// }

// var_dump($list);

header('Content-Type: application/json');

echo json_encode($list);


?>