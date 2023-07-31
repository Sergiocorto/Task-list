<template>
    <div class="card w-100">
        <div class="card-body">
            <form name="taskForm">
                <div class="taskCard taskTitle">
                    <p class="title" id="title" onformdata="title">{{ task.title }}</p>
                    <input class="name" name="id" readOnly type="hidden" value="{{ task.id }}">
                    <input class="name" name="status_id" readOnly type="hidden" value="{{ task.status.id }}">
                    <span class="badge bg-secondary badge-light" id="status">{{ task.status.name }}</span>
                </div>
                <div class="btn-group btn-card taskCard">
                    <button type="button" class="btn btn-info"  @click="openTaskForm(task)" data-bs-toggle="modal" data-bs-target="#editModalWindow">
                        Edit
                    </button>
                    <button type="button" class="btn btn-danger" @click="deleteTask(task.id)">
                        Delete
                    </button>
                </div>
            </form>
        </div>
    </div>
</template>

<script>
import axios from "axios";
import config from "../config/config";

export default {
  props: {
    task: Object,
  },
  methods: {
    deleteTask(taskId) {
      const url = config.apiUrl+"tasks/delete/"+taskId;
        axios.delete(url)
        .then(response => {
          const id = response.data;
          if(taskId == id) this.$emit('task-deleted')
      })
      .catch(error => {
        console.error('Помилка отримання даних:', error);
      });
    },

    openTaskForm(task) {
      const newTask = JSON.parse(JSON.stringify(task));
      this.$emit('open-edit-form', newTask)
    }
  }
};
</script>