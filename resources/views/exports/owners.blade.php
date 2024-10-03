<table>
    <thead>
        <tr>
            <th style="background-color: #ffbd57; width: 200px;"><strong>Nombre</strong></th>
            <th style="background-color: #ffbd57; width: 200px;"><strong>Apellido</strong></th>
            <th style="background-color: #ffbd57; width: 80px;"><strong>DNI</strong></th>
            <th style="background-color: #ffbd57; width: 80px;"><strong>Lote</strong></th>
            <th style="background-color: #ffbd57; width: 300px;"><strong>Email</strong></th>
        </tr>
    </thead>
    <tbody>
        @foreach ($owners as $owner)
            <tr>
                <td style="width: 200px;">{{ $owner->name }}</td>
                <td style="width: 200px;">{{ $owner->last_name }}</td>
                <td style="width: 80px;">{{ $owner->dni }}</td>
                <td style="width: 80px;">{{ $owner->lot }}</td>
                <td style="width: 300px;">{{ $owner->email }}</td>
            </tr>
        @endforeach
    </tbody>
</table>
