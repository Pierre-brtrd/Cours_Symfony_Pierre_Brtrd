import { sendRequest } from './sendRequestActif';

const switchs = document.querySelectorAll('[data-switch-active-tag]');

if (switchs) {
    switchs.forEach((element) => {
        element.addEventListener('change', (e) => {
            let tagId = element.value;
            sendRequest(`/admin/categorie/switch/${tagId}`, e.target);
        });
    });
}