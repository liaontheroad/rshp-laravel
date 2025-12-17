@extends('layouts.app')

@section('title', 'Detail Rekam Medis')

@section('content-header', 'Detail Rekam Medis')

@section('content')
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">Detail Rekam Medis</h3>
                    <div class="card-tools">
                        <a href="{{ route('perawat.rekam-medis.index') }}" class="btn btn-sm btn-secondary">Kembali</a>
                    </div>
                </div>
                <div class="card-body">
                    <dl class="row">
                        <dt class="col-sm-3">ID Rekam Medis</dt>
                        <dd class="col-sm-9">{{ $rekamMedis->idrekam_medis }}</dd>

                        <dt class="col-sm-3">Nama Hewan</dt>
                        <dd class="col-sm-9">{{ $rekamMedis->pet->nama ?? 'N/A' }}</dd>

                        <dt class="col-sm-3">Pemilik</dt>
                        <dd class="col-sm-9">{{ $rekamMedis->pet->pemilik->user->nama ?? 'N/A' }}</dd>

                        <dt class="col-sm-3">Anamnesa</dt>
                        <dd class="col-sm-9">{{ $rekamMedis->anamnesa }}</dd>

                        <dt class="col-sm-3">Temuan Klinis</dt>
                        <dd class="col-sm-9">{{ $rekamMedis->temuan_klinis }}</dd>

                        <dt class="col-sm-3">Diagnosa</dt>
                        <dd class="col-sm-9">{{ $rekamMedis->diagnosa }}</dd>

                        <dt class="col-sm-3">Dokter Pemeriksa</dt>
                        <dd class="col-sm-9">{{ $rekamMedis->temuDokter->dokter->user->nama ?? $rekamMedis->dokter->user->nama ?? 'N/A' }}</dd>

                        <dt class="col-sm-3">Tanggal Dibuat</dt>
                        <dd class="col-sm-9">{{ $rekamMedis->created_at ? \Carbon\Carbon::parse($rekamMedis->created_at)->format('d/m/Y H:i') : 'N/A' }}</dd>
                    </dl>

                    @if($rekamMedis->detailRekamMedis->count() > 0)
                        <h4 class="mt-4">Detail Tindakan Terapi</h4>
                        <div class="table-responsive">
                            <table class="table table-bordered">
                                <thead>
                                    <tr>
                                        <th>Kode Tindakan</th>
                                        <th>Nama Tindakan</th>
                                        <th>Deskripsi</th>
                                    </tr>
                                </thead>
                                <tbody>
                                @foreach($rekamMedis->detailRekamMedis as $detail)
                                    <tr>
                                        <td>{{ $detail->kodeTindakanTerapi->kode ?? 'N/A' }}</td>
                                        <td>{{ $detail->kodeTindakanTerapi->deskripsi_tindakan_terapi ?? 'N/A' }}</td>
                                        <td>{{ $detail->kodeTindakanTerapi->deskripsi_tindakan_terapi ?? 'N/A' }}</td>
                                    </tr>
                                @endforeach
                                </tbody>
                            </table>
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
@endsection
