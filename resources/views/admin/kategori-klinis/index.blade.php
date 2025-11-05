    <table border="1" cellpadding="8" cellspacing="0">
            <thead>
                <tr>
                    <th>NO</th>
                    <th>Nama Kategori Klinis</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($kategoriKlinis as $index => $item)
                <tr>
                    <td>{{ $index + 1 }}</td>
                    <td>{{ $item->nama_kategori_klinis }}</td>
                        {{-- Safely access related model properties --}}
                    <td>{{ $item->kategori->nama_kategori ?? 'N/A' }}</td>
                    <td>{{ $item->kategoriKlinis->nama_kategori_klinis ?? 'N/A' }}</td>
                </tr>
                @endforeach
            </tbody>
        </table>