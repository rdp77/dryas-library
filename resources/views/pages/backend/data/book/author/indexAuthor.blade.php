@extends('layouts_backend._main') @section('content')
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0 text-dark">Master Pengarang</h1>
                </div>
                <!-- /.col -->
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="{{ route('home') }}">Home</a></li>
                        <li class="breadcrumb-item">Master</li>
                        <li class="breadcrumb-item active">Pengarang</li>
                    </ol>
                </div>
                <!-- /.col -->
            </div>

            <div class="card card-info">
                <div class="card-header">
                    <div class="float-right">
                        <button class="btn btn-sm btn-warning" onclick="tambah()"><i class="fas fa-plus"></i> Tambah
                        </button>
                    </div>
                </div>

                <div class="card-body">
                    <table id="tables" class="table-bordered table-striped table" width="100%">
                        <thead>
                            <tr>
                                <td>No</td>
                                <td>Nama</td>
                                <td>Alamat</td>
                                <td>Telepon</td>
                                <td>Aksi</td>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($data as $index => $element)
                            <tr>
                                <td>{{ $index+1 }}</td>
                                <td>{{ $element->mpg_name }}</td>
                                <td>{{ $element->mpg_alamat }}</td>
                                <td>{{ $element->mpg_tlp }}</td>
                                <td>
                                    <button class="btn btn-sm btn-info btn-block"
                                        onclick="edit('{{ $element->mpg_id }}')"><i class="fas fa-pen"></i>
                                        Edit</button>
                                    <button class="btn btn-sm btn-danger btn-block"
                                        onclick="hapus('{{ $element->mpg_id }}')"><i class="fas fa-trash"></i>
                                        Hapus</button>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
                <!-- /.card-body -->
            </div>
            <!-- /.row -->
        </div>
        <!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->
</div>
@endsection

<script type="text/javascript">
    function tambah(argument) {
        location.href = '{{ route('author.create') }}';
    }

    function edit(argument) {
        location.href = '{{ url('/') }}' + '/pengarang_edit?&id=' + argument;
    }

    function hapus(argument) {
        Swal.fire({
            title: 'Yakin menghapus data?',
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Yes'
        }).then((result) => {
            if (result.value) {
                Swal.fire({
                title: 'Data berhasil di hapus',
                icon: 'success',
                showConfirmButton: false,
                }
            )
            location.href = '{{ url('/') }}' + '/pengarang_hapus?&id=' + argument;
            }
        })
    }
</script>