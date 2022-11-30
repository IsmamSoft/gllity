@extends('admin.master')

@section('content')
<div class="container py-4">
    <div class="col-md-12">
<!-- Button trigger modal -->
<a class="btn btn-outline-primary" data-toggle="modal" data-target="#addservice">
    <i class="fas fa-plus"></i> Add New Service
</a>
<p></p>
<table class="table" id="usertable">
    <thead>
      <tr>
         {{-- <th scope="col">SL.</th> --}}
         <th scope="col">Service Image</th>
         <th scope="col">Service Name</th>
         <th scope="col">Service Category</th>
         <th scope="col">Service Price</th>
         <th scope="col">Service Time</th>
        <th scope="col">Edit</th>
        <th scope="col">Delete</th>
      </tr>
    </thead>
    <tbody>
{{-- @foreach ($service as $key=> $item) --}}
@foreach ($service as $item)
<tr>
    {{-- <td> {{$service->firstItem()+$key}} </td> --}}
    <td><img src="{{url('public/admin/images/service/')}}/{{$item->s_image}}" style="height:50px; width:50px;"></td>
    <td> {{$item->s_name}} </td>
    <td> {{$item->s_category}} </td>
    <td> {{$item->s_price}} </td>
    <td> {{$item->s_timing}} </td>
    <td> <a href="{{url('admin/service/edit', $item->s_name)}}" class="btn btn-outline-success"><i class="fa fa-edit"></i></a></td>
    <td>
        <form action="{{url('admin/service/delete', $item->id)}}" method="POST">
            @method('POST')
            @csrf
            <button class="btn btn-outline-success" type="submit"><i class="fa fa-trash"></i></button>
        </form>
    </td>
</tr>
@endforeach
    </tbody>
  </table>

</div>
    <!-- Modal -->
    <div class="modal fade" id="addservice" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
      <div class="modal-dialog">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLabel">Add New Service</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>
          {{-- @foreach ($location as $key=> $item) --}}
          <form action="{{url('admin/service/add')}}" method="POST" enctype="multipart/form-data">
            @csrf
          <div class="modal-body">
            <div class="form-group">
                <input type="file" class="form-control-file" name="s_image">
           </div>
          <div class="form-group">
            <input type="text" class="form-control" id="s_name" name="s_name" placeholder="Service Name">
          </div>
          <div class="form-group">
            <input type="text" class="form-control" id="s_slug" name="s_slug" placeholder="Service Slug">
          </div>
          <div class="form-group">
            <input type="text" class="form-control" name="s_price" placeholder="Service Price">
          </div>
          {{-- <div class="form-group">
            <input type="text" class="form-control" name="s_employee" placeholder="Service Employee">
          </div> --}}
         {{-- <div class="form-group">
           <div class="input-group">
            <input type="text" class="form-control" name="s_discount" placeholder="Discount">
            <div class="input-group-append">
              <button class="btn btn-outline-secondary dropdown-toggle" type="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">Select Discount Type</button>
              <div class="dropdown-menu">
                <a class="dropdown-item" name="percentage" href="#">%</a>
                <a class="dropdown-item" name="amount" href="#">Amount</a>
              </div>
            </div>
          </div>
          </div> --}}

          <div class="form-group">
            <select name="s_location" class="form-control">
            @foreach (App\Location::all() as $location)
               <option value="{{$location->city}} | {{$location->state}} | {{$location->country}}"> {{$location->city}} | {{$location->state}} | {{$location->country}} </option>
            @endforeach
            </select>
          </div>

          <div class="form-group">
            <select name="s_category" class="form-control">
            @foreach (App\Service_Category::all() as $category)
               <option value="{{$category->cat_name}}">{{$category->cat_name}}</option>
            @endforeach
            </select>
          </div>

          <div class="form-group">
            <input type="text" class="form-control" name="s_timing" placeholder="Service Time">
          </div>

          <div class="form-group">
            <textarea type="text" class="form-control" name="s_desc" placeholder="Description"></textarea>
          </div>

          </div>
          <div class="modal-footer">
            <button type="submit" class="btn btn-outline-primary">Save</button>
          </div>
        </form>
        {{-- @endforeach --}}
        </div>
      </div>
    </div>


    {{-- <div class="modal fade" id="edit" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
          <div class="modal-content">
            <div class="modal-header">
              <h5 class="modal-title" id="exampleModalLabel">Update</h5>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>
            @foreach ($location as $key=> $item)
            <form action="{{url('admin/service/edit_location')}}" method="POST" enctype="multipart/form-data">
              @csrf
            <div class="modal-body">
            <div class="form-group">
              <input type="text" class="form-control" name="city" value="{{ $item->city }}" placeholder="City">
            </div>
            <div class="form-group">
              <input type="text" class="form-control" name="state" value="{{ $item->state }}" placeholder="State">
            </div>
            <div class="form-group">
              <input type="text" class="form-control" name="country" value="{{ $item->country }}" placeholder="Country">
            </div>
            </div>
            <div class="modal-footer">
              <button type="submit" class="btn btn-outline-primary">Save</button>
            </div>
          </form>
          @endforeach
          </div>
        </div>
      </div>
</div> --}}
@endsection
@section('footer_js')
<script>
    $(document).ready( function () {
    $('#usertable').DataTable();
});
    $('#s_name').keyup(function() {
    $('#s_slug').val($(this).val().toLowerCase().split(',').join('').replace(/\s/g,"-"));
    });
</script>
<script>
    $(function() {
      $('#toggle-two').bootstrapToggle({
         on: 'Enabled',
        off: 'Disabled'
      });
    });

    $('.toggle-class').on('change', function(){
        var service_status=$(this).prop('checked')==true ? 1 : 0;
        var user_id=$(this).data('id');

        $.ajax({
            type:'GET',
            dataType:'json',
            url: '{{ route('servicestatus')}}',
            data: {'service_status':service_status , 'user_id':user_id},
            success:function(data){
                console.log(data);
            }
        });
    });
  </script>
@endsection
