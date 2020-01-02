<template>
    <div >
        <div class="pb-3">

            <form action="#" method="post" v-on:submit.prevent="submitHandler">
                <input type="hidden" name="parent_id" value=""/>

                <div class="form-group row">
                    <div class="col">
                        <label for="content" class="col-md-4 col-form-label ">Comment</label>

                        <textarea id="content"
                                  type="text"
                                  class="form-control"
                                  name="content"
                                  value=""
                                  autocomplete="off" autofocus>
                                </textarea>

                        <span class="invalid-feedback" role="alert">
                                        <strong></strong>
                                    </span>
                    </div>
                </div>
                <button type="submit" class="btn btn-primary">Send</button>
            </form>
        </div>

        <div>Comments:</div>
        <div v-if="data.comments">
            <div v-for="comment in data.comments">

                <comment :comment="comment"/>
            </div>
            <div v-if="data.comments.length < data.commentsCount">
                <a href="#" v-on:click.prevent="loadMore" class="btn btn-sm btn-dark">Load more comments</a>
            </div>
        </div>

    </div>
</template>

<script>
    import Comment from "./Comments/Comment";
    import Comments from "../helpers/comments";

    export default {
        name: "Comments",
        components: {Comment},
        props: ['postId'],
        data() {
            return {
                data: Object
            }
        },
        mounted() {
            console.log(document.querySelector('meta[name=csrf-token]').getAttribute('content'));
            Comments.get('posts', this.postId, _,(data) => {
                this.data = data;
            });
        },
        methods: {
            submitHandler(e) {
                let content = (e.target.querySelector('textarea#content').value);
                Comments.save(content, this.postId, _, (data)=>{
                    this.data.comments.unshift(data.comment);
                    this.data.commentsCount = data.commentsCount;
                })
            },
            loadMore() {

                Comments.get('posts', this.postId, this.data.comments.length,(data) => {
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
