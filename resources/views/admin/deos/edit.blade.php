@extends('layouts.admin')

@section('content')
<div class="container-fluid">

    <div class="card">
        <div class="card-header">
            <h5>Edit DEO</h5>
        </div>

        <form action="{{ route('admin.deos.update', $deo->id) }}" method="POST">
            @csrf
            @method('PUT')

            <div class="card-body">

                <div class="mb-3">
                    <label class="form-label">Name</label>
                    <input type="text" name="name"
                        class="form-control"
                        value="{{ old('name', $deo->name) }}">
                </div>

                <div class="mb-3">
                    <label class="form-label">Email</label>
                    <input type="email" name="email"
                        class="form-control"
                        value="{{ old('email', $deo->email) }}">
                </div>

                <div class="mb-3">
                    <label class="form-label">Area Operator</label>
                    <select name="area_operator_id" class="form-select">
                        <option value="">-- Select --</option>
                        @foreach($areaOperators as $operator)
                            <option value="{{ $operator->id }}"
                                @selected($deo->area_operator_id == $operator->id)>
                                {{ $operator->name }}
                            </option>
                        @endforeach
                    </select>
                </div>

            </div>

            <div class="card-footer text-end">
                <a href="{{ route('admin.deos') }}" class="btn btn-secondary">
                    Back
                </a>
                <button type="submit" class="btn btn-primary">
                    Update
                </button>
            </div>
        </form>
    </div>

</div>
@endsection
