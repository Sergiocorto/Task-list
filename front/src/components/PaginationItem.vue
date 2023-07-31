<template>
     <li class="page-item">
        <button :class="{ 'page-link': true, 'active': link.active }" 
            v-html="link.label"
            v-on:click="refreshTaskList(link.url)"
            :disabled="link.url === null"
        ></button>
    </li>
</template>

<script>
    export default{
        props: {
            link: {
                type: Object,
                required: true,
            }
        },
        methods: {
            refreshTaskList(url) {
                this.$emit("click-pgt-button", url)
            }
        }
    }

</script>