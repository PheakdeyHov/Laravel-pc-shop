@extends('layouts.app')

@section('page-title', 'ការបន្ថែមទំនិញក្នុងស្ទុក')

@section('content')
    <div class="form-data">
        <div class="card">
            <div class="row">
                <div class="mt-3">
                    <a href="{{ route('products.index') }}" class="btn btn-primary kh">ត្រឡប់ក្រោយ</a>
                </div>
            </div>
            <form action="{{ route('products.store') }}" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="mt-4">
                    <p class="title kh">/ ការកំណត់នៃទំនិញ :</p>
                </div>
                <div class="row">
                    <div class="col-md-4">
                        <div class="mt-1">
                            <label for="name">Product Name :</label>
                            <input type="text" name="name" id="name" class="form-control shadow-none"
                                value="{{ old('name') }}" required>
                            @error('name')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="mt-1">
                            <label for="category_id">Category :</label>
                            <select name="category_id" id="category_id" class="form-control shadow-none" required>
                                <option value="">Select Category</option>
                                @foreach ($categories as $category)
                                    <option value="{{ $category->id }}"
                                        {{ old('category_id') == $category->id ? 'selected' : '' }}>
                                        {{ $category->name }}
                                    </option>
                                @endforeach
                            </select>
                            @error('category_id')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="mt-1">
                            <label for="brands_id">Brand :</label>
                            <select name="brand_id" id="brand_id" class="form-control shadow-none" required>
                                <option value="">Select Brand</option>
                                @foreach ($brands as $brand)
                                    <option value="{{ $brand->id }}"
                                        {{ old('brand_id') == $brand->id ? 'selected' : '' }}>
                                        {{ $brand->name }}
                                    </option>
                                @endforeach
                            </select>
                            @error('brand_id')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-12">
                        <div class="mt-1">
                            <label for="image">Product Image :</label>
                            <div class="card imgholder d-flex align-items-center justify-content-center">
                                <label for="imgInput" class="upload">
                                    <input type="file" name="image" id="imgInput" style="display: none;">
                                    <i class="bi bi-plus-circle-dotted" style="font-size: 2rem; cursor: pointer;"></i>
                                </label>
                                <!-- Ensure the default image is displayed initially -->
                                <img id="imagePreview" src="{{ asset('assets/img/box.png') }}" alt="Preview"
                                    style="max-width: 100%; height: 250px;">
                                @error('image')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>
                    </div>
                </div>
                <div class="mt-3">
                    <p class="title kh">/ ការកំណត់ Specification នៃទំនិញ :</p>
                </div>
                <div class="row">
                    <div class="col-md-4">
                        <div class="mt-3 d-flex align-items-center">
                            <button class="btn btn-primary me-1 kh" id="addRow">បន្ថែម Specifications</button>
                            <div id="removeAllContainer" style="display: none;">
                                <button type="button" id="removeAllBtn" class="btn btn-danger me-1">Remove All</button>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-12">
                        <div class="mt-4">
                            <div class="searchTable table-responsive">
                                <table class="table">
                                    <thead>
                                        <tr>
                                            <th>
                                                <input type="checkbox" name="" id="check-all">
                                            </th>
                                            <th class="kh">Product Code/SKU</th>
                                            <th class="kh">Specifications Value</th>
                                            <th class="kh">ចំនួន</th>
                                            <th class="kh">តម្លៃនាំចូល</th>
                                            <th class="kh">តម្លៃលក់ចេញ</th>
                                            <th class="kh">លក្ខណះនៃទំនិញ</th>
                                            <th class="kh">ប្រតិបត្តិការណ៍</th>
                                        </tr>
                                    </thead>
                                    <tbody id="specsTableBody">

                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="mt-3">
                    <button class="btn btn-success kh" type="submit">រក្សាទុក</button>
                </div>
            </form>
        </div>
    </div>
@endsection

