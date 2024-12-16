@if($errors->any())
    <div class="alert alert-danger">
        @foreach ($errors->all() as $error)
            <p>{{ $error }}</p>
        @endforeach
    </div>
@endif

<h1>Student Dues</h1>
<ul>
    @if (is_array($dues) && count($dues) > 0)
        @foreach ($dues as $due)
            <li>{{ $due['item_name'] ?? 'Unknown Item' }} - ${{ $due['amount'] ?? '0.00' }}</li>
        @endforeach
    @else
        <li>No dues found.</li>
    @endif
</ul>