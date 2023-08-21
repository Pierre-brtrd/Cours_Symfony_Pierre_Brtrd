export async function sendRequest(url, input) {
    const response = await fetch(url);

    if (response.status >= 200 && response.status < 300) {
        const data = await response.json();
        const textActif = input.closest('.blog-card-content').querySelector('.blog-card-actif');

        if (data.enable) {
            textActif.classList.remove('text-danger');
            textActif.classList.add('text-success');
            textActif.innerHTML = "Actif";
        } else {
            textActif.classList.remove('text-success');
            textActif.classList.add('text-danger');
            textActif.innerHTML = "Inactif";
        }
    } else {
        const alert = document.createElement('div');
        alert.classList.add('alert');
        alert.classList.add('alert-danger')
        alert.setAttribute('role', 'alert');

        alert.innerHTML = 'Une erreur est survenue, veuillez rééssayer';

        document.querySelector('main').prepend(alert);
    }
}