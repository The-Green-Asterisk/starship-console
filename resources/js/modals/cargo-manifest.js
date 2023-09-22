import * as el from '../elements.js';

window.activateCargo = () => {
    const nameInput = document.querySelector('#name');
    const quantityInput = document.querySelector('#quantity');
    const descriptionInput = document.querySelector('#description');
    let cargoList = document.querySelector('#cargo-items');
    const noItems = document.querySelector('#no-items');
    const starshipId = (el.starshipId ? el.starshipId.value : null);

    Echo.join(`presenceStarshipConsole.${starshipId}`)
        .listen('AddCargo', (data) => {
            showItem(data.data);
        })
        .listen('UpdateCargo', (data) => {
            updateItem(data.data);
        });

    window.addCargoItem = async () => {
        await fetch('/add-cargo', {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
            },
            body: JSON.stringify({
                starship_id: el.starshipId.value,
                name: nameInput.value,
                quantity: quantityInput.value,
                description: descriptionInput.value,
            })
        })
            .catch((err) => {
                console.log(err);
                alert('Something went wrong');
            });
    };

    function showItem(item) {
        if (!cargoList) {
            cargoList = document.createElement('div');
            cargoList.id = 'cargo-items';
        }
        let cargoItemDiv = document.createElement('div');
        cargoItemDiv.classList.add('cargo-item');
        cargoItemDiv.id = `item-${item.id}`

        let newItemName = document.createElement('p');
        newItemName.textContent = item.name;
        newItemName.id = `item-${item.id}-name`;
        newItemName.contentEditable = true;
        newItemName.addEventListener('blur', () => { updateCargoItem(item.id) });

        let styleDiv = document.createElement('div');
        styleDiv.style.flexGrow = 1;

        let newItemQuantity = document.createElement('input');
        newItemQuantity.type = 'number';
        newItemQuantity.value = item.quantity;
        newItemQuantity.id = `item-${item.id}-qty`;
        newItemQuantity.min = 0;
        newItemQuantity.addEventListener('blur', () => { updateCargoItem(item.id) });

        let newItemDeleteButton = document.createElement('button');
        newItemDeleteButton.style.margin = 0;
        newItemDeleteButton.textContent = 'x';
        newItemDeleteButton.title = 'Delete';
        newItemDeleteButton.addEventListener('click', () => { deleteCargoItem(item.id) });

        let cargoDescriptionDiv = document.createElement('div');
        cargoDescriptionDiv.classList.add('cargo-description');
        cargoDescriptionDiv.id = `description-${item.id}`;

        let newItemDescription = document.createElement('p');
        newItemDescription.innerHTML = item.description;
        newItemDescription.id = `item-${item.id}-description`;
        newItemDescription.contentEditable = true;
        newItemDescription.addEventListener('blur', () => { updateCargoItem(item.id) });

        cargoItemDiv.appendChild(newItemName);
        cargoItemDiv.appendChild(styleDiv);
        cargoItemDiv.appendChild(newItemQuantity);
        cargoItemDiv.appendChild(newItemDeleteButton);
        cargoDescriptionDiv.appendChild(newItemDescription);

        if (noItems) {
            const modalBody = el.dialog();
            modalBody.insertBefore(cargoList, noItems)
            noItems.remove();
        }
        cargoList.appendChild(cargoItemDiv);
        cargoList.appendChild(cargoDescriptionDiv);
    }

    function updateItem(item) {
        if (item.quantity === 0) {
            deleteCargoItemConfirmed(item.id, true);
            return;
        }

        const cargoItemName = document.getElementById(`item-${item.id}-name`);
        const cargoItemQty = document.getElementById(`item-${item.id}-qty`);
        const cargoItemDescription = document.getElementById(`item-${item.id}-description`);

        cargoItemName.textContent = item.name;
        cargoItemQty.value = item.quantity;
        cargoItemDescription.textContent = item.description;
    }

    window.updateCargoItem = async (id) => {
        const name = document.querySelector(`#item-${id}-name`).textContent;
        const quantity = parseInt(document.querySelector(`#item-${id}-qty`).value);
        const description = document.querySelector(`#item-${id}-description`).textContent;

        if (quantity === 0) {
            await window.deleteCargoItem(id, true);
            return;
        }

        await fetch(`/update-cargo/${id}`, {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
            },
            body: JSON.stringify({
                name: name,
                quantity: quantity,
                description: description,
            })
        })
            .catch((err) => {
                console.log(err);
                alert('Something went wrong');
            })
    };

    window.deleteCargoItem = async (id, qtyChange = false) => {
        if (document.getElementById(`confirm-button-${id}`)) return;
        const confirmButton = document.createElement('button');
        confirmButton.innerHTML = 'Are you sure you want to delete this item?';
        confirmButton.id = `confirm-button-${id}`;
        confirmButton.style.margin = 0;
        confirmButton.addEventListener('click', () => { deleteCargoItemConfirmed(id) });

        const itemDescriptionDiv = document.querySelector(`#description-${id}`);
        itemDescriptionDiv.appendChild(confirmButton);

        setTimeout(() => {
            confirmButton?.removeEventListener('click', () => { deleteCargoItemConfirmed(id) });
            confirmButton?.remove();
            if (qtyChange) {
                const qty = document.querySelector(`#item-${id}-qty`);
                if (qty) {
                    qty.value = 1;
                    window.updateCargoItem(id);
                }
            }
        }, 5000);
    };

    async function deleteCargoItemConfirmed(id, skipCall = false) {
        if (!skipCall)
            await fetch(`/delete-cargo/${id}`, {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                },
            })
                .catch((err) => {
                    console.log(err);
                    alert('Something went wrong');
                });
        const cargoItemDiv = document.getElementById(`item-${id}`);
        const cargoItemDescription = document.getElementById(`description-${id}`);

        cargoItemDiv?.remove();
        cargoItemDescription?.remove();
    };
}
