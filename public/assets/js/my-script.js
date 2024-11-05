const Swal2 = Swal.mixin({
    customClass: {
        input: "form-control",
    },
});

const Toast = Swal.mixin({
    toast: true,
    position: "top-end",
    showConfirmButton: false,
    timer: 3000,
    timerProgressBar: true,
    didOpen: (toast) => {
        toast.addEventListener("mouseenter", Swal.stopTimer);
        toast.addEventListener("mouseleave", Swal.resumeTimer);
    },
});

function deleteConfirm(element, event) {
    event.preventDefault(); // Prevent the default link action immediately

    Swal2.fire({
        title: "Are you sure?",
        text: "You won't be able to revert this!",
        icon: "warning",
        showCancelButton: true,
        confirmButtonText: "Yes, delete it!",
    }).then((result) => {
        if (result.isConfirmed) {
            window.location.href = element.href; // Proceed with the link action if confirmed
        }
    });
}

function successAlert(title) {
    Toast.fire({
        icon: "success",
        title: title,
    });
}

function warningAlert(title) {
    Toast.fire({
        icon: "warning",
        title: title,
    });
}

function errorAlert(title) {
    Toast.fire({
        icon: "error",
        title: title,
    });
}

const validFileTypes = ["image/jpeg", "image/png", "image/gif"];
const maxSize = 500 * 1024; // 500KB in bytes
const maxDimension = 1080; // Max width/height in pixels
const totalImagesSize = 300 * maxSize; // total size in bytes for all images

function product_image_preview(event) {
    const fileInput = event.target;
    const imagePreview = document.getElementById("image_preview");
    const errorMessage = document.getElementById("image_error_message");
    const file = fileInput.files[0];

    errorMessage.textContent = "";
    imagePreview.style.display = "none";

    if (!file) return;

    if (!validFileTypes.includes(file.type)) {
        errorMessage.textContent =
            "Please select a valid image (JPEG, PNG, GIF).";
        fileInput.value = "";
        return;
    }

    if (file.size > maxSize) {
        errorMessage.textContent = "File size should not exceed 500KB.";
        fileInput.value = "";
        return;
    }

    const img = new Image();
    const objectURL = URL.createObjectURL(file);

    img.onload = function () {
        // Guard clause: Image dimensions exceed 1080px in width or height
        if (img.width > maxDimension || img.height > maxDimension) {
            errorMessage.textContent =
                "Image dimensions should not exceed 1080px in width or height.";
            fileInput.value = "";
            URL.revokeObjectURL(objectURL);
            return;
        }

        // If all checks pass, display the image preview
        const reader = new FileReader();
        reader.onload = function (e) {
            imagePreview.src = e.target.result;
            imagePreview.style.display = "block";
        };
        reader.readAsDataURL(file);
    };

    img.src = objectURL;
}
