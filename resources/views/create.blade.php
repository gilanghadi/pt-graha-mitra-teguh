<x-layout>
    <x-slot:title>Tambah Karyawan</x-slot:title>

    <div class="my-5 py-4">
        <h1 class="fw-bold">Tambah Karyawan</h1>

        <div class="card p-4">
            <form action="{{ route('karyawan.store') }}" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="row">
                    <div class="col-6">
                        <div class="mb-3">
                            <label for="nama_karyawan" class="form-label">Nama Karyawan</label>
                            <input type="text" name="nama_karyawan" value="{{ old('nama_karyawan') }}" class="form-control" id="nama_karyawan">
                            @if ($errors->has('nama_karyawan'))
                                <span class="text-danger">{{ $errors->first('nama_karyawan') }}</span>
                            @endif
                        </div>
                    </div>
                    <div class="col-6">
                        <div class="mb-3">
                            <label for="tanggal_lahir" class="form-label">Tanggal Lahir</label>
                            <input type="date" name="tanggal_lahir" value="{{ old('tanggal_lahir') }}" class="form-control" id="tanggal_lahir">
                            @if ($errors->has('tanggal_lahir'))
                                <span class="text-danger">{{ $errors->first('tanggal_lahir') }}</span>
                            @endif
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-6 mb-2">
                        <div class="mb-3">
                            <label for="foto" class="form-label">Foto Karyawan</label>
                            <input type="file" name="foto" class="form-control" id="foto">
                            @if ($errors->has('foto'))
                                <span class="text-danger">{{ $errors->first('foto') }}</span>
                            @endif
                        </div>
                        <img src="" alt="" id="foto_preview" width="200">
                    </div>
                    <div class="col-6">
                        <div class="mb-3">
                            <label for="status_perkawinan" class="form-label">Email address</label>
                            <select name="status_perkawinan" name="status_perkawinan" id="status_perkawinan" class="form-control">
                                <option value="" selected disabled>Pilih Status Perkawinan</option>
                                <option value="true" {{ old('status_perkawinan') == 'true' ? 'selected' : '' }}>Sudah Kawin</option>
                                <option value="false" {{ old('status_perkawinan') == 'false' ? 'selected' : '' }}>Belum Kawin</option>
                            </select>
                            @if ($errors->has('status_perkawinan'))
                                <span class="text-danger">{{ $errors->first('status_perkawinan') }}</span>
                            @endif
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="mb-3">
                        <label for="alamat" class="form-label">Alamat Karyawan</label>
                        <textarea name="alamat" id="alamat" cols="30" rows="3" class="form-control">{{ old('alamat') }}</textarea>
                        @if ($errors->has('alamat'))
                            <span class="text-danger">{{ $errors->first('alamat') }}</span>
                        @endif
                    </div>
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

<x-javascript>
    <script>
        $(document).on('change', '#foto', function() {
            const file = event.target.files[0]
            $('#foto_preview').attr('src', URL.createObjectURL(file))
        })
    </script>
</x-javascript>
