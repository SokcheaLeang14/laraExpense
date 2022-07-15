@extends('layout.apps')
@section('content')
    

<div class="card mb-4">
    <div class="card-header">
        <span class="small ms-1">Show Expense</span>
    </div>
 
    <div class="card-body">
        <div style="margin-bottom: 10px;" class="row">
            <div class="col-lg-12">
                <a class="btn btn-default" href="{{ url('expenses') }}">
                    Back to list
                </a>
            </div>
        </div>
        <div class="table-responsive ">
            <table class="table table-bordered table-striped table-hover">
                <tbody>
                    @if (isset($expense))
                        <tr>
                            <th>Name</th>
                            <td>{{ $expense->name }}</td>
                       </tr>
                       <tr>
                            <th>Description</th>
                            <td>{{ $expense->description }}</td>
                       </tr>
                       <tr>
                            <th>Amount</th>
                            <td>${{ $expense->amount }}</td>
                       </tr>
                       <tr>
                            <th>Image</th>
                            <td>
                                @if($expense->image !== NULL) 
                                <img src="{{ asset('upload/expense/'.$expense->image) }}" width="100" alt=""> 
                                @endif
                            </td>
                        </tr>
                       <tr>
                            <th>Expense Date</th>
                            <td>{{ $expense->expense_date }}</td>
                        </tr>
                    @endif
                </tbody>
            </table>
        </div>
    </div>
</div>

@endsection
