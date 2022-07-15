@extends('layout.apps')
@section('content')
    
<div class="card mb-4">
    <div class="card-header">
        <span class="small ms-1">Expense Categories</span>
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
                <label for="category_parent">Parent Category</label>
                <select class="form-control" name="category_parent" id="category_parent">
                    <option value="" disabled="" selected="">Please select</option>
                    @foreach($expense_cats as $expense)
                        <option value="{{ $expense->id }}">{{ $expense->name }}</option>
                    @endforeach
                </select>
            </div>
            <div class="form-group">
                <label for="image">Image</label>
                <input class="form-control" type="file" name="image" id="image"  accept=".png,.jpg,.jpeg,.pdf">
               
            </div>
            @if($page_type == 'ed')
            <div class="form-group">
                @if($record->image !== '')
                <img src="{{ asset('upload/expense_category/'. $expense->image) }}" width="150" alt="">
                @endif
                <input type="hidden" name="current_image" value={{ $expense->image }}>
            </div>
            @endif

          <button type="submit" class="btn btn-danger">Submit</button>
    </div>
</div>

@endsection