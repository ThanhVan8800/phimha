<table>
    <thead>
    <tr>
        <th>Name</th>
        <th>Email</th>
    </tr>
    </thead>
    <tbody>
    @foreach($invoices as $invoice)
        <tr>
            <td>{{ $invoice->name }}</td>
            <td>{{ $invoice->email }}</td>
            <td>{{ $invoice->thumb }}</td>
        </tr>
    @endforeach
    </tbody>
</table>