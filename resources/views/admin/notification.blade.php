@extends('layouts.admin')

@php
    $notificationSettings = (object) [
        'otp_enabled' => true,
        'otp_provider' => 'Twilio',
        'otp_api_key' => 'your_twilio_api_key',
        'otp_from_number' => '+1234567890',
        'otp_expiry' => 5,
        'otp_template' => 'Your OTP is {otp}. It expires in {expiry} minutes. Do not share it.',
        'sms_enabled' => true,
        'sms_provider' => 'Twilio',
        'sms_api_key' => 'your_sms_api_key',
        'sms_from_number' => '+1234567890',
        'sms_rate_limit' => 100,
        'sms_template' => 'Welcome to Panchayath Connect! Your account is now active.',
        'push_enabled' => true,
        'push_provider' => 'FCM (Firebase)',
        'push_server_key' => 'your_fcm_server_key',
        'android_sender_id' => '123456789012',
        'ios_cert_path' => '/path/to/apns-cert.p12',
        'push_template' => 'New update available in Panchayath Connect! Check it out now.',
    ];
@endphp

@section('content')
    {{-- Page Title --}}
    <div class="row">
        <div class="col-12">
            <div class="page-title-box d-sm-flex align-items-center justify-content-between bg-galaxy-transparent">
                <h4 class="mb-sm-0">Notification Settings</h4>
                <div class="page-title-right">
                    <ol class="breadcrumb m-0">
                        <li class="breadcrumb-item"><a href="">Profile & Settings</a></li>
                        <li class="breadcrumb-item active">Notification Settings</li>
                    </ol>
                </div>
            </div>
        </div>
    </div>

    {{-- Flash Messages --}}
    @if (session('success'))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            {{ session('success') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
        </div>
    @endif

    {{-- Notification Settings Sections --}}
    <div class="row">
        <div class="col-xl-8">
            {{-- OTP Settings --}}
            <div class="card mb-4">
                <div class="card-header align-items-center d-flex">
                    <h4 class="card-title mb-0 flex-grow-1">OTP Settings</h4>
                    <div class="flex-shrink-0">
                        <div class="form-check form-switch form-switch-md">
                            <input class="form-check-input" type="checkbox" id="otpEnabled" name="otp_enabled" {{ old('otp_enabled', $notificationSettings->otp_enabled) ? 'checked' : '' }}>
                            <label class="form-check-label" for="otpEnabled">Enable OTP</label>
                        </div>
                    </div>
                </div>
                <div class="card-body">
                    <form action="" method="POST">
                        @csrf @method('PUT')
                        <div class="row">
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label for="otpProvider" class="form-label">OTP Provider</label>
                                    <select class="form-select @error('otp_provider') is-invalid @enderror" id="otpProvider" name="otp_provider">
                                        <option {{ old('otp_provider', $notificationSettings->otp_provider) == 'Twilio' ? 'selected' : '' }}>Twilio</option>
                                        <option {{ old('otp_provider', $notificationSettings->otp_provider) == 'Nexmo' ? 'selected' : '' }}>Nexmo</option>
                                        <option {{ old('otp_provider', $notificationSettings->otp_provider) == 'MessageBird' ? 'selected' : '' }}>MessageBird</option>
                                    </select>
                                    @error('otp_provider')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label for="otpApiKey" class="form-label">API Key</label>
                                    <input type="password" class="form-control @error('otp_api_key') is-invalid @enderror" id="otpApiKey" name="otp_api_key" value="{{ old('otp_api_key', $notificationSettings->otp_api_key) }}">
                                    @error('otp_api_key')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label for="otpFromNumber" class="form-label">From Number</label>
                                    <input type="text" class="form-control @error('otp_from_number') is-invalid @enderror" id="otpFromNumber" name="otp_from_number" value="{{ old('otp_from_number', $notificationSettings->otp_from_number) }}">
                                    @error('otp_from_number')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label for="otpExpiry" class="form-label">OTP Expiry (minutes)</label>
                                    <input type="number" class="form-control @error('otp_expiry') is-invalid @enderror" id="otpExpiry" name="otp_expiry" value="{{ old('otp_expiry', $notificationSettings->otp_expiry) }}">
                                    @error('otp_expiry')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                        </div>
                        <div class="mb-3">
                            <label for="otpTemplate" class="form-label">OTP Message Template</label>
                            <textarea class="form-control @error('otp_template') is-invalid @enderror" id="otpTemplate" name="otp_template" rows="2">{{ old('otp_template', $notificationSettings->otp_template) }}</textarea>
                            @error('otp_template')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="text-end">
                            <button type="submit" class="btn btn-primary">Save OTP Settings</button>
                            <button type="button" class="btn btn-outline-primary ms-2" onclick="testOTP()">Test OTP</button>
                        </div>
                    </form>
                </div>
            </div>

            {{-- SMS Settings --}}
            <div class="card mb-4">
                <div class="card-header align-items-center d-flex">
                    <h4 class="card-title mb-0 flex-grow-1">SMS Settings</h4>
                    <div class="flex-shrink-0">
                        <div class="form-check form-switch form-switch-md">
                            <input class="form-check-input" type="checkbox" id="smsEnabled" name="sms_enabled" {{ old('sms_enabled', $notificationSettings->sms_enabled) ? 'checked' : '' }}>
                            <label class="form-check-label" for="smsEnabled">Enable SMS</label>
                        </div>
                    </div>
                </div>
                <div class="card-body">
                    <form action="" method="POST">
                        @csrf @method('PUT')
                        <div class="row">
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label for="smsProvider" class="form-label">SMS Provider</label>
                                    <select class="form-select @error('sms_provider') is-invalid @enderror" id="smsProvider" name="sms_provider">
                                        <option {{ old('sms_provider', $notificationSettings->sms_provider) == 'Twilio' ? 'selected' : '' }}>Twilio</option>
                                        <option {{ old('sms_provider', $notificationSettings->sms_provider) == 'Amazon SNS' ? 'selected' : '' }}>Amazon SNS</option>
                                        <option {{ old('sms_provider', $notificationSettings->sms_provider) == 'Plivo' ? 'selected' : '' }}>Plivo</option>
                                    </select>
                                    @error('sms_provider')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label for="smsApiKey" class="form-label">API Key</label>
                                    <input type="password" class="form-control @error('sms_api_key') is-invalid @enderror" id="smsApiKey" name="sms_api_key" value="{{ old('sms_api_key', $notificationSettings->sms_api_key) }}">
                                    @error('sms_api_key')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label for="smsFromNumber" class="form-label">From Number</label>
                                    <input type="text" class="form-control @error('sms_from_number') is-invalid @enderror" id="smsFromNumber" name="sms_from_number" value="{{ old('sms_from_number', $notificationSettings->sms_from_number) }}">
                                    @error('sms_from_number')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label for="smsRateLimit" class="form-label">Rate Limit (SMS/hour)</label>
                                    <input type="number" class="form-control @error('sms_rate_limit') is-invalid @enderror" id="smsRateLimit" name="sms_rate_limit" value="{{ old('sms_rate_limit', $notificationSettings->sms_rate_limit) }}">
                                    @error('sms_rate_limit')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                        </div>
                        <div class="mb-3">
                            <label for="smsTemplate" class="form-label">SMS Message Template</label>
                            <textarea class="form-control @error('sms_template') is-invalid @enderror" id="smsTemplate" name="sms_template" rows="2">{{ old('sms_template', $notificationSettings->sms_template) }}</textarea>
                            @error('sms_template')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="text-end">
                            <button type="submit" class="btn btn-primary">Save SMS Settings</button>
                            <button type="button" class="btn btn-outline-primary ms-2" onclick="testSMS()">Test SMS</button>
                        </div>
                    </form>
                </div>
            </div>

            {{-- Push Notification Settings --}}
            <div class="card">
                <div class="card-header align-items-center d-flex">
                    <h4 class="card-title mb-0 flex-grow-1">Push Notification Settings</h4>
                    <div class="flex-shrink-0">
                        <div class="form-check form-switch form-switch-md">
                            <input class="form-check-input" type="checkbox" id="pushEnabled" name="push_enabled" {{ old('push_enabled', $notificationSettings->push_enabled) ? 'checked' : '' }}>
                            <label class="form-check-label" for="pushEnabled">Enable Push Notifications</label>
                        </div>
                    </div>
                </div>
                <div class="card-body">
                    <form action="" method="POST">
                        @csrf @method('PUT')
                        <div class="row">
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label for="pushProvider" class="form-label">Push Provider</label>
                                    <select class="form-select @error('push_provider') is-invalid @enderror" id="pushProvider" name="push_provider">
                                        <option {{ old('push_provider', $notificationSettings->push_provider) == 'FCM (Firebase)' ? 'selected' : '' }}>FCM (Firebase)</option>
                                        <option {{ old('push_provider', $notificationSettings->push_provider) == 'APNS (Apple)' ? 'selected' : '' }}>APNS (Apple)</option>
                                        <option {{ old('push_provider', $notificationSettings->push_provider) == 'OneSignal' ? 'selected' : '' }}>OneSignal</option>
                                    </select>
                                    @error('push_provider')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label for="pushServerKey" class="form-label">Server Key</label>
                                    <input type="password" class="form-control @error('push_server_key') is-invalid @enderror" id="pushServerKey" name="push_server_key" value="{{ old('push_server_key', $notificationSettings->push_server_key) }}">
                                    @error('push_server_key')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label for="androidSenderId" class="form-label">Android Sender ID</label>
                                    <input type="text" class="form-control @error('android_sender_id') is-invalid @enderror" id="androidSenderId" name="android_sender_id" value="{{ old('android_sender_id', $notificationSettings->android_sender_id) }}">
                                    @error('android_sender_id')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label for="iosCertPath" class="form-label">iOS Certificate Path</label>
                                    <input type="text" class="form-control @error('ios_cert_path') is-invalid @enderror" id="iosCertPath" name="ios_cert_path" value="{{ old('ios_cert_path', $notificationSettings->ios_cert_path) }}">
                                    @error('ios_cert_path')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                        </div>
                        <div class="mb-3">
                            <label for="pushTemplate" class="form-label">Push Notification Template</label>
                            <textarea class="form-control @error('push_template') is-invalid @enderror" id="pushTemplate" name="push_template" rows="2">{{ old('push_template', $notificationSettings->push_template) }}</textarea>
                            @error('push_template')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="text-end">
                            <button type="submit" class="btn btn-primary">Save Push Settings</button>
                            <button type="button" class="btn btn-outline-primary ms-2" onclick="testPush()">Test Push</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
        <div class="col-xl-4">
            <div class="card">
                <div class="card-header">
                    <h4 class="card-title mb-0">Notification Tips</h4>
                </div>
                <div class="card-body">
                    <div class="d-flex align-items-center mb-3">
                        <div class="avatar-xs flex-shrink-0 me-2">
                            <span class="avatar-title bg-light text-primary rounded-circle fs-2">
                                <i class="ri-lightbulb-line"></i>
                            </span>
                        </div>
                        <div class="flex-grow-1">
                            <h6 class="fs-16 mb-0 fw-semibold">OTP Best Practices</h6>
                            <p class="text-muted mb-0">Use short expiry times and rate limiting to prevent abuse.</p>
                        </div>
                    </div>
                    <div class="d-flex align-items-center mb-3">
                        <div class="avatar-xs flex-shrink-0 me-2">
                            <span class="avatar-title bg-light text-success rounded-circle fs-2">
                                <i class="ri-check-double-line"></i>
                            </span>
                        </div>
                        <div class="flex-grow-1">
                            <h6 class="fs-16 mb-0 fw-semibold">SMS Compliance</h6>
                            <p class="text-muted mb-0">Ensure templates comply with TRAI regulations for DND.</p>
                        </div>
                    </div>
                    <div class="d-flex align-items-center">
                        <div class="avatar-xs flex-shrink-0 me-2">
                            <span class="avatar-title bg-light text-warning rounded-circle fs-2">
                                <i class="ri-alert-line"></i>
                            </span>
                        </div>
                        <div class="flex-grow-1">
                            <h6 class="fs-16 mb-0 fw-semibold">Push Limits</h6>
                            <p class="text-muted mb-0">Limit daily pushes to avoid user fatigue and app store issues.</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

<script>
    function testOTP() {
        // Simulate test
        alert('Test OTP sent successfully!');
    }
    function testSMS() {
        // Simulate test
        alert('Test SMS sent successfully!');
    }
    function testPush() {
        // Simulate test
        alert('Test Push sent successfully!');
    }
</script>