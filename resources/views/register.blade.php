<x-layout>
    <div class="my-5 py-4">
        <form action="{{ route('registerPost') }}" method="POST" class="w-50 mx-auto">
            @csrf
            <h1 class="fw-bold mb-4">Register</h1>

            @if (Session::has('success'))
                <x-alert type="success" :message="Session::get('success')"></x-alert>
            @endif

            <div class="mb-3">
                <label for="name" class="form-label">Nama</label>
                <input type="text" name="name" value="{{ old('name') }}" class="form-control" id="name">
                @if ($errors->has('name'))
                    <span class="text-danger">{{ $errors->first('name') }}</span>
                @endif
                <div id="emailHelp" class="form-text mt-1">We'll never share your email with anyone else.</div>
            </div>
            <div class="mb-3">
                <label for="exampleInputEmail1" class="form-label">Email address</label>
                <input type="email" name="email" value="{{ old('email') }}" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp">
                @if ($errors->has('email'))
                    <span class="text-danger">{{ $errors->first('email') }}</span>
                @endif
                <div id="emailHelp" class="form-text mt-1">We'll never share your email with anyone else.</div>
            </div>
            <div class="mb-3">
                <label for="exampleInputPassword1" class="form-label">Password</label>
                <input type="password" name="password" class="form-control" value="{{ old('password') }}" id="exampleInputPassword1">
                @if ($errors->has('password'))
                    <span class="text-danger">{{ $errors->first('password') }}</span>
                @endif
            </div>
            <p>
                Anda sudah punya akun?
                <x-link href="{{ route('login') }}" classes="text-primary">Login</x-link>
            </p>
            <button type="submit" class="btn btn-primary">Submit</button>
        </form>
    </div>
</x-layout>
