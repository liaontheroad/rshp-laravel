<table border="1" cellspacing="0" cellpadding="8">
<thead>
                <tr>
                    <th>ID Pet</th>
                    <th>Nama Pet</th>
                    <th>Jenis Hewan</th>
                    <th>Ras</th>
                    <th>Jenis Kelamin</th>
                    <th>Tanggal Lahir</th>
                    <th>Pemilik</th>
                    <th>Warna/Tanda</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($pets as $pet)
                <tr>
                    <td>{{ $pet->idpet }}</td>
                    <td>{{ $pet->nama }}</td>
                    <td>{{ $pet->rasHewan->jenis->nama_jenis_hewan ?? 'N/A' }}</td>
                    <td>{{ $pet->rasHewan->nama_ras ?? 'N/A' }}</td>
                    <td>{{ $pet->jenis_kelamin == 'J' ? 'Jantan' : 'Betina' }}</td>
                    <td>{{ \Carbon\Carbon::parse($pet->tanggal_lahir)->format('d M Y') }}</td>
                    <td>{{ $pet->pemilik->user->nama ?? 'N/A' }}</td>
                    <td>{{ $pet->warna_tanda }}</td>
                </tr>
                @endforeach
            </tbody>
        </table>
