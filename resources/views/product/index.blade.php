@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            @if(session()->has('success'))
            <div class="alert alert-success" role="alert">
              {{ session()->get('success') }}
            </div>
            @endif
            @if(session()->has('fail') || session()->has('delete'))
            <div class="alert alert-danger" role="alert">
              {{ @session()->get('fail') }} {{ @session()->get('delete') }}
            </div>
            @endif
        </div>
        <div class="col-md-12">
            <div class="card">
                <div class="card-header"><h5 class="my-2 float-md-left">Product</h5> <a href="{{ route('product.create') }}" class="float-md-right btn btn-primary">Add</a></div>

                <div class="card-body px-4">
                    <table class="table table-hover data-table">
                        <thead>
                          <tr>
                            <th>Code</th>
                            <th>Name</th>
                            <th>Price</th>
                            <th>Action</th>
                          </tr>
                        </thead>
                        <tbody>
                        </tbody>
                      </table>

                    
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@section('js')
    
<script type="text/javascript">
  $(function () {
    var table = $('.data-table').DataTable({
        processing: true,
        serverSide: true,
        ajax: "{{ route('product') }}",
        columns: [
            {data: 'id_product', name: 'DT_RowIndex'},
            {data: 'product_name', name: 'name'},
            {data: 'price', name: 'price'},
            {data: 'action', name: 'action', orderable: false, searchable: false},
        ]
    });

    $('.data-table').DataTable().on('click', '.btn-delete', function (e) { 
        $.ajaxSetup({
        headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
        var url = $(this).data('id');
        $.ajax({
            url: url,
            type: 'DELETE',
            dataType: 'json',
            data: {method: '_DELETE', submit: true}
        }).always(function (data) {
            $('.data-table').DataTable().draw(false);
        });
    });
  });


</script>
@endsection
