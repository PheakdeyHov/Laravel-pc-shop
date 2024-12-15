
@extends('layouts.app')

@section('page-title', 'ទិន្នន័យអ្នកផ្គត់ផ្គង់')

@section('content')
    <div class="form-data">
        <div class="card">
            <div class="row">
                <div class="col-md-9 d-flex align-items-center">
                    <a href="{{ route('suppliers.create') }}" class="btn btn-primary me-1"><i class="bi bi-plus-square"></i></a>
                    <a href="" class="btn btn-primary me-1"><i class="bi bi-file-earmark-arrow-up"></i></a>
                    <div class="search-input me-1">
                        <form action="" method="GET" id="searchForm">
                            <div class="form-group">
                                <input type="text" id="searchInput" value="{{ request('name', $searchTerm ?? '') }}"
                                       name="name" placeholder="Search..." class="form-control">
                                <i class="bi bi-search"></i>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
            <div class="row mt-3">
                <div class="searchTable table-responsive">
                    <table class="table" id="searchTable">
                        <thead>
                            <tr>
                                <th>ID</th>
                                <th>Name</th>
                                <th>Address</th>
                                <th>Email</th>
                                <th>Phonenumber</th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            @if ($suppliers->isEmpty())
                                <tr>
                                    <td colspan="6" class="text-center">No suppliers found</td>
                                </tr>
                            @else
                                @foreach ($suppliers as $supplier)
                                    <tr>
                                        <td>{{ $supplier->id }}</td>
                                        <td>{{ $supplier->name }}</td>
                                        <td>{{ $supplier->address }}</td>
                                        <td>{{ $supplier->email }}</td>
                                        <td>{{ $supplier->phonenumber }}</td>
                                        <td>
                                            <form id="delete-form-{{ $supplier->id }}" action="{{ route('suppliers.destroy', $supplier->id) }}" method="POST">
                                                @csrf
                                                @method('DELETE')
                                                <a href="{{ route('suppliers.edit', $supplier->id) }}" class="btn btn-success"><i class="bi bi-pencil-square"></i></a>
                                                <button type="button" class="btn btn-danger" onclick="confirmDelete({{ $supplier->id }})"><i class="bi bi-trash"></i></button>
                                            </form>
                                        </td>
                                    </tr>
                                @endforeach
                            @endif
                        </tbody>
                    </table>
                </div>
                <div class="pagination-container">
                    {{ $suppliers->appends(['name' => request('name', $searchTerm ?? '')])->links('pagination::bootstrap-5') }}
                </div>
            </div>
        </div>
    </div>

    @include('alerts.message')
    @include('alerts.question')
@endsection


@section('scripts')
<script>

    $('#searchInput').on('input', function() {
        const searchTerm = $(this).val();

        // Prevent default form submission and keep the cursor in the input
        if (searchTerm.length >= 0) {
            fetch(`{{ route('suppliers.search') }}?name=${searchTerm}`, {
                method: 'GET',
                headers: {
                    'X-Requested-With': 'XMLHttpRequest', // Indicate this is an AJAX request
                },
            })
            .then(response => response.text())
            .then(data => {
                // Update the category table with the fetched data
                $('#searchTable').html($(data).find('#searchTable').html());
            })
            .catch(error => console.error('Error:', error));
        }
    });

</script>
@endsection
