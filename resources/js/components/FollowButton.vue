<template>
    <div v-if="currentUserId != userId">

        <button
            class="btn btn-primary btn-sm ml-4"
            @click="followUser"
            v-text="buttonText"
        >

        </button>
    </div>
</template>

<script>
    export default {

        props: ['userId','currentUserId', 'follows'],

        mounted() {
            console.log('Component mounted.')
        },

        data()  {
          return {
              status: this.follows
          }
        },

        computed: {
          buttonText()  {
              return (this.status) ? 'Unfollow' : 'Follow'
            }
        },

        methods: {
            followUser() {
                axios.post('/follow/' + this.userId)
                .then(resposne => {
                    this.status = ! this.status;
                })
                .catch(errors => {
                    if (errors.response.status == 401) {
                        window.location = '/login'
                    }
                })
            }
        }
    }
</script>
