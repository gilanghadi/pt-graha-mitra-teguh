<x-layout>
    <x-slot:title>
        Ubah Password
    </x-slot:title>

    <div class="my-5">
        <h1 class="fw-bold">Ubah Profile</h1>

        @if (Session::has('success'))
            <x-alert type="success" :message="Session::get('success')"></x-alert>
        @endif

        @if (Session::has('error'))
            <x-alert type="danger" :message="Session::get('error')"></x-alert>
        @endif

        <div class="card p-4">
            <form action="{{ route('profilePost', Auth::user()->id) }}" method="POST">
                @csrf
                <div class="mb-3">
                    <label for="name" class="form-label">Nama</label>
                    <input type="text" name="name" class="form-control" value="{{ old('name', Auth::user()->name) }}" id="name">
                    @if ($errors->has('name'))
                        <span class="text-danger">{{ $errors->first('name') }}</span>
                    @endif
                </div>
                <div class="mb-3">
                    <label for="email" class="form-label">Email Address</label>
                    <input type="email" name="email" class="form-control" value="{{ old('email', Auth::user()->email) }}" id="email">
                    @if ($errors->has('email'))
                        <span class="text-danger">{{ $errors->first('email') }}</span>
                    @endif
                </div>
                <div class="mb-3">
                    <label for="exampleInputPassword1" class="form-label">Password</label>
                    <input type="password" name="password" class="form-control" value="{{ old('password') }}" id="exampleInputPassword1">
                    @if ($errors->has('password'))
                        <span class="text-danger">{{ $errors->first('password') }}</span>
                    @endif
                </div>
                <div class="row justify-content-end">
                    <div class="col-3">
                        <x-link href="{{ route('karyawan.index') }}" classes="btn btn-secondary me-3">Kembali</x-link>
                        <button type="submit" class="btn btn-primary mb-3">Submit</button>
                    </div>
                </div>
            </form>
        </div>
    </div>

</x-layout>
