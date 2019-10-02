<template>
    <ckeditor :editor="editor" :value="text" :config="editorConfig" name="text" @input="log($event)"></ckeditor>
</template>

<script>
    import ClassicEditor from '@ckeditor/ckeditor5-build-classic';

    export default {
        props: ['text'],
        data() {
            return {
                editor: ClassicEditor,
                editorConfig: {
                    // plugins: [ Alignment,],
                    // toolbar: [ 'alignment',]
                }
            }
        },
        methods: {
            log(a) {
                console.log(a)
            }
        }
    }
</script>

<style>
.ck-editor__editable {
    min-height: 350px;
}
</style>
