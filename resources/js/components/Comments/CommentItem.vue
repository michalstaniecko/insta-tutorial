<template>
    <div>

        <div>
            <strong>{{ comment.username }}</strong> {{ comment.content }}

        </div>
        <div>
            <small>{{ comment.created_at }}</small>
        </div>
    </div>
</template>

<script>
    export default {
        props: ['comment'],
        name: "CommentItem"
    }
</script>

<style scoped>

</style>
