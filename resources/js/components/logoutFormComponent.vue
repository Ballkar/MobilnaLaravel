<template>
    <a class="item" @click.prevent="logout">logout</a>
</template>

<script>
    export default {
        data() {
            return {}
        },
        methods: {
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
