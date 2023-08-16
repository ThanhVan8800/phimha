<form action="{{ route('export') }}" method="POST">
    @csrf
    <!-- Form fields here -->
    <input type="text" name="text">
    <input type="text" name="name">
    <button type="submit">Export to Excel</button>
</form>