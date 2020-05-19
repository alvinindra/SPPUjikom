<table>
    <thead>
    <tr>
        <th>Nisn</th>
        <th>Nis</th>
        <th>Nama Siswa</th>
        <th>Kelas</th>
        <th>Kompetensi Keahlian</th>
        <th>Jenis Kelamin</th>
        <th>No.telp</th>
    </tr>
    </thead>
    <tbody>
    @foreach($siswa as $item)
        <tr>
            <td>{{ $item->nisn}}</td>
            <td>{{ $item->nis}}</td>
            <td>{{ $item->nama }}</td>
            <td>
                {{ $item->kelas->nama_kelas }}
            </td>
            <td>
                {{ $item->kelas->kompetensi_keahlian }}
            </td>
            <td>
                {{ $item->jenis_kelamin}}
            </td>
            <td>
                {{ $item->no_telp}}
            </td>
        </tr>
    @endforeach
    </tbody>
</table>