<h3>Tambah Ras Hewan Baru</h3>

@if ($errors->any())
    <div style="color: red;">
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif

<form action="{{ route('admin.ras-hewan.store') }}" method="POST">
    @csrf
    <div>
        <label for="idjenis_hewan">Jenis Hewan:</label>
        <select name="idjenis_hewan" id="idjenis_hewan" required>
            <option value="">-- Pilih Jenis Hewan --</option>
            @foreach ($jenisHewan as $jenis)
                <option value="{{ $jenis->idjenis_hewan }}">{{ $jenis->nama_jenis_hewan }}</option>
            @endforeach
        </select>
    </div>
    <br>
    <div>
        <label for="nama_ras_hewan">Nama Ras Hewan:</label>
        <input type="text" name="nama_ras_hewan" id="nama_ras_hewan" required>
    </div>
    <br>
    <button type="submit">Simpan</button>
</form>
