import * as el from '../elements.js';

window.activateCargo = () => {
    const addButton = document.querySelector('#add-cargo');
    const nameInput = document.querySelector('#name');
    const quantityInput = document.querySelector('#quantity');
    const descriptionInput = document.querySelector('#description');
    let cargoList = document.querySelector('#cargo-items');
    const noItems = document.querySelector('#no-items');

    async function addCargoItem() {
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
            })
            .then((res) => {
                res.json()
                    .then((item) => {
                        if (!cargoList) {
                            cargoList = document.createElement('div');
                            cargoList.id = 'cargo-items';
                        }
                        let cargoItemDiv = document.createElement('div');
                        cargoItemDiv.classList.add('cargo-item');

                        let newItemName = document.createElement('p');
                        newItemName.innerHTML = item.name;

                        let styleDiv = document.createElement('div');
                        styleDiv.style = 'flex-grow: 1;';

                        let newItemQuantity = document.createElement('input');
                        newItemQuantity.type = 'number';
                        newItemQuantity.value = item.quantity;
                        newItemQuantity.id = `item-${item.id}-qty`;

                        let cargoDescriptionDiv = document.createElement('div');
                        cargoDescriptionDiv.classList.add('cargo-description');

                        let newItemDescription = document.createElement('p');
                        newItemDescription.innerHTML = item.description;

                        cargoItemDiv.appendChild(newItemName);
                        cargoItemDiv.appendChild(styleDiv);
                        cargoItemDiv.appendChild(newItemQuantity);
                        cargoDescriptionDiv.appendChild(newItemDescription);

                        if (noItems) {
                            el.modalBody.insertBefore(cargoList, noItems)
                            noItems.remove();
                        }
                        cargoList.appendChild(cargoItemDiv);
                        cargoList.appendChild(cargoDescriptionDiv);

                        console.log(cargoList)
                    })
            });
    };
    addButton.addEventListener('click', addCargoItem);
}
