<template>
    <div class="modal" id="editModalWindow" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="alert alert-success alert-edit-task" role="alert">Task updated success</div>
                <div class="alert alert-danger alert-edit-task" role="alert">Error </div>
                <form id="edit_task"  @submit.prevent="editTask" method = "patch" action="tasks/update/">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Update task</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <div class="row">
                            <div class="col-md-9 pr-1">
                                <div class="form-group">
                                    <label>Write task</label>
                                    <textarea name="title" type="text" class="form-control" v-model="task.title"></textarea>
                                    <input class="name" name="id" readOnly type="hidden">
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-9">
                                <div class="form-group">
                                    <label>Status</label>
                                    <select class="form-control" name="status_id" v-model="task.status.id">
                                        <option :value="1">Completed</option>
                                        <option :value="2">Not completed</option>
                                    </select>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                        <button name ="submit" type="submit" class="btn btn-primary">Update task</button>
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
            task: {
                "title": "",
                "status": {"id": 0}
            },
        }
    },
    methods: {
        editTask() {
            
            const formData = { 
                "title": this.task.title,
                "status_id": this.task.status.id
            }
            const url = config.apiUrl+'tasks/update/'+this.task.id;

            axios.patch(url, formData)
                .then( response => {
                const task = response.data.data;
                if(task.title === formData.title) this.$emit('task-updated');
                } )
                .catch(error => {
                console.error('Помилка при додаванні задачі:', error);
                });
        }
    }
}
    

</script>