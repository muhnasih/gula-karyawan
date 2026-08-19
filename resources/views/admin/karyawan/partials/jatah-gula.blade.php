{{-- =========================================================
    PARTIAL: PENGATURAN JATAH GULA
    =========================================================
    Variabel yang dibutuhkan dari view pemanggil:
    - $aturanJatahGula (Collection dari AturanJatahGula)
========================================================= --}}

<style>
    .jatah-gula-grid {
        display: grid;
        grid-template-columns: repeat(auto-fill, minmax(260px, 1fr));
        gap: 16px;
    }

    .jatah-gula-item {
        display: flex;
        flex-direction: column;
        height: 100%;
        border: 1px solid #e9ecef;
        border-left: 4px solid #adb5bd;
        border-radius: 12px;
        padding: 16px;
        background: #f8f9fa;
        transition: box-shadow 0.2s ease, transform 0.2s ease;
    }

    .jatah-gula-item:hover {
        box-shadow: 0 6px 16px rgba(0, 0, 0, 0.08);
        transform: translateY(-2px);
    }

    .jatah-gula-item.punya-jatah {
        border-left-color: #198754;
    }

    .jatah-gula-header {
        display: flex;
        justify-content: space-between;
        align-items: flex-start;
        gap: 8px;
        margin-bottom: 14px;
    }

    .jatah-gula-status-label {
        font-size: 11px;
        text-transform: uppercase;
        letter-spacing: 0.03em;
        color: #6c757d;
        margin-bottom: 2px;
    }

    .jatah-gula-status {
        font-size: 15px;
        font-weight: 700;
        color: #212529;
        word-break: break-word;
    }

    .jatah-gula-label {
        font-size: 12px;
        font-weight: 600;
        color: #495057;
        margin-bottom: 6px;
    }

    .jatah-gula-input-group {
        margin-bottom: 10px;
    }

    .jatah-gula-input {
        font-weight: 600;
        text-align: center;
    }

    .jatah-gula-info {
        font-size: 12px;
        color: #6c757d;
        margin-top: auto;
        padding-top: 10px;
    }

    @media (max-width: 767.98px) {

        .jatah-gula-item:hover {
            transform: none;
        }
    }

    @media (max-width: 575.98px) {

        .jatah-gula-grid {
            grid-template-columns: 1fr;
            gap: 12px;
        }

        .jatah-gula-item {
            padding: 14px;
        }

        .jatah-gula-status {
            font-size: 14px;
        }
    }
</style>


<div class="card shadow-sm border-0 mb-4">

    <div class="card-body">

        <div class="d-flex align-items-center mb-4">

            <div
                class="d-flex align-items-center justify-content-center rounded-3 bg-success bg-opacity-10 text-success me-3"
                style="width: 46px; height: 46px;"
            >
                <i class="bi bi-gear-fill fs-5"></i>
            </div>

            <div>

                <h5 class="fw-bold mb-1">
                    Pengaturan Jatah Gula
                </h5>

                <p class="text-muted small mb-0">
                    Atur jumlah jatah gula berdasarkan status karyawan.
                </p>

            </div>

        </div>


        <div class="jatah-gula-grid">

            @forelse ($aturanJatahGula as $aturan)

                <form
                    action="{{ route('admin.karyawan.updateJatahGula') }}"
                    method="POST"
                    class="jatah-gula-item {{ $aturan->jumlah_gula > 0 ? 'punya-jatah' : '' }}"
                >

                    @csrf


                    <input
                        type="hidden"
                        name="status"
                        value="{{ $aturan->status }}"
                    >


                    <div class="jatah-gula-header">

                        <div>

                            <div class="jatah-gula-status-label">
                                Status Karyawan
                            </div>

                            <div class="jatah-gula-status">
                                {{ $aturan->status }}
                            </div>

                        </div>


                        @if ($aturan->jumlah_gula > 0)

                            <span class="badge bg-success">
                                Mendapat Gula
                            </span>

                        @else

                            <span class="badge bg-secondary">
                                Tidak Mendapat
                            </span>

                        @endif

                    </div>


                    <label
                        for="jumlahGula{{ $aturan->id }}"
                        class="jatah-gula-label"
                    >
                        Jatah Gula
                    </label>


                    <div class="input-group jatah-gula-input-group">

                        <input
                            type="number"
                            id="jumlahGula{{ $aturan->id }}"
                            name="jumlah_gula"
                            value="{{ $aturan->jumlah_gula }}"
                            class="form-control jatah-gula-input"
                            min="0"
                            max="1000"
                            step="1"
                            required
                        >

                        <span class="input-group-text">
                            KG
                        </span>

                        <button
                            type="submit"
                            class="btn btn-success"
                            title="Simpan jatah gula"
                        >

                            <i class="bi bi-check-lg"></i>

                        </button>

                    </div>


                    <div class="jatah-gula-info">

                        @if ($aturan->jumlah_gula > 0)

                            <i class="bi bi-check-circle text-success me-1"></i>

                            Jatah saat ini:
                            <strong>
                                {{ $aturan->jumlah_gula }} KG
                            </strong>

                        @else

                            <i class="bi bi-dash-circle me-1"></i>

                            Status ini tidak mendapatkan gula.

                        @endif

                    </div>

                </form>

            @empty

                <div class="alert alert-warning mb-0">

                    <i class="bi bi-exclamation-circle me-2"></i>

                    Belum ada aturan jatah gula.

                </div>

            @endforelse

        </div>

    </div>

</div>