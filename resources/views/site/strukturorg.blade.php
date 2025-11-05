<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Struktur Organisasi - RSHP UNAIR</title>
    <link rel="stylesheet" href="{{ asset('css/site.css') }}">
</head>
<body>

    <x-navigation></x-navigation>

    <main class="page-container">
        <header class="page-header-alt">
            <h1>Struktur Organisasi</h1>
            <p>Struktur Organisasi Rumah Sakit Hewan Pendidikan Universitas Airlangga.</p>
        </header>

        <section class="structure-section">
            <div class="org-chart">
                <!-- Tingkat Direktur -->
                <div class="org-level">
                    <div class="org-node director">
                        <img src="{{ asset('images/Direktur.png') }}" alt="Direktur" class="org-chart-image">
                        <div class="node-content">
                            <strong>Direktur</strong>
                            <span>Dr, Ira Sari Yudaniayanti, M.P., drh.</span>
                        </div>
                    </div>
                </div>

                <!-- Garis penghubung -->
                {{-- <div class="line-down"></div> --}}

                <!-- Tingkat Manajer -->
                <div class="org-level">
                    <div class="org-node">
                        <img src="{{ asset('images/Wakil-Direktur-1.png') }}" alt="Wakil Direktur 1" class="org-chart-image">
                        <div class="node-content">
                            <strong>Wakil Direktur 1 <br> (Pelayanan Medis, Pendidikan dan penelitian)</strong>
                            <span>Dr. Nusdianto Triakoso, M.P., drh.</span>
                        </div>
                    </div>
                    <div class="org-node">
                        <img src="{{ asset('images/Wakil-Direktur-2.png') }}" alt="Wakil Direktur 2" class="org-chart-image">
                        <div class="node-content">
                            <strong>Wakil Direktur 2 <br> (Sumber daya, Sarana Prasarana dan Keuangan)</strong>
                            <span>Dr. Miyayu Soneta S,. M.Vet., drh.</span>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </main>

    <x-footer></x-footer>

</body>
</html>