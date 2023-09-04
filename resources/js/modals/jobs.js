import el from '../elements.js';

export default function activateJobs() {
    const nameInput = document.querySelector('#name');
    const quantityInput = document.querySelector('#quantity');
    const descriptionInput = document.querySelector('#description');
    let cargoList = document.querySelector('#cargo-Jobs');
    const noJobs = document.querySelector('#no-Jobs');
    const starshipId = (el.starshipId ? el.starshipId.value : null);

    Echo.join(`presenceStarshipConsole.${starshipId}`)
        .listen('AddJob', (data) => {
            showJob(data.data);
        })
        .listen('UpdateJob', (data) => {
            updateJob(data.data);
        });

    window.addCargoJob = async () => {
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

    function showJob(job) {
        if (!cargoList) {
            cargoList = document.createElement('div');
            cargoList.id = 'cargo-Jobs';
        }
        let cargoJobDiv = document.createElement('div');
        cargoJobDiv.classList.add('cargo-Job');
        cargoJobDiv.id = `Job-${job.id}`

        let newJobName = document.createElement('p');
        newJobName.textContent = job.name;
        newJobName.id = `Job-${job.id}-name`;
        newJobName.contentEditable = true;
        newJobName.addEventListener('blur', () => { updateCargoJob(job.id) });

        let styleDiv = document.createElement('div');
        styleDiv.style.flexGrow = 1;

        let newJobQuantity = document.createElement('input');
        newJobQuantity.type = 'number';
        newJobQuantity.value = job.quantity;
        newJobQuantity.id = `Job-${job.id}-qty`;
        newJobQuantity.min = 0;
        newJobQuantity.addEventListener('blur', () => { updateCargoJob(job.id) });

        let newJobDeleteButton = document.createElement('button');
        newJobDeleteButton.style.margin = 0;
        newJobDeleteButton.textContent = 'x';
        newJobDeleteButton.title = 'Delete';
        newJobDeleteButton.addEventListener('click', () => { deleteCargoJob(job.id) });

        let cargoDescriptionDiv = document.createElement('div');
        cargoDescriptionDiv.classList.add('cargo-description');
        cargoDescriptionDiv.id = `description-${job.id}`;

        let newJobDescription = document.createElement('p');
        newJobDescription.innerHTML = job.description;
        newJobDescription.id = `job-${job.id}-description`;
        newJobDescription.contentEditable = true;
        newJobDescription.addEventListener('blur', () => { updateCargoJob(job.id) });

        cargoJobDiv.appendChild(newJobName);
        cargoJobDiv.appendChild(styleDiv);
        cargoJobDiv.appendChild(newJobQuantity);
        cargoJobDiv.appendChild(newJobDeleteButton);
        cargoDescriptionDiv.appendChild(newJobDescription);

        if (noJobs) {
            const modalBody = el.dialog();
            modalBody.insertBefore(cargoList, noJobs)
            noJobs.remove();
        }
        cargoList.appendChild(cargoJobDiv);
        cargoList.appendChild(cargoDescriptionDiv);
    }

    function updateJob(Job) {
        if (Job.quantity === 0) {
            deleteCargoJobConfirmed(Job.id, true);
            return;
        }

        const cargoJobName = document.getElementById(`Job-${Job.id}-name`);
        const cargoJobQty = document.getElementById(`Job-${Job.id}-qty`);
        const cargoJobDescription = document.getElementById(`Job-${Job.id}-description`);

        cargoJobName.textContent = Job.name;
        cargoJobQty.value = Job.quantity;
        cargoJobDescription.textContent = Job.description;
    }

    window.updateJob = async (id) => {
        const name = document.querySelector(`#Job-${id}-name`).textContent;
        const quantity = parseInt(document.querySelector(`#Job-${id}-qty`).value);
        const description = document.querySelector(`#Job-${id}-description`).textContent;

        if (quantity === 0) {
            await window.deleteCargoJob(id, true);
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

    window.deleteJob = async (id, qtyChange = false) => {
        if (document.getElementById(`confirm-button-${id}`)) return;
        const confirmButton = document.createElement('button');
        confirmButton.innerHTML = 'Are you sure you want to delete this Job?';
        confirmButton.id = `confirm-button-${id}`;
        confirmButton.style.margin = 0;
        confirmButton.addEventListener('click', () => { deleteCargoJobConfirmed(id) });

        const JobDescriptionDiv = document.querySelector(`#description-${id}`);
        JobDescriptionDiv.appendChild(confirmButton);

        setTimeout(() => {
            confirmButton?.removeEventListener('click', () => { deleteCargoJobConfirmed(id) });
            confirmButton?.remove();
            if (qtyChange) {
                const qty = document.querySelector(`#Job-${id}-qty`);
                if (qty) {
                    qty.value = 1;
                    window.updateCargoJob(id);
                }
            }
        }, 5000);
    };

    async function deleteJobConfirmed(id, skipCall = false) {
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
        const cargoJobDiv = document.getElementById(`Job-${id}`);
        const cargoJobDescription = document.getElementById(`description-${id}`);

        cargoJobDiv?.remove();
        cargoJobDescription?.remove();
    };
}
