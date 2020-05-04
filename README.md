# Phew

Enjoy Vue Single File Components without build process! (Proof of concept)

## What is this?

I love Vue SFC, but I hate build processes with a passion. With a little help of mod_rewrite and a single PHP file, we use Vue single file components without Webpack, parcel or whatever. Just a good old CMD+R worflow in the browser <3

## Installation

Make sure the rewrite rules in the htaccess file are working correctly and point to the `.phew.php` file

## Usage

```html
<!-- Load the stylesheet from your SFC by appending .css -->
<link rel="stylesheet" href="./components/TodoItem.vue.css">

<!-- Load Vue.js -->
<script src="https://cdn.jsdelivr.net/npm/vue"></script>

<!-- Create your app -->
<div id="app">
  <ol>
    <todo-item
      v-for="(todo, index) in todos"
      :todo="todo"
      :key="index"
      >
    </todo-item>
  </ol>

  <form @submit.prevent="add">
    <input type="text" v-model="todo" placeholder="New todo …">
  </form>
</div>

<!-- Write your app code. Make sure to use type="module"!! -->
<script type="module">

// Import your components like you normally would
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
```

## Disclaimer

This is a very rough proof of concept. It works great so far, but will most likely have lots of unexpected bugs. It's not meant to use for production apps. Use it as a playground to experiment with Vue.js
