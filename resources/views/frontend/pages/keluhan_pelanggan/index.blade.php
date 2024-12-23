@extends('frontend.templates.app')

@section('content')
<div class="container">
    <h4 class="page-title">Keluhan</h4>

    <div id="alertMessage" class="alert d-none" role="alert"></div>

    <button class="btn btn-primary mb-3" data-bs-toggle="modal" data-bs-target="#keluhanModal">Tambah Keluhan +</button>
    <div class="row mb-3">
        <div class="col-md-12">
            <button class="btn btn-success" onclick="window.location='{{ route('keluhan.export', ['format' => 'csv']) }}'">Export CSV</button>
            <button class="btn btn-success" onclick="window.location='{{ route('keluhan.export', ['format' => 'xls']) }}'">Export XLS</button>
            <button class="btn btn-success" onclick="window.location='{{ route('keluhan.export', ['format' => 'txt']) }}'">Export TXT</button>
            <button class="btn btn-success" onclick="window.location='{{ route('keluhan.export', ['format' => 'pdf']) }}'">Export PDF</button>
        </div>
    </div>
    
    <div class="modal fade" id="keluhanModal" tabindex="-1" aria-labelledby="keluhanModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="keluhanModalLabel">Tambah/Edit Keluhan</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form id="keluhanForm">
                        @csrf
                        <input type="hidden" id="keluhan_id" name="id">
                        <div class="mb-3">
                            <label for="nama" class="form-label">Nama</label>
                            <input type="text" class="form-control" id="nama" name="nama" required>
                        </div>
                        <div class="mb-3">
                            <label for="email" class="form-label">Email</label>
                            <input type="email" class="form-control" id="email" name="email" required>
                        </div>
                        <div class="mb-3">
                            <label for="nomor_hp" class="form-label">Nomor HP</label>
                            <input type="text" class="form-control" id="nomor_hp" name="nomor_hp">
                        </div>
                        <div class="mb-3">
                            <label for="keluhan" class="form-label">Keluhan</label>
                            <textarea class="form-control" id="keluhan" name="keluhan" rows="3" required></textarea>
                        </div>
                        <button type="submit" class="btn btn-primary">Simpan</button>
                        <button type="reset" class="btn btn-secondary" id="resetForm">Reset</button>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <div class="modal fade" id="deleteModal" tabindex="-1" aria-labelledby="deleteModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="deleteModalLabel">Konfirmasi Hapus</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    Apakah Anda yakin ingin menghapus keluhan ini?
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Tidak</button>
                    <button type="button" class="btn btn-danger" id="confirmDelete">Ya, Hapus</button>
                </div>
            </div>
        </div>
    </div>

    <div class="modal fade" id="historyModal" tabindex="-1" aria-labelledby="historyModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="historyModalLabel">Timeline Status Keluhan</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <table class="table table-bordered">
                        <thead>
                            <tr>
                                <th>Status</th>
                                <th>Waktu Perubahan</th>
                            </tr>
                        </thead>
                        <tbody id="timelineContainer">
                            <!-- Timeline akan diisi di sini -->
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>

    <div class="card">
        <div class="card-header">Daftar Keluhan</div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered" id="keluhanTable">
                    <thead>
                        <tr>
                            <th>Nama</th>
                            <th>Email</th>
                            <th>Nomor HP</th>
                            <th>Status</th>
                            <th>Created_at</th>
                            <th>Updated_at</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($keluhan as $item)
                        <tr>
                            <td>{{ $item->nama }}</td>
                            <td>{{ $item->email }}</td>
                            <td>{{ $item->nomor_hp ?? '-' }}</td>
                            <td>
                                @php
                                $statuses = ['Received', 'In Process', 'Done'];
                                $status = $statuses[$item->status_keluhan] ?? 'Unknown';
                                @endphp
                                {{ $status }}
                            </td>
                            <td>{{ $item->created_at }}</td>
                            <td>{{ $item->updated_at }}</td>
                            <td>
                                <button class="btn btn-warning btn-sm edit" data-id="{{ $item->id }}">Edit</button>
                                <button class="btn btn-danger btn-sm delete" data-id="{{ $item->id }}">Hapus</button>
                                <button class="btn btn-info btn-sm history" data-id="{{ $item->id }}">History</button>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table> </div>           
        </div>
    </div>
</div>

