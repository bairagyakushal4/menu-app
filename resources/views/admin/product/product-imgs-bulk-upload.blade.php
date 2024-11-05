<x-admin.admin-layout title="Product">
    <x-slot name="sidebar">
        <x-admin.admin-sidebar activeModule="product" activePage="product"></x-admin.admin-sidebar>
    </x-slot>

    <x-slot name="pageTitle">
        <x-admin.admin-page-title title="Product" subtitle="Product images bulk upload">
            <li class="breadcrumb-item"><a href="/admin">Dashboard</a></li>
            <li class="breadcrumb-item"><a href="/admin/product">Product</a></li>
            <li class="breadcrumb-item active" aria-current="page">Product images bulk upload</li>
        </x-admin.admin-page-title>
    </x-slot>

    <x-slot name="main">

        <style>
            #image_preview {
                display: flex;
                flex-wrap: wrap;
                gap: 10px;
                margin-top: 10px;
            }

            #image_preview img {
                height: 100px;
                width: auto;
                border: 1px solid #ccc;
            }

            #progress_bar_container {
                display: none;
                margin-top: 10px;
            }

            progress {
                width: 100%;
            }
        </style>

        <div class="card">

            <div class="card-body">
                <form class="form" method="POST">
                    @csrf

                    <div class="form-group">
                        <div class="row">
                            <div class="col-md-6 col-12">
                                <label for="product_images" class="form-label">Product Images</label>
                                <input type="file" name="product_images[]" id="product_images" class="form-control mb-2"
                                    multiple required onchange="previewImages(event)">
                                <small class="text-muted">
                                    Images should match with SKU of the product. Ex: S1AA15C.jpg, S1AA15C.png
                                </small>
                            </div>
                        </div>
                        <div id="image_error_message" class="invalid-feedback d-block"></div>
                    </div>


                    <div id="image_preview"></div>
                    <div id="progress_bar_container">
                        <progress id="progress_bar" value="0" max="100"></progress>
                        <span id="progress_percent">0%</span>
                    </div>


                    <div class="row mt-3">
                        <div class="col-12 d-flex justify-content-end">
                            <button type="button" id="upload_button" onclick="uploadImages(event)"
                                class="btn btn-primary me-3 mb-1">
                                Upload
                            </button>
                            <button type="reset" class="btn btn-light-secondary mb-1">
                                Reset
                            </button>
                        </div>
                    </div>
                </form>
            </div>

        </div>
    </x-slot>

    <x-slot name="script">
        <script>
            let selectedFiles = []; // To keep track of valid files
            const imagePreview = $("#image_preview");
            const errorMessage = $("#image_error_message");

            function previewImages(event) {
                const fileInput = event.target;

                errorMessage.text("");

                const files = Array.from(fileInput.files);
                let totalSize = 0; // Variable to hold total size
                selectedFiles = []; // Reset selected files array
                imagePreview.empty(); // Clear previous previews

                files.forEach((file) => {
                    let isValid = true; // Flag to check validity

                    // Check file type
                    if (!validFileTypes.includes(file.type)) {
                        errorMessage.text("Invalid file type: " + file.name);
                        isValid = false;
                    }

                    // Check file size
                    if (file.size > maxSize) {
                        errorMessage.text("File removed! File size limit exceeds : " + file.name+ ".  Max file size: 500KB");
                        isValid = false;
                    }

                    // If file is valid, accumulate total size and add to selectedFiles
                    if (isValid) {
                        selectedFiles.push(file);
                        totalSize += file.size;

                        const img = new Image();
                        const objectURL = URL.createObjectURL(file);
                        img.src = objectURL;
                        img.onload = function () {
                            imagePreview.append(img);
                            URL.revokeObjectURL(objectURL);
                        };
                    }
                });

                // Check total size against the limit
                if (totalSize > totalImagesSize) {
                    errorMessage.text("Total image size should not exceed 150MB.");
                    selectedFiles = []; // Reset selected files if total size exceeds limit
                    imagePreview.empty(); // Clear preview if total size exceeds
                }
            }

            function uploadImages() {
                if (selectedFiles.length === 0) {
                    alert("Please select valid images first!");
                    return;
                }

                const progressBarContainer = $("#progress_bar_container");
                const progressBar = $("#progress_bar");
                const progressPercent = $("#progress_percent");

                progressBarContainer.show();
                progressBar.val(0);
                progressPercent.text("0%");

                const formData = new FormData();
                formData.append('_token', '{{ csrf_token() }}');
                selectedFiles.forEach((file) => {
                    formData.append("product_images[]", file);
                });

                $.ajax({
                    url: "/admin/product-imgs-bulk-upload",
                    type: "POST",
                    data: formData,
                    contentType: false,
                    processData: false,
                    xhr: function () {
                        const xhr = new window.XMLHttpRequest();
                        // Upload progress
                        xhr.upload.addEventListener("progress", function (e) {
                            if (e.lengthComputable) {
                                const percentComplete = (e.loaded / e.total) * 100;
                                progressBar.val(percentComplete);
                                progressPercent.text(Math.round(percentComplete) + "%");
                            }
                        });
                        return xhr;
                    },
                    success: function (data) {
                        console.log(data);
                        successAlert("Images uploaded successfully!");


                        errorMessage.text("");
                        progressBar.val(100); // Complete progress
                        progressPercent.text("100%");
                        $("#product_images").val(""); // Reset input
                        $("#image_preview").empty(); // Clear preview
                        progressBarContainer.hide(); // Hide progress bar
                    },
                    error: function () {
                        alert("Error uploading images.");
                    },
                });
            }

        </script>
    </x-slot>

</x-admin.admin-layout>