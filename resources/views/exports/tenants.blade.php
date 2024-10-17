<table>
    <thead>
        <tr>
            <th style="background-color: #ffbd57; width: 200px;"><strong>Nombre</strong></th>
            <th style="background-color: #ffbd57; width: 200px;"><strong>Apellido</strong></th>
            <th style="background-color: #ffbd57; width: 80px;"><strong>DNI</strong></th>
            <th style="background-color: #ffbd57; width: 80px;"><strong>Lote</strong></th>
            <th style="background-color: #ffbd57; width: 300px;"><strong>Telefono</strong></th>
            <th style="background-color: #ffbd57; width: 300px;"><strong>Desde</strong></th>
            <th style="background-color: #ffbd57; width: 300px;"><strong>Hasta</strong></th>
        </tr>
    </thead>
    <tbody>
        @foreach ($tenants as $tenant)
            <tr>
                <td style="width: 200px;">{{ $tenant->name }}</td>
                <td style="width: 200px;">{{ $tenant->last_name }}</td>
                <td style="width: 80px;">{{ $tenant->dni }}</td>
                <td style="width: 80px;">{{ $tenant->lot }}</td>
                <td style="width: 300px;">{{ $tenant->phone }}</td>
                <td style="width: 300px;">{{ $tenant->since }}</td>
                <td style="width: 300px;">{{ $tenant->until }}</td>
            </tr>
        @endforeach
    </tbody>
</table>
