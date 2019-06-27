@extends('layouts.app')


@section('content')
    @if(session()->has('success'))
        <div class="alert alert-success">
            {{session()->get('success')}}
        </div>

        @endif
    <div class="d-flex justify-content-end my-1">
        <a href="{{route('categories.create')}}" class="btn btn-success">Add Category</a>
    </div>
<div class="card card-default">
    <div class="card-header">
        <strong style="color: #1b4b72">Categories</strong>
    </div>
    <div class="card-body">
        @if(session()->has('error'))
            <div class="alert alert-danger">
                {{session()->get('error')}}
            </div>


        @endif
<table class="table">
    <tr>
        <th>Name</th>
        <th>Post count</th>

    </tr>
       @forelse($categories as $category)
         <tr>

           <td>
                {{$category->name}}
           </td>
             <td>{{$category->posts->count()}}</td>

             <td>
               <div class="float-right">

               <a href="{{route('categories.edit',$category->id)}}" class="btn btn-primary btn-sm mx-1">Edit</a>

             <button class="btn btn-danger btn-sm" onclick="handelDelete({{$category->id}})">Delete</button>
               </div>
                </td>



         </tr>
                @empty
           <h1>No Categories</h1>
            @endforelse

</table>

       {{$categories->links()}}
    </div>
</div>

    <div class="modal" id="deleteModal" aria-labelledby="deleteModalLabel" tabindex="-1" role="dialog">
        <div class="modal-dialog" role="document">
            <form method="post" action="" id="deleteCategoryForm">
                {{Csrf_field()}}
                @method('DELETE')

            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="deleteModalLabel">Delete Category</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <p>هل انت متاكد من حذف هذا الصنف؟</p>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">No,Go Back</button>
                    <button type="submit" class="btn btn-danger">Yes,Deleted</button>

                </div>

            </div>
            </form>
        </div>
    </div>

    @endsection

@section('scripts')
<script>
    function handelDelete(id) {
  var form=document.getElementById('deleteCategoryForm');
  form.action='/categories/'+ id;
        console.log('deleting',form);
    $('#deleteModal').modal('show')


    }
</script>


    @endsection