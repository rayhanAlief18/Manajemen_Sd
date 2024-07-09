<!DOCTYPE html>
<html>

<head>
    <title>{{ $title }}</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/css/bootstrap.min.css"
        integrity="sha384-xOolHFLEh07PJGoPkLv1IbcEPTNtaed2xpHsD9ESMhqIYd0nLMwNLD69Npy4HI+N" crossorigin="anonymous">
</head>

<body style="width: 100%">
    <div>
        <h5 class="text-center"> <strong> DAFTAR NILAI SD BHAYANGKARI 1 SURABAYA </strong></h5>
        <h5 class="text-center" style="margin-bottom: 30px;"> <strong> TAHUN PELAJARAN {{ $tahunAjaran }} </strong></h5>

        <table class="table table-borderless">
            <tbody>
                <tr>
                    <td class="px-0 py-0">Kelas</td>
                    <td class="px-0 py-0">: {{ $kelas->nama_kelas }}</td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td class="px-0 py-0 text-end" style="text-align: end">Jenis Ujian</td>
                    <td class="px-0 py-0 text-end" style="text-align: end">: {{ $kategori == 'uts' ? 'UTS / PTS' : 'UAS / PAS' }}</td>
                </tr>
                <tr>
                    <td class="px-0 py-0">Semester</td>
                    <td class="px-0 py-0">: {{ $semester }}</td>
                </tr>
            </tbody>
        </table>

        <table class="table table-bordered">
            <thead>
                <tr>
                    <th rowspan="2" class="text-center align-content-center">No</th>
                    <th rowspan="2" class="text-center align-content-center">Nama</th>
                    <th colspan="{{ $mapel->count() }}" class="text-center">Mata Pelajaran</th>
                    <th rowspan="2" class="text-center align-content-center">Total Nilai</th>
                    <th rowspan="2" class="text-center align-content-center">Rata-rata</th>
                </tr>
                <tr>
                    @foreach ($mapel as $mp)
                        <th class="text-center">{{ $mp->kd_pelajaran }}</th>
                    @endforeach
                </tr>
            </thead>
            <tbody>
                @foreach ($nilaiSiswaArray as $index => $nilaiSiswa)
                    <tr>
                        <td class="text-center">{{ $loop->iteration }}</td>
                        <td>{{ $nilaiSiswa['nama_siswa'] }}</td>
                        @php
                            $totalNilai = 0;
                            $jumlahMapel = $mapel->count();
                        @endphp
                        @foreach ($mapel as $mp)
                            @php
                                $nilai = $nilaiSiswa['nilai'][$mp->kd_pelajaran] ?? 0;
                                $totalNilai += $nilai;
                            @endphp
                            <td class="text-center">
                                {{ $nilai ?: '-' }}
                            </td>
                        @endforeach
                        <td class="text-center">{{ $totalNilai }}</td>
                        <td class="text-center">{{ $jumlahMapel > 0 ? round($totalNilai / $jumlahMapel, 2) : '-' }}
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</body>

</html>
