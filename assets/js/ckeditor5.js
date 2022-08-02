import BalloonEditior from '@ckeditor/ckeditor5-build-balloon';

BalloonEditior
    .create(
        document.querySelector('#editor'), {
        language: 'fr',
        heading: {
            options: [
                { model: 'paragraph', title: 'Paragraphe', class: 'ck-heading_paragraph' },
                { model: 'heading1', view: 'h1', title: 'Heading 1', class: 'ck-heading_heading1' },
                { model: 'heading2', view: 'h2', title: 'Heading 2', class: 'ck-heading_heading2' },
                { model: 'heading3', view: 'h3', title: 'Heading 3', class: 'ck-heading_heading3' },
                { model: 'heading4', view: 'h4', title: 'Heading 4', class: 'ck-heading_heading4' },
            ]
        }
    }
    )
    .then(editor => {
        let form = document.querySelector('.form-article');
        let input = editor.sourceElement.parentElement.querySelector('input');

        form.addEventListener('submit', (e) => {
            e.preventDefault();
            input.value = editor.getData();
            form.submit();
        })
    });