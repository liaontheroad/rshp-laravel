<x-dashboard-layout>
    <x-slot name="title">Manajemen Jenis Hewan</x-slot>

    @if (session('message'))
        <div class="alert alert-{{ session('status') }} alert-dismissible">
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            {{ session('message') }}
        </div>
    @endif

    <div class="card">
        <div class="card-header">
            <h3 class="card-title">{{ $is_editing ? 'Edit Jenis Hewan' : 'Tambah Jenis Hewan Baru' }}</h3>
        </div>
        <div class="card-body">
            <form action="{{ $is_editing ? route('admin.jenis-hewan.update', $data_to_edit->id) : route('admin.jenis-hewan.store') }}" method="POST">
                @csrf
                @if ($is_editing)
                    @method('PUT')
                @endif
                <div class="form-group">
                    <label for="nama_jenis_hewan">Nama Jenis Hewan</label>
                    <input type="text" id="nama_jenis_hewan" name="nama_jenis_hewan" class="form-control" value="{{ $is_editing ? $data_to_edit->nama_jenis_hewan : old('nama_jenis_hewan') }}" required>
                </div>
                <button type="submit" class="btn btn-primary">{{ $is_editing ? 'Update' : 'Tambah' }}</button>
                @if ($is_editing)
                    <a href="{{ route('admin.jenis-hewan.index') }}" class="btn btn-secondary ml-2">Batal</a>
                @endif
            </form>
        </div>
    </div>

    <div class="card">
        <div class="card-header">
            <h3 class="card-title">Daftar Jenis Hewan</h3>
        </div>
        <div class="card-body">
            <table class="table table-bordered table-striped">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Nama Jenis Hewan</th>
                        <th style="width: 150px;">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($all_jenis_hewan as $jenis)
                        <tr>
                            <td>{{ $jenis->idjenis_hewan }}</td>
                            <td>{{ $jenis->nama_jenis_hewan }}</td>
                            <td>
                                <a href="{{ route('admin.jenis-hewan.edit', $jenis->id) }}" class="btn btn-warning btn-sm">Edit</a>
                                <form action="{{ route('admin.jenis-hewan.destroy', $jenis->id) }}" method="POST" style="display:inline;">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('Anda yakin ingin menghapus jenis hewan ini?');">Hapus</button>
                                </form>
                            </td>
                        </tr>
                    @empty
                        <tr><td colspan="3" class="text-center">Tidak ada data.</td></tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</x-dashboard-layout>
