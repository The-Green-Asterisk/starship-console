const d4 = document.querySelector('#d4');
const d6 = document.querySelector('#d6');
const d8 = document.querySelector('#d8');
const d10 = document.querySelector('#d10');
const d12 = document.querySelector('#d12');
const d20 = document.querySelector('#d20');
const d100 = document.querySelector('#d100');
const diceTray = document.querySelector('#dice-tray');
const mod = document.querySelector('#modifier');
const roll = document.querySelector('#roll');
const result = document.querySelector('#result');

let diceResult = 0;
let diceArray = [];
var rollValue = 0;

d4.addEventListener('click', () => {
    let roll = Math.floor(Math.random() * 4) + 1;
    diceResult += roll;
    diceArray.push(roll);
    let tray4 = d4.cloneNode(true);
    diceTray.insertBefore(tray4, diceTray.firstChild);
    result.innerText = '';
});
d6.addEventListener('click', () => {
    let roll = Math.floor(Math.random() * 6) + 1;
    diceResult += roll;
    diceArray.push(roll);
    let tray6 = d6.cloneNode(true);
    diceTray.insertBefore(tray6, diceTray.firstChild);
    result.innerText = '';
});
d8.addEventListener('click', () => {
    let roll = Math.floor(Math.random() * 8) + 1;
    diceResult += roll;
    diceArray.push(roll);
    let tray8 = d8.cloneNode(true);
    diceTray.insertBefore(tray8, diceTray.firstChild);
    result.innerText = '';
});
d10.addEventListener('click', () => {
    let roll = Math.floor(Math.random() * 10) + 1;
    diceResult += roll;
    diceArray.push(roll);
    let tray10 = d10.cloneNode(true);
    diceTray.insertBefore(tray10, diceTray.firstChild);
    result.innerText = '';
});
d12.addEventListener('click', () => {
    let roll = Math.floor(Math.random() * 12) + 1;
    diceResult += roll;
    diceArray.push(roll);
    let tray12 = d12.cloneNode(true);
    diceTray.insertBefore(tray12, diceTray.firstChild);
    result.innerText = '';
});
d20.addEventListener('click', () => {
    let roll = Math.floor(Math.random() * 20) + 1;
    diceResult += roll;
    diceArray.push(roll);
    let tray20 = d20.cloneNode(true);
    diceTray.insertBefore(tray20, diceTray.firstChild);
    result.innerText = '';
});
d100.addEventListener('click', () => {
    let roll = Math.floor(Math.random() * 100) + 1;
    diceResult += roll;
    diceArray.push(roll);
    let tray100 = d100.cloneNode(true);
    diceTray.insertBefore(tray100, diceTray.firstChild);
    result.innerText = '';
});

roll.addEventListener('click', () => {
    for (let i = 0; i < diceArray.length; i++)
        result.innerText += '\u00a0[' + diceArray[i] + '] +';
    if (mod.value == 0){
        let sliced = result.innerText.slice(0, -1);
        result.innerText = sliced + ' =\u00a0';
    }else{
        result.innerText += Number(mod.value) + ' =\u00a0';
    }
    result.innerText += diceResult + Number(mod.value);
    rollValue = parseInt(diceResult + Number(mod.value));
    console.log(rollValue);
    for (let i = 0; i < diceArray.length; i++)
        diceTray.removeChild(diceTray.firstChild);
    diceArray = [];
    diceResult = 0;
    mod.value = 0;
});

export {rollValue};
