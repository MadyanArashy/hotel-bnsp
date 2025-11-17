<x-app-layout>
  <div class="flex flex-col w-full items-center absolute top-24">
    <h1 class="text-3xl font-bold">
        Pesanan Kamar
    </h1>
    <table>
      <thead>
        <tr>
          <th class="text-center border-2 border-amber-600 bg-amber-500 px-4 py-1">No.</th>
          <th class="text-center border-2 border-amber-600 bg-amber-500 px-4 py-1">Pemesan</th>
          <th class="text-center border-2 border-amber-600 bg-amber-500 px-4 py-1">Kelamin</th>
          <th class="text-center border-2 border-amber-600 bg-amber-500 px-4 py-1">No_Identitas</th>
          <th class="text-center border-2 border-amber-600 bg-amber-500 px-4 py-1">Check In</th>
          <th class="text-center border-2 border-amber-600 bg-amber-500 px-4 py-1">Check Out</th>
          <th class="text-center border-2 border-amber-600 bg-amber-500 px-4 py-1">Durasi</th>
          <th class="text-center border-2 border-amber-600 bg-amber-500 px-4 py-1">Sarapan</th>
          <th class="text-center border-2 border-amber-600 bg-amber-500 px-4 py-1">Total Bayar</th>
          <th class="text-center border-2 border-amber-600 bg-amber-500 px-4 py-1">Kamar</th>
        </tr>
        </thead>
        <tbody>
        @foreach ($pesanans as $data)
            <tr class="cursor-pointer" onclick="openDataModal(document.getElementById('data-modal-{{ $data->id }}'))">
                <td class="text-center border-2 border-amber-600 px-4 bg-amber-500">{{ $loop->iteration }}</td>
                <td class="text-start border border-amber-300 px-4 {{ $loop->iteration % 2 ? '' : 'bg-amber-100' }}">{{ $data->nama }}</td>
                <td class="text-start border border-amber-300 px-4 {{ $loop->iteration % 2 ? '' : 'bg-amber-100' }}">{{ $data->jenis_kelamin }}</td>
                <td class="text-start border border-amber-300 px-4 {{ $loop->iteration % 2 ? '' : 'bg-amber-100' }}">{{ $data->nomor_identitas }}</td>
                <td class="text-start border border-amber-300 px-4 {{ $loop->iteration % 2 ? '' : 'bg-amber-100' }}">{{ $data->check_in->timezone('Asia/Jakarta')->format('l, d M Y') }}</td>
                <td class="text-start border border-amber-300 px-4 {{ $loop->iteration % 2 ? '' : 'bg-amber-100' }}">{{ $data->check_in->addDays($data->durasi_menginap)->timezone('Asia/Jakarta')->format('l, d M Y') }}</td>
                <td class="text-start border border-amber-300 px-4 {{ $loop->iteration % 2 ? '' : 'bg-amber-100' }}">{{ $data->durasi_menginap }} hari</td>
                <td class="text-start border border-amber-300 px-4 {{ $loop->iteration % 2 ? '' : 'bg-amber-100' }}">{{ $data->sarapan ? 'iya' : 'tidak' }}</td>
                <td class="text-start border border-amber-300 px-4 {{ $loop->iteration % 2 ? '' : 'bg-amber-100' }}">Rp.{{ number_format($data->total_bayar, 2, ',', '.') }}</td>
                <td class="text-start border border-amber-300 px-4 {{ $loop->iteration % 2 ? '' : 'bg-amber-100' }}">
                    <b class="font-bold">{{ $data->kamar->jenis->nama ?? '-' }}</b>
                </td>
            </tr>
            <div id="data-modal-{{ $data->id }}" class="modal">
                <div class="modal-overlay" onclick="closeDataModal(document.getElementById('data-modal-{{ $data->id }}'))"></div>
                <div class="modal-container">
                    <!-- Header -->
                    <div class="modal-header">
                        <h2 class="modal-title">Data Pesanan {{ $data->nama . " (id:$data->id)" }}</h2>
                        <button class="modal-close" onclick="closeDataModal(document.getElementById('data-modal-{{ $data->id }}'))">✕</button>
                    </div>

                    <!-- Modal Body -->
                    <div class="modal-body">
                        <div class="space-y-3">
                            <div class="grid grid-cols-2 gap-4">
                                <p class="font-semibold text-gray-700">Nama:</p>
                                <p class="text-gray-900">{{ $data->nama }}</p>
                            </div>
                            <div class="grid grid-cols-2 gap-4">
                                <p class="font-semibold text-gray-700">Nomor Identitas:</p>
                                <p class="text-gray-900">{{ $data->nomor_identitas }}</p>
                            </div>
                            <div class="grid grid-cols-2 gap-4">
                                <p class="font-semibold text-gray-700">Jenis Kelamin:</p>
                                <p class="text-gray-900">{{ $data->jenis_kelamin }}</p>
                            </div>
                            <div class="grid grid-cols-2 gap-4">
                                <p class="font-semibold text-gray-700">Tipe Kamar:</p>
                                <p class="text-gray-900 font-bold">{{ $data->kamar->jenis->nama ?? '-' }}</p>
                            </div>
                            <div class="grid grid-cols-2 gap-4">
                                <p class="font-semibold text-gray-700">Durasi Penginapan:</p>
                                <p class="text-gray-900">{{ $data->durasi_menginap }} hari</p>
                            </div>
                            <div class="grid grid-cols-2 gap-4">
                                <p class="font-semibold text-gray-700">Harga Normal:</p>
                                @php
                                    if ($data->sarapan) {
                                        $sarapan = 80000;
                                    } else {
                                        $sarapan = 0;
                                    }
                                @endphp
                                <p class="text-gray-900">Rp.{{ number_format(($data->kamar->jenis->harga + $sarapan) * $data->durasi_menginap, 2, ',', '.') }}</p>
                            </div>
                            <div class="grid grid-cols-2 gap-4 {{ $data->durasi_menginap < 3 ? 'hidden' : '' }}">
                                <p class="font-semibold text-gray-700">Diskon:</p>
                                <p class="text-gray-900">10% (Rp.{{ number_format($data->kamar->jenis->harga * $data->durasi_menginap * 0.1, 2, ',', '.') }})</p>
                            </div>
                            <div class="grid grid-cols-2 gap-4">
                                <p class="font-semibold text-gray-700">Total Bayar:</p>
                                <p class="text-gray-900">Rp.{{ number_format($data->total_bayar, 2, ',', '.') }}</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        @endforeach
        </tbody>
    </table>
    </div>
    @push('scripts')
    <script>
    function openDataModal(modal) {
        modal.classList.add('active');
    }
    function closeDataModal(modal) {
        modal.classList.remove('active');
    }

    </script>
    @endpush
</x-app-layout>
