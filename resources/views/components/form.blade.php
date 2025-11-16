{{-- components/form.blade.php --}}
<div id="booking-modal" class="modal">
    <div class="modal-overlay" onclick="closeBookingModal()"></div>
    <div class="modal-container">
        <!-- Header -->
        <div class="modal-header">
            <h2 class="modal-title">Booking Form</h2>
            <button class="modal-close" onclick="closeBookingModal()">✕</button>
        </div>

        <!-- Body -->
        <div class="modal-body">
            <form action="{{ route('pesanan.store') }}" method="post">
            @csrf
            <!-- Room Selection -->
              <div class="form-section">
                  <h3 class="form-section-title">Select Room Type</h3>
                  <div class="room-type-grid">
                    @foreach($jenisKamars as $jenis)
                    @php
                        // cari kamar yang tersedia
                        $kamarTersedia = $jenis->kamars->where('tersedia', 1)->first();
                        $available = $kamarTersedia ? 1 : 0;
                    @endphp

                    <label class="room-type-card {{ $available ? '' : 'opacity-50 pointer-events-none' }}">
                        <input type="radio" name="jenis_kamar_id" value="{{ $jenis->id }}" class="room-type-radio"
                            {{ $available ? '' : 'disabled' }} required>
                        <div class="room-type-content">
                            <div class="room-type-image"
                                style="background-image: url({{ $jenis->thumbnailPath }})">
                            </div>
                            <div class="room-type-info">
                                <h4 class="room-type-name">{{ $jenis->nama }}</h4>
                                <p class="room-type-price">
                                    @if($available)
                                        Rp.{{ number_format($jenis->harga, 0, ",", ".") }}/malam
                                    @else
                                        <span class="text-red-500">Tidak tersedia</span>
                                    @endif
                                </p>
                                <p class="room-type-details">{{ $jenis->deskripsi }}</p>
                            </div>
                        </div>
                    </label>
                    @endforeach
                  </div>
              </div>

                <!-- Guest Info -->
                <div class="form-section md:mx-4 lg:mx-8 xl:mx-12">
                    <h3 class="form-section-title">Informasi Pribadi</h3>
                    <div class="form-grid">
                        <div class="form-group">
                            <label class="form-label">Nama Anda</label>
                            <input type="text" class="form-input" name="nama" required>
                        </div>
                        <div class="form-group">
                            <label class="form-label">Jenis Kelamin</label>

                            <input type="radio" id="laki2" name="jenis_kelamin" value="laki-laki" required>
                            <label for="laki2" class="mr-2">Laki-Laki</label>

                            <input type="radio" id="perempuan" name="jenis_kelamin" value="perempuan" required>
                            <label for="perempuan" class="mr-2">Perempuan</label>
                        </div>
                        <div class="form-group">
                            <label class="form-label">Nomor Identitas (NIK)</label>
                            <input
                                type="text"
                                class="form-input"
                                name="nomor_identitas"
                                pattern="\d{16}"
                                maxlength="16"
                                maxlength="16"
                                oninput="this.value = this.value.replace(/[^0-9]/g, '')"
                                required
                            >
                        </div>
                    </div>
                </div>

                <!-- Dates -->
                <div class="form-section md:mx-4 lg:mx-8 xl:mx-12">
                    <h3 class="form-section-title">Tanggal Pemesanan</h3>
                    <div class="form-grid">
                        <div class="form-group">
                            <label class="form-label">Check-In</label>
                            <input type="date" id="check_in" class="form-input" required name="check_in">
                        </div>
                        <div class="form-group">
                          <label class="form-label">Durasi (hari)</label>
                          <div class="relative">
                            <input
                              type="number"
                              class="form-input pr-12"
                              required
                              name="durasi_menginap"
                              min="1"
                              pattern="[0-9]*"
                              inputmode="numeric"
                              oninput="this.value = this.value.replace(/[^0-9]/g, '')"
                              value="1"
                            >
                          </div>
                        </div>
                    </div>
                </div>

                <!-- Services -->
                <div class="form-section md:mx-4 lg:mx-8 xl:mx-12">
                    <h3 class="form-section-title">Additional Services</h3>
                    <div class="services-grid">
                        <label class="service-checkbox">
                            <input type="checkbox" name="sarapan" value="0">
                            <div class="service-label">
                                <span class="service-icon">🥐</span>
                                <span class="service-text">Breakfast</span>
                            </div>
                        </label>
                    </div>
                </div>

                <!-- Summary -->
                <div class="booking-summary md:mx-4 lg:mx-8 xl:mx-12">
                    <div class="summary-title">Booking Summary</div>
                    <div class="summary-row">
                        <span class="summary-label">Ruangan</span>
                        <span class="summary-value">Deluxe Suite</span>
                    </div>
                    <div class="summary-row">
                        <span class="summary-label">Nights</span>
                        <span class="summary-value">2</span>
                    </div>
                    <div class="summary-row total">
                        <span class="summary-label">Total</span>
                        <span class="summary-value">0</span>
                    </div>
                </div>

                <!-- Footer -->
                <div class="modal-footer">
                    <button type="button" class="btn-cancel" onclick="closeBookingModal()">Cancel</button>
                    <button type="submit" class="btn-submit-booking">Confirm Booking</button>
                </div>
            </form>
        </div>
    </div>
