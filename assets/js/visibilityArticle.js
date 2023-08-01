import { sendRequest } from './senRequestActif';

export default function visibilityArticle() {
    const switchs = document.querySelectorAll('[data-switch-active-article]');

    if (switchs) {
        switchs.forEach((element) => {
            element.addEventListener('change', (e) => {
                let articleId = element.value;
                sendRequest(`/admin/article/switch/${articleId}`, e.target);
            });
        });
    }
}
