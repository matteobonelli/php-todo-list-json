<?php
$filecontent = file_get_contents("todo-list.json");

// var_dump($filecontent);

$list = json_decode($filecontent, true);

//var_dump($list);

if (isset($_POST['text']) && isset($_POST['done'])) {
    $isFalse = true;
    if ($_POST['done'] === 'false') {
        $isFalse = false;
    }
    $newObj = (object) [
        'text' => $_POST['text'],
        'done' => $isFalse,
    ];
    array_push($list, $newObj);
    file_put_contents('todo-list.json', json_encode($list));
}

if (isset($_POST['index'])) {
    $index = $_POST['index'];
    $list[$index]['done'] = !$list[$index]['done'];
    file_put_contents('todo-list.json', json_encode($list));
}

if (isset($_POST['index-remove'])) {
    $index = $_POST['index-remove'];
    array_splice($list, $index, 1);
    file_put_contents('todo-list.json', json_encode($list));
}

// var_dump($list);

header('Content-Type: application/json');

echo json_encode($list);


?>