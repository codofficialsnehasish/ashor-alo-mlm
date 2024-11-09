<h2>Customer List</h2>
<table class="table">
    <thead>
        <tr>
            <th>Reg Date</th>
            <th>Name</th>
            <th>Position</th>
            <th>Level</th>
            <th>Mobile</th>
            <th>Email</th>
            <th>Status</th>
            <th>Agent Name</th>
        </tr>
    </thead>
    <tbody>
        @foreach($customers as $c)
            <tr>
                <td>{{ format_datetime($c->created_at) }}</td>
                <td>{{ $c->name }}</td>
                <td>{{ $c->is_left ? 'Left' : 'Right' }}</td>
                <td>{{ $c->level }}</td>
                <td>{{ $c->phone }}</td>
                <td>{{ $c->email }}</td>
                <td>{{ $c->status }}</td>
                <td>{{ get_user_name('user_id', $c->agent_id) }}</td>
            </tr>
        @endforeach
    </tbody>
</table>
