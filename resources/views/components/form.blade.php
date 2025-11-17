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
                        // Cari kamar yang tersedia untuk jenis ini
                        $kamarTersedia = $jenis->kamars->where('tersedia', 1)->first();
                        $available = $kamarTersedia ? true : false;
                    @endphp

                    <label class="room-type-card {{ !$available ? 'opacity-50 pointer-events-none cursor-not-allowed' : 'cursor-pointer' }}">
                        <input
                            type="radio"
                            name="jenis_kamar_id"
                            value="{{ $jenis->id }}"
                            class="room-type-radio"
                            {{ !$available ? 'disabled' : '' }}
                            required
                        >
                        <div class="room-type-content">
                            <div class="room-type-image"
                                style="background-image: url({{ $jenis->thumbnailPath }})">
                                @if(!$available)
                                    <div class="absolute inset-0 bg-black bg-opacity-50 flex items-center justify-center">
                                        <span class="text-white font-bold text-lg">SOLD OUT</span>
                                    </div>
                                @endif
                            </div>
                            <div class="room-type-info">
                                <h4 class="room-type-name">{{ $jenis->nama }}</h4>
                                <p class="room-type-price">
                                    @if($available)
                                        Rp.{{ number_format($jenis->harga, 0, ",", ".") }}/malam
                                    @else
                                        <span class="text-red-500 font-semibold">Tidak Tersedia</span>
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
                            <input
                                type="text"
                                class="form-input"
                                name="nama"
                                oninput="this.value = this.value.replace(/[^a-zA-Z\s]/g, '')"
                                required
                            >
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
                                oninput="this.value = this.value.replace(/[^0-9]/g, ''); limitNIK(this, 16)"
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
                            <input type="date" id="check_in" class="form-input" required name="check_in" oninput="minCheckIn(this)">
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
                    <h3 class="form-section-title">Layanan Tambahan</h3>
                    <div class="services-grid">
                        <label class="service-checkbox">
                            <input type="checkbox" name="sarapan" value="0">
                            <div class="service-label">
                                <span class="service-icon">🥐</span>
                                <span class="service-text">Sarapan <span class="text-xs">(Rp.80.000/malam)</span></span>
                            </div>
                        </label>
                    </div>
                </div>

                <!-- Summary -->
                <div class="booking-summary md:mx-4 lg:mx-8 xl:mx-12">
                    <div class="summary-title">Booking Summary</div>
                    <div class="summary-row">
                        <span class="summary-label">Ruangan</span>
                        <span class="summary-value">Belum dipilih</span>
                    </div>
                    <div class="summary-row">
                        <span class="summary-label">Durasi</span>
                        <span class="summary-value">1</span>
                    </div>
                    <div class="summary-row discount hidden">
                        <span class="summary-label">Diskon</span>
                        <span class="summary-value">10%</span>
                    </div>
                    <div class="summary-row total">
                        <span class="summary-label">Total</span>
                        <span class="summary-value">Rp 0</span>
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

function limitNIK(el, maxLength) {
    el.value = el.value.replace(/\D/g, '');
    if (el.value.length > maxLength) el.value = el.value.slice(0, maxLength);
    if (el.value.length !== 16) {
        el.setCustomValidity('Nomor identitas harus 16 angka');
    } else {
        el.setCustomValidity('');
    }
}

function minCheckIn(el) {
    const today = new Date().toISOString().split('T')[0];
    const checkInValue = el.value;
    if (checkInValue < today) {
        el.setCustomValidity('Tanggal check in harus setelah hari ini');
    } else {
        el.setCustomValidity('');
    }
}

// Calculate total price
function calculateTotal() {
    const selectedRoom = document.querySelector('input[name="jenis_kamar_id"]:checked:not(:disabled)');
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

    if(nights >= 3) {
        totalRoomPrice *= 0.9;
        const discountRow = document.querySelector('.discount');
        if (discountRow) {
            discountRow.classList.remove('hidden');
            discountRow.style.display = '';
        }
    } else {
        const discountRow = document.querySelector('.discount');
        if (discountRow) {
            discountRow.classList.add('hidden');
            discountRow.style.display = 'none';
        }
    }

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

    // Row 3: Discount
    const summaryDiscountElement = summaryRows[2]?.querySelector('.summary-value');
    if (summaryDiscountElement) {
        summaryDiscountElement.textContent = `10% (Rp ${(summary.roomPrice * 0.1).toLocaleString('id-ID')})`;
    }

    // Row 4: Total
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
});
  </script>
@endpush
