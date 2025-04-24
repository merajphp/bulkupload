<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Contact List</title>
    <!-- Bootstrap 5 -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">


</head>
<body>

<div class="container">
<div class="d-flex justify-content-center align-items-center" style="height: 100vh; margin-top:-200px;">
    <div class="text-center border p-4 bg-white rounded shadow" style="width: 400px;">
        <h3>Import Contacts XML</h3>
        <form action="{{ route('contacts.import') }}" method="POST" enctype="multipart/form-data">
            @csrf
            <input type="file" name="xml_file" accept=".xml" class="form-control mb-3" required>
            <button class="btn btn-success w-100" type="submit">Import</button>
        </form>
    </div>
</div>

    @if(session('message'))
        <div class="alert alert-success message">{{ session('message') }}</div>
    @endif

    <table class="table table-bordered table-hover" style="height: 100vh; margin-top:-300px;">
        <thead>
            <tr>
                <th>ID</th>
                <th>Name</th>
                <th>Phone</th>
                <th style="width: 180px;">Actions</th>
            </tr>
        </thead>
        <tbody>
            @forelse($contacts as $contact)
                <tr>
                    <td>{{ $contact->id }}</td>
                    <td>{{ $contact->name }}</td>
                    <td>{{ $contact->number }}</td>
                    <td>
                        <a href="{{ route('contacts.edit', $contact) }}" class="btn btn-sm btn-warning">Edit</a>
                        <form action="{{ route('contacts.destroy', $contact) }}" method="POST" class="d-inline">
                            @csrf
                            @method('DELETE')
                            <button class="btn btn-sm btn-danger" onclick="return confirm('Are you sure?')">Delete</button>
                        </form>
                    </td>
                </tr>
            @empty
                <tr>
                    <td colspan="4" class="text-center text-muted">No contacts found.</td>
                </tr>
            @endforelse
        </tbody>
    </table>

    @if($contacts->hasPages())
        <div class="d-flex justify-content-center mt-4">
            {{$contacts->links('pagination::bootstrap-5')}}
        </div>
    @endif
</div>

</body>
</html>
