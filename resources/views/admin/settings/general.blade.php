@extends('layouts.admin')

@section('title', 'General Settings')

@section('content')
<div class="container-fluid">

    <div class="row mb-3">
        <div class="col-12 d-flex justify-content-between align-items-center">
            <div>
                <h4 class="fw-semibold mb-0">General Settings</h4>
                <small class="text-muted">Application & system preferences</small>
            </div>
            <span class="badge bg-info">System Config</span>
        </div>
    </div>

    <form id="settingsForm" enctype="multipart/form-data">
        @csrf

        <div class="row">

            <!-- LEFT PANEL -->
            <div class="col-lg-8">

                <!-- Application Settings -->
                <div class="card mb-3">
                    <div class="card-header">
                        <h6 class="mb-0">Application Settings</h6>
                    </div>
                    <div class="card-body">

                        <div class="row">
                            <div class="col-md-6 mb-3">
                                <label>Application Name</label>
                                <input type="text" class="form-control"
                                       name="app_name"
                                       value="{{ $settings['app_name'] ?? config('app.name') }}">
                            </div>

                            <div class="col-md-6 mb-3">
                                <label>Application URL</label>
                                <input type="url" class="form-control"
                                       name="app_url"
                                       value="{{ $settings['app_url'] ?? config('app.url') }}">
                            </div>

                            <div class="col-md-6 mb-3">
                                <label>Support Email</label>
                                <input type="email" class="form-control"
                                       name="support_email"
                                       value="{{ $settings['support_email'] ?? '' }}">
                            </div>

                            <div class="col-md-6 mb-3">
                                <label>Support Phone</label>
                                <input type="text" class="form-control"
                                       name="support_phone"
                                       value="{{ $settings['support_phone'] ?? '' }}">
                            </div>
                        </div>

                    </div>
                </div>

                <!-- Localization -->
                <div class="card mb-3">
                    <div class="card-header"><h6 class="mb-0">Localization</h6></div>
                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-4 mb-3">
                                <label>Timezone</label>
                                <select class="form-select" name="timezone">
                                    <option value="Asia/Kolkata" @selected(($settings['timezone'] ?? '')=='Asia/Kolkata')>Asia/Kolkata</option>
                                    <option value="UTC" @selected(($settings['timezone'] ?? '')=='UTC')>UTC</option>
                                </select>
                            </div>

                            <div class="col-md-4 mb-3">
                                <label>Date Format</label>
                                <select class="form-select" name="date_format">
                                    <option value="d-m-Y" @selected(($settings['date_format'] ?? '')=='d-m-Y')>DD-MM-YYYY</option>
                                    <option value="Y-m-d" @selected(($settings['date_format'] ?? '')=='Y-m-d')>YYYY-MM-DD</option>
                                </select>
                            </div>

                            <div class="col-md-4 mb-3">
                                <label>Language</label>
                                <select class="form-select" name="language">
                                    <option value="English">English</option>
                                    <option value="Malayalam">Malayalam</option>
                                    <option value="Hindi">Hindi</option>
                                </select>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Security -->
                <div class="card mb-3">
                    <div class="card-header"><h6 class="mb-0">Security</h6></div>
                    <div class="card-body">

                        <div class="form-check form-switch mb-2">
                            <input class="form-check-input" type="checkbox"
                                   name="maintenance_mode" value="1"
                                   {{ isset($settings['maintenance_mode']) ? 'checked' : '' }}>
                            <label class="form-check-label">Enable Maintenance Mode</label>
                        </div>

                        <div class="form-check form-switch mb-2">
                            <input class="form-check-input" type="checkbox"
                                   name="force_https" value="1"
                                   {{ isset($settings['force_https']) ? 'checked' : '' }}>
                            <label class="form-check-label">Force HTTPS</label>
                        </div>

                        <div class="form-check form-switch">
                            <input class="form-check-input" type="checkbox"
                                   name="login_alerts" value="1"
                                   {{ isset($settings['login_alerts']) ? 'checked' : '' }}>
                            <label class="form-check-label">Send Login Alerts</label>
                        </div>

                    </div>
                </div>

            </div>

            <!-- RIGHT PANEL -->
            <div class="col-lg-4">

                <div class="card mb-3">
                    <div class="card-header"><h6 class="mb-0">Branding</h6></div>
                    <div class="card-body">

                        <div class="mb-3">
                            <label>Logo</label>
                            <input type="file" name="logo" class="form-control">
                            @isset($settings['logo'])
                                <img src="{{ asset('storage/'.$settings['logo']) }}" class="mt-2" height="40">
                            @endisset
                        </div>

                        <div class="mb-3">
                            <label>Favicon</label>
                            <input type="file" name="favicon" class="form-control">
                        </div>

                    </div>
                </div>

                <div class="card bg-light">
                    <div class="card-body">
                        <h6>System Info</h6>
                        <ul class="list-unstyled small mb-0">
                            <li>Laravel: {{ app()->version() }}</li>
                            <li>PHP: {{ phpversion() }}</li>
                            <li>ENV: {{ config('app.env') }}</li>
                        </ul>
                    </div>
                </div>

            </div>
        </div>

        <div class="text-end mt-3">
            <button class="btn btn-primary px-4">
                <i class="ri-save-line"></i> Save Settings
            </button>
        </div>

    </form>

    <!-- Toast -->
    <div class="toast-container position-fixed top-0 end-0 p-3">
        <div id="settingsToast" class="toast">
            <div class="toast-body"></div>
        </div>
    </div>

</div>
@endsection

@push('scripts')
<script>
document.getElementById('settingsForm').addEventListener('submit', function(e){
    e.preventDefault();

    let formData = new FormData(this);

    fetch("{{ route('admin.settings.general.store') }}", {
        method: "POST",
        headers: {
            'X-CSRF-TOKEN': '{{ csrf_token() }}'
        },
        body: formData
    })
    .then(res => res.json())
    .then(res => {
        let toastEl = document.getElementById('settingsToast');
        toastEl.querySelector('.toast-body').innerText = res.message;
        new bootstrap.Toast(toastEl).show();
    });
});
</script>
@endpush
