@extends('layout.apps')
@section('content')
    

<div class="card mb-4">
    <div class="card-header">
        <span class="small ms-1">Show Wallets</span>
    </div>
 
    <div class="card-body">
        <div style="margin-bottom: 10px;" class="row">
            <div class="col-lg-12">
                <a class="btn btn-default" href="{{ url('wallets') }}">
                    Back to list
                </a>
            </div>
        </div>
        <div class="table-responsive ">
            <table class="table table-bordered table-striped table-hover">
                <tbody>
                    @if (isset($wallet))
                        <tr>
                            <th>Name</th>
                            <td>{{ $wallet->name }}</td>
                       </tr>
                       <tr>
                            <th>Description</th>
                            <td>{{ $wallet->description }}</td>
                       </tr>
                       <tr>
                            <th>Amount</th>
                            <td>{{ $wallet->amount }}</td>
                       </tr>
                    @endif
                </tbody>
            </table>
        </div>
    </div>
</div>

@endsection