@section('scripts')
    <script>
        //display img
        document.getElementById('imgInput').addEventListener('change', function(event) {
            const imagePreview = document.getElementById('imagePreview');
            const file = event.target.files[0];
            const reader = new FileReader();

            reader.onload = function(e) {
                imagePreview.src = e.target.result; // Set the new image
                imagePreview.style.display = 'block'; // Ensure the image is visible
            };

            if (file) {
                reader.readAsDataURL(file); // Read and display the uploaded image
            } else {
                // If no file is uploaded, revert to the default image
                imagePreview.src = '{{ asset('assets/img/box.png') }}';
                imagePreview.style.display = 'block'; // Make sure it's visible
            }
        });

        // Add Row
        // Initial setup to display message if no rows are present
        let rowCounter = 0; // Global counter to keep track of the row index

        // Add Row
        document.getElementById('addRow').addEventListener('click', function(e) {
            e.preventDefault(); // Prevent form submission on button click

            const tableBody = document.getElementById('specsTableBody');

            const newRow = document.createElement('tr');
            newRow.innerHTML = `
        <td>
            <input type="checkbox" name="check" class="row-checkbox">
        </td>
        <td style="width: 200px">
            <input type="text" class="form-control shadow-none @error('product_code') is-invalid @enderror" name="specifications[${rowCounter}][product_code]" value={{ old('product_code') }} required>
            @error('product_code')
                <span class="text-danger">{{ $message }}</span>
            @enderror
        </td>
        <td>
            <textarea name="specifications[${rowCounter}][specs_value]" class="form-control shadow-none" cols="10" rows="5" required></textarea>
        </td>
        <td style="width: 150px">
            <input type="text" class="form-control shadow-none" name="specifications[${rowCounter}][qty]" required>
        </td>
        <td style="width: 200px">
            <input type="text" class="form-control shadow-none" name="specifications[${rowCounter}][purchase_price]" required>
        </td>
        <td style="width: 200px">
            <input type="text" class="form-control shadow-none" name="specifications[${rowCounter}][sale_price]" required>
        </td>
        <td style="width: 200px">
            <select name="specifications[${rowCounter}][status]" class="form-control shadow-none" required>
                <option value="">Select Status</option>
                <option value="new">New</option>
                <option value="second-hand">Second Hand</option>
                <option value="99">99%</option>
            </select>
        </td>
        <td>
            <button type="button" class="btn btn-danger delete-row-btn"><i class="bi bi-x-circle"></i></button>
        </td>
    `;

            tableBody.appendChild(newRow);
            attachRowEventListeners(newRow);

            // Increment rowCounter to ensure each new row gets a unique index
            rowCounter++;

            updateTablePlaceholder(); // Update table placeholder if necessary
        });

        // Function to attach event listeners to delete buttons for each row
        function attachRowEventListeners(row) {
            const deleteButton = row.querySelector('.delete-row-btn');
            deleteButton.addEventListener('click', function() {
                row.remove();
                updateTablePlaceholder(); // Update table placeholder if necessary
            });
        }

        // Placeholder update if no rows exist
        function updateTablePlaceholder() {
            const tableBody = document.getElementById('specsTableBody');
            const placeholderRow = document.getElementById('placeholderRow');

            if (tableBody.children.length === 0) {
                if (!placeholderRow) {
                    const row = document.createElement('tr');
                    row.id = 'placeholderRow';
                    row.innerHTML = `
                <td colspan="8" class="text-center text-muted">
                    There isn't specifications of this product
                </td>
            `;
                    tableBody.appendChild(row);
                }
            } else {
                if (placeholderRow) {
                    placeholderRow.remove();
                }
            }
        }

        // Handle "Check All" functionality
        document.getElementById('check-all').addEventListener('change', function() {
            const checkboxes = document.querySelectorAll('.row-checkbox');
            const isChecked = this.checked;

            checkboxes.forEach((checkbox) => {
                checkbox.checked = isChecked;
            });

            updateRemoveAllVisibility();
        });

        // Update visibility of "Remove All" button
        function updateRemoveAllVisibility() {
            const checkboxes = document.querySelectorAll('.row-checkbox:checked');
            const removeAllContainer = document.getElementById('removeAllContainer');

            if (checkboxes.length > 0) {
                removeAllContainer.style.display = 'block';
            } else {
                removeAllContainer.style.display = 'none';
            }
        }

        // Handle "Remove All" functionality
        document.getElementById('removeAllBtn').addEventListener('click', function() {
            const checkboxes = document.querySelectorAll('.row-checkbox:checked');

            checkboxes.forEach((checkbox) => {
                checkbox.closest('tr').remove();
            });

            updateRemoveAllVisibility();
            updateTablePlaceholder();
        });
    </script>
@endsection
