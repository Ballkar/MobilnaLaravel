<template>
    <a class="item" @click.prevent="log">logout</a>
</template>

<script>
    export default {
        dat() {
            return {
                form: new Form({
                    name: '',
                    description: ''
                })
            }

        },
        methods: {
            log(){
                console.log(this.form);
            },
            logout() {
                axios.post('/logout', {})
                    .then(function (response) {
                        document.location.href = "/admin";
                    })
                    .catch(function (error) {
                        console.log(error);
                    })
            }
        }
    }
</script>

<style>

</style>
