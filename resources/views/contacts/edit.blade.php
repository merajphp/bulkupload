
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
<div class="container mt-5" style="max-width: 500px;">
    <h3 class="mb-4 text-center">Edit Contact</h3>
    <form action="{{ route('contacts.update', $contact->id) }}" method="POST" class="border p-4 rounded shadow-sm bg-light">
        @csrf
        @method('PUT')
        <div class="mb-3">
            <label for="name" class="form-label">Name:</label>
            <input type="text" id="name" name="name" value="{{ $contact->name }}" class="form-control" required>
        </div>

        <div class="mb-3">
            <label for="number" class="form-label">Number:</label>
            <input type="text" id="number" name="number" value="{{ $contact->number }}" class="form-control" required>
        </div>

        <button type="submit" class="btn btn-primary w-100">Update</button>
    </form>
</div>
