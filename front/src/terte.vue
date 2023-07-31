<section class="vh-100 w-100">
  <div class="container py-5 h-100">
    <div class="row d-flex justify-content-center align-items-center h-100">
      <div class="col">
        <div class="card" id="list1" style="border-radius: .75rem; background-color: #eff1f2;">
          <div class="card-body py-4 px-4 px-md-5">

            <p class="h1 text-center mt-3 mb-4 pb-3 text-primary">
              <i class="fas fa-check-square me-1"></i>
              <u>My Task-s</u>
            </p>
            
            <task-form />

            <select v-model="tasksPerPage" class="form-control mt-2">
              <option v-for="option in options" :key="option" :value="option">{{ option }}</option>
            </select>

            <hr class="my-4">
            <task-list :tasks="tasks" class="mt-3" />

          </div>
        </div>
      </div>
    </div>
  </div>
</section>