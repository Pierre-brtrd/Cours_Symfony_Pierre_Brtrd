const inputsPassword = document.querySelectorAll('input[type="password"]');

if (inputsPassword) {
    inputsPassword.forEach(input => {
        const parent = document.createElement('div');
        parent.classList.add('parent-password');

        const icon = document.createElement('i');
        icon.classList.add('bi', 'bi-eye-slash-fill', 'icon-password');

        input.before(parent);
        parent.append(input);
        input.after(icon);

        icon.addEventListener('click', e => {
            const type = input.getAttribute('type') === 'password' ? 'text' : 'password';
            input.setAttribute('type', type);

            if (type === 'password') {
                icon.classList.remove('bi-eye-fill');
                icon.classList.add('bi-eye-slash-fill');
            } else {
                icon.classList.remove('bi-eye-slash-fill');
                icon.classList.add('bi-eye-fill');
            }
        });
    });
}