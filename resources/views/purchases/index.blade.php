
@extends('layouts.app')

@section('page-title', 'ការនាំចូល')

@section('content')
    <div class="form-data">
        <div class="card">
            <div class="row">
                <div class="col-md-9 d-flex align-items-center">
                    <a href="{{ route('purchases.create') }}" class="btn btn-primary me-1"><i
                            class="bi bi-plus-square"></i></a>
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
                        <thead class="">
                            <tr>
                                <th>ID</th>
                                <th>Supplier</th>
                                <th class="text-center">Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            @if ($purchases->isEmpty())
                                <tr>
                                    <td colspan="3" class="text-center">No purchases found</td>
                                </tr>
                            @else
                                @foreach ($purchases as $purchase)
                                    <tr>
                                        <td>{{ $purchase->id }}</td>
                                        <td>{{ $purchase->suppliers->name }}</td>
                                    </tr>
                                @endforeach
                            @endif
                        </tbody>
                    </table>
                </div>

                <div class="pagination-container">
                    {{ $purchases->appends(['name' => request('name', $searchTerm ?? '')])->links('pagination::bootstrap-5') }}
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



</script>
@endsection
