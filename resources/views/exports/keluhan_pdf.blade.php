<!DOCTYPE html>
<html>
<head>
    <style>
        table {
            width: 100%;
            border-collapse: collapse;
        }
        th, td {
            padding: 8px;
            border: 1px solid #ddd;
        }
        th {
            text-align: left;
        }
    </style>
</head>
<body>
    <h1>Data Keluhan Pelanggan</h1>
    <table>
        <thead>
            <tr>
                <th>ID</th>
                <th>Nama</th>
                <th>Email</th>
                <th>No. Hp</th>
                <th>Status Keluhan</th>
                <th>Keluhan</th>
                <th>Created At</th>
                <th>Updated At</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($keluhan as $item)
            <tr>
                <td>{{ $item->id }}</td>
                <td>{{ $item->nama }}</td>
                <td>{{ $item->email }}</td>
                <td>{{ $item->nomor_hp }}</td>
                <td>
                    @php
                    $statuses = ['Received', 'In Process', 'Done'];
                    $status = $statuses[$item->status_keluhan] ?? 'Unknown';
                    @endphp
                    {{ $status }}
                </td>
                <td>{{ $item->keluhan }}</td>
                <td>{{ $item->created_at }}</td>
                <td>{{ $item->updated_at }}</td>
            </tr>
            @endforeach
        </tbody>
    </table>
</body>
</html>
