<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Librarian - Search Student Dues</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <div class="container mt-5">
        <h1>Search Student Dues</h1>

        <!-- Display Errors -->
        @if ($errors->any())
            <div class="alert alert-danger">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <!-- Search Form -->
        <form action="{{ route('librarian.search.dues.submit') }}" method="POST">
            @csrf
            <div class="mb-3">
                <label for="studentId" class="form-label">Student ID</label>
                <input type="text" name="studentId" id="studentId" class="form-control" value="{{ old('studentId', $studentId ?? '') }}" placeholder="Enter Student ID">
            </div>
            <button type="submit" class="btn btn-primary">Search</button>
        </form>

        <!-- Display Results -->
        @if (!empty($dues))
            <h2 class="mt-4">Dues for Student ID: {{ $studentId }}</h2>
            <ul class="list-group">
                @forelse ($dues as $due)
                    <li class="list-group-item">
                        {{ $due['title'] ?? 'Unknown Title' }} - ${{ $due['fine'] ?? '0.00' }}
                    </li>
                @empty
                    <li class="list-group-item">No dues found.</li>
                @endforelse
            </ul>
        @endif
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