</div>

@push('scripts')
  <script>
  // Open modal
function openBookingModal() {
    const modal = document.getElementById('booking-modal');
    if (modal) {
        modal.classList.add('active');
        document.body.style.overflow = 'hidden';
        setMinDates();
        updateSummary();
    }
}

// Close modal
function closeBookingModal() {
    const modal = document.getElementById('booking-modal');
    if (modal) {
        modal.classList.remove('active');
        document.body.style.overflow = '';
    }
}

// Set minimum dates
function setMinDates() {
    const today = new Date().toISOString().split('T')[0];
    const checkInInput = document.getElementById('check_in');
    if (checkInInput) {
        checkInInput.min = today;
    }
}

// Calculate total price
function calculateTotal() {
    const selectedRoom = document.querySelector('input[name="jenis_kamar_id"]:checked');
    const durasiInput = document.querySelector('input[name="durasi_menginap"]');
    const sarapanCheckbox = document.querySelector('input[name="sarapan"]');

    let roomPrice = 0;
    let roomName = 'Belum dipilih';
    let nights = parseInt(durasiInput?.value) || 1;

    if (selectedRoom) {
        const roomCard = selectedRoom.closest('.room-type-card');
        const roomNameElement = roomCard.querySelector('.room-type-name');
        const roomPriceElement = roomCard.querySelector('.room-type-price');

        roomName = roomNameElement?.textContent || 'Belum dipilih';

        // Extract price from text (format: Rp.XXX.XXX/malam)
        if (roomPriceElement) {
            const priceText = roomPriceElement.textContent;
            const priceMatch = priceText.match(/Rp\.([\d.]+)/);
            if (priceMatch) {
                roomPrice = parseInt(priceMatch[1].replace(/\./g, ''));
            }
        }
    }

    let totalRoomPrice = roomPrice * nights;
    let sarapanPrice = 0;
    const sarapanPricePerDay = 80000; // Rp 80.000 per hari

    if (sarapanCheckbox?.checked) {
        sarapanPrice = sarapanPricePerDay * nights;
    }

    let totalPrice = totalRoomPrice + sarapanPrice;

    return {
        roomName,
        nights,
        roomPrice: totalRoomPrice,
        sarapanPrice,
        totalPrice
    };
}

// Update summary display
function updateSummary() {
    const summary = calculateTotal();

    // Update summary elements
    const summaryRows = document.querySelectorAll('.summary-row');

    // Row 1: Ruangan
    const summaryRoomElement = summaryRows[0]?.querySelector('.summary-value');
    if (summaryRoomElement) {
        summaryRoomElement.textContent = summary.roomName;
    }

    // Row 2: Nights
    const summaryNightsElement = summaryRows[1]?.querySelector('.summary-value');
    if (summaryNightsElement) {
        summaryNightsElement.textContent = summary.nights;
    }

    // Row 3: Total
    const summaryTotalElement = document.querySelector('.summary-row.total .summary-value');
    if (summaryTotalElement) {
        summaryTotalElement.textContent = `Rp ${summary.totalPrice.toLocaleString('id-ID')}`;
    }
}

// Event listeners
document.addEventListener('DOMContentLoaded', function() {
    // Room selection change
    document.querySelectorAll('input[name="jenis_kamar_id"]').forEach(radio => {
        radio.addEventListener('change', updateSummary);
    });

    // Duration input change
    const durasiInput = document.querySelector('input[name="durasi_menginap"]');
    if (durasiInput) {
        durasiInput.addEventListener('input', updateSummary);

        // Prevent negative or zero values
        durasiInput.addEventListener('blur', function() {
            if (!this.value || parseInt(this.value) < 1) {
                this.value = 1;
                updateSummary();
            }
        });
    }

    // Check-in date change
    const checkInInput = document.getElementById('check_in');
    if (checkInInput) {
        checkInInput.addEventListener('change', updateSummary);
    }

    // Sarapan checkbox change
    const sarapanCheckbox = document.querySelector('input[name="sarapan"]');
    if (sarapanCheckbox) {
        sarapanCheckbox.addEventListener('change', function() {
            // Set value to 1 when checked, remove when unchecked
            this.value = this.checked ? '1' : '0';
            updateSummary();
        });
    }

    // Close modal on escape key
    document.addEventListener('keydown', function(e) {
        if (e.key === 'Escape') {
            closeBookingModal();
        }
    });

    // Initial summary update
    updateSummary();
});    </script>
    @endpush
