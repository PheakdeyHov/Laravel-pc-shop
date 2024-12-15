@extends('layouts.app')

@section('page-title', 'ការបន្ថែមប្រភេទទំនិញ')

@section('content')
    <div class="form-data">
        <div class="card">
            <div class="row">
                <div class="mt-3">
                    <a href="{{ route('categories.index') }}" class="btn btn-primary kh">ត្រឡប់ក្រោយ</a>
                </div>
                <form action="{{ route('categories.store') }}" method="POST">
                    @csrf
                    <div class="mt-3">
                        <label for="name">Category Name :</label>
                        <input type="text" name="name" class="form-control shadow-none @error('name') is-invalid @enderror" value="{{ old('name') }}" id="">
                        @error('name')
                            <div class="text-danger">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="mt-3">
                        <button class="btn btn-success btn-sm kh" type="submit">រក្សាទុក</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection
