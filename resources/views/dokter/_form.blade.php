@if ($errors->any())
    <div class="alert alert-danger">
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif

<div class="form-group">
    <label for="nama_pet">Nama Pet</label>
    <input type="text" name="nama_pet" id="nama_pet" value="{{ old('nama_pet', $pet->nama_pet) }}" required>
</div>

<div class="form-group">
    <label for="idpemilik">Pemilik</label>
    <select name="idpemilik" id="idpemilik" required>
        <option value="">-- Pilih Pemilik --</option>
        @foreach($pemiliks as $pemilik)
            <option value="{{ $pemilik->idpemilik }}" {{ old('idpemilik', $pet->idpemilik) == $pemilik->idpemilik ? 'selected' : '' }}>
                {{ $pemilik->user->nama }}
            </option>
        @endforeach
    </select>
</div>

<div class="form-group">
    <label for="idjenis_hewan">Jenis Hewan</label>
    <select id="idjenis_hewan" name="idjenis_hewan" required>
        <option value="">-- Pilih Jenis Hewan --</option>
        @foreach($jenisHewans as $jenis)
            <option value="{{ $jenis->idjenis_hewan }}" {{ old('idjenis_hewan', $pet->rasHewan->idjenis_hewan ?? '') == $jenis->idjenis_hewan ? 'selected' : '' }}>
                {{ $jenis->nama_jenis_hewan }}
            </option>
        @endforeach
    </select>
</div>

<div class="form-group">
    <label for="idras_hewan">Ras Hewan</label>
    <select id="idras_hewan" name="idras_hewan" required {{ !old('idjenis_hewan', $pet->rasHewan->idjenis_hewan ?? false) ? 'disabled' : '' }}>
        <option value="">-- Pilih Jenis Hewan Terlebih Dahulu --</option>
    </select>
</div>

<div class="form-group">
    <label for="tanggal_lahir">Tanggal Lahir</label>
    <input type="date" name="tanggal_lahir" id="tanggal_lahir" value="{{ old('tanggal_lahir', $pet->tanggal_lahir) }}" required>
</div>

<div class="form-group">
    <label for="jenis_kelamin">Jenis Kelamin</label>
    <select name="jenis_kelamin" id="jenis_kelamin" required>
        <option value="J" {{ old('jenis_kelamin', $pet->jenis_kelamin) == 'J' ? 'selected' : '' }}>Jantan</option>
        <option value="B" {{ old('jenis_kelamin', $pet->jenis_kelamin) == 'B' ? 'selected' : '' }}>Betina</option>
    </select>
</div>

<div class="form-group">
    <label for="warna_tanda">Warna / Tanda</label>
    <input type="text" name="warna_tanda" id="warna_tanda" value="{{ old('warna_tanda', $pet->warna_tanda) }}" placeholder="Contoh: Coklat dengan kaos kaki putih">
</div>

@push('scripts')
<script>
document.addEventListener('DOMContentLoaded', function() {
    const jenisHewanSelect = document.getElementById('idjenis_hewan');
    const rasHewanSelect = document.getElementById('idras_hewan');
    const oldRas = "{{ old('idras_hewan', $pet->idras_hewan ?? '') }}";

    function fetchBreeds(idJenis, selectedRasId = null) {
        if (!idJenis) {
            rasHewanSelect.innerHTML = '<option value="">-- Pilih Jenis Hewan Terlebih Dahulu --</option>';
            rasHewanSelect.disabled = true;
            return;
        }

        // Fetch breeds for the selected animal type
        fetch(`{{ url('/dokter/pets/get-breeds') }}/${idJenis}`)
            .then(response => response.json())
            .then(data => {
                rasHewanSelect.innerHTML = '<option value="">-- Pilih Ras --</option>';
                if (data.length > 0) {
                    data.forEach(breed => {
                        const option = new Option(breed.nama_ras_hewan, breed.idras_hewan);
                        if (selectedRasId && breed.idras_hewan == selectedRasId) {
                            option.selected = true;
                        }
                        rasHewanSelect.add(option);
                    });
                    rasHewanSelect.disabled = false; // Enable the dropdown
                } else {
                    rasHewanSelect.innerHTML = '<option value="">-- Tidak ada ras untuk jenis ini --</option>';
                    rasHewanSelect.disabled = true;
                }
            })
            .catch(error => {
                console.error('Error fetching breeds:', error);
                rasHewanSelect.innerHTML = '<option value="">-- Gagal memuat ras --</option>';
                rasHewanSelect.disabled = true;
            });
    }

    jenisHewanSelect.addEventListener('change', function() {
        fetchBreeds(this.value);
    });

    // On page load (for edit form), if a jenis_hewan is already selected, fetch its breeds
    if (jenisHewanSelect.value) {
        fetchBreeds(jenisHewanSelect.value, oldRas);
    }
});
</script>
@endpush