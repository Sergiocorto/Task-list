<template>
    <select class="form-select" required aria-label="select example" v-on:change="selectStatus($event)">
        <option value="0">All</option>
        <option value="1">Completed</option>
        <option value="2">Not completed</option>
    </select>
</template>

<script>
export default {
    name: 'SelectStatusTasks',
    methods: {
        selectStatus(event) {
            const selectedValue = event.target.value;
            this.$emit("select-status", selectedValue);
        },
    },
};
</script>
