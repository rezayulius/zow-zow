// Emergency call confirmation dialog + one-off flash message toasts.
// SweetAlert2 is only fetched (via the shared loadSwal() dynamic import) the
// moment one of these actually needs to show, not on every page load.
import { loadSwal } from './swal';

const EMERGENCY_PHONE_TEL = 'tel:+6281295911911';

function bindEmergency(btn) {
    if (!btn || btn.dataset.bound) return;
    btn.dataset.bound = '1';

    btn.addEventListener('click', async () => {
        const Swal = await loadSwal();

        Swal.fire({
            icon: 'warning',
            title: 'Konfirmasi Emergency Call',
            html: `
                <div class="text-left text-sm">
                  <p class="text-gray-700 mb-2">Layanan emergency call ditujukan untuk kondisi darurat pada hewan peliharaan yang membutuhkan penanganan segera. Layanan ini dapat dikenakan biaya tambahan sesuai tarif yang berlaku.</p>
                  <p class="text-gray-700 mb-2">Kondisi darurat dapat mencakup:</p>
                  <ul class="list-disc list-inside text-gray-800 mb-4">
                    <li>Sesak napas, kejang, pingsan, atau lemas berat.</li>
                    <li>Perdarahan, luka serius, trauma, atau kecelakaan.</li>
                    <li>Dugaan keracunan, muntah/diare berat, atau kondisi memburuk tiba-tiba.</li>
                    <li>Kondisi mendesak lainnya yang memerlukan respons dokter hewan.</li>
                  </ul>
                  <div class="border-t pt-4 mt-4">
                    <p class="text-gray-700 mb-3 font-medium">Syarat dan Ketentuan:</p>
                    <ul class="list-disc list-inside text-gray-600 text-xs mb-4 space-y-1">
                      <li>Saya memahami bahwa emergency call dapat dikenakan biaya tambahan.</li>
                      <li>Saya menyatakan bahwa kondisi hewan peliharaan saya membutuhkan bantuan segera.</li>
                      <li>Saya bersedia memberikan informasi lengkap mengenai kondisi hewan saat dihubungi.</li>
                      <li>Saya memahami bahwa dokter hewan akan menentukan tindakan berdasarkan hasil penilaian awal.</li>
                    </ul>
                    <div class="flex items-start space-x-2">
                      <input type="checkbox" id="emergencyTermsCheckbox" class="mt-1 h-4 w-4 text-rose-600 focus:ring-rose-500 border-gray-300 rounded">
                      <label for="emergencyTermsCheckbox" class="text-xs text-gray-700 cursor-pointer">
                        Saya telah membaca dan menyetujui syarat dan ketentuan emergency call di atas.
                      </label>
                    </div>
                  </div>
                </div>
              `,
            showCancelButton: true,
            confirmButtonText: 'Telepon Sekarang',
            cancelButtonText: 'Tutup',
            confirmButtonColor: '#f43f5e', // rose-500
            cancelButtonColor: '#e5e7eb', // gray-200
            didOpen: () => {
                const confirmButton = Swal.getConfirmButton();
                const checkbox = document.getElementById('emergencyTermsCheckbox');

                confirmButton.disabled = true;
                confirmButton.style.opacity = '0.5';
                confirmButton.style.cursor = 'not-allowed';

                checkbox.addEventListener('change', function () {
                    if (this.checked) {
                        confirmButton.disabled = false;
                        confirmButton.style.opacity = '1';
                        confirmButton.style.cursor = 'pointer';
                    } else {
                        confirmButton.disabled = true;
                        confirmButton.style.opacity = '0.5';
                        confirmButton.style.cursor = 'not-allowed';
                    }
                });
            },
            preConfirm: () => {
                const checkbox = document.getElementById('emergencyTermsCheckbox');
                if (!checkbox.checked) {
                    Swal.showValidationMessage('Anda harus menyetujui syarat dan ketentuan terlebih dahulu');
                    return false;
                }
                return true;
            }
        }).then((result) => {
            if (result.isConfirmed) {
                window.location.href = EMERGENCY_PHONE_TEL;
            }
        });
    });
}

export function initEmergencyModal() {
    bindEmergency(document.getElementById('btnEmergencyCall'));
    bindEmergency(document.getElementById('btnEmergencyCallMobile'));
    bindEmergency(document.getElementById('emergency-call-mobile'));
}

// Flash messages come from a full-page redirect after a form POST (e.g. sign
// in/out), never from a wire:navigate transition — the data is handed off via
// a small inline JSON blob (see layouts/app.blade.php) instead of executing
// Swal.fire() directly in a blocking inline <script>.
export async function initFlashMessages() {
    const el = document.getElementById('flash-data');
    if (!el) return;

    const flash = JSON.parse(el.textContent);
    if (!flash.success && !flash.error) return;

    const Swal = await loadSwal();

    if (flash.success) {
        Swal.fire({ icon: 'success', title: 'Berhasil!', text: flash.success, timer: 2000, showConfirmButton: false });
    }
    if (flash.error) {
        Swal.fire({ icon: 'error', title: 'Error!', text: flash.error, timer: 2000, showConfirmButton: false });
    }
}
