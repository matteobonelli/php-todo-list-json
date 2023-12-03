<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css"
        integrity="sha512-z3gLpd7yknf1YoNbCzqRKc4qyor8gaKU1qmn+CShxbuBusANI9QpRohGBreCFkKxLhei6S9CQXFEbbKuqLg0DA=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Playpen+Sans:wght@600&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="css/style.css">
    <title>Vue To Do List</title>
</head>

<body>
    <div id="app">
        <div class="container bg-gradient">
            <header class="my-3">
                <h1 class="text-center display-3 fw-bold">La mia lista di cose da fare</h1>
            </header>
            <main>
                <div v-if="tasks.length === 0" class="success-height text-success">
                    <h2 class="display-3 fw-bold">Complimenti hai finito le tue mansioni!</h2>
                </div>
                <ul class="list-group my-3 list-height d-flex justify-content-center align-items-center" v-else>
                    <li class="list-group-item d-flex justify-content-between w-50"
                        v-for="(task, index) in listFiltered"
                        :class="{'list-group-item-success' : task.done}, {'list-group-item-danger' : !task.done}"
                        :key="task.id">
                        <div @click="taskCrossedOut(task.id) /*task.done = !task.done*/" :style="'cursor : pointer'"
                            :class="{'crossedOut' : task.done}">{{task.text}}</div>
                        <div :style="'cursor : pointer'" class="d-flex align-items-center" @click="removeItem(task.id)">
                            <i class="fa-solid fa-xmark"></i>
                        </div>
                    </li>
                </ul>
                <h3 class="text-center">Aggiungi altre cose da fare</h3>
                <div class="d-flex justify-content-center my-4">
                    <input type="text" class="w-25 mx-4" v-model="inputText" @keyup.enter="newTask">
                    <button class="btn btn-success" @click="newTask">Aggiungi</button>
                </div>
                <div class="selector">
                    <h3>Seleziona i lavori da visualizzare</h3>
                    <div class="d-flex justify-content-center">
                        <select name="compiti" id="compiti" v-model="inputSelect">
                            <option value="">Tutti</option>
                            <option value="yes-done">Lavori fatti</option>
                            <option value="not-done">Lavori da fare</option>
                        </select>
                    </div>

                </div>
            </main>


        </div>

    </div>
    <script src="https://unpkg.com/axios/dist/axios.min.js"></script>
    <script src="https://unpkg.com/vue@3/dist/vue.global.js"></script>
    <script src="js/script.js"></script>
</body>

</html>