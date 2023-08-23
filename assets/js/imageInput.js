const inputImage = document.querySelector('.input-image-content input');
const previewImage = document.querySelector('.preview-img');
const label = document.querySelector('.input-image-content label');

if (inputImage) {
    inputImage.addEventListener('change', (e) => {
        const file = e.target.files[0];
        if (file) {
            const reader = new FileReader();
            reader.addEventListener('load', () => {
                previewImage.setAttribute('src', reader.result);
            });
            reader.readAsDataURL(file);

            label.querySelector('span').innerText = file.name
        }
    });
}