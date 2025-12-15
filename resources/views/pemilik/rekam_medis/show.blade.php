@extends('layouts.app')

@section('content')
<div class="container-fluid">
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">Detail Rekam Medis</h3>
                    <div class="card-tools">
                        <a href="{{ route('pemilik.rekam-medis.index') }}" class="btn btn-sm btn-secondary">
                            <i class="fas fa-arrow-left"></i> Kembali
                        </a>
                    </div>
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label><strong>Tanggal Kunjungan:</strong></label>
                                <p>{{ \Carbon\Carbon::parse($rekamMedis->created_at)->format('d F Y, H:i') }}</p>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label><strong>Nama Pet:</strong></label>
                                <p>{{ $rekamMedis->pet->nama_pet }}</p>
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label><strong>Jenis Hewan:</strong></label>
                                <p>{{ $rekamMedis->pet->rasHewan->jenisHewan->nama_jenis_hewan ?? 'N/A' }}</p>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label><strong>Ras:</strong></label>
                                <p>{{ $rekamMedis->pet->rasHewan->nama_ras ?? 'N/A' }}</p>
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label><strong>Dokter Pemeriksa:</strong></label>
                                <p>{{ $rekamMedis->dokter->user->nama ?? 'N/A' }}</p>
                            </div>
                        </div>
                    </div>

                    <hr>

                    <div class="form-group">
                        <label><strong>Anamnesa:</strong></label>
                        <div class="border p-3 bg-light">
                            {!! nl2br(e($rekamMedis->anamnesa)) !!}
                        </div>
                    </div>

                    <div class="form-group">
                        <label><strong>Temuan Klinis:</strong></label>
                        <div class="border p-3 bg-light">
                            {!! nl2br(e($rekamMedis->temuan_klinis)) !!}
                        </div>
                    </div>

                    <div class="form-group">
                        <label><strong>Diagnosa:</strong></label>
                        <div class="border p-3 bg-light">
                            {!! nl2br(e($rekamMedis->diagnosa)) !!}
                        </div>
                    </div>

                    @if($rekamMedis->kodeTindakanTerapi->count() > 0)
                        <div class="form-group">
                            <label><strong>Tindakan/Terapi yang Diberikan:</strong></label>
                            <div class="border p-3 bg-light">
                                <ul class="list-unstyled">
                                    @foreach($rekamMedis->kodeTindakanTerapi as $tindakan)
                                        <li><i class="fas fa-check-circle text-success"></i> {{ $tindakan->kode }} - {{ $tindakan->deskripsi_tindakan_terapi }}</li>
                                    @endforeach
                                </ul>
                            </div>
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
