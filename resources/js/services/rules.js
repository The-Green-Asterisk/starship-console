export default class {
    static limit255 = (e) => {
        if (e.innerText.length > 255) {
            e.innerText = e.innerText.substring(0, 255);
            var range = document.createRange();
            var sel = window.getSelection();
            range.setStart(e.childNodes[0], 255);
            range.collapse(true);
            sel.removeAllRanges();
            sel.addRange(range);
        }
    }
    
    static limitLong = (e) => {
        if (e.innerText.length > 65535) {
            e.innerText = e.innerText.substring(0, 65535);
            var range = document.createRange();
            var sel = window.getSelection();
            range.setStart(e.childNodes[0], 65535);
            range.collapse(true);
            sel.removeAllRanges();
            sel.addRange(range);
        }
    }

    static isTouchEnabled = () => {
        return ('ontouchstart' in window) ||
            (navigator.maxTouchPoints > 0) ||
            (navigator.msMaxTouchPoints > 0);
    }
}