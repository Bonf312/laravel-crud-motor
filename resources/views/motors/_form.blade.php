<div class="row">
    <div class="col-md-6 mb-3">
        <label class="form-label">Nama Motor</label>
        <input type="text" name="nama" class="form-control"
            value="{{ old('nama', $motor->nama) }}" required>
        @error('nama') <div class="text-danger">{{ $message }}</div> @enderror
    </div>

    <div class="col-md-6 mb-3">
        <label class="form-label">Merek</label>
        <input type="text" name="merek" class="form-control"
            value="{{ old('merek', $motor->merek) }}" required>
        @error('merek') <div class="text-danger">{{ $message }}</div> @enderror
    </div>

<div class="mb-3">
    <label for="tipe" class="form-label">Tipe Motor</label>

    <select name="tipe" id="tipe" class="form-select" required>
        <option value="">Pilih Tipe Motor</option>
        <option value="Matic" @selected(old('tipe', $motor->tipe) == 'Matic')>
            Matic
        </option>
        <option value="Sport" @selected(old('tipe', $motor->tipe) == 'Sport')>
            Sport
        </option>
        <option value="Bebek" @selected(old('tipe', $motor->tipe) == 'Bebek')>
            Bebek
        </option>
    </select>

    @error('tipe')
        <div class="text-danger">{{ $message }}</div>
    @enderror
</div>

    <div class="col-md-4 mb-3">
        <label class="form-label">Tahun</label>
        <input type="number" name="tahun" class="form-control"
            value="{{ old('tahun', $motor->tahun) }}"
            min="1900" max="2100" required>
        @error('tahun') <div class="text-danger">{{ $message }}</div> @enderror
    </div>

    <div class="col-md-4 mb-3">
        <label class="form-label">Harga (Rp)</label>
        <input type="number" name="harga" class="form-control"
            value="{{ old('harga', $motor->harga) }}"
            min="0" step="0.01" required>
        @error('harga') <div class="text-danger">{{ $message }}</div> @enderror
    </div>

    <div class="col-md-4 mb-3">
        <label class="form-label">Stok</label>
        <input type="number" name="stok" class="form-control"
            value="{{ old('stok', $motor->stok ?? 0) }}"
            min="0" required>
        @error('stok') <div class="text-danger">{{ $message }}</div> @enderror
    </div>

    <div class="col-12 mb-3">
        <label class="form-label">Foto Motor</label>
        <input type="file" name="gambar" class="form-control"
            accept=".jpg,.jpeg,.png,.webp">

        <div class="form-text">JPG, JPEG, PNG, atau WEBP. Maksimal 2 MB.</div>
        @error('gambar') <div class="text-danger">{{ $message }}</div> @enderror

        @if (request()->routeIs('motors.edit') && $motor->gambar)
    <div class="mt-2">
        <p class="mb-1">Foto saat ini:</p>
        <img src="{{ asset('storage/' . $motor->gambar) }}"
            alt="Foto motor"
            class="img-thumbnail"
            style="max-width: 220px; max-height: 160px; object-fit: contain;">
    </div>
@endif
    </div>
</div>

<hr>
<h5 class="mb-3">Spesifikasi Motor</h5>

@php
    $sp = $motor->spesifikasi;
@endphp

