<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Layanan Umum - RSHP UNAIR</title>
    <link rel="stylesheet" href="{{ asset('css/site.css') }}">
</head> 
<body>
    <x-navigation></x-navigation>



    <main class="page-container">
        <header class="page-header-alt">
            <h1>Layanan RSHP Universitas Airlangga</h1>
        </header>
        
        <section class="content-section">
            <h2>DAFTAR LAYANAN</h2>
            <ul class="service-list">
                <li>Pemeriksaan Umum Hewan</li>
                <li>Vaksinasi</li>
                <li>Bedah dan tindakan medis</li>
                <li>Rawat inap hewan kecil dan besar</li>
                <li>Konsultasi kesehatan hewan</li>
                <li>Laboratorium diagnostik</li>
            </ul>
        </section>

        <section class="content-section">
            <h2>JAM OPERASIONAL</h2>
            <table class="hours-table">
                <thead>
                    <tr>
                        <th>HARI</th>
                        <th>PELAYANAN</th>
                        <th>JAM</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td rowspan="2">Senin - Jumat</td>
                        <td>Pelayanan Umum</td>
                        <td>08.30 - 21.30 WIB</td>
                    </tr>
                    <tr>
                        <td>IGD</td>
                        <td>21.30 - 08.00 WIB</td>
                    </tr>
                    <tr>
                        <td rowspan="2">Sabtu</td>
                        <td>Pelayanan Umum</td>
                        <td>09.00 - 16.00 WIB</td>
                    </tr>
                    <tr>
                        <td>IGD</td>
                        <td>16.00 - 08.00 WIB</td>
                    </tr>
                    <tr>
                        <td>Minggu</td>
                        <td colspan="2" style="text-align:center; font-weight:bold; color:red;">
                            🚨 FULL IGD 🚨</td>
                    </tr>
                </tbody>
            </table>
        </section>

        <section class="content-section">
            <h2>LOKASI RSHP</h2>
            <p style="text-align:center">GEDUNG RS HEWAN PENDIDIKAN</p>
            <p style="text-align:center; margin-bottom: 20px;">Kampus C Universitas Airlangga, Mulyorejo, Kec. Mulyorejo, Surabaya, Jawa Timur 60115, Indonesia.</p>
            <div class="location-map">
                <iframe src="https://www.google.com/maps/embed?pb=!1m14!1m8!1m3!1d7915.482022032093!2d112.788135!3d-7.270285!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x2dd7fbd40a9784f5%3A0xe756f6ae03eab99!2sAnimal%20Hospital%2C%20Universitas%20Airlangga!5e0!3m2!1sen!2sus!4v1755250825759!5m2!1sen!2sus"
                width="800" height="450" style="border:0;" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade">
                </iframe>
            </div>      
        </section>
    </main>

    <x-footer></x-footer>
</body>
</html>
