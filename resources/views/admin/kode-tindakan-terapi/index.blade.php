<table border="1" cellpadding="8" cellspacing="0">
    <thead>
        <tr>
            <th>Kode</th>
            <th>Deskripsi</th>
            <th>Kategori</th>
            <th>Kategori Klinis</th>
        </tr>
    </thead>
    <tbody>
        @foreach ($kodeTindakanTerapi as $item)
        <tr>
                <td>{{ $item->kode }}</td>
                <td>{{ $item->deskripsi }}</td>
                {{-- Safely access related model properties --}}
                <td>{{ $item->kategori->nama_kategori ?? 'N/A' }}</td>
                <td>{{ $item->kategoriKlinis->nama_kategori_klinis ?? 'N/A' }}</td>
        </tr>
        @endforeach
    </tbody>
</table>