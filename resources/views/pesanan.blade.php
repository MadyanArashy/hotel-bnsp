<x-app-layout>
  <div class="flex flex-grow w-full min-h-screen items-center justify-center">
    <table class="absolute top-20">
      <thead>
        <tr>
          <th class="text-center border-2 border-amber-500 px-4">Pemesan</th>
          <th class="text-center border-2 border-amber-500 px-4">Kelamin</th>
          <th class="text-center border-2 border-amber-500 px-4">No_Identitas</th>
          <th class="text-center border-2 border-amber-500 px-4">Check In</th>
          <th class="text-center border-2 border-amber-500 px-4">Check Out</th>
          <th class="text-center border-2 border-amber-500 px-4">Durasi</th>
          <th class="text-center border-2 border-amber-500 px-4">Sarapan</th>
          <th class="text-center border-2 border-amber-500 px-4">Total Bayar</th>
          <th class="text-center border-2 border-amber-500 px-4">Kamar</th>
        </tr>
        </thead>
        <tbody>
        @foreach ($pesanans as $data)
            <tr>
                <td class="text-center border border-amber-300 px-4">{{ $data->nama }}</td>
                <td class="text-center border border-amber-300 px-4">{{ $data->jenis_kelamin }}</td>
                <td class="text-center border border-amber-300 px-4">{{ $data->nomor_identitas }}</td>
                <td class="text-center border border-amber-300 px-4">{{ $data->check_in->timezone('Asia/Jakarta')->format('l, d M Y') }}</td>
                <td class="text-center border border-amber-300 px-4">{{ $data->check_in->clone()->addDays($data->durasi_menginap)->timezone('Asia/Jakarta')->format('l, d M Y') }}</td>
                <td class="text-center border border-amber-300 px-4">{{ $data->durasi_menginap }} hari</td>
                <td class="text-center border border-amber-300 px-4">{{ $data->sarapan ? 'iya' : 'tidak' }}</td>
                <td class="text-center border border-amber-300 px-4">Rp.{{ number_format($data->total_bayar, 2, ',', '.') }}</td>
                <td class="text-center border border-amber-300 px-4">
                    <b class="font-bold">{{ $data->kamar->jenis->nama ?? '-' }}</b>
                </td>
            </tr>
        @endforeach
        </tbody>

    </table>
  </div>
</x-app-layout>
