/**
 * PDF Compressor Tool
 * Client-side PDF compression
 */

document.addEventListener('DOMContentLoaded', function() {
    // Elements
    const uploadArea = document.getElementById('uploadArea');
    const editorArea = document.getElementById('editorArea');
    const loadingState = document.getElementById('loadingState');
    const successState = document.getElementById('successState');
    const pdfInput = document.getElementById('pdfInput');
    const compressPdfBtn = document.getElementById('compressPdfBtn');
    const cancelBtn = document.getElementById('cancelBtn');
    const downloadCompressedBtn = document.getElementById('downloadCompressedBtn');
    const compressAnotherBtn = document.getElementById('compressAnotherBtn');
    const imageQuality = document.getElementById('imageQuality');
    const qualityDisplay = document.getElementById('qualityDisplay');
    
    let currentPdfFile = null;
    let compressedPdfBlob = null;

    // Quality slider update
    if (imageQuality) {
        imageQuality.addEventListener('input', function() {
            qualityDisplay.textContent = this.value + '%';
        });
    }

    // File input change
    if (pdfInput) {
        pdfInput.addEventListener('change', handleFileSelect);
    }

    // Drag and drop
    if (uploadArea) {
        uploadArea.addEventListener('dragover', (e) => {
            e.preventDefault();
            uploadArea.style.borderColor = 'var(--primary-color)';
        });

        uploadArea.addEventListener('dragleave', (e) => {
            e.preventDefault();
            uploadArea.style.borderColor = '#cbd5e1';
        });

        uploadArea.addEventListener('drop', (e) => {
            e.preventDefault();
            uploadArea.style.borderColor = '#cbd5e1';
            const files = e.dataTransfer.files;
            if (files.length > 0) {
                handleFile(files[0]);
            }
        });
    }

    // Compress button
    if (compressPdfBtn) {
        compressPdfBtn.addEventListener('click', compressPdf);
    }

    // Cancel button
    if (cancelBtn) {
        cancelBtn.addEventListener('click', resetTool);
    }

    // Download button
    if (downloadCompressedBtn) {
        downloadCompressedBtn.addEventListener('click', downloadCompressed);
    }

    // Compress another button
    if (compressAnotherBtn) {
        compressAnotherBtn.addEventListener('click', resetTool);
    }

    // Compression level presets
    document.querySelectorAll('input[name="compressionLevel"]').forEach(radio => {
        radio.addEventListener('change', function() {
            if (this.value === 'low') {
                imageQuality.value = 90;
            } else if (this.value === 'medium') {
                imageQuality.value = 70;
            } else if (this.value === 'high') {
                imageQuality.value = 50;
            }
            qualityDisplay.textContent = imageQuality.value + '%';
        });
    });

    function handleFileSelect(e) {
        const file = e.target.files[0];
        if (file) {
            handleFile(file);
        }
    }

    function handleFile(file) {
        // Validate file type
        if (file.type !== 'application/pdf') {
            alert('Please select a PDF file');
            return;
        }

        // Validate file size (50MB max)
        if (file.size > 50 * 1024 * 1024) {
            alert('File size must be less than 50MB');
            return;
        }

        currentPdfFile = file;
        displayPdfInfo(file);
        showEditor();
    }

    function displayPdfInfo(file) {
        // Display file information
        document.getElementById('fileName').textContent = file.name;
        document.getElementById('originalSize').textContent = formatFileSize(file.size);
        
        // TODO: Load PDF and get page count using PDF.js library
        // For now, show placeholder
        document.getElementById('pageCount').textContent = '-';
    }

    function showEditor() {
        uploadArea.classList.add('d-none');
        editorArea.classList.remove('d-none');
        loadingState.classList.add('d-none');
        successState.classList.add('d-none');
    }

    function showLoading() {
        uploadArea.classList.add('d-none');
        editorArea.classList.add('d-none');
        loadingState.classList.remove('d-none');
        successState.classList.add('d-none');
    }

    function showSuccess() {
        uploadArea.classList.add('d-none');
        editorArea.classList.add('d-none');
        loadingState.classList.add('d-none');
        successState.classList.remove('d-none');
    }

    async function compressPdf() {
        if (!currentPdfFile) return;

        showLoading();
        updateProgress(0, 'Loading PDF...');

        try {
            // TODO: Implement actual PDF compression using PDF-lib or similar
            // This is a simulation
            await simulateCompression();
            
            showSuccess();
        } catch (error) {
            console.error('Compression error:', error);
            alert('Error compressing PDF. Please try again.');
            showEditor();
        }
    }

    function simulateCompression() {
        return new Promise((resolve) => {
            let progress = 0;
            const interval = setInterval(() => {
                progress += 10;
                updateProgress(progress, 'Compressing...');
                
                if (progress >= 100) {
                    clearInterval(interval);
                    
                    // Simulate compression results
                    const originalSize = currentPdfFile.size;
                    const compressionLevel = document.querySelector('input[name="compressionLevel"]:checked').value;
                    let reduction = compressionLevel === 'low' ? 0.3 : compressionLevel === 'medium' ? 0.6 : 0.9;
                    const compressedSize = originalSize * (1 - reduction);
                    
                    document.getElementById('statOriginalSize').textContent = formatFileSize(originalSize);
                    document.getElementById('statCompressedSize').textContent = formatFileSize(compressedSize);
                    document.getElementById('savedPercentage').textContent = Math.round(reduction * 100) + '%';
                    
                    resolve();
                }
            }, 200);
        });
    }

    function updateProgress(percent, text) {
        const progressBar = document.getElementById('progressBar');
        const progressText = document.getElementById('progressText');
        
        if (progressBar) {
            progressBar.style.width = percent + '%';
        }
        
        if (progressText) {
            progressText.textContent = text;
        }
    }

    function downloadCompressed() {
        // TODO: Implement actual download
        alert('Download functionality will be implemented with PDF compression library');
    }

    function resetTool() {
        currentPdfFile = null;
        compressedPdfBlob = null;
        pdfInput.value = '';
        
        uploadArea.classList.remove('d-none');
        editorArea.classList.add('d-none');
        loadingState.classList.add('d-none');
        successState.classList.add('d-none');
    }

    function formatFileSize(bytes) {
        if (bytes === 0) return '0 Bytes';
        const k = 1024;
        const sizes = ['Bytes', 'KB', 'MB', 'GB'];
        const i = Math.floor(Math.log(bytes) / Math.log(k));
        return Math.round((bytes / Math.pow(k, i)) * 100) / 100 + ' ' + sizes[i];
    }
});