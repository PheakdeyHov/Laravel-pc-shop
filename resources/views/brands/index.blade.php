
@extends('layouts.app')

@section('page-title', 'ម៉ាកទំនិញ')

@section('content')
    <div class="form-data">
        <div class="card">
            <div class="row">
                <div class="col-md-9 d-flex align-items-center">
                    <a href="{{ route('brands.create') }}" class="btn btn-primary me-1"><i
                            class="bi bi-plus-square"></i></a>
                    <a href="" class="btn btn-primary me-1"><i class="bi bi-file-earmark-arrow-up"></i></a>
                    <div class="search-input me-1">
                        <form action="{{ route('brands.search') }}" method="GET" id="searchForm">
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
                        <thead class="">
                            <tr>
                                <th>ID</th>
                                <th>Name</th>
                                <th class="text-center">Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            @if ($brands->isEmpty())
                                <tr>
                                    <td colspan="3" class="text-center">No brands found</td>
                                </tr>
                            @else
                                @foreach ($brands as $brand)
                                    <tr>
                                        <td>{{ $brand->id }}</td>
                                        <td>{{ $brand->name }}</td>
                                        <td class="text-center">
                                            <form id="delete-form-{{ $brand->id }}" action="{{ route('brands.destroy', $brand->id) }}" method="POST">
                                                @csrf
                                                @method('DELETE')
                                                <a href="{{ route('brands.edit', $brand->id) }}" class="btn btn-success"><i class="bi bi-pencil-square"></i></a>
                                                <button type="button" class="btn btn-danger" onclick="confirmDelete({{ $brand->id }})"><i class="bi bi-trash"></i></button>
                                            </form>
                                        </td>
                                    </tr>
                                @endforeach
                            @endif
                        </tbody>
                    </table>
                </div>

                <div class="pagination-container">
                    {{ $brands->appends(['name' => request('name', $searchTerm ?? '')])->links('pagination::bootstrap-5') }}
                </div>

            </div>
        </div>
    </div>

    @include('alerts.message')
    @include('alerts.question')
@endsection


@section('scripts')
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>

    $('#searchInput').on('input', function() {
        const searchTerm = $(this).val();

        // Prevent default form submission and keep the cursor in the input
        if (searchTerm.length >= 0) {
            fetch(`{{ route('brands.search') }}?name=${searchTerm}`, {
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
