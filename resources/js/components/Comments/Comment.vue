<template>
    <div>
        <comment-item :comment="comment"/>
        <div v-if="replies" class="pl-5">
            <div v-for="comment in replies">
                <comment-item :comment="comment"/>
            </div>

            <div v-if="replies.length < repliesCount">
                <a href="#" v-on:click.prevent="loadMore" class="btn btn-sm btn-dark">Load more comments</a>
            </div>
        </div>
    </div>
</template>

<script>
    import CommentItem from "./CommentItem";
    export default {
        components: {CommentItem},
        props: ['comment'],
        name: "Comment",
        data() {
            return {
                replies: [],
                repliesCount: '',
                offset: 0,
            }
        },
        mounted() {
            axios
                .get('/api/comments/' + this.comment.id + '/comments')
                .then(response => {
                    this.replies = response.data.comments;
                    this.repliesCount = response.data.count;
                })
        },
        methods: {
            loadMore() {

                axios
                    .get('/api/comments/' + this.comment.id + '/comments', {
                        params: {
                            offset: this.replies.length
                        }
                    })
                    .then(response => {
                        this.replies = [...this.replies, ...response.data.comments];
                        this.repliesCount = response.data.count;
                        this.offset= this.replies.length
                    })
            }
        }
    }
</script>

<style scoped>

</style>
