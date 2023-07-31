<template>
  <div class="container body">
    <TaskItem
      v-for = "task in tasks"
      :task = "task"
      :key = 'task.id'
      @task-deleted="handleTaskDeleted"
      @open-edit-form="handleOpenEditForm"
      />
  </div>

</template>

<script>
import TaskItem from "./TaskItem.vue";

export default {
  props: {
    tasks: {
      type: Array,
      require: true
    },
  },
  components: {
    TaskItem,
  },
  methods: {
    handleOpenEditForm(task) {
      this.$emit('open-edit-form', task)
    },
    handleTaskDeleted() {
      this.$emit('task-deleted')
    }
  },
};
</script>

<style>
</style>