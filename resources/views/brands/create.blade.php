@extends('layouts.app')
@section('page-title','ការបន្ថែមម៉ាកទំនិញ')
@section('content')
<div class="form-data">
    <div class="card">
        <div class="row">
            <div class="col-md-5">
                <a href="{{ route('brands.index') }}" class="kh btn btn-primary">ត្រឡប់ក្រោយ</a>
            </div>
        </div>
        <div class="row">
            <form action="{{ route('brands.store') }}" method="POST">
                @csrf
                <div class="mt-3">
                    <label for="name">Brand Name :</label>
                    <input type="text" name="name" class="form-control shadow-none @error('name') is-invalid @enderror" value="{{ old('name') }}" id="">
                    @error('name')
                        <div class="text-danger">{{ $message }}</div>
                    @enderror
                </div>
                <div class="mt-3">
                    <button class="btn btn-success kh">រក្សាទុក</button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection
