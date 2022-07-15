@extends('layout.apps')
@section('content')
    
<div style="margin-bottom: 10px;" class="row">
    <div class="col-lg-12">
        <a class="btn btn-success" href="{{ url('expense_category/form?type=cr') }}">
            Add Expense Category
        </a>
    </div>
</div>
<div class="card mb-4">
    <div class="card-header">
        <span class="small ms-1">Expense Categories</span>
    </div>
    <div class="card-body">
        @if(session('status'))
        <div class="alert alert-success">
            {{ session('status') }}
        </div>
        @endif
        <div class="table-responsive ">
            <table class="table table-bordered table-striped table-hover datatable" id="datatable_wallet">
                <thead>
                    <th>Name</th>
                    <th>Parent Category</th>
                    <th>Image</th>
                    <th>Actions</th>
                </thead>
                <tbody>
                    @if (isset($expense_cats))
                        @foreach ($expense_cats as $cat)
                        <?php $parent_cat = App\Models\ExpenseCategory::where('id', $cat->category_parent)->first(); ?>
                        <tr>
                            <td>{{ $cat->name }}</td>
                            <td>{{  isset($parent_cat->name) ? $parent_cat->name : 'None' }}</td>
                            <td><img src="{{ asset('upload/expense_category/'.$cat->image) }}" width="100" alt=""></td>
                            <td>
                                <a class="btn btn-xs btn-primary" href="{{ url('expense_category/view/?code='. base64_encode($cat->id)) }}">View</a>
                                <a class="btn btn-xs btn-info" href="{{ url('expense_category/form?type=ed&code='. base64_encode($cat->id)) }}">Edit</a>
                                <form action="{{ url('expense_category/delete/?code='. base64_encode($cat->id)) }}" method="post" onsubmit="return confirm('Are you sure want to delete this?')" style="display: inline-block;">
                                    <input type="hidden" name="_method" value="POST">
                                    <input type="hidden" name="_token" value={{ csrf_token() }}>
                                    <input type="submit" class="btn btn-xs btn-danger" value="Delete">
                                </form>
                            </td>
                       </tr>
                        @endforeach
                    @endif
                </tbody>
            </table>
        </div>
    </div>
</div>

@endsection

@section('scripts')
    <script>
        //Initial Datatable
        $(document).ready(function () {
            $('#datatable_wallet').DataTable();
        });

        //Close Success Message
        setTimeout(() => {
            $('.alert').hide();
        }, 3000);

    </script>
    
@endsection