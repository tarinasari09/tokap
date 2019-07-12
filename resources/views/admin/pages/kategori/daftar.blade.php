@extends('admin.main')
@section('title','kategori')
@section('content')
<h1>Kategori</h1>
<hr>

@if( session('result') == 'success')
 <div class="alert alert-success alert-dismissible fade show">
	<strong>Saved !</strong> Berhasil disimpan.
	<button type="button" class="close" data-dismiss="alert">
			&times;
	</button>
 </div>
@endif

@if( session('result') == 'update')
 <div class="alert alert-success alert-dismissible fade show">
	<strong>Updated !</strong> Berhasil diupdate.
	<button type="button" class="close" data-dismiss="alert">
			&times;
	</button>
 </div>
@endif

@if( session('result') == 'delete')
 <div class="alert alert-success alert-dismissible fade show">
	<strong>Deleted!</strong> Berhasil dihapus.
	<button type="button" class="close" data-dismiss="alert">
			&times;
	</button>
 </div>
@endif

@if( session('result') == 'fail-delete')
 <div class="alert alert-danger alert-dismissible fade show">
	<strong>Failed !</strong> Gagal dihapus
	<button type="button" class="close" data-dismiss="alert">
			&times;
	</button>
 </div>
@endif

	<div class="row">
		<div class="col-md-6 mb-3">
			<a href="{{ route('admin.kategori.add') }}" class="btn btn-primary">[+] Tambah</a>
		</div>

		<div class="col-md-6 mb-3">
			<form method="GET" action="{{ route('admin.kategori') }}">
				<div class="input-group">
					<input type="text" name="keyword" class="form-control"
					value="{{ request('keyword') }}">
					<div class="input-group-append">
						<button type="submit" class="btn btn-primary">
							Cari!
						</button>
					</div>
				</div><!-- End Input Group-->
			</form>
			
		</div>
	</div><!--End Row-->

	<table class="table table-striped mb-3">
		<tr>
		<th>Kategori</th><th>&nbsp;</th>
		</tr>
			@foreach($data as $dt)
			<tr>
<td>{{ $dt->nama_kategori }}</td>
<td>

<a href="{{route('admin.kategori.edit',['id'=>$dt->id])}}"
		class="btn btn-success btn-sm">
		<i class="fa fa-w fa-edit"></i>
		</a>
		<button type="button" 
		data-id="{{ $dt->id }}"
		class="btn btn-danger btn-sm">
		<i class="fa fa-w fa-trash"></i>
		</button>
	</td>
	</tr>
		@endforeach
	</table>

	{{
		$data->appends( request()->only('keyword') )
		->links('vendor.pagination.bootstrap-4')
	}}
@endsection

@push('modal')
<div class="modal fade" id="deleteModal" tabindex="-1" role="dialog">
<div class="modal-dialog" role="document">
	<div class="modal-content">
		<div class="modal-header">
			<h5 class="modal-title">Delete</h5>
			<button class="close" type="button" data-dismiss="modal">
			</button>
</div> <!-- End modal header -->
<div class="modal-body">
	Apakah anda yakin ingin menghapusnya?
	<form id="form-delete" method="post" action="{{ route('admin.kategori')}}">
		{{ method_field('delete') }}
		{{ csrf_field()}}
		<input type="hidden" name="id" id="input-id">
	</form>
	<div class="modal-footer">
		<button class="btn btn-secondary" type="button" data-dismiss="modal">Cancel</button>
		<button class="btn btn-primary btn-delete" type="button">Delete</button>
	</div> <!-- End modal footer-->
	</div>
</div>
</div>
</div>
@endpush

@push('js')
<script type="text/javascript">
$(function(){
		$('.btn-trash').click(function(){
			id=$(this).attr('data-id');
			$('#input-id').val(id);
			$('#deleteModal').modal('show');
		});
		$('.btn-delete').click(function(){
			$('#form-delete').submit();
		});
});
</script>
@endpush