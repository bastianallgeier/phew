<template>
  <li class="todo-item">
    <label><input type="checkbox" v-model="todo.done"> {{ todo.text }}</label>
  </li>
</template>

<script>
export default {
  props: {
    todo: String
  }
};
</script>

<style>
.todo-item label {
  display: flex;
  align-items: center;
}
.todo-item input {
  margin-right: .5rem;
}
</style>
