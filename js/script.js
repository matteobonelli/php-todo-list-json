

const { createApp } = Vue;

createApp({
    data() {
        return {
            tasks: [],
            apiUrl: 'server.php',
            idLast: 4,
            inputText: '',
            inputSelect: ''
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
                const newObj = {
                    text: this.inputText,
                    done: false,
                    id: this.idLast
                }
                this.tasks.unshift(newObj);
                this.inputText = ''
            }

        },
        taskCrossedOut(id) {
            const index = this.indexFinder(id)
            this.tasks[index].done = !this.tasks[index].done
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