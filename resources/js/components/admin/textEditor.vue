<template>
    <ckeditor :editor="editor" v-model="editorData" :config="editorConfig"></ckeditor>
</template>

<script>
    import ClassicEditor from '@ckeditor/ckeditor5-build-classic';

    export default {
        data() {
            return {
                editor: ClassicEditor,
                editorData: '<p> test </p>',
                editorConfig: {
                    // plugins: [ Alignment,],
                    // toolbar: [ 'alignment',]
                }
            }
        },
    }
</script>

<style>
.ck-editor__editable {
    min-height: 350px;
}
</style>
