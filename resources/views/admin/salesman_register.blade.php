<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Register Salesman</title>

    <!-- BOOTSTRAP -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.3.2/css/bootstrap.min.css" rel="stylesheet">

    <style>
        *{margin:0;padding:0;box-sizing:border-box;}
        body{
            font-family:'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            background:#57618f;
            min-height:100vh;
        }
        .logo-header{padding:220px 170px;}
        .logo-header img{width:200px;}
        .logo-header p{font-size: larger;padding-left: 10px;}
        .card-wrapper{
            border-radius:12px;
            box-shadow:0 8px 24px rgba(0,0,0,.18);
        }
        .form-container{
            background:#fff;
            border-radius:12px;
            overflow:hidden;
            margin-top:20px;
        }
        .image-side{
            min-height:550px;
            background:linear-gradient(135deg,#a855f7,#c084fc,#e9d5ff);
            position:relative;
        }
        .image-side svg{
            position:absolute;
            right:-50px;
            top:0;
            height:100%;
        }
        .form-side{
            padding:40px 30px;
            background:#fff;
        }
        h3{
            text-align:center;
            margin-bottom:25px;
            color:#333;
        }
        input,select{
            border:2px solid #e0e0e0!important;
            padding:12px!important;
            border-radius:8px!important;
        }
        input:focus,select:focus{
            border-color:#4B5584!important;
            box-shadow:none!important;
        }
        .btn-submit{
            background:#4B5584;
            color:#fff;
        }
        .btn-submit:hover{
            background:#35458e;
        }
        .text-danger{font-size:.875rem;}
        @media(max-width:992px){
            .image-side{min-height:300px;}
            .logo-header{padding:50px 30px;}
        }
    </style>
</head>

<body>

<div class="container pb-5">
    <div class="row justify-content-center">
        <div class="col-lg-10">

            <div class="card-wrapper">
                <div class="row form-container">

                    <!-- LEFT IMAGE -->
                    <div class="col-lg-6 d-none d-lg-block image-side">
                        <div class="logo-header">
                            <img src="{{ asset('images/logo-2.png') }}" alt="Logo">
                            <p>connecting services...</p>

                            <svg viewBox="0 0 100 300" xmlns="http://www.w3.org/2000/svg">
                                <path d="M0,0 Q50,150 0,300 T0,600 L200,600 L200,0 Z"
                                      fill="rgba(255,255,255,0.2)"/>
                                <path d="M20,0 Q70,180 20,350 T20,600 L200,600 L200,0 Z"
                                      fill="rgba(255,255,255,0.15)"/>
                            </svg>
                        </div>
                    </div>

                    <!-- FORM SIDE -->
                    <div class="col-lg-6 col-12 form-side">

                        <h3>Register Salesman</h3>

                        <form action="{{ route('admin.salesmen.store') }}" method="POST">
                            @csrf

                            <!-- Name -->
                            <div class="mb-3">
                                <label>Full Name *</label>
                                <input type="text" name="name" class="form-control"
                                       value="{{ old('name') }}" required>
                                @error('name') <span class="text-danger">{{ $message }}</span> @enderror
                            </div>

                            <!-- Email -->
                            <div class="mb-3">
                                <label>Email *</label>
                                <input type="email" name="email" class="form-control"
                                       value="{{ old('email') }}" required>
                                @error('email') <span class="text-danger">{{ $message }}</span> @enderror
                            </div>

                            <!-- Assign DEO -->
                            <div class="mb-3">
                                <label>Assign to DEO *</label>
                                <select name="deo_id" class="form-select" required>
                                    <option value="">Select DEO</option>
                                    @foreach($deos as $deo)
                                        <option value="{{ $deo->id }}"
                                            {{ old('deo_id') == $deo->id ? 'selected' : '' }}>
                                            {{ $deo->name }}
                                        </option>
                                    @endforeach
                                </select>
                                @error('deo_id') <span class="text-danger">{{ $message }}</span> @enderror
                            </div>

                            <!-- Password -->
                            <div class="mb-3">
                                <label>Password *</label>
                                <input type="password" name="password" class="form-control" required>
                                @error('password') <span class="text-danger">{{ $message }}</span> @enderror
                            </div>

                            <button type="submit" class="btn btn-submit w-100 py-2">
                                Register Salesman
                            </button>

                        </form>

                    </div>
                </div>
            </div>

        </div>
    </div>
</div>

<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.3.2/js/bootstrap.bundle.min.js"></script>
</body>
</html>
