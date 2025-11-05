<table border="1" cellspacing="0" cellpadding="8">
    <thead>
        <tr>
             <th>ID User</th>
             <th>Nama</th>
             <th>Email</th>
        </tr>
    </thead>
    <tbody>
        @foreach ($users as $user)
                <tr>
                    <td>{{ $user->iduser }}</td>
                    <td>{{ $user->nama }}</td>
                    <td>{{ $user->email }}</td>
            </tr>
        @endforeach
    </tbody>
</table>
