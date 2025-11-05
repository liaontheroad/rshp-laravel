<table border="1" cellspacing="0" cellpadding="8">
            <thead>
                <tr>
                    <th>Jenis Hewan</th>
                    <th>Ras yang Terdaftar</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($jenisHewanWithRaces as $jenis)
                <tr>
                    <td class="jenis-hewan-header">{{ $jenis->nama_jenis_hewan }}</td>
                    <td>
                        @if ($jenis->rasHewan->isNotEmpty())
                        <ul class="ras-list">
                            @foreach ($jenis->rasHewan as $ras)
                            <li>
                                <span>{{ $ras->nama_ras }}</span>
                                {{-- CUD action links removed as per "view only, no CUD" --}}
                            </li>
                            @endforeach
                        </ul>
                        @else
                        <p>Belum ada ras yang terdaftar.</p>
                        @endif
                        {{-- Form for adding new races removed as per "view only, no CUD" --}}
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>