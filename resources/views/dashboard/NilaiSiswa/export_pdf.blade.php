<!DOCTYPE html>
<html>

<head>
    <title>Export PDF Nilai Siswa</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/css/bootstrap.min.css"
        integrity="sha384-xOolHFLEh07PJGoPkLv1IbcEPTNtaed2xpHsD9ESMhqIYd0nLMwNLD69Npy4HI+N" crossorigin="anonymous">
    <style>
        .table {
            width: 100%;
            border-collapse: collapse;
        }

        .table th,
        .table td {
            border: 1px solid rgb(0, 0, 0);
        }

        .table th {
            background-color: #dfdfdf;
            border: 1px solid#000
        }

        .py-3 {
            padding-top: 10px;
            padding-bottom: 10px;
        }

        .p-2 {
            padding: 4px;
        }

        .table .text-center {
            text-align: center;
        }

        .table-borderless {
            margin-bottom: 30px;
        }
    </style>
</head>

<body>
    <h5 class="text-center" style="margin-bottom: 30px;">LAPORAN HASIL BELAJAR (
        {{ $request->kategori == 'uts' ? 'UTS / PTS' : 'UAS / PAS' }} )</h5>

    <table class="table table-borderless">
        <tbody>
            <tr>
                <td class="px-0 py-0">Nama</td>
                <td class="px-0 py-0">: {{ $siswa->nama_siswa }}</td>
                <td class="px-0 py-0">Kelas</td>
                <td class="px-0 py-0">: {{ $siswa->kelas->nama_kelas }}</td>
            </tr>
            <tr>
                <td class="px-0 py-0">NISN / NIS</td>
                <td class="px-0 py-0">: {{ $siswa->NISN }} / {{ $siswa->NIS }}</td>
                <td class="px-0 py-0">Semester</td>
                <td class="px-0 py-0">: {{ $request->input('semester', 'Semua') }}</td>
            </tr>
            <tr>
                <td class="px-0 py-0">Sekolah</td>
                <td class="px-0 py-0">: SD Kemala Bhayangkari 1 SBY</td>
                <td class="px-0 py-0">Tahun Ajaran</td>
                <td class="px-0 py-0">: {{ $request->input('tahun_ajaran', 'Semua') }}</td>
            </tr>
        </tbody>
    </table>

    <p class="mb-1"><strong>A. Nilai Siswa</strong></p>
    <table class="table">
        <thead>
            <tr>
                <th class="text-center py-2">No</th>
                <th class="text-center py-2">Mata Pelajaran</th>
                <th class="text-center py-2">Nilai</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($data as $datas)
                <tr>
                    <td class="text-center py-1">{{ $loop->iteration }}</td>
                    <td class=" py-1">{{ $datas->mataPelajaran->nama_pelajaran }}</td>
                    <td class="text-center py-1">{{ $datas->nilai }}</td>
                </tr>
            @endforeach
            <tr>
                <td colspan="2" class="text-center py-2"><strong>Total Nilai</strong></td>
                <td class="text-center py-2">{{ $totalNilai }}</td>
            </tr>
            <tr>
                <td colspan="2" class="text-center py-2"><strong>Rata-rata Nilai</strong></td>
                <td class="text-center py-2">{{ number_format($averageNilai, 2) }}</td>
            </tr>
        </tbody>
    </table>

    <p class="mb-1"><strong>B. Absensi Siswa</strong></p>
    <table class="table">
        <thead>
            <tr>
                <th class="py-1 text-center">Status</th>
                <th class="py-1 text-center">Jumlah</th>
            </tr>
        </thead>
        <tbody>
            <tr>
                <td class="py-0">Izin</td>
                <td class="py-0">{{ $izinCount }}</td>
            </tr>
            <tr>
                <td class="py-0">Sakit</td>
                <td class="py-0">{{ $sakitCount }}</td>
            </tr>
            <tr>
                <td class="py-0">Alpha</td>
                <td class="py-0">{{ $alphaCount }}</td>
            </tr>
        </tbody>
    </table>

    <table class="table table-borderless mt-4">
        <tbody>
            <tr>
                <td class="px-0 py-0">Mengetahui,<br>Orang tua/Wali,</td>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
                <td class="px-0 py-0">Surabaya, <br>Wali Kelas<br><br><br> <strong>{{ $guru->nama_guru }}</strong></td>
            </tr>
            <tr>
                <td class="px-0 py-0">
                    <div style="border-top: 1px solid black; width: 140px;"></div>
                </td>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
                <td class="px-0 py-0">
                    <div style="border-top: 1px solid black; width: 140px;"></div>
                </td>
            </tr>
        </tbody>
    </table>

    <script src="https://cdn.jsdelivr.net/npm/jquery@3.5.1/dist/jquery.slim.min.js"
        integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous">
    </script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-Fy6S3B9q64WdZWQUiU+q4/2Lc9npb8tCaSX9FK7E8HnRr0Jz8D6OP9dO5Vg3Q9ct" crossorigin="anonymous">
    </script>
</body>

</html>
