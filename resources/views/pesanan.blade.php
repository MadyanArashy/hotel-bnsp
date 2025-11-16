<x-app-layout>
  <div class="flex flex-grow">
    <table class="w-[50%] mx-auto">
      <thead>
        <tr>
          <th>Pemesan</th>
          <th>Kelamin</th>
          <th>No_Identitas</th>
          <th>Check In</th>
          <th>Durasi</th>
          <th>Sarapan</th>
          <th>Total Bayar</th>
          <th>Kamar</th>
        </tr>
        </thead>
        <tbody>
        @foreach ($pesanans as $data)
            <tr>
                <td>{{ $data->nama }}</td>
                <td>{{ $data->jenis_kelamin }}</td>
                <td>{{ $data->nomor_identitas }}</td>
                <td>{{ $data->check_in->timezone('Asia/Jakarta')->format('l, d M Y e') }}</td>
                <td>{{ $data->durasi_menginap }} hari</td>
                <td>{{ $data->sarapan ? 'iya' : 'tidak' }}</td>
                <td>{{ $data->total_bayar }}</td>
                <td>
                    <b class="font-bold">{{ $data->kamar->jenis->nama ?? '-' }}</b>
                </td>
            </tr>
        @endforeach
        </tbody>

    </table>
  </div>
</x-app-layout>
