<template>
    <div class = "container col-10">
        <div class="container-fluid">
           <div class = "d-flex justify-content-between">
                <div>
                    <button type="button" class="btn btn-outline-primary" data-bs-toggle="modal" data-bs-target="#exampleModal">
                        Add Task
                    </button>
                </div>
               <div class="d-flex">
                   <h4 class="lh-base">Filter</h4>
                   <SelectStatusTasks @select-status="handleFilterTasksList"/>
               </div>
            </div>
        </div>
        <div class = "row" id="tasks">
            <TaskList
              :tasks= 'tasks'
              ref="taskList"
              @open-edit-form="handleOpenEditForm"
              @task-deleted="handleTaskDeleted"
              />
              <Pagination :links="links" @click-pgt-button="handleRefreshTaskList"/>
        </div>
    </div>
  <CreateTaskForm @task-added="handleTaskAdded"/>
  <EditTaskForm ref="editForm" @task-updated="handleTaskUpdated"/>
</template>


<script>
import CreateTaskForm from "./components/CreateTaskForm.vue";
import EditTaskForm from "./components/EditTaskForm.vue";
import TaskList from "./components/TaskList.vue";
import axios from "axios";
import config from "./config/config";
import Pagination from "./components/Pagination.vue";
import SelectStatusTasks from "./components/SelectStatusTasks.vue";

export default {
  components: {
    SelectStatusTasks,
    CreateTaskForm,
    EditTaskForm,
    TaskList,
    Pagination
},
  data() {
    return {
      tasks: [],
      links: [],
      currentUrl: String,
        params: Object,
    }
  },
  methods: {
    handleTaskAdded() {
      this.fetchTasks(this.currentUrl, this.params);
    },
    handleTaskDeleted() {
      this.fetchTasks(this.currentUrl, this.params);
    },
    handleOpenEditForm(task) {
      this.$refs.editForm.task = task;
    },
    handleTaskUpdated(){
      this.fetchTasks(this.currentUrl,this.params);
    },
    handleRefreshTaskList(url) {
      this.fetchTasks(url, this.params)
      this.currentUrl = url;
    },
    handleFilterTasksList(statusId) {
        const url = config.apiUrl+'tasks/5'
        let params = {};

        if(statusId > 0) {
            this.params = {'filter': statusId};
        }else {
            this.params = {};
        }

        this.fetchTasks(url, this.params);

    },
    fetchTasks(url, params ={}) {
      axios.get(url, {params})
        .then(response => {
          this.tasks = response.data.data;
          this.links = response.data.meta.links;
        })
        .catch(error => {
          console.error('Помилка отримання даних:', error);
        });
    },
  },
  mounted() {
    const url = config.apiUrl+'tasks/5';
    this.fetchTasks(url);
  }
};
</script>

<style>

</style>
