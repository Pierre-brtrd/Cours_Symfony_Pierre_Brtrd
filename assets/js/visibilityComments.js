import { sendRequest } from './sendRequestActif';

const switchs = document.querySelectorAll('[data-switch-active-comment]');

if (switchs) {
    switchs.forEach((element) => {
        element.addEventListener('change', (e) => {
            let commentId = element.value;
            sendRequest(`/admin/comments/switch/${commentId}`, e.target);
        });
    });
}