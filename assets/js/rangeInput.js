const label = document.querySelector('form[name="comments"] label[for="comments_note"]');
const input = document.querySelector('form[name="comments"] input[name="comments[note]"]');

if (label) {
    const labelText = label.innerHTML;
    changeValueLabel(label, labelText, input.value);
    input.addEventListener('change', e => {
        changeValueLabel(label, labelText, input.value);
    })
}

function changeValueLabel(label, labelText, value) {
    label.innerHTML = `${labelText} [${value}]`;
}