<div class="row">
    <div class="col-md-4 mb-3">
        <label class="form-label">Kapasitas Mesin (CC)</label>
        <input type="number" name="spesifikasi[kapasitas_cc]"
            class="form-control" min="0"
            value="{{ old('spesifikasi.kapasitas_cc', $sp?->kapasitas_cc) }}">
        @error('spesifikasi.kapasitas_cc') <div class="text-danger">{{ $message }}</div> @enderror
    </div>

    <div class="col-md-4 mb-3">
        <label class="form-label">Transmisi</label>
        <select name="spesifikasi[transmisi]" class="form-select">
            <option value="">-- Pilih transmisi --</option>
            @foreach (['Otomatis', 'Manual', 'Semi otomatis'] as $item)
                <option value="{{ $item }}"
                    @selected(old('spesifikasi.transmisi', $sp?->transmisi) === $item)>
                    {{ $item }}
                </option>
            @endforeach
        </select>
        @error('spesifikasi.transmisi') <div class="text-danger">{{ $message }}</div> @enderror
    </div>

    <div class="col-md-4 mb-3">
        <label class="form-label">Bahan Bakar</label>
        <select name="spesifikasi[bahan_bakar]" class="form-select">
            <option value="">-- Pilih bahan bakar --</option>
            @foreach (['Bensin', 'Listrik', 'Hybrid'] as $item)
                <option value="{{ $item }}"
                    @selected(old('spesifikasi.bahan_bakar', $sp?->bahan_bakar) === $item)>
                    {{ $item }}
                </option>
            @endforeach
        </select>
        @error('spesifikasi.bahan_bakar') <div class="text-danger">{{ $message }}</div> @enderror
    </div>

    <div class="col-md-4 mb-3">
        <label class="form-label">Berat Motor (kg)</label>
        <input type="number" step="0.01" min="0"
            name="spesifikasi[berat_motor]" class="form-control"
            value="{{ old('spesifikasi.berat_motor', $sp?->berat_motor) }}">
        @error('spesifikasi.berat_motor') <div class="text-danger">{{ $message }}</div> @enderror
    </div>

    <div class="col-md-4 mb-3">
        <label class="form-label">Kapasitas Tangki (liter)</label>
        <input type="number" step="0.01" min="0"
            name="spesifikasi[kapasitas_tangki]" class="form-control"
            value="{{ old('spesifikasi.kapasitas_tangki', $sp?->kapasitas_tangki) }}">
        @error('spesifikasi.kapasitas_tangki') <div class="text-danger">{{ $message }}</div> @enderror
    </div>

    <div class="col-md-4 mb-3">
        <label class="form-label">Rem ABS</label>
        <select name="spesifikasi[rem_abs]" class="form-select">
            <option value="0"
                @selected((string) old('spesifikasi.rem_abs', (int) ($sp?->rem_abs ?? false)) === '0')>
                Tidak
            </option>
            <option value="1"
                @selected((string) old('spesifikasi.rem_abs', (int) ($sp?->rem_abs ?? false)) === '1')>
                Ya
            </option>
        </select>
        @error('spesifikasi.rem_abs') <div class="text-danger">{{ $message }}</div> @enderror
    </div>

    <div class="col-md-4 mb-3">
        <label class="form-label">Sistem Pendingin</label>
        <select name="spesifikasi[sistem_pendingin]" class="form-select">
            <option value="">-- Pilih sistem --</option>
            @foreach (['Udara', 'Cairan', 'Oli'] as $item)
                <option value="{{ $item }}"
                    @selected(old('spesifikasi.sistem_pendingin', $sp?->sistem_pendingin) === $item)>
                    {{ $item }}
                </option>
            @endforeach
        </select>
        @error('spesifikasi.sistem_pendingin') <div class="text-danger">{{ $message }}</div> @enderror
    </div>

    <div class="col-md-4 mb-3">
        <label class="form-label">Tenaga Mesin (PS)</label>
        <input type="number" step="0.01" min="0"
            name="spesifikasi[tenaga_mesin]" class="form-control"
            value="{{ old('spesifikasi.tenaga_mesin', $sp?->tenaga_mesin) }}">
        @error('spesifikasi.tenaga_mesin') <div class="text-danger">{{ $message }}</div> @enderror
    </div>

    <div class="col-md-4 mb-3">
        <label class="form-label">Torsi (Nm)</label>
        <input type="number" step="0.01" min="0"
            name="spesifikasi[torsi]" class="form-control"
            value="{{ old('spesifikasi.torsi', $sp?->torsi) }}">
        @error('spesifikasi.torsi') <div class="text-danger">{{ $message }}</div> @enderror
    </div>
</div>