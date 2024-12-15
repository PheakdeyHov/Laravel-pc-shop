@extends('layouts.app')
@section('page-title','ការកែប្រែប្រភេទទំនិញ')
@section('content')
<div class="form-data">
    <div class="card">
        <div class="row">
            <div class="col-md-5">
                <a href="{{ route('categories.index') }}" class="kh btn btn-primary">ត្រឡប់ក្រោយ</a>
            </div>
        </div>
        <div class="row">
            <form action="{{ route('categories.update' , $categories->id) }}" method="POST">
                @csrf
                @method('PUT')
                <div class="mt-3">
                    <label for="name">Category Name :</label>
                    <input type="text" name="name" class="form-control shadow-none @error('name') is-invalid @enderror" value="{{ $categories->name }}" id="">
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
