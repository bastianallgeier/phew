<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Phew</title>

  <link rel="stylesheet" href="./components/TodoItem.vue.css">
  <script src="https://cdn.jsdelivr.net/npm/vue"></script>

</head>
<body>

  <div id="app">
    <ol>
      <todo-item
        v-for="(todo, index) in todos"
        :todo="todo"
        :key="index"
      ></todo-item>
    </ol>

    <form @submit.prevent="add">
      <input type="text" v-model="todo" placeholder="New todo …">
    </form>
  </div>

  <script type="module">
  import TodoItem from "./components/TodoItem.vue";

  Vue.component("todo-item", TodoItem);

  var app = new Vue({
    el: '#app',
    data() {
      return {
        todos: [
          { text: 'Learn JavaScript' },
          { text: 'Learn Vue' },
          { text: 'Build something awesome' }
        ],
        todo: null
      };
    },
    methods: {
      add() {
        this.todos.push({ text: this.todo });
        this.todo = null;
      }
    }
  });
  </script>

</body>
</html>
