@extends('layouts.area_operator')

@section('title', 'Edit Salesman')

@section('content')
    <div class="container-fluid">



        {{-- Success Message --}}
        @if (session('success'))
            <div class="alert alert-success">{{ session('success') }}</div>
        @endif

        {{-- Edit Form --}}
        <form action="{{ route('area.salesmen.update', ['salesman' => $salesman->id]) }}" method="POST">
            @csrf
            @method('PUT')

            <!-- Name -->
            <div class="mb-3">
                <label class="form-label">Name</label>
                <input type="text" name="name" value="{{ old('name', $salesman->name) }}" class="form-control" required>
            </div>

            <!-- Email -->
            <div class="mb-3">
                <label class="form-label">Email</label>
                <input type="email" name="email" value="{{ old('email', $salesman->email) }}" class="form-control"
                    required>
            </div>

            <!-- Phone -->
            <div class="mb-3">
                <label class="form-label">Phone</label>
                <input type="text" name="phone_number" value="{{ old('phone_number', $salesman->phone_number) }}"
                    class="form-control">
            </div>

            <!-- Address -->
            <div class="mb-3">
                <label class="form-label">Address</label>
                <input type="text" name="address" value="{{ old('address', $salesman->address) }}" class="form-control">
            </div>

            <button type="submit" class="btn btn-primary">Update Salesman</button>
        </form>

    </div>
@endsection
