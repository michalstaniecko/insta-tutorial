<template>
    <div class="border">
        <div>Vue Component</div>
        <div class="pb-3">

            <form action="#" method="post" v-on:submit.prevent="submitHandler">
                <input type="hidden" name="parent_id" value=""/>

                <div class="form-group row">
                    <div class="col">
                        <label for="content" class="col-md-4 col-form-label ">Comment</label>

                        <textarea id="content"
                                  type="text"
                                  class="form-control @error('content') is-invalid @enderror"
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
        <div>
            <div v-for="comment in comments">

                <comment :comment="comment"/>
            </div>
            <div v-if="comments.length < commentsCount">
                <a href="#" v-on:click.prevent="loadMore" class="btn btn-sm btn-dark">Load more comments</a>
            </div>
        </div>

    </div>
</template>

<script>
    import Comment from "./Comments/Comment";

    export default {
        name: "Comments",
        components: {Comment},
        props: ['postId'],
        data() {
            return {
                comments: '',
                commentsCount: '',
                offset: 0,
            }
        },
        mounted() {

            axios
                .get('/api/posts/' + this.postId + '/comments')
                .then((response) => {
                    this.comments = (response.data.comments);
                    this.commentsCount = response.data.count;
                    this.offset= this.comments.length;
                })
                .catch(error => {
                    console.log(error);
                })
        },
        methods: {
            submitHandler() {
                console.log('submitHandler');
            },
            loadMore() {
                axios
                    .get('/api/posts/' + this.postId + '/comments', {
                        params: {
                            offset: this.comments.length
                        }
                    })
                    .then((response) => {
                        this.comments = [...this.comments, ...response.data.comments];
                        this.commentsCount = response.data.count;
                        this.offset= this.comments.length
                    })
                    .catch(error => {
                        console.log(error);
                    })
            }
        }
    }
</script>

<style scoped>

</style>
