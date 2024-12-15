@extends('layouts.app')
@section('page-title','ការបន្ថែមអ្នកផ្គត់ផ្គង់')
@section('content')
<div class="form-data">
    <div class="card">
        <div class="row">
            <div class="mt-3">
                <a href="{{ route('suppliers.index') }}" class="kh btn btn-primary">ត្រឡប់ក្រោយ</a>
            </div>
        </div>
        <form action="{{ route('suppliers.store') }}" method="POST">
            @csrf
            <div class="row">
                <div class="col-md-6">
                    <div class="mt-3">
                        <label for="name">Supplier Name :</label>
                        <input type="text" name="name" class="form-control shadow-none @error('name') is-invalid @enderror" value="{{ old('name') }}" id="">
                        @error('name')
                            <div class="text-danger">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="mt-3">
                        <label for="email">Email :</label>
                        <input type="text" name="email" class="form-control shadow-none @error('email') is-invalid @enderror" value="{{ old('email') }}" id="">
                        @error('email')
                            <div class="text-danger">{{ $message }}</div>
                        @enderror
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="mt-3">
                        <label for="name">Phonenumber :</label>
                        <input type="text" name="phonenumber" class="form-control shadow-none @error('phonenumber') is-invalid @enderror" value="{{ old('phonenumber') }}" id="" pattern="[0-9]*" oninput="this.value = this.value.replace(/[^0-9]/g, '');>
                        @error('phonenumber')
                            <div class="text-danger">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="mt-3">
                        <label for="address">Address :</label>
                        <textarea name="address" class="form-control shadow-none @error('address') is-invalid @enderror" id="" cols="30" rows="10">
                            {{ old('address') }}
                        </textarea>
                        @error('address')
                            <div class="text-danger">{{ $message }}</div>
                        @enderror
                    </div>
                </div>
            </div>


            <div class="mt-3">
                <button class="btn btn-success kh">រក្សាទុក</button>
            </div>
        </form>
    </div>
</div>
@endsection
