export default function (el, comp) {
    const modals = comp.modals;
    const starshipId = el.starshipId;

    const closeModal = () => {
        let modal = el.modal();
        if (modal != null) {
            modal.className = 'modal fadeout';
            return new Promise(resolve => setTimeout(() => {
                //allow 350 ms for fadeout animation to complete
                modal.remove();
                document.removeEventListener('click', clickOutside);
                resolve();
            }, 350));
        }
    };
    const clickOutside = (ev) => {
        ev.stopImmediatePropagation();
        let dialog = el.dialog();
        if ((dialog != null && !dialog.contains(ev.target)) && el.loader.style.display === 'none') {
            closeModal();
        }
    };
    const flashModal = (res, goToAfter) => {
        res.text()
            .then((data) => {
                let modal = document.createElement('div')
                modal.innerHTML = data;
                el.body.appendChild(modal.firstChild);
                setTimeout(() => {
                    closeModal();
                    if (goToAfter) window.location.href = goToAfter;
                }, 3000);
            });
    }

    async function popModal(res) {
        function buildModal(data) {
            let incomingModal = document.createElement('div');
            incomingModal.innerHTML = data;
            el.body.appendChild(incomingModal.firstChild);
            document.onclick = e => { clickOutside(e) };
            const closeButton = el.closeButton();
            closeButton.onclick = () => { closeModal() };
        }
        document.activeElement.blur();

        if (res.status === 200) {
            await res.text()
                .then((data) => {
                    buildModal(data);
                });
        } else if (typeof res === 'string') {
            buildModal(res);
        }
    }

    if (el.register) {
        el.register.onclick = () => {
            fetch('/register')
                .catch((err) => {
                    console.log(err);
                    alert('Something went wrong');
                })
                .then((res) => {
                    popModal(res).then(() => { modals.registration(el) });
                });
        };
    }

    if (el.login) {
        el.login.onclick = () => {
            fetch('/login')
                .catch((err) => {
                    console.log(err);
                    alert('Something went wrong');
                })
                .then((res) => {
                    popModal(res)
                        .then(() => {
                            modals.login(el, closeModal, popModal, flashModal);
                        });
                });
        };
    }

    if (el.roll) {
        el.roll.onclick = () => {
            fetch(`/roll/${el.roll.value}`)
                .catch((err) => {
                    console.log(err);
                    alert('Something went wrong');
                })
                .then((res) => {
                    popModal(res)
                        .then(() => {
                            modals.dice(el);
                        });
                });
        };
    }

    if (el.newCharacter) {
        el.newCharacter.onclick = () => {
            fetch('/new-character')
                .catch((err) => {
                    console.log(err);
                    alert('Something went wrong');
                })
                .then((res) => popModal(res));
        };
    }

    if (el.editCharacter) {
        el.editCharacter.onclick = () => {
            fetch(`/edit-character/${el.characterSelect.value}`)
                .catch((err) => {
                    console.log(err);
                    alert('Something went wrong');
                })
                .then((res) => popModal(res));
        };
    }

    if (el.deleteCharacter) {
        el.deleteCharacter.oclick = () => {
            fetch(`/delete-character/${el.characterSelect.value}`)
                .catch((err) => {
                    console.log(err);
                    alert('Something went wrong');
                })
                .then((res) => popModal(res));
        };
    }

    if (el.newStarship) {
        el.newStarship.onclick = () => {
            fetch('/new-starship')
                .catch((err) => {
                    console.log(err);
                    alert('Something went wrong');
                })
                .then((res) => popModal(res));
        };
    }

    if (el.editStarship) {
        el.editStarship.onclick = () => {
            fetch(`/edit-starship/${starshipId}`)
                .catch((err) => {
                    console.log(err);
                    alert('Something went wrong');
                })
                .then((res) => popModal(res));
        };
    }

    if (el.deleteStarship) {
        el.deleteStarship.onclick = () => {
            fetch(`/delete-starship/${starshipId}`)
                .catch((err) => {
                    console.log(err);
                    alert('Something went wrong');
                })
                .then((res) => popModal(res));
        };
    }

    if (el.newSystem) {
        el.newSystem.onclick = () => {
            fetch(`/starship/${starshipId}/division/${el.newSystem.value}/new-system`)
                .catch((err) => {
                    console.log(err);
                    alert('Something went wrong');
                })
                .then((res) => popModal(res));
        };
    }

    if (el.editSystemButtons) {
        for (let i = 0; i < el.editSystemButtons.length; i++) {
            el.editSystemButtons[i].onclick = () => {
                let systemId = el.editSystemButtons[i].value;
                fetch(`/edit-system/${systemId}`)
                    .catch((err) => {
                        console.log(err);
                        alert('Something went wrong');
                    })
                    .then((res) => popModal(res));
            };
        }
    }

    //manifest menu

    if (el.crew) {
        el.crew.onclick = () => {
            fetch(`/starship/${starshipId}/crew-manifest`)
                .catch((err) => {
                    console.log(err);
                    alert('Something went wrong');
                })
                .then((res) => popModal(res));
            el.manifestMenu.style.display = 'none';
        };
    }

    if (el.cargo) {
        el.cargo.onclick = () => {
            fetch(`/starship/${starshipId}/cargo-manifest`)
                .catch((err) => {
                    console.log(err);
                    alert('Something went wrong');
                })
                .then((res) => {
                    popModal(res)
                        .then(() => modals.cargoManifest(el));
                });
            el.manifestMenu.style.display = 'none';
        };
    }

    if (el.jobs) {
        el.jobs.onclick = () => {
            if (true) {
                alert('This feature is not yet available');
                return;
            }
            fetch(`/starship/${starshipId}/jobs`)
                .catch((err) => {
                    console.log(err);
                    alert('Something went wrong');
                })
                .then((res) => popModal(res));
            el.manifestMenu.style.display = 'none';
        };
    }

    //welcome logo
    if (el.welcomeLogo != null) {
        el.welcomeLogo.onclick = () => {
            fetch('/orientation')
                .catch((err) => {
                    console.log(err);
                    alert('Something went wrong');
                })
                .then((res) => popModal(res));
        };
    }

    return {
        clickOutside,
        closeModal,
        flashModal,
        popModal
    }

}