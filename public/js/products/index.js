/**
 * lists items
 */

const productsTable = document.getElementById('products-table');
const productsTableBody = productsTable.querySelector('tbody');
const productsTablePagination = document.getElementById(
    'products-table-pagination'
);

function tableStartLoading() {
    productsTableBody.innerHTML = `<tr>
      <td colspan="7">
        <div class="text-center my-5">
          <div class="spinner-border text-primary" role="status">
            <span class="visually-hidden">Loading...</span>
          </div>
        </div>
      </td>
    </tr>`;
}

function tableMakeRow({ id, ...data }) {
    const tr = document.createElement('tr');

    const th = document.createElement('th');
    th.setAttribute('scope', 'row');
    th.textContent = id;

    tr.append(th);

    for (let key in data) {
        const td = document.createElement('td');
        td.textContent = data[key];
        tr.appendChild(td);
    }

    const td = document.createElement('td');
    td.innerHTML = `
      <a href="/products/${id}/edit" type="button" class="btn btn-link text-success p-0">
        Edit
      </a>
      <span class="mx-1">/</span>
      <button
        type="button"
        class="btn btn-link text-danger p-0"
        data-bs-toggle="modal"
        data-bs-target="#deleteModal"
        data-bs-id="${id}"
        data-bs-name="${data.name}"
      >
        Delete
      </button>`;

    tr.appendChild(td);

    return tr;
}

function tableMakePagination(links = []) {
    const elements = [];

    for (let link of links) {
        const button = document.createElement('a');

        button.innerHTML = link.label;
        button.className = `btn btn-primary ${link.active ? 'active' : ''} ${
            link.url ? '' : 'disabled'
        }`;

        // data fetching starts here
        button.onclick = () => tableFetchData(link.url);

        elements.push(button);
    }

    return elements;
}

function tablePopulate(data) {
    const caption = productsTable.querySelector('caption');
    caption.textContent = `${data.to} items out of ${data.total} items total.`;

    // tbody
    const rows = data.data.map((o) => tableMakeRow(o));
    productsTableBody.innerHTML = '';
    productsTableBody.append(...rows);

    // pagination
    productsTablePagination.innerHTML = '';
    productsTablePagination.append(...tableMakePagination(data.links));
}

async function tableFetchData(url) {
    tableStartLoading();

    const response = await fetch(url, {
        headers: {
            accept: 'application/json',
        },
    });

    const data = await response.json();

    tablePopulate(data);
}

/**
 * delete modal
 */

const deleteModalClass = new bootstrap.Modal('#deleteModal');

// handles ui changes and api call for deleting an item
function deleteItem(id) {
    console.log('to delete ' + id);
    deleteModalClass.hide();
}

const deleteModalEl = document.getElementById('deleteModal');

// listen for deleteModal "show"
deleteModalEl.addEventListener('show.bs.modal', (event) => {
    // Button that triggered the modal
    const button = event.relatedTarget;

    // Extract info from data-bs-* attributes
    const itemId = button.getAttribute('data-bs-id');
    const itemName = button.getAttribute('data-bs-name');

    // update modal custom title
    const modalTitle = deleteModalEl.querySelector('#modal-delete-title');
    modalTitle.textContent = `Delete item "${itemName}"?`;

    // update modal button
    const modalDeleteButton = deleteModalEl.querySelector(
        '#modal-delete-confirm'
    );
    modalDeleteButton.setAttribute('onClick', `deleteItem(${itemId})`);
});

// listen for deleteModal "closed"
deleteModalEl.addEventListener('hide.bs.modal', () => {
    const modalDeleteButton = deleteModalEl.querySelector(
        '#modal-delete-confirm'
    );
    modalDeleteButton.removeAttribute('onClick');
});

/**
 * start application
 */

function init() {
    tableFetchData('/api/products');
}

init();