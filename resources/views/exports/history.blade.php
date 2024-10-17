<table>
    <thead>
        <tr>
            <th style="background-color: #ffbd57; width: 200px;"><strong>Nombre</strong></th>
            <th style="background-color: #ffbd57; width: 200px;"><strong>Apellido</strong></th>
            <th style="background-color: #ffbd57; width: 100px;"><strong>Tipo</strong></th>
            <th style="background-color: #ffbd57; width: 80px;"><strong>DNI</strong></th>
            <th style="background-color: #ffbd57; width: 80px;"><strong>Lote</strong></th>
            <th style="background-color: #ffbd57; width: 80px;"><strong>Registro</strong></th>
            <th style="background-color: #ffbd57; width: 80px;"><strong>Fecha</strong></th>
            <th style="background-color: #ffbd57; width: 80px;"><strong>Hora</strong></th>
            <th style="background-color: #ffbd57; width: 80px;"><strong>Vehiculo</strong></th>
            <th style="background-color: #ffbd57; width: 80px;"><strong>Modelo</strong></th>
            <th style="background-color: #ffbd57; width: 80px;"><strong>Patente</strong></th>
            <th style="background-color: #ffbd57; width: 80px;"><strong>Color</strong></th>
            <th style="background-color: #ffbd57; width: 300px;"><strong>Observacion</strong></th>
        </tr>
    </thead>
    <tbody>
        @foreach ($historys as $history)
            <tr>
                <td style="width: 200px;">{{ $history->name }}</td>
                <td style="width: 200px;">{{ $history->last_name }}</td>
                <td style="width: 100px;">{{ $history->type }}</td>
                <td style="width: 80px;">{{ $history->dni }}</td>
                <td style="width: 80px;">{{ $history->lot }}</td>
                <td style="width: 80px;">{{ $history->reason }}</td>
                <td style="width: 80px;">{{ $history->date }}</td>
                <td style="width: 80px;">{{ $history->hour }}</td>
                <td style="width: 80px;">{{ $history->vehicle }}</td>
                <td style="width: 80px;">{{ $history->carModel }}</td>
                <td style="width: 80px;">{{ $history->plate }}</td>
                <td style="width: 80px;">{{ $history->color }}</td>
                <td style="width: 300px;">{{ $history->observation }}</td>
            </tr>
        @endforeach
    </tbody>
</table>
