import { sendRequest } from './senRequestActif';

const switchs = document.querySelectorAll('[data-switch-active-comment]');

if (switchs) {
    switchs.forEach((element) => {
        element.addEventListener('change', (e) => {
            let commentId = element.value;
            sendRequest(`/admin/comments/switch/${commentId}`, e.target);
        });
    });
}