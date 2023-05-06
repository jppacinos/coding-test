/**
 * form submit button
 */

const formSubmitButton = document.getElementById('formSubmitButton');

function formSubmitButtonLoading(isLoading = true) {
    isLoading
        ? formSubmitButton.setAttribute('disabled', true)
        : formSubmitButton.removeAttribute('disabled');

    isLoading
        ? (formSubmitButton.innerHTML = `
            <div class="spinner-border text-light" role="status" style="width: 15px; height: 15px; margin-right: 5px">
                <span class="visually-hidden">Loading...</span>
            </div> Confirm Edit`)
        : (formSubmitButton.innerHTML = 'Confirm Edit');
}

/**
 * form main
 */

const form = document.getElementById('form-edit');

form.onsubmit = async (e) => {
    e.preventDefault();

    formSubmitButtonLoading();

    const formData = new FormData(form);

    const response = await fetch(`/api/products/${formData.get('id')}`, {
        headers: {
            accept: 'application/json',
            'content-type': 'application/json',
        },
        method: 'PATCH',
        body: JSON.stringify(Object.fromEntries(formData)),
    });

    if (response.status === 422) {
        const errors = await response.json();
        alert(`There was an error in validation. \n${errors.message}`);
    }

    formSubmitButtonLoading(false);
};
