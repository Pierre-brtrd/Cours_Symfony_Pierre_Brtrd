import axios from 'axios';

export default function visibilityArticle() {
    let switchs = document.querySelectorAll('[data-switch-active-article]');

    if (switchs) {
        switchs.forEach((element) => {
            element.addEventListener('change', () => {
                let articleId = element.value;
                axios.get(`/admin/article/switch/${articleId}`);
            });
        });
    }
}
