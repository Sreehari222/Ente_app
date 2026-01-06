@push('scripts')
<script>
document.getElementById('settingsForm').addEventListener('submit', function(e){
    e.preventDefault();

    fetch("{{ route('admin.store') }}", {
        method: "POST",
        headers: {
            'X-CSRF-TOKEN': '{{ csrf_token() }}'
        },
        body: new FormData(this)
    })
    .then(r => r.json())
    .then(res => {
        alert(res.message);
    });
});
</script>
@endpush
