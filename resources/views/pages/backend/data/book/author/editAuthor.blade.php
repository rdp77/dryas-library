@extends('layouts_backend._main')

@section('content')
<div class="content-wrapper">
  <!-- Content Header (Page header) -->
  <div class="content-header">
    <div class="container-fluid">
      <div class="row mb-2">
        <div class="col-sm-6">
        </div><!-- /.col -->
        <div class="col-sm-6">
          <ol class="breadcrumb float-sm-right">
            <li class="breadcrumb-item"><a href="#">Home</a></li>
            <li class="breadcrumb-item">Master</li>
            <li class="breadcrumb-item active">Edit Pengarang</li>
          </ol>
        </div><!-- /.col -->
      </div><!-- /.row -->
    </div><!-- /.container-fluid -->
  </div>
  <!-- /.content-header -->

  <!-- Main content -->
  <section class="content">
    <div class="container-fluid">
      <!-- FORM -->
      <div class="card card-default">
        <div class="card-header">
          <h3 class="card-title">Edit Pengarang</h3>
        </div>
        <!-- /.card-header -->
        <div class="card-body" style="display: block;">
          <form class="form-save">
            <div class="form-group">
              <label>Nama</label>
              <input type="text" class="form-control" name="name" value="{{ $data->mpg_name }}">
              <input type="hidden" class="form-control" name="id" value="{{ $data->mpg_id }}">
            </div>
            <div class="form-group">
              <label>Alamat</label>
              <input type="text" class="form-control" name="alamat" value="{{ $data->mpg_alamat }}">
            </div>
            <div class="form-group">
              <label>Telepon</label>
              <input type="text" class="form-control" data-inputmask="&quot;mask&quot;: &quot;(+62) 999-9999-9999&quot;"
                name="tlp" value="{{ $data->mpg_tlp }}">
            </div>
        </div>
        <!-- /.card-body -->
        <div class="card-footer">
          <button type="button" class="btn btn-primary" onclick="save()"><i class="fas fa-save"></i> Save</button>
        </div>
        </form>
      </div>
      <!-- /.card -->
    </div>
  </section>
</div>
@endsection

<script type="text/javascript">
  function save(argument) {
    $.ajax({
      url:'{{ route('author.update') }}',
      data:$('.form-save').serialize(),
      type:'get',      
      error:function(data){
        if(data.status == 422){
            Swal.fire({
              title: 'Pastikan data tidak kosong.',
              icon: 'error',
              confirmButtonText: 'Ok'
            })
          }
        }, 
      success:function(data){
        if (data.status == 'sukses') {
          Swal.fire({
            title: 'Data sudah disimpan.',
            icon: 'success',
            confirmButtonText: 'Ok'
          }).then(function(result){
            location.href = '{{ route('author.index') }}';
             })
        }
      }
    });
  }
</script>