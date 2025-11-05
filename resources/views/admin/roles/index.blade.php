<table border="1" cellspacing="0" cellpadding="8">
            <thead>
                <tr>
                    <th>ID User</th>
                    <th>Nama Pengguna</th>
                    <th>Role yang Dimiliki</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($users as $user)
                <tr>
                    <td>{{ $user->iduser }}</td>
                    <td>{{ $user->nama }}</td>
                    <td>
                        @foreach ($user->roles as $role)
                            <span class="role-badge {{ $role->pivot->status == 1 ? 'role-active' : 'role-inactive' }}">
                                {{ $role->nama_role }}
                            </span>
                        @endforeach
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>