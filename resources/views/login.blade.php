
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
        <div class="d-flex justify-content-center align-items-center vh-100" style="margin-top: -3rem;">
            <div class="card p-5" style="max-width: 700px; width: 100%;">
                <form action="{{ route('login.auth') }}" method="POST">
                    @csrf

                    @if (Session::get('failed'))
                        <div class="alert alert-danger mb-3">{{ Session::get('failed') }}</div>
                    @endif
                    
                    <h3 class="mb-4">Halaman Login</h3>
                    <div class="mb-3">
                        <label for="email" class="form-label @error('email') text-danger @enderror">Email:</label>
                        <input type="email" class="form-control @error('email') is-invalid @enderror" id="email" name="email" value="{{ old('email') }}" required placeholder="Masukan Email">
                        @error('email')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="mb-3">
                        <label for="password" class="form-label @error('password') text-danger @enderror">Password:</label>
                        <input type="password" class="form-control @error('password') is-invalid @enderror" id="password" name="password" required placeholder="Masukan Password">
                        @error('password')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="mb-3 text-end">
                        <button type="submit" class="btn btn-primary">Login</button>
                    </div>
                </form>
            </div>
        </div>
