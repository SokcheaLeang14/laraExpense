@extends('layout.apps')
@section('content')
    
<div style="margin-bottom: 10px;" class="row">
    <div class="col-lg-12">
        <a class="btn btn-success" href="{{ url('wallet/form?type=cr') }}">
            Add Wallet
        </a>
    </div>
</div>
<div class="card mb-4">
    <div class="card-header">
        <strong>My</strong><span class="small ms-1">Wallets</span>
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
                    <th>Description</th>
                    <th>Amount</th>
                    <th>Actions</th>
                </thead>
                <tbody>
                    @if (isset($wallets))
                        @foreach ($wallets as $wallet)
                        <tr>
                            <td>{{ $wallet->name }}</td>
                            <td>{{ $wallet->description }}</td>
                            <td>{{ $wallet->amount }}</td>
                            <td>
                                <a class="btn btn-xs btn-primary" href="{{ url('wallet/view/?code='. base64_encode($wallet->id)) }}">View</a>
                                <a class="btn btn-xs btn-info" href="{{ url('wallet/form?type=ed&code='. base64_encode($wallet->id)) }}">Edit</a>
                                <form action="{{ url('wallet/delete/?code='. base64_encode($wallet->id)) }}" method="post" onsubmit="return confirm('Are you sure want to delete this?')" style="display: inline-block;">
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