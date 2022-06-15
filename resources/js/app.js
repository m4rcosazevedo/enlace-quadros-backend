require('./bootstrap');

import Editor from '@toast-ui/editor'
import '@toast-ui/editor/dist/toastui-editor.css';

const el = document.querySelector('#editor')
if (el) {
    const editor = new Editor({
        el,
        height: '400px',
        initialEditType: 'markdown'
    })

    const content = document.querySelector('#oldContent')
    if (content) {
        editor.setMarkdown(content.value);
    }

    const form = document.querySelector('#create-edit-form')
    if (form) {
        form.addEventListener('submit', e => {
            e.preventDefault();
            document.querySelector('#content').value = editor.getMarkdown();
            e.target.submit();
        });
    }
}
