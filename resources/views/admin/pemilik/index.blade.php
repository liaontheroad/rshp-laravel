<table border="1" cellspacing="0" cellpadding="8">
    <thead>
        <tr>
            <th>No</th>
            <th>Nama Pemilik</th>
            <th>No WA</th>
            <th>Alamat
        </tr>
    </thead>
    <tbody>
        @foreach ($pemilik as $index => $item)
            <tr>
                <td>{{$index + 1 }}</td>
                <td>{{$item->user->nama }}</td>
                <td>{{$item->no_wa }}</td>
                <td>{{$item->alamat }}</td>
            </tr>
        @endforeach
    </tbody>
</table>