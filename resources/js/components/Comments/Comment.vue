<template>
    <div >
        <comment-item :comment="comment"/>
        <a href="#" v-on:click.prevent="toggleForm"><small>Reply</small></a>
        <div v-if="formShow">
            <form action="" method="post" v-on:submit.prevent="submitHandler">
                <input  type="hidden" name="parent_id" v-bind:value="comment.id" />
                <input class="form-control content" type="text"  v-bind:name="'content-' + comment.id"  v-bind:id="'content-'+comment.id" />
                <button type="submit" class="btn btn-sm btn-dark">Reply</button>
            </form>
        </div>
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
            let post = {
                id: false
            };
            post = Object.assign({}, post, {id: this.comment.commentable_id})
            return {
                data: Object,
                formShow: false,
                post: post
            }
        },
        mounted() {
            Comments.get('comments',this.comment.id, _, (data) => {
               this.data = data;
            });

        },
        methods: {
            toggleForm() {
                this.formShow = !this.formShow;
            },
            submitHandler(e) {
                let content = (e.target.querySelector('input.content').value);
                Comments.save(content, this.post.id, this.comment.id, (data)=>{
                    this.data.comments.unshift(data.comment);
                    this.data.commentsCount = data.commentsCount;
                })
            },
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
