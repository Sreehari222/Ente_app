<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Register Data Entry Operator</title>

  <!-- BOOTSTRAP -->
  <link href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.3.2/css/bootstrap.min.css" rel="stylesheet">

  <style>
    *{
      margin:0;
      padding:0;
      box-sizing:border-box;
    }

    body{
      font-family:'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
      background:#57618f;
      min-height:100vh;
    }

    .logo-header{
      padding:220px 170px;
    }

    .logo-header img{
      width:200px;
    }
    .logo-header p{
        font-size: larger;
        padding-left: 10px;
    }

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
      z-index:1;
    }

    .image-side svg{
      position:absolute;
      right:-50px;
      top:0;
      height:100%;
    }

    .form-side{
      padding:40px 30px;
      position:relative;
      z-index:5;
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

    .text-danger{
      font-size: 0.875rem;
    }

    @media(max-width:992px){
      .image-side{
        min-height:300px;
      }
      .logo-header{
        padding:50px 30px;
      }
    }
  </style>
</head>

<body>

  <div class="container pb-5">
    <div class="row justify-content-center">
      <div class="col-lg-10">

        <div class="card-wrapper">

          <div class="row form-container">

            <!-- Left Image Side -->
            <div class="col-lg-6 d-none d-lg-block image-side">
              <div class="logo-header">
                <img src="{{ asset('images/logo-2.png') }}" alt="Logo">
                <p>connecting services...</p>

                <svg viewBox="0 0 100 300" xmlns="http://www.w3.org/2000/svg">
                  <path d="M0,0 Q50,150 0,300 T0,600 L200,600 L200,0 Z" fill="rgba(255,255,255,0.2)"/>
                  <path d="M20,0 Q70,180 20,350 T20,600 L200,600 L200,0 Z" fill="rgba(255,255,255,0.15)"/>
                </svg>
              </div>
            </div>

            <!-- Form Side -->
            <div class="col-lg-6 col-12 form-side">

              <h3>Register Data Entry Operator</h3>

              <form action="{{ route('admin.deos.store') }}" method="POST">
                @csrf

                <!-- Name -->
                <div class="mb-3">
                  <label for="name">Full Name *</label>
                  <input type="text" class="form-control" name="name" id="name"
                    value="{{ old('name') }}" required>
                  @error('name') <span class="text-danger">{{ $message }}</span> @enderror
                </div>

                <!-- Email -->
                <div class="mb-3">
                  <label for="email">Email *</label>
                  <input type="email" class="form-control" name="email" id="email"
                    value="{{ old('email') }}" required>
                  @error('email') <span class="text-danger">{{ $message }}</span> @enderror
                </div>

                <!-- Area Operator -->
                <div class="mb-3">
                  <label for="area_operator_id">Assign to Area Operator *</label>
                  <select name="area_operator_id" class="form-select" id="area_operator_id" required>
                    <option value="">Select Area Operator</option>
                    @foreach($areaOperators as $ao)
                      <option value="{{ $ao->id }}" {{ old('area_operator_id') == $ao->id ? 'selected' : '' }}>
                        {{ $ao->name }}
                      </option>
                    @endforeach
                  </select>
                  @error('area_operator_id') <span class="text-danger">{{ $message }}</span> @enderror
                </div>

                <!-- Password -->
                <div class="mb-3">
                  <label for="password">Password *</label>
                  <input type="password" class="form-control" name="password" id="password" required>
                  @error('password') <span class="text-danger">{{ $message }}</span> @enderror
                </div>

                <!-- Confirm Password -->
                <div class="mb-3">
                  <label for="password_confirmation">Confirm Password *</label>
                  <input type="password" class="form-control" name="password_confirmation"
                    id="password_confirmation" required>
                </div>

                <button type="submit" class="btn btn-submit w-100 py-2">Register</button>

                <div class="text-center mt-3">
                  <span class="text-muted">Already have an account?</span>
                  <a href="{{ route('login') }}" class="fw-semibold" style="color:#4B5584;">Sign in</a>
                </div>

              </form>

            </div>

          </div>

        </div>

      </div>
    </div>
  </div>

  <!-- BOOTSTRAP JS -->
  <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.3.2/js/bootstrap.bundle.min.js"></script>
</body>
</html>
