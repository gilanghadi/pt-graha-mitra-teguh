<x-layout>
    <x-slot:title>
        Data Karyawan
    </x-slot:title>

    <div class="mt-5 pt-5">
        <x-link href="{{ route('karyawan.create') }}" classes="btn btn-primary">
            Tambah Karyawan
        </x-link>

        @if (Session::has('success'))
            <x-alert type="success" :message="Session::get('success')"></x-alert>
        @endif

        <table id="myTable" class="display">
            <thead>
                <tr>
                    <th>#</th>
                    <th>Foto Karyawan</th>
                    <th>Nama Karyawan</th>
                    <th>Tanggal Lahir</th>
                    <th>Alamat</th>
                    <th>Status Perkawinan</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($karyawans as $key => $karyawan)
                    <tr>
                        <td>{{ $loop->iteration }}</td>
                        <td>
                            <img src="{{ Storage::url('foto-karyawan/' . $karyawan->foto) }}" alt="" width="100">
                        </td>
                        <td>{{ $karyawan->nama_karyawan }}</td>
                        <td>{{ \Carbon\Carbon::parse($karyawan->tanggal_lahir)->format('d-m-Y') }}</td>
                        <td>{{ $karyawan->alamat }}</td>
                        <td>{{ $karyawan->getStatusMarried() }}</td>
                        <td>
                            <div class="d-flex gap-2">
                                <x-link href="{{ route('karyawan.edit', $karyawan->id) }}" classes="btn btn-warning">Ubah</x-link>
                                <form action="{{ route('karyawan.destroy', $karyawan->id) }}" method="POST">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-danger">Hapus</button>
                                </form>
                            </div>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>

</x-layout>

<x-javascript>
    <script>
        $(document).ready(function() {
            $('#myTable').DataTable();
        });
    </script>
</x-javascript>
