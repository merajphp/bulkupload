<h3>Import Contacts (XML)</h3>
<form action="{{ route('contacts.import') }}" method="POST" enctype="multipart/form-data">
    @csrf
    <input type="file" name="xml_file" accept=".xml" required>
    <button type="submit">Import</button>
</form>
<br>
