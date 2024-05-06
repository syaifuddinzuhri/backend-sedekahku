<table>
    <thead>
        <tr>
            @if (isset($payload['is_all']))
                <th>Semua Tanggal</th>
                <th></th>
            @else
                <th>Dari</th>
                <th style="font-weight: bold">{{ $payload['from_date'] }}</th>
                <th></th>
                <th>Sampai</th>
                <th style="font-weight: bold">{{ $payload['end_date'] }}</th>
            @endif
        </tr>
        <tr></tr>
        <tr>
            <th style="font-weight: bold">Program</th>
            <th style="font-weight: bold">Total Sedekah</th>
        </tr>
    </thead>
    <tbody>
        @foreach ($data as $item)
            <tr>
                <td>{{ $item->name }}</td>
                <td>{{ $item->total }}</td>
            </tr>
        @endforeach
    </tbody>
</table>
