document.addEventListener('DOMContentLoaded', () => {
    let formGroup = document.getElementById("recipe-picture-group")
    let inputField = formGroup.getElementsByTagName("input")[0]
    inputField.addEventListener("change", imageAdded);

    let form = document.getElementById("create-recipe");
    form.addEventListener("formdata", submitted)

    let imageCarousel = document.getElementById("picture-carousel");
    for (const child of imageCarousel.children) {
        child.querySelector("button").addEventListener("click", removeImage);
        window.files.push(undefined);
    }

});
window.files = [];
window.toRemove = [];

function submitted(e) {
    const formData = e.formData;
    formData.delete("pictures");
    for (let i = 0; i < window.files.length; i++) {
        const file = window.files[i];
        if (file === undefined) {
            continue;
        }
        formData.append("pictures[]", file);
    }
    for (const toRemoveElement of window.toRemove) {
        formData.append("toRemovePictures[]", toRemoveElement);
    }
    window.files = [];
    window.toRemove = [];
}

function imageAdded(event) {
    let imageInput = event.target;

    let files = imageInput.files;

    let reader = new FileReader();
    reader.onload = addImageToCarousel(files[0]);
    reader.readAsDataURL(files[0]);

    imageInput.value = "";
}

function addFile(file) {
    window.files.push(file);
}

function removeFile(index) {
    window.files.splice(index, 1);
}

function addImageToCarousel(file) {
    return function (event) {
        addFile(file)
        let image = event.target.result;
        let imageContainer = document.getElementById("picture-preview-template").content.cloneNode(true);

        let imageElement = imageContainer.querySelector("img");
        imageElement.src = image;

        let deleteButton = imageContainer.querySelector("button");


        deleteButton.addEventListener("click", removeImage)

        let imageCarousel = document.getElementById("picture-carousel");
        imageCarousel.appendChild(imageContainer);
    }
}


function removeImage(event) {
    let parent = event.target;
    while (parent.parentElement.id !== "picture-carousel") {
        parent = parent.parentElement;
    }
    let index = Array.prototype.indexOf.call(parent.parentElement.children, parent);
    removeFile(index);
    if (parent.hasAttribute("data-imgid")) {
        window.toRemove.push(parent.dataset.imgid);
    }

    parent.remove();
}
