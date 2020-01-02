<template>
    <div v-if="data.comments">
        <comment-item :comment="comment"/>
        <div v-if="data.comments" class="pl-5">
            <div v-for="comment in data.comments">
                <comment-item :comment="comment"/>
            </div>

            <div v-if="data.comments.length < data.commentsCount">
                <a href="#" v-on:click.prevent="loadMore" class="btn btn-sm btn-dark">Load more comments</a>
            </div>
        </div>
    </div>
</template>

<script>
    import CommentItem from "./CommentItem";
    import Comments from "../../helpers/comments";
    export default {
        components: {CommentItem},
        props: ['comment'],
        name: "Comment",
        data() {
            return {
                data: Object
            }
        },
        mounted() {
            Comments.get('comments',this.comment.id, _, (data) => {
               this.data = data;
            });

        },
        methods: {
            loadMore() {

                Comments.get('comments',this.comment.id, this.data.comments.length, (data) => {
                    this.data = {
                        comments: [...this.data.comments, ...data.comments],
                        commentsCount: data.commentsCount
                    }
                });
            }
        }
    }
</script>

<style scoped>

</style>
