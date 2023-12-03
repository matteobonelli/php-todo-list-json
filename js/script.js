

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
                this.idLast = this.tasks.length;
                console.log(this.idLast)
            })

        },
        removeItem(index) {
            const data = new FormData();
            data.append("index-remove", index);
            axios.post(this.apiUrl, data).then((res) => {
                // console.log(res.data);
                this.todoList = res.data;
            }).finally(() => {
                this.readList();
            })
        },
        newTask() {
            if (this.inputText === '') {
                return
            } else {
                this.idLast++
                const data = new FormData();
                data.append("text", this.inputText);
                data.append("done", false);
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
        taskCrossedOut(index) {
            const data = new FormData();
            data.append("index", index);
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