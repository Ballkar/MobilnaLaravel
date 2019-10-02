<template>
    <form action="/admin/blog/post" method="POST" id="addPostForm">
        <!-- @csrf -->
        <div class="inputContainer">
            <div class="error" v-if="form.errors.has('title')" v-text="form.errors.get('title')"></div>
            <label for="title" >Tytuł</label>
            <input id="title" type="text" name="title" placeholder="Tytuł bloga" v-model="form.title">
        </div>
        <div class="inputContainer">
            <div class="error" v-if="form.errors.has('category_id')" v-text="form.errors.get('category_id')"></div>
            <label for="category_id">Kategoria</label>
            <select id="category_id" type="text" name="category_id" v-model="form.category_id">
                <option :value="category.id" v-for="category in categories" :key="category.name">{{category.name}}</option>
            </select>
        </div>

        <div class="inputContainer">
            <div class="error" v-if="form.errors.has('text')" v-text="form.errors.get('text')"></div>
            <label for="text">Treść</label>
            <text-editor :text="text" @input="form.text=$event.target.value"></text-editor>
        </div>
        <input type="submit" value="dodaj" class="submit" @click.prevent="onSubmit()">
    </form>

</template>

<script>
    import textEditor from './textEditor'

    export default {
        props: [
            'title',
            'text',
            'categories',
            'selectedCategory',
        ],
        data() {
            return {
                form: new Form({
                    title: this.title,
                    category_id: this.selectedCategory,
                    text: this.text
                }),
            }
        },
        methods: {
            log() {
                console.log(this.form)
            },
            onSubmit() {
            this.form.post('/admin/blog/post')
                .then(response => window.location.href = '/admin/blog/post/'+response.id);
            }
        },
        components: {
            textEditor,

        }
    }
</script>

<style>
.ck-editor__editable {
    min-height: 350px;
}
</style>
