@extends('layout.apps')
@section('content')
    
<div class="card mb-4">
    <div class="card-header">
        <span class="small ms-1">Expense</span>
    </div>

    <div class="card-body">
        @if ($errors->any())
            <div class="alert alert-danger">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif
        <form action="{{ $action_url }}" method="POST" enctype="multipart/form-data">
            @csrf

            <div class="form-group">
                <label for="name">Name <span class="text-danger">*</span></label>
                <input type="text" id="name" name="name" class="form-control" value="{{ isset($record) ? $record->name : '' }}" required>
            </div>
            <div class="form-group">
                <label for="wallet_id">Wallet</label>
                <select class="form-control" name="wallet_id" id="wallet_id">
                    <option value="" disabled="" selected="">Please select</option>
                    @foreach($wallets as $wallet)
                        <option value="{{ $wallet->id }}" {{ isset($record) ? ($record->wallet_id == $wallet->id ? 'selected' : '') : '' }}>{{ $wallet->name }}</option>
                    @endforeach
                </select>
            </div>
            <div class="form-group">
                <label for="category_id">Category</label>
                <select class="form-control" name="category_id" id="category_id">
                    <option value="" disabled="" selected="">Please select</option>
                    @foreach($expense_cats as $cat)
                        <option value="{{ $cat->id }}" {{ isset($record) ? ($record->category_id == $cat->id ? 'selected' : '') : '' }}>{{ $cat->name }}</option>
                    @endforeach
                </select>
            </div>
            <div class="form-group">
                <label for="amount">Amount <span class="text-danger">*</span></label>
                <input type="number" step="any" id="amount" name="amount" class="form-control" value="{{ isset($record) ? $record->amount : '' }}" required>
            </div>
            <div class="form-group">
                <label for="description">Description</label>
                <textarea class="form-control" name="description" id="" cols="30" rows="5">{{ isset($record) ? $record->description : '' }}</textarea>
            </div>
            <div class="form-group">
                <label for="date">Expense Date <span class="text-danger">*</span></label>
                <input type="date" id="expense_date" name="expense_date" class="form-control" value="{{ isset($record) ? $record->expense_date : '' }}" required>
            </div>
            <div class="form-group">
                <label for="image">Image</label>
                <input class="form-control" type="file" name="image" id="image"  accept=".png,.jpg,.jpeg">
            </div>
            @if($page_type == 'ed')
            <div class="form-group">
                @if($record->image !== '')
                <img src="{{ asset('upload/expense/'. $record->image) }}" width="150" alt="">
                @endif
                <input type="hidden" name="current_image" value="{{ $record->image }}">
            </div>
            @endif

          <button type="submit" class="btn btn-danger">Submit</button>
    </div>
</div>

@endsection