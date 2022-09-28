<template>
    <div>
        <button class="btn btn-primary btn-block" @click="fallowUser" v-text="buttonText"></button>
    </div>
</template>

<script>
    export default {

        props: ['userId', 'follows'],

        mounted() {
            console.log('Component mounted.')
        },

        data: function () {
            return {
                status: this.follows,
            }
        },

        methods: {
            fallowUser() {
                axios.post('/follow/' + this.userId)
                    .then(response => {
                        this.status = ! this.status;
                        console.log(response.data);
                     })
                    .catch(errors => {
                        if (errors.response.status == 401) {
                            window.location = '/login';
                        }
                    });
            }
        },

        computed: {
            buttonText() {
                return (this.status) ? 'Remove from my favorites' : 'Add to my favorites';
            }
        }
    }
</script>
