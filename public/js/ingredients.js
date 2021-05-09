document.addEventListener('DOMContentLoaded', () => {
    let table = document.getElementById('ing-table');
    let body = table.getElementsByTagName('tbody'.toUpperCase())[0];
    let children = body.children;
    for (let i = 0; i < children.length; i++) {
        forEachAllValueTags(children[i], (e) => {
            e.addEventListener('input', onContentsChanged);
        });
    }
});


function onContentsChanged(event) {
    let element = event.target;
    let body = getTBody(element);
    let row = getTR(element);
    if (!doesContainAnyValues(row)) {
        if (body.children.length > 1 && body.lastElementChild !== row) {
            row.removeEventListener('input', onContentsChanged);
            row.remove();
            body.lastElementChild.getElementsByTagName('input'.toUpperCase())[0].focus();
        }
    } else {
        if (body.lastElementChild === row) {
            insertTableRow(body);
        }
    }
}

function insertTableRow(tableBody) {
    let currentLast = tableBody.lastElementChild;
    let newLast = currentLast.cloneNode(true);
    newLast.addEventListener('input', onContentsChanged);
    tableBody.appendChild(newLast);
    clearAllValues(newLast);
}

function clearAllValues(element) {
    forEachAllValueTags(element, (e) => {
        if (e.tagName.toUpperCase() === 'input'.toUpperCase()) {
            e.value = '';
        } else if (e.tagName.toUpperCase() === 'textarea'.toUpperCase()) {
            e.innerText = '';
        }
    })
}

function forEachAllValueTags(element, f) {
    let elements = element.getElementsByTagName('INPUT');
    for (let i = 0; i < elements.length; i++) {
        f(elements[i]);
    }
    elements = element.getElementsByTagName('TEXTAREA');
    for (let i = 0; i < elements.length; i++) {
        f(elements[i]);
    }
}

function doesContainAnyValues(element) {
    let e = element;
    if (e.tagName.toUpperCase() !== 'tr'.toUpperCase()) {
        e = getTR(e);
    }
    let anyNotBlank = false;
    forEachAllValueTags(e, (e) => {
        let value = e.tagName.toUpperCase() === 'input'.toUpperCase() ? e.value : e.innerText;
        if (!isBlank(value)) {
            anyNotBlank = true;
        }
    });
    return anyNotBlank;
}

function getParentWithTagName(element, tagName) {
    let current = element;
    while (!!current && current.tagName.toUpperCase() !== tagName.toUpperCase()) {
        current = current.parentElement;
    }
    return current;
}

function getTR(element) {
    return getParentWithTagName(element, 'tr');
}

function getTBody(element) {
    return getParentWithTagName(element, 'tbody');
}

function isBlank(value) {
    return (!value || /^\s*$/.test(value));
}
