@extends('layouts.app')
@section('page-title', 'ការបន្ថែមការនាំចូល')

@section('content')
    <div class="form-data">
        <div class="card">
            <div class="row">
                <div class="mt-3">
                    <a href="{{ route('purchases.index') }}" class="btn btn-primary kh">ត្រឡប់ក្រោយ</a>
                </div>
            </div>
            <div class="mt-4">
                <p class="title kh">/ ការកំណត់នៃទំនិញ :</p>
            </div>
            <div class="row">
                <div class="col-md-6">
                    <div class="mt-2">
                        <label for="product_id">Product Name :</label>
                        <div class="custom-dropdown">
                            <input type="text" id="product_name" class="form-control shadow-none"
                                placeholder="Select Product" autocomplete="off" required>
                            <ul id="productList" class="dropdown-list">
                                @foreach ($products as $product)
                                    <li data-id="{{ $product->id }}">{{ $product->name }}</li>
                                @endforeach
                            </ul>
                        </div>
                        <input type="hidden" class="shadow-none" id="product_id"
                            value="{{ old('product_id') }}">
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="mt-2">
                        <label for="product_specifications_id">Specifications :</label>
                        <div class="custom-dropdown">
                            <input type="text" id="product_specifications_id" class="form-control shadow-none"
                                placeholder="Select Specs" autocomplete="off" required>
                            <ul id="specsList" class="dropdown-list">
                                @foreach ($specs as $spec)
                                    <li data-id="{{ $spec->id }}">{{ $spec->specs_value }}</li>
                                @endforeach
                            </ul>
                        </div>
                        <input type="hidden" class="shadow-none" id="product_specifications_id"
                            value="{{ old('product_specifications_id') }}">
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-3">
                    <div class="mt-3">
                        <label for="qty">Qty :</label>
                        <input type="number" name="qty" class="form-control shadow-none" id="">
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="mt-3">
                        <label for="purchase_price">Purchase Price :</label>
                        <input type="text" name="purchase_price" class="form-control shadow-none" id="">
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="mt-3">
                        <label for="sale_price">Sale Price :</label>
                        <input type="text" name="sale_price" class="form-control shadow-none" id="">
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="mt-3">
                        <label for="status">Conditions :</label>
                        <select name="status" class="form-control shadow-none" required>
                            <option value="">Select Status</option>
                            <option value="new">New</option>
                            <option value="second hand">Second Hand</option>
                            <option value="99%">99%</option>
                        </select>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-4">
                    <div class="mt-3 d-flex align-items-center">
                        <button type="button" class="btn btn-primary me-1 kh" id="addRow">បន្ថែម
                            Specifications</button>
                        <div id="removeAllContainer" style="display: none;">
                            <button type="button" id="removeAllBtn" class="btn btn-danger me-1">Remove All</button>
                        </div>
                    </div>
                </div>
            </div>
            <form action="{{ route('purchases.store') }}" method="post">
                @csrf
                <div class="mt-4">
                    <p class="title kh">/ ការកំណត់នៃអ្នកផ្គត់ផ្គង់ :</p>
                </div>
                <div class="row">
                    <div class="col-md-3">
                        <div class="mt-3">
                            <label for="suppliers_id">Supplier Name :</label>
                            <select name="suppliers_id" id="suppliers_id" class="form-control shadow-none" required>
                                <option value="">Select Supplier</option>
                                @foreach ($suppliers as $supplier)
                                    <option value="{{ $supplier->id }}"
                                        {{ old('suppliers_id') == $supplier->id ? 'selected' : '' }}>
                                        {{ $supplier->name }}
                                    </option>
                                @endforeach
                            </select>
                            @error('suppliers_id')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="mt-3">
                            <label for="shipping_company">Shipping Company :</label>
                            <input type="text" name="shipping_company"
                                class="form-control shadow-none @error('shipping_company') is-invalid @enderror"
                                value="{{ old('shipping_company') }}" id="">
                            @error('shipping_company')
                                <div class="text-danger">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="mt-3">
                            <label for="shipping_price">Shipping Price :</label>
                            <input type="text" name="shipping_price"
                                class="form-control shadow-none @error('shipping_price') is-invalid @enderror"
                                value="{{ old('shipping_price') }}" id="">
                            @error('shipping_price')
                                <div class="text-danger">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="mt-3">
                            <label for="shipping_status">Shipping Status :</label>
                            <select name="shipping_status" class="form-control shadow-none" required>
                                <option value="">Select Shipping Status</option>
                                <option value="ordered">Ordered</option>
                                <option value="waiting">Waiting</option>
                                <option value="recieved">Recieved</option>
                            </select>
                            @error('shipping_status')
                                <div class="text-danger">{{ $message }}</div>
                            @enderror
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
                                                N.O.
                                            </th>
                                            <th class="kh">ឈ្មោះទំនិញ</th>
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
                                <div class="row">
                                    <div class="col-md-3">
                                        <div class="mt-3">
                                            <label for="total_price">Total Price :</label>
                                            <input type="number" class="form-control shadow-none" name="total_price"
                                                id="total_price" step="0.01" readonly>
                                        </div>
                                        <div class="mt-3">
                                            <label for="paid_price">Paid Price :</label>
                                            <input type="number" class="form-control shadow-none" name="paid_price"
                                                id="paid_price" step="0.01" oninput="updateNotPaidPrice()">
                                        </div>
                                        <div class="mt-3">
                                            <label for="notpaid_price">Not Paid Price :</label>
                                            <input type="number" class="form-control shadow-none" name="notpaid_price"
                                                id="notpaid_price" readonly>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="mt-3">
                    <button type="submit" class="btn btn-success kh">រក្សា​ទុក</button>
                </div>
            </form>
        </div>
    </div>
