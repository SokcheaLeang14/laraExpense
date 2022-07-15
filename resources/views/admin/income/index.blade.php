@extends('layout.apps')
@section('content')
    
<div style="margin-bottom: 10px;" class="row">
    <div class="col-lg-12">
        <a class="btn btn-success" href="{{ url('income/form?type=cr') }}">
            Add Income
        </a>
    </div>
</div>
<div class="card mb-4">
    <div class="card-header">
        <span class="small ms-1">Income</span>
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
                    <th>Income Date</th>
                    <th>Actions</th>
                </thead>
                <tbody>
                    @if (isset($incomes))
                        @foreach ($incomes as $income)
                        <tr>
                            <td>{{ $income->name }}</td>
                            <td>{{ isset($income->income_category->name) ?  $income->income_category->name : 'Uncategorized' }}</td>
                            <td>{{ $income->wallet->name }}</td>
                            <td>$ {{ $income->amount }}</td>
                            <td>{{ $income->income_date }}</td>
                            <td>
                                <a class="btn btn-xs btn-primary" href="{{ url('income/view/?code='. base64_encode($income->id)) }}">View</a>
                                <a class="btn btn-xs btn-info" href="{{ url('income/form?type=ed&code='. base64_encode($income->id)) }}">Edit</a>
                                <form action="{{ url('income/delete/?code='. base64_encode($income->id)) }}" method="post" onsubmit="return confirm('Are you sure want to delete this?')" style="display: inline-block;">
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