@push('scripts')
<script>
    $(document).ready(function(){
        var table = $('#keluhanTable').DataTable({
            "order": [[4, 'desc']],
            "columnDefs": [
                {
                    "targets": 4,
                    "orderable": true
                }
            ]
        });

        $('#keluhanForm').on('submit', function(e) {
            e.preventDefault();

            var formData = {
                nama: $('#nama').val(),
                email: $('#email').val(),
                nomor_hp: $('#nomor_hp').val(),
                keluhan: $('#keluhan').val(),
                _token: $('input[name="_token"]').val(),
            };

            var keluhanId = $('#keluhan_id').val();
            var url = keluhanId ? '{{ route('keluhan.update', ':id') }}'.replace(':id', keluhanId) : '{{ route('keluhan.store') }}';
            var type = keluhanId ? 'PUT' : 'POST';

            $.ajax({
                url: url,
                type: type,
                data: formData,
                success: function(response) {
                    console.log(response); 
                    if (response.status === 'success') {
                        $('#alertMessage').removeClass('d-none alert-danger').addClass('alert-success')
                                        .text('Data berhasil disimpan!').fadeIn();
                        $('#keluhanForm')[0].reset();
                        $('#keluhanModal').modal('hide');

                        var newRow = [
                            response.data.nama,
                            response.data.email,
                            response.data.nomor_hp ?? '-',
                            response.data.status_keluhan,
                            response.data.created_at,
                            response.data.updated_at,
                            `<button class="btn btn-warning btn-sm edit" data-id="${response.data.id}">Edit</button>
                            <button class="btn btn-danger btn-sm delete" data-id="${response.data.id}">Hapus</button>
                            <button class="btn btn-info btn-sm history" data-id="${response.data.id}">History</button>`
                        ];

                        table.row.add(newRow).draw(false);
                    }
                },
                error: function(xhr) {
                    console.log(xhr.responseJSON);
                    var errors = xhr.responseJSON.errors;
                    if (errors) {
                        var errorMessage = '';
                        $.each(errors, function(key, value) {
                            errorMessage += value + '<br>';
                        });
                        $('#alertMessage').removeClass('d-none alert-success').addClass('alert-danger')
                        .html(errorMessage).fadeIn();
                    } else {
                        $('#alertMessage').removeClass('d-none alert-success').addClass('alert-danger')
                        .text('Terjadi kesalahan.').fadeIn();
                    }
                }
            });
        });

        $(document).on('click', '.edit', function() {
            var keluhanId = $(this).data('id');
            
            $.ajax({
                url: '{{ route('keluhan.show', ':id') }}'.replace(':id', keluhanId),
                type: 'GET',
                success: function(response) {
                    if (response.status === 'success') {
                        $('#keluhan_id').val(response.data.id);
                        $('#nama').val(response.data.nama);
                        $('#email').val(response.data.email);
                        $('#nomor_hp').val(response.data.nomor_hp);
                        $('#keluhan').val(response.data.keluhan);
                        
                        $('#keluhanModal').modal('show');
                    }
                },
                error: function(xhr) {
                    alert('Terjadi kesalahan saat mengambil data keluhan.');
                }
            });
        });

        $(document).on('click', '.delete', function() {
            var keluhanId = $(this).data('id');
            $('#deleteModal').modal('show');
            $('#confirmDelete').on('click', function() {
                $.ajax({
                    url: '{{ route('keluhan.destroy', ':id') }}'.replace(':id', keluhanId),
                    type: 'DELETE',
                    data: {
                        _token: $('meta[name="csrf-token"]').attr('content')
                    },
                    success: function(response) {
                        $('#deleteModal').modal('hide');
                        if (response.status === 'success') {
                            $('#alertMessage').removeClass('d-none alert-danger').addClass('alert-success')
                                            .text(response.message).fadeIn();
                            $('button[data-id="' + keluhanId + '"]').closest('tr').remove();
                        }
                    },
                    error: function(xhr) {
                        $('#deleteModal').modal('hide');
                        $('#alertMessage').removeClass('d-none alert-success').addClass('alert-danger')
                                        .text('Terjadi kesalahan saat menghapus data.').fadeIn();
                    }
                });
            });
        });

        $(document).on('click', '.history', function() {
            var keluhanId = $(this).data('id');
            $.ajax({
                url: '{{ route('keluhan.history', ':id') }}'.replace(':id', keluhanId),
                type: 'GET',
                success: function(response) {
                    if (response.status === 'success') {
                        $('#timelineContainer').empty();

                        response.data.history.forEach(function(item) {
                            var statusText = ['Received', 'In Process', 'Done'][item.status_keluhan] || 'Unknown';
                            
                            var formattedDate = new Date(item.updated_at).toLocaleString('id-ID', {
                                weekday: 'long', 
                                year: 'numeric', 
                                month: 'long', 
                                day: 'numeric', 
                                hour: 'numeric', 
                                minute: 'numeric', 
                                second: 'numeric'
                            });

                            $('#timelineContainer').append(`
                                <tr>
                                    <td>${statusText}</td>
                                    <td>${formattedDate}</td>
                                </tr>
                            `);
                        });

                        $('#historyModal').modal('show');
                    } else {
                        alert('Tidak ada riwayat status untuk keluhan ini.');
                    }
                },
                error: function(xhr) {
                    alert('Terjadi kesalahan saat mengambil data riwayat status keluhan.');
                }
            });
        });

    });
</script>
@endpush

@endsection
