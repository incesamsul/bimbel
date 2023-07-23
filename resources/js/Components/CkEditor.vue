<template>
    <div>
        <textarea ref="editor"></textarea>
    </div>
</template>

<script>
//   import ClassicEditor from '@ckeditor/ckeditor5-build-classic';

export default {
    props: ['content'],

    mounted() {
        ClassicEditor.create(this.$refs.editor, {
            // your CKEditor configuration
            toolbar: {
                items: [
                    'undo', 'redo',
                    '|', 'heading',
                    '|', 'fontfamily', 'fontsize', 'fontColor', 'fontBackgroundColor',
                    '|', 'bold', 'italic', 'strikethrough', 'subscript', 'superscript', 'code',
                    '|', 'link', 'uploadImage', 'blockQuote', 'codeBlock',
                    '|', 'bulletedList', 'numberedList', 'todoList', 'outdent', 'indent'
                ],
            },
        })
            .then(editor => {
                editor.setData(this.content); // set the initial data from the prop
                editor.model.document.on('change:data', () => {
                    const newData = editor.getData();
                    this.$emit('update:content', newData); // emit the new data to the parent component
                });
            })
            .catch(error => {
                console.error(error);
            });
    }
};
</script>
