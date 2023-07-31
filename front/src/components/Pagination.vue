<template>
    <nav>
        <ul class="pagination justify-content-center">
            <PaginationItem v-for="link in links" :link="link" @click-pgt-button="handleClickPgtButton"/>
        </ul>
    </nav>
</template>

<script>
import PaginationItem from './PaginationItem.vue';

export default{
    props: {
        links: {
        type: Array,
        required: true,
        },
    },
    components: { PaginationItem },
    methods: {
        handleClickPgtButton(url) {
            this.$emit("click-pgt-button", url)
        }
    }
}

</script>
