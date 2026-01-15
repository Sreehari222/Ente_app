@extends(auth()->user()->role === 'salesman' ? 'layouts.salesman' : (auth()->user()->role === 'deo' ? 'layouts.deo' : 'layouts.area_operator'))


@section('content')
    <div class="container">
        <h1>Create Task</h1>

        @if ($errors->any())
            <div class="alert alert-danger">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form action="{{ route('tasks.store') }}" method="POST">
            @csrf

            <div class="mb-3">
                <label>Title</label>
                <input type="text" name="title" class="form-control" required>
            </div>

            <div class="mb-3">
                <label>Description</label>
                <textarea name="description" class="form-control"></textarea>
            </div>

            <div class="mb-3">
                <label>Priority</label>
                <select name="priority" class="form-control">
                    <option value="low">Low</option>
                    <option value="medium" selected>Medium</option>
                    <option value="high">High</option>
                </select>
            </div>

            <div class="mb-3">
                <label>Assign DEO</label>
                <select name="deo_id" id="deo_select" class="form-control">
                    <option value="">-- Select DEO --</option>
                    @foreach ($deos as $deo)
                        <option value="{{ $deo->id }}">{{ $deo->name }}</option>
                    @endforeach
                </select>
            </div>

            <div class="mb-3">
                <label>Assign Salesman</label>
                <select name="salesman_id" id="salesman_select" class="form-control">
                    <option value="">-- Select Salesman --</option>
                    <!-- Salesmen will be filled dynamically -->
                </select>
            </div>


            <button type="submit" class="btn btn-success">Create Task</button>
        </form>
    </div>
    @section('scripts')
<script>
document.getElementById('deo_select').addEventListener('change', function() {
    const deoId = this.value;
    const salesmanSelect = document.getElementById('salesman_select');

    // Clear existing options
    salesmanSelect.innerHTML = '<option value="">-- Select Salesman --</option>';

    if(deoId) {
        fetch(`/deos/${deoId}/salesmen`)
            .then(response => response.json())
            .then(data => {
                data.forEach(salesman => {
                    const option = document.createElement('option');
                    option.value = salesman.id;
                    option.textContent = salesman.name;
                    salesmanSelect.appendChild(option);
                });
            });
    }
});
</script>
@endsection

@endsection
