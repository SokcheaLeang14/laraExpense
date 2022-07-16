@extends('layout.apps')
@section('content')
    
<div class="card mb-4">
    <div class="card-header">
        <strong>My</strong><span class="small ms-1">Wallets</span>
    </div>
    <div class="card-body">
        <form action="{{ $action_url }}" method="POST" enctype="multipart/form-data">
            @csrf
            <div class="form-group">
                <label for="name">Name <span class="text-danger">*</span></label>
                <input type="text" id="name" name="name" class="form-control" value="{{ isset($record) ? $record->name : '' }}" required>
            </div>
            <div class="form-group">
                <label for="currency_symbol">Currency Symbol <span class="text-danger">*</span></label>
                <select name="currency_symbol" id="currency_symbol" class="form-select">
                    <option value="$" {{ isset($record) && $record->currency_symbol == '$' ? 'selected' : ''  }}>$</option>
                    <option value="៛" {{ isset($record) && $record->currency_symbol == '៛' ? 'selected' : ''  }}>៛</option>
                </select>
            </div>
            <div class="form-group">
                <label for="description">Description</label>
                <input type="text" id="description" name="description" class="form-control" value="{{ isset($record) ? $record->description : '' }}" required>
            </div>

          <button type="submit" class="btn btn-primary">Submit</button>
    </div>
</div>

@endsection