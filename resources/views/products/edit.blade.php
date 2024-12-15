@extends('layouts.app')

@section('page-title', 'ការកែប្រែទំនិញ')

@section('content')
    <div class="form-data">
        <div class="card">
            <div class="row">
                <div class="col-md-5">
                    <a href="{{ route('products.index') }}" class="kh btn btn-primary">ត្រឡប់ក្រោយ</a>
                </div>
            </div>
            <div class="row">
                <form action="{{ route('products.update', $products->id) }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    @method('PUT')
                    <div class="mt-4">
                        <p class="title kh">/ ការកំណត់នៃទំនិញ :</p>
                    </div>
                    <div class="row">
                        <div class="col-md-4">
                            <div class="mt-1">
                                <label for="name">Product Name :</label>
                                <input type="text" name="name" id="name" class="form-control shadow-none"
                                    value="{{ $products->name }}" required>
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
                                            {{ $products->category_id == $category->id ? 'selected' : '' }}>
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
                                            {{ $products->brand_id == $brand->id ? 'selected' : '' }}>
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
                    <div class="row p-3">
                        <label for="image">Product Image</label>
                        <div class="card imgholder d-flex align-items-center justify-content-center">
                            <label for="imgInput" class="upload">
                                <input type="file" name="image" id="imgInput" style="display: none;">
                                <i class="bi bi-plus-circle-dotted" style="font-size: 2rem; cursor: pointer;"></i>
                            </label>
                            <!-- Ensure the default image is displayed initially -->
                            <img id="imagePreview"
                                src="{{ $products->image ? asset('storage/' . $products->image) : asset('assets/img/box.png') }}"
                                alt="Preview" style="max-width: 100%; height: 250px;">


                            @error('image')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>
                    <div class="mt-3">
                        <p class="title kh">/ ការកំណត់ Specification នៃទំនិញ :</p>
                    </div>
                    <div class="row">
                        <div class="col-md-4">
                            <div class="mt-3 d-flex align-items-center">
                                <button class="btn btn-primary me-1 kh" id="addRowBtn">បន្ថែម Specifications</button>
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
                                        <tbody class="text-center" id="specsTableBody">
                                            @foreach ($products->specifications as $index => $specification)
                                                <tr>
                                                    <td>
                                                        <input type="checkbox" name="check" class="row-checkbox">
                                                    </td>
                                                    <td style="width: 200px">
                                                        <input type="text" class="form-control shadow-none"
                                                            name="specifications[{{ $index }}][product_code]"
                                                            value="{{ $specification->product_code }}" required>
                                                    </td>
                                                    <td>
                                                        <textarea name="specifications[{{ $index }}][specs_value]" class="form-control shadow-none" cols="10"
                                                            rows="5" required>{{ $specification->specs_value }}</textarea>
                                                    </td>
                                                    <td style="width: 150px">
                                                        <input type="text" class="form-control shadow-none"
                                                            name="specifications[{{ $index }}][qty]"
                                                            value="{{ $specification->qty }}" required>
                                                    </td>
                                                    <td style="width: 200px">
                                                        <input type="text" class="form-control shadow-none"
                                                            name="specifications[{{ $index }}][purchase_price]"
                                                            value="{{ $specification->purchase_price }}" required>
                                                    </td>
                                                    <td style="width: 200px">
                                                        <input type="text" class="form-control shadow-none"
                                                            name="specifications[{{ $index }}][sale_price]"
                                                            value="{{ $specification->sale_price }}" required>
                                                    </td>
                                                    <td style="width: 200px">
                                                        <select name="specifications[{{ $index }}][status]"
                                                            class="form-control shadow-none" required>
                                                            <option value="">Select Status</option>
                                                            <option value="new"
                                                                {{ $specification->status == 'new' ? 'selected' : '' }}>New</option>
                                                            <option value="second-hand"
                                                                {{ $specification->status == 'second-hand' ? 'selected' : '' }}>Second
                                                                Hand</option>
                                                            <option value="99"
                                                                {{ $specification->status == '99' ? 'selected' : '' }}>99%</option>
                                                        </select>
                                                    </td>
                                                    <td>
                                                        <button type="button" class="btn btn-danger delete-row-btn"><i
                                                                class="bi bi-x-circle"></i></button>
                                                    </td>
                                                </tr>
                                            @endforeach
                                        </tbody>

                                    </table>
                                </div>
                            </div>
                       </div>


                    </div>

                    <div class="mt-3">
                        <button class="btn btn-success kh">រក្សាទុក</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    @include('alerts.message')
    @include('alerts.question')
@endsection

@section('scripts')
    <script>
        //display img
        document.getElementById('imgInput').addEventListener('change', function(event) {
            const imagePreview = document.getElementById('imagePreview');
            const file = event.target.files[0];
            const reader = new FileReader();

            reader.onload = function(e) {
                imagePreview.src = e.target.result; // Set the preview to the uploaded image
            };

            if (file) {
                reader.readAsDataURL(file); // Read the uploaded file and display the preview
            } else {
                // If no file is uploaded, keep the current image as the preview
                imagePreview.src =
                    '{{ $products->image ? asset("storage/assets/img/{$products->image}") : asset('assets/img/box.png') }}';

            }
        });



        document.addEventListener('DOMContentLoaded', () => {
            // Add listeners to all existing rows on page load
            const existingRows = document.querySelectorAll('#specsTableBody tr');
            existingRows.forEach(attachRowEventListeners);

            // Add a new row
            document.getElementById('addRowBtn').addEventListener('click', function() {
                const tableBody = document.getElementById('specsTableBody');
                const rowIndex = tableBody.children.length;

                const newRow = document.createElement('tr');
                newRow.innerHTML = `
            <td>
                <input type="checkbox" name="check" class="row-checkbox">
            </td>
            <td style="width: 200px">
                <input type="text" class="form-control shadow-none" name="specifications[${rowIndex}][product_code]" required>
            </td>
            <td>
                <textarea name="specifications[${rowIndex}][specs_value]" class="form-control shadow-none" cols="10" rows="5" required></textarea>
            </td>
            <td style="width: 150px">
                <input type="text" class="form-control shadow-none" name="specifications[${rowIndex}][qty]" required>
            </td>
            <td style="width: 200px">
                <input type="text" class="form-control shadow-none" name="specifications[${rowIndex}][purchase_price]" required>
            </td>
            <td style="width: 200px">
                <input type="text" class="form-control shadow-none" name="specifications[${rowIndex}][sale_price]" required>
            </td>
            <td style="width: 200px">
                <select name="specifications[${rowIndex}][status]" class="form-control shadow-none" required>
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
            });

            // Attach event listeners for each new or existing row
            function attachRowEventListeners(row) {
                const checkbox = row.querySelector('.row-checkbox');
                const deleteBtn = row.querySelector('.delete-row-btn');

                // Handle individual checkbox change
                if (checkbox) {
                    checkbox.addEventListener('change', updateRemoveAllVisibility);
                }

                // Handle delete button
                if (deleteBtn) {
                    deleteBtn.addEventListener('click', function() {
                        row.remove();
                        updateRemoveAllVisibility();
                    });
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
            });
        });
    </script>


@endsection
