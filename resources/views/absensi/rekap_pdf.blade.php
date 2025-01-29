<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Rekap Absensi Mahasiswa</title>
    <style>
        body { font-family: Arial, sans-serif; font-size: 12px; }
        table { width: 100%; border-collapse: collapse; margin-top: 10px; }
        th, td { border: 1px solid black; padding: 8px; text-align: center; }
        th { background-color: #f2f2f2; }
    </style>
</head>
<body>
    <h2 style="text-align: center;">Rekap Absensi Mahasiswa</h2>
    <table>
        <thead>
            <tr>
                <th>No</th>
                <th>Nama Mahasiswa</th>
                <th>NPM</th>
                <th>Hadir</th>
                <th>Izin</th>
                <th>Sakit</th>
                <th>Alpa</th>
                <th>Point</th>
                <th>Presentase (%)</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($rekap as $index => $data)
                <tr>
                    <td>{{ $index + 1 }}</td>
                    <td>{{ $data['nama'] }}</td>
                    <td>{{ $data['npm'] }}</td>
                    <td>{{ $data['hadir'] }}</td>
                    <td>{{ $data['izin'] }}</td>
                    <td>{{ $data['sakit'] }}</td>
                    <td>{{ $data['alpa'] }}</td>
                    <td>{{ $data['point'] }}</td>
                    <td>{{ number_format($data['presentase'], 2) }}%</td>
                </tr>
            @endforeach
        </tbody>
    </table>
</body>
</html>
