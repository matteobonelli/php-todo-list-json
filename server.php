<?php
$filecontent = file_get_contents("todo-list.json");

// var_dump($filecontent);

$list = json_decode($filecontent, true);

if (isset($_POST['text']) && isset($_POST['done']) && isset($_POST['id'])) {
    $isFalse = true;
    if ($_POST['done'] === 'false') {
        $isFalse = false;
    }
    $newObj = (object) [
        'text' => $_POST['text'],
        'done' => $isFalse,
        'id' => intval($_POST['id']),
    ];
    array_push($list, $newObj);
    file_put_contents('todo-list.json', json_encode($list));
}

// var_dump($list);

header('Content-Type: application/json');

echo json_encode($list);


?>