// File Upload Validation
document.addEventListener('DOMContentLoaded', function() {
    // Validasi untuk bukti pembayaran (max 10MB) - skip if has data-no-validation
    const buktiPembayaranInput = document.querySelector('input[name="bukti_pembayaran"]:not([data-no-validation])');
    if (buktiPembayaranInput) {
        // Add file size info
        addFileSizeInfo(buktiPembayaranInput, '10MB', 'JPG, JPEG, PNG, PDF');
        
        buktiPembayaranInput.addEventListener('change', function() {
            const file = this.files[0];
            const errorDiv = document.getElementById('file-error');
            
            if (file) {
                const fileSize = file.size / 1024 / 1024; // Convert to MB
                if (fileSize > 10) {
                    if (errorDiv) {
                        errorDiv.textContent = 'Ukuran file terlalu besar. Maksimal 10MB.';
                        errorDiv.style.display = 'block';
                    }
                    this.value = '';
                    
                    if (typeof Swal !== 'undefined') {
                        Swal.fire({
                            title: 'File Terlalu Besar!',
                            text: `Ukuran file: ${fileSize.toFixed(2)}MB. Maksimal 10MB.`,
                            icon: 'error',
                            confirmButtonText: 'OK',
                            confirmButtonColor: '#dc3545'
                        });
                    } else {
                        alert('Ukuran file terlalu besar. Maksimal 10MB.');
                    }
                } else {
                    if (errorDiv) {
                        errorDiv.style.display = 'none';
                    }
                }
            }
        });
    }

    // Validasi untuk foto JBI (max 5MB)
    const fotoJBIInput = document.querySelector('input[name="foto"]');
    if (fotoJBIInput) {
        // Add file size info
        addFileSizeInfo(fotoJBIInput, '5MB', 'JPG, JPEG, PNG');
        
        fotoJBIInput.addEventListener('change', function() {
            const file = this.files[0];
            
            if (file) {
                const fileSize = file.size / 1024 / 1024; // Convert to MB
                if (fileSize > 5) {
                    if (typeof Swal !== 'undefined') {
                        Swal.fire({
                            title: 'File Terlalu Besar!',
                            text: `Ukuran file: ${fileSize.toFixed(2)}MB. Maksimal 5MB.`,
                            icon: 'error',
                            confirmButtonText: 'OK',
                            confirmButtonColor: '#dc3545'
                        });
                    } else {
                        alert('Ukuran file terlalu besar. Maksimal 5MB.');
                    }
                    this.value = '';
                }
            }
        });
    }

    // Validasi untuk foto profil (max 5MB)
    const fotoProfilInput = document.querySelector('input[name="foto_profile"]');
    if (fotoProfilInput) {
        // Add file size info
        addFileSizeInfo(fotoProfilInput, '5MB', 'JPG, JPEG, PNG');
        
        fotoProfilInput.addEventListener('change', function() {
            const file = this.files[0];
            
            if (file) {
                const fileSize = file.size / 1024 / 1024; // Convert to MB
                if (fileSize > 5) {
                    if (typeof Swal !== 'undefined') {
                        Swal.fire({
                            title: 'File Terlalu Besar!',
                            text: `Ukuran file: ${fileSize.toFixed(2)}MB. Maksimal 5MB.`,
                            icon: 'error',
                            confirmButtonText: 'OK',
                            confirmButtonColor: '#dc3545'
                        });
                    } else {
                        alert('Ukuran file terlalu besar. Maksimal 5MB.');
                    }
                    this.value = '';
                }
            }
        });
    }
    
    // Function to add file size info
    function addFileSizeInfo(input, maxSize, formats) {
        // Check if info already exists
        if (input.nextElementSibling && input.nextElementSibling.classList.contains('file-size-info')) {
            return;
        }
        
        const infoDiv = document.createElement('div');
        infoDiv.className = 'file-size-info text-muted mt-1';
        infoDiv.style.fontSize = '12px';
        infoDiv.innerHTML = `
            <i class="fas fa-info-circle me-1"></i>
            Maksimal: <strong>${maxSize}</strong> | Format: <strong>${formats}</strong>
        `;
        
        // Insert after the input
        input.parentNode.insertBefore(infoDiv, input.nextSibling);
    }
});