<template>
    <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div id="successAlert" class="alert alert-success alert-add-task" role="alert">Task added success </div>
            <div id="errorAlert" class="alert alert-danger alert-add-task" role="alert">Error</div>
            <form id="add_task" @submit.prevent="addTask" method = "POST" action="/api/tasks">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Add task</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="row">
                        <div class="col-md-9 pr-1">
                            <div class="form-group">
                                <label>Write task</label>
                                <textarea v-model="taskTitle" name="title" type="text" class="form-control"></textarea>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                  <button type="button" class="btn btn-secondary" data-bs-dismiss="modal" @click="clearTaskTitle">Cancel</button>
                  <button type="submit" id="subBtn" class="btn btn-primary" :disabled="isTaskTitleEmpty">Add task</button>
                </div>
            </form>
        </div>
    </div>
</div>
</template>

<script>
import axios from 'axios';
import config from '../config/config';

export default {
  data() {
    return {
      taskTitle: "",
      newTask: "",
    };
  },
  computed: {
    isTaskTitleEmpty() {
      return this.taskTitle.trim() === "";
    }
  },
  methods: {
    clearTaskTitle() {
      this.taskTitle = "";
    },
    addTask() {
      const formData = { "title": this.taskTitle }
      
      const url = config.apiUrl+'tasks';

      axios.post(url, formData)
        .then( response => {
          const task = response.data.data;
          if(task.title === formData.title) this.$emit('task-added');
        } )
        .catch(error => {
          console.error('Помилка при додаванні задачі:', error);
        });
    }
  },
};
</script>

<style>
</style>