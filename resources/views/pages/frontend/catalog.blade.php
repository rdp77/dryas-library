@extends('layouts.frontend.default')
@section('title', __('catalog.title'))
@section('content')
<section class="similar-songs-section">
    <div class="container-fluid">
        <div class="section-title">
            <h2>Catalog</h2>
        </div>
        <div class="body">
            <table id="tables" class="table-bordered table-striped table-hover table" width="100%">
                <thead>
                    <tr>
                        <td>No</td>
                        <td>Judul</td>
                        <td>Pengarang</td>
                        <td>Deskripsi</td>
                        <td>Gambar</td>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($data as $index => $element)
                    <tr>
                        <td>{{ $index+1 }}</td>
                        <td>{{ $element->mb_name }}</td>
                        <td>{{ $element->pengarang->mpg_name }}</td>
                        <td>{{ $element->mb_desc }}</td>
                        <td><a class="btn btn-sm btn-info btn-block" data-toggle="lightbox"
                                href="{{ asset('storage/buku/'.$element->mb_image) }}"><i class="fa fa-eye"></i>
                                Lihat</a></td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</section>
@endsection
@section('script')
<script type="text/javascript">
    $(document).on('click', '[data-toggle="lightbox"]', function(event) {
            event.preventDefault();
            $(this).ekkoLightbox();
        });
$(document).ready(function () {    
$("#tables").DataTable({
    "responsive": true,
    "autoWidth": true,
    "paging":   true,
    "pagingType": "numbers",
    "lengthChange": false,
    "pageLength": 25,
    "ordering": false,
    "info":     false,
  });       
});
</script>
@endsection