@endsection
@section('scripts')
<script>
    document.addEventListener('DOMContentLoaded', function () {
        // All specs data
        const allSpecs = @json($specs);

        // Product Dropdown
        const productInput = document.getElementById('product_name');
        const productDropdown = document.getElementById('productList');
        const productHiddenInput = document.getElementById('product_id');

        // Specs Dropdown
        const specsInput = document.getElementById('product_specifications_id');
        const specsDropdown = document.getElementById('specsList');
        const specsHiddenInput = document.getElementById('product_specifications_id'); // Hidden input for specs_value

        const purchasePriceInput = document.querySelector('input[name="purchase_price"]');
        const salePriceInput = document.querySelector('input[name="sale_price"]');
        const conditionSelect = document.querySelector('select[name="status"]');

        const qtyInput = document.querySelector('input[name="qty"]');
        const shippingPriceInput = document.querySelector('input[name="shipping_price"]');
        const paidPriceInput = document.querySelector('input[name="paid_price"]');

        const specsTableBody = document.getElementById('specsTableBody');

        // Function to update specs based on selected product
        const updateSpecs = (productId) => {
            specsDropdown.innerHTML = ''; // Clear previous list
            const filteredSpecs = productId ?
                allSpecs.filter(spec => spec.product_id == productId) :
                allSpecs; // Show all specs if no product is selected

            // Populate dropdown with filtered specs
            filteredSpecs.forEach(spec => {
                const li = document.createElement('li');
                li.textContent = spec.specs_value; // Display specs_value in the dropdown
                li.setAttribute('data-id', spec.id);
                li.setAttribute('data-purchase-price', spec.purchase_price);
                li.setAttribute('data-sale-price', spec.sale_price);
                li.setAttribute('data-condition', spec.conditions); // Store product_specifications_id in data-id attribute
                specsDropdown.appendChild(li);
            });
        };

        const updateFields = (spec) => {
            const purchasePrice = spec.getAttribute('data-purchase-price');
            const salePrice = spec.getAttribute('data-sale-price');
            const condition = spec.getAttribute('data-condition');

            // Set values in input fields
            purchasePriceInput.value = purchasePrice || '';
            salePriceInput.value = salePrice || '';

            // Update condition dropdown
            if (conditionSelect) {
                Array.from(conditionSelect.options).forEach(option => {
                    option.selected = option.value === condition;
                });
            }
        };

        // Show dropdown on input focus for Product
        productInput.addEventListener('focus', () => {
            productDropdown.style.display = 'block';
        });

        // Filter the product list
        productInput.addEventListener('input', function() {
            const filter = this.value.toLowerCase();
            Array.from(productDropdown.children).forEach(item => {
                const text = item.textContent.toLowerCase();
                item.style.display = text.includes(filter) ? 'block' : 'none';
            });
        });

        // Handle selecting a product
        productDropdown.addEventListener('click', function(e) {
            if (e.target.tagName === 'LI') {
                productInput.value = e.target.textContent;
                productHiddenInput.value = e.target.getAttribute('data-id');
                productDropdown.style.display = 'none';
                updateSpecs(productHiddenInput.value); // Update specs for selected product
            }
        });

        // Handle clearing the product selection (clear the input or reset)
        productInput.addEventListener('input', function() {
            if (productInput.value === '') {
                // If product input is cleared, show all specs
                productHiddenInput.value = ''; // Clear the product ID
                updateSpecs(); // Show all specs
            }
        });

        // Show dropdown on input focus for Specs
        specsInput.addEventListener('focus', () => {
            specsDropdown.style.display = 'block';
        });

        // Filter the specs list
        specsInput.addEventListener('input', function() {
            const filter = this.value.toLowerCase();
            Array.from(specsDropdown.children).forEach(item => {
                const text = item.textContent.toLowerCase();
                item.style.display = text.includes(filter) ? 'block' : 'none';
            });
        });

        // Handle selecting a spec and store specs_value in the hidden input
        specsDropdown.addEventListener('click', function(e) {
            if (e.target.tagName === 'LI') {
                const selectedSpec = e.target;
                specsInput.value = selectedSpec.textContent; // Display specs_value in the input field
                specsHiddenInput.value = selectedSpec.textContent; // Store specs_value in the hidden input
                specsDropdown.style.display = 'none'; // Close the dropdown

                if (productHiddenInput.value && specsHiddenInput.value) {
                    updateFields(selectedSpec);
                }
            }
        });

        // Add Row Functionality
        const addRowButton = document.getElementById('addRow');
        addRowButton.addEventListener('click', () => {
            const productName = productInput.value;
            const specsValue = specsInput.value;
            const qty = parseInt(qtyInput.value);
            const purchasePrice = parseFloat(purchasePriceInput.value);
            const salePrice = parseFloat(salePriceInput.value);
            const condition = conditionSelect.value;

            if (!productName || !specsValue || !qty || !purchasePrice || !salePrice || !condition) {
                alert('Please fill all the fields before adding the row.');
                return;
            }

            // Check if the row already exists with the same product, specs, price, and condition
            let existingRow = null;
            Array.from(specsTableBody.rows).forEach(row => {
                const existingProductName = row.cells[1].querySelector('input').value;
                const existingSpecsValue = row.cells[2].querySelector('textarea').value; // Updated to textarea
                const existingPurchasePrice = parseFloat(row.cells[4].querySelector('input').value);
                const existingSalePrice = parseFloat(row.cells[5].querySelector('input').value);
                const existingCondition = row.cells[6].querySelector('input').value;

                if (existingProductName === productName && existingSpecsValue === specsValue && existingPurchasePrice === purchasePrice && existingSalePrice === salePrice && existingCondition === condition) {
                    existingRow = row;
                    const existingQty = parseInt(existingRow.cells[3].querySelector('input').value);
                    existingRow.cells[3].querySelector('input').value = existingQty + qty; // Sum the quantities
                }
            });

            // If no existing row, create a new row
            if (!existingRow) {
                const newRow = document.createElement('tr');
                newRow.innerHTML = `
                    <td><input type="checkbox" class="checkbox-item"></td>
                    <td><input type="text" name="product_names[]" value="${productName}" readonly></td>
                    <td><textarea name="specs_value[]" readonly>${specsValue}</textarea></td> <!-- Updated to textarea -->
                    <td><input  name="qty[]" type="number" value="${qty}" class="qty-input"></td>
                    <td><input name="purchase_price[]" type="number" value="${purchasePrice}" class="purchase-price-input" step="0.01"></td>
                    <td><input name="sale_price[]" type="number" value="${salePrice}" class="sale-price-input" step="0.01"></td>
                    <td><input name="status[]" type="text" value="${condition}" readonly></td>
                    <td>
                        <button type="button" class="btn btn-danger remove-row">Remove</button>
                    </td>
                `;
                specsTableBody.appendChild(newRow);
            }

            // Clear inputs after adding row
            productInput.value = '';
            specsInput.value = '';
            qtyInput.value = '';
            purchasePriceInput.value = '';
            salePriceInput.value = '';
            conditionSelect.value = '';

            // Update total price
            updateTotalPrice();
            updateFields();
            updateSpecs();
        });

        // Remove Row Functionality
        specsTableBody.addEventListener('click', function(e) {
            if (e.target && e.target.classList.contains('remove-row')) {
                e.target.closest('tr').remove();
                updateTotalPrice();
            }
        });

        // Real-time update of the total price, including shipping and paid price
        const updateTotalPrice = () => {
            let total = 0;
            document.querySelectorAll('#specsTableBody tr').forEach(row => {
                const qty = parseInt(row.cells[3].querySelector('input').value);
                const purchasePrice = parseFloat(row.cells[4].querySelector('input').value);
                total += qty * purchasePrice;
            });

            // Get shipping price and add it to total
            const shippingPrice = parseFloat(shippingPriceInput.value) || 0;
            total += shippingPrice;

            document.getElementById('total_price').value = total.toFixed(2);
            updateNotPaidPrice();
        };

        // Real-time update of the not paid price
        const updateNotPaidPrice = () => {
            const totalPrice = parseFloat(document.getElementById('total_price').value) || 0;
            const paidPrice = parseFloat(paidPriceInput.value) || 0;
            const notPaidPrice = totalPrice - paidPrice;
            document.getElementById('notpaid_price').value = notPaidPrice.toFixed(2);
        };

        // Shipping price real-time update
        shippingPriceInput.addEventListener('input', updateTotalPrice);

        // Paid price real-time update
        paidPriceInput.addEventListener('input', updateNotPaidPrice);

        // Quantity change to update total price
        specsTableBody.addEventListener('input', function(e) {
            if (e.target && e.target.classList.contains('qty-input')) {
                updateTotalPrice();
            }
        });
    });
</script>
@endsection

