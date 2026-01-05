@extends('layouts.admin')

@section('title','Notification Settings')

@section('content')
<div class="container-fluid">

<h4 class="mb-3">Notification Settings</h4>

<form id="settingsForm">
@csrf

<div class="card mb-3">
<div class="card-header">Email Notifications</div>
<div class="card-body">

<div class="form-check form-switch mb-2">
    <input class="form-check-input" type="checkbox"
           name="email_notifications" value="1"
           {{ isset($settings['email_notifications']) ? 'checked' : '' }}>
    <label>Email Notifications</label>
</div>

<div class="form-check form-switch mb-2">
    <input class="form-check-input" type="checkbox"
           name="login_alerts" value="1"
           {{ isset($settings['login_alerts']) ? 'checked' : '' }}>
    <label>Login Alerts</label>
</div>

<div class="form-check form-switch">
    <input class="form-check-input" type="checkbox"
           name="weekly_reports" value="1"
           {{ isset($settings['weekly_reports']) ? 'checked' : '' }}>
    <label>Weekly Reports</label>
</div>

</div>
</div>

<div class="card mb-3">
<div class="card-header">SMS / Push</div>
<div class="card-body">

<div class="form-check form-switch mb-2">
    <input class="form-check-input" type="checkbox"
           name="sms_notifications" value="1"
           {{ isset($settings['sms_notifications']) ? 'checked' : '' }}>
    <label>SMS Notifications</label>
</div>

<div class="form-check form-switch">
    <input class="form-check-input" type="checkbox"
           name="push_notifications" value="1"
           {{ isset($settings['push_notifications']) ? 'checked' : '' }}>
    <label>Push Notifications</label>
</div>

</div>
</div>

<button class="btn btn-primary">
<i class="ri-save-line"></i> Save Notification Settings
</button>

</form>
</div>
@endsection

@include('admin.settings._ajax-save')
