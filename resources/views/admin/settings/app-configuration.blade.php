@extends('layouts.admin')

@section('title','App Configuration')

@section('content')
<div class="container-fluid">

<h4 class="mb-3">App Configuration</h4>

<form id="settingsForm">
@csrf

<div class="card mb-3">
<div class="card-header">System Configuration</div>
<div class="card-body">

<div class="row">
    <div class="col-md-4 mb-3">
        <label>App Version</label>
        <input type="text" class="form-control"
               name="app_version"
               value="{{ $settings['app_version'] ?? '1.0.0' }}">
    </div>

    <div class="col-md-4 mb-3">
        <label>API Rate Limit</label>
        <input type="number" class="form-control"
               name="api_rate_limit"
               value="{{ $settings['api_rate_limit'] ?? 60 }}">
    </div>

    <div class="col-md-4 mb-3">
        <label>Session Timeout (mins)</label>
        <input type="number" class="form-control"
               name="session_timeout"
               value="{{ $settings['session_timeout'] ?? 30 }}">
    </div>
</div>

<hr>

<div class="form-check form-switch mb-2">
    <input class="form-check-input" type="checkbox"
           name="enable_cache" value="1"
           {{ isset($settings['enable_cache']) ? 'checked' : '' }}>
    <label class="form-check-label">Enable Cache</label>
</div>

<div class="form-check form-switch mb-2">
    <input class="form-check-input" type="checkbox"
           name="debug_mode" value="1"
           {{ isset($settings['debug_mode']) ? 'checked' : '' }}>
    <label class="form-check-label">Debug Mode</label>
</div>

<div class="form-check form-switch">
    <input class="form-check-input" type="checkbox"
           name="allow_registration" value="1"
           {{ isset($settings['allow_registration']) ? 'checked' : '' }}>
    <label class="form-check-label">Allow User Registration</label>
</div>

</div>
</div>

<button class="btn btn-primary">
<i class="ri-save-line"></i> Save Configuration
</button>

</form>
</div>
@endsection

@include('admin.settings._ajax-save')
