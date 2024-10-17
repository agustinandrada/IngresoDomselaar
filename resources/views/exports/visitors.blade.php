<table>
    <thead>
        <tr>
            <th style="background-color: #ffbd57; width: 200px;"><strong>Nombre</strong></th>
            <th style="background-color: #ffbd57; width: 200px;"><strong>Apellido</strong></th>
            <th style="background-color: #ffbd57; width: 80px;"><strong>DNI</strong></th>
            <th style="background-color: #ffbd57; width: 80px;"><strong>Lote</strong></th>
            <th style="background-color: #ffbd57; width: 300px;"><strong>Desde</strong></th>
            <th style="background-color: #ffbd57; width: 300px;"><strong>Hasta</strong></th>
        </tr>
    </thead>
    <tbody>
        @foreach ($visitors as $visitor)
            <tr>
                <td style="width: 200px;">{{ $visitor->name }}</td>
                <td style="width: 200px;">{{ $visitor->last_name }}</td>
                <td style="width: 80px;">{{ $visitor->dni }}</td>
                <td style="width: 80px;">{{ $visitor->lot }}</td>
                <td style="width: 300px;">{{ $visitor->since }}</td>
                <td style="width: 300px;">{{ $visitor->until }}</td>
            </tr>
        @endforeach
    </tbody>
</table>
