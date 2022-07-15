@extends('layout.apps')
@section('content')
    
<div style="margin-bottom: 10px;" class="row">
    <div class="col-lg-12">
        <a class="btn btn-success" href="{{ url('expense/form?type=cr') }}">
            Add Expense
        </a>
    </div>
</div>
<div class="card mb-4">
    <div class="card-header">
        <span class="small ms-1">Expense</span>
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
                    <th>Category</th>
                    <th>Wallet</th>
                    <th>Amount</th>
                    <th>Expense Date</th>
                    <th>Actions</th>
                </thead>
                <tbody>
                    @if (isset($expenses))
                        @foreach ($expenses as $expense)
                        <tr>
                            <td>{{ $expense->name }}</td>
                            <td>{{ isset($expense->expense_category->name) ?  $expense->expense_category->name : 'Uncategorized' }}</td>
                            <td>{{ $expense->wallet->name }}</td>
                            <td>$ {{ $expense->amount }}</td>
                            <td>{{ $expense->expense_date }}</td>
                            <td>
                                <a class="btn btn-xs btn-primary" href="{{ url('expense/view/?code='. base64_encode($expense->id)) }}">View</a>
                                <a class="btn btn-xs btn-info" href="{{ url('expense/form?type=ed&code='. base64_encode($expense->id)) }}">Edit</a>
                                <form action="{{ url('expense/delete/?code='. base64_encode($expense->id)) }}" method="post" onsubmit="return confirm('Are you sure want to delete this?')" style="display: inline-block;">
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
            $('#datatable_wallet').DataTable({
                "ordering": false
            });
        });

        //Close Success Message
        setTimeout(() => {
            $('.alert').hide();
        }, 3000);

    </script>
    
@endsection