@extends('layout.apps')
@section('content')
    

<div class="card mb-4">
    <div class="card-header">
        <span class="small ms-1">Show Income</span>
    </div>
 
    <div class="card-body">
        <div style="margin-bottom: 10px;" class="row">
            <div class="col-lg-12">
                <a class="btn btn-default" href="{{ url('incomes') }}">
                    Back to list
                </a>
            </div>
        </div>
        <div class="table-responsive ">
            <table class="table table-bordered table-striped table-hover">
                <tbody>
                    @if (isset($income))
                        <tr>
                            <th>Name</th>
                            <td>{{ $income->name }}</td>
                       </tr>
                       <tr>
                            <th>Description</th>
                            <td>{{ $income->description }}</td>
                       </tr>
                       <tr>
                            <th>Amount</th>
                            <td>${{ $income->amount }}</td>
                       </tr>
                       <tr>
                            <th>Image</th>
                            <td>
                                @if($income->image !== NULL) 
                                <img src="{{ asset('upload/income/'.$income->image) }}" width="100" alt=""> 
                                @endif
                            </td>
                        </tr>
                       <tr>
                            <th>Income Date</th>
                            <td>{{ $income->income_date }}</td>
                        </tr>
                    @endif
                </tbody>
            </table>
        </div>
    </div>
</div>

@endsection
