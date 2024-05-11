@extends('layouts.admin-dashboard')

@section('content')
    <!-- Page Heading -->
    <h1 class="h3 mb-4 text-gray-800">Daftar User</h1>

    @if (session('error'))
        <div class="alert alert-danger">
            {{ session('error') }}
        </div>
    @endif

    @if (session('status'))
        <div class="alert alert-success">
            {{ session('status') }}
        </div>
    @endif
    <!-- DataTales Example -->
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">Tabel User</h6>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered" id="userTable" width="100%" cellspacing="0">
                    <thead>
                        <tr>
                            <th>No.</th>
                            <th>Nama</th>
                            <th>Email</th>
                            <th>Tanggal Daftar</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>

                    <tbody>
                        @foreach ($users as $user)
                            <tr>
                                <td>{{ ($users->currentpage() - 1) * $users->perpage() + $loop->index + 1 }}</td>
                                <td>{{ $user->name }}</td>
                                <td>{{ $user->email }}</td>
                                <td>{{ Carbon\Carbon::parse($user->created_at)->translatedFormat('d F Y') }}</td>
                                <td>

                                    <button type="button" class="btnDelete btn btn-danger" data-name="{{ $user->name }}"
                                        data-id="{{ $user->id }}" data-toggle="modal" data-target="#deleteModal"><i
                                            class="fas fa-fw fa-trash-alt"></i></button>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
                <div class="mt-4 d-flex justify-content-end">
                    {{ $users->links() }}
                </div>
            </div>
        </div>
    </div>
@endsection

@section('modal')
    <!-- Delete Modal-->
    <div class="modal fade" id="deleteModal" tabindex="-1" role="dialog" aria-labelledby="deleteModalLabel"
        aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="deleteModalLabel">Peringatan</h5>
                    <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">×</span>
                    </button>
                </div>
                <div class="modal-body">Apakah anda yakin ingin menghapus data ini?</div>
                <div class="modal-footer">
                    <button class="btn btn-secondary" type="button" data-dismiss="modal">Batal</button>

                    <form id="modalDeleteForm" style="display: inline" method="POST" action="">
                        @csrf
                        @method('DELETE')

                        <button type="submit" class="btn btn-danger"><i class="fas fa-fw fa-trash-alt"></i> Hapus</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('scripts')
    <script>
        $(document).ready(function() {
            const form = $('#modalDeleteForm')
            const modalBody = $('#deleteModal > .modal-dialog > .modal-content > .modal-body')
            $('.btnDelete').on('click', function() {
                const userId = $(this).data('id')
                const userName = $(this).data('name')

                modalBody.html(`Apakah anda yakin ingin menghapus data <b>${userName}</b>?`)
                form.attr('action', `/admin-dashboard/user/${userId}`)
            })
        });
    </script>
@endsection
