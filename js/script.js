

const { createApp } = Vue;

createApp({
    data() {
        return {
            tasks: [],
            apiUrl: 'server.php',
            idLast: 0,
            inputText: '',
            inputSelect: '',
            crossedIndex: '',
        }
    },
    methods: {
        readList() {
            axios.get(this.apiUrl).then((res) => {
                // console.log(res.data);
                this.tasks = res.data;
                console.log(this.tasks);
            }).catch((error) => {
                console.log(error)
            }).finally(() => {

            })
            this.idLast = this.tasks.length;
        },

        indexFinder(id) {
            return this.tasks.findIndex((task) => task.id === id)

        },
        removeItem(id) {
            const index = this.indexFinder(id)
            this.tasks.splice(index, 1);
        },
        newTask() {
            if (this.inputText === '') {
                return
            } else {
                this.idLast++
                const data = new FormData();
                data.append("text", this.inputText);
                data.append("done", false);
                data.append("id", this.idLast);
                axios.post(this.apiUrl, data).then((res) => {
                    console.log(res);
                    this.todoList = res.data;
                }).catch((error) => {
                    console.log(error);
                }).finally(() => {
                    this.readList();
                })

                this.inputText = ''
            }

        },
        taskCrossedOut(id) {
            const index = this.indexFinder(id)
            const data = new FormData();
            data.append("index", index);
            console.log(index);
            axios.post(this.apiUrl, data).then((res) => {
                // console.log(res.data);
                this.todoList = res.data;
            }).finally(() => {
                this.readList();
            })

        },

    },
    computed: {
        listFiltered() {
            return this.tasks.filter((task) => {
                if (this.inputSelect === 'yes-done' && task.done) {
                    return task
                } else if (this.inputSelect === 'not-done' && !task.done) {
                    return task
                } else if (this.inputSelect === '') {
                    return task
                }
            })
        }
    },
    mounted() {
        this.readList();
    }
}).mount('#app')