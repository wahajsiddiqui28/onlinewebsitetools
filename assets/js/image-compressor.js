// Image Compressor Tool Logic
(function() {
    'use strict';

    // DOM Elements
    const imageInput = document.getElementById('imageInput');
    const uploadArea = document.getElementById('uploadArea');
    const compressionControls = document.getElementById('compressionControls');
    const loadingState = document.getElementById('loadingState');
    const comparisonArea = document.getElementById('comparisonArea');
    const qualitySlider = document.getElementById('qualitySlider');
    const qualityValue = document.getElementById('qualityValue');
    const compressBtn = document.getElementById('compressBtn');
    const resetBtn = document.getElementById('resetBtn');
    const downloadBtn = document.getElementById('downloadBtn');
    const compressAnotherBtn = document.getElementById('compressAnotherBtn');

    let originalFile = null;
    let compressedBlob = null;
    let selectedFormat = 'original';

    // Initialize
    function init() {
        setupEventListeners();
        setupDragAndDrop();
    }

    // Event Listeners
    function setupEventListeners() {
        imageInput.addEventListener('change', handleFileSelect);
        qualitySlider.addEventListener('input', updateQualityValue);
        compressBtn.addEventListener('click', compressImage);
        resetBtn.addEventListener('click', resetTool);
        downloadBtn.addEventListener('click', downloadCompressedImage);
        compressAnotherBtn.addEventListener('click', resetTool);

        // Format selection
        document.querySelectorAll('input[name="outputFormat"]').forEach(radio => {
            radio.addEventListener('change', (e) => {
                selectedFormat = e.target.value;
            });
        });
    }

    // Drag and Drop
    function setupDragAndDrop() {
        const dropZone = uploadArea.querySelector('.upload-area-inner');

        dropZone.addEventListener('dragover', (e) => {
            e.preventDefault();
            dropZone.classList.add('drag-over');
        });

        dropZone.addEventListener('dragleave', () => {
            dropZone.classList.remove('drag-over');
        });

        dropZone.addEventListener('drop', (e) => {
            e.preventDefault();
            dropZone.classList.remove('drag-over');
            
            const files = e.dataTransfer.files;
            if (files.length > 0) {
                handleFile(files[0]);
            }
        });

        // Click to upload
        dropZone.addEventListener('click', (e) => {
            if (e.target.tagName !== 'BUTTON') {
                imageInput.click();
            }
        });
    }

    // Handle File Selection
    function handleFileSelect(e) {
        const file = e.target.files[0];
        if (file) {
            handleFile(file);
        }
    }

    // Handle File
    // function handleFile(file) {
    //     // Validate file
    //     if (!file.type.startsWith('image/')) {
    //         alert('Please select an image file');
    //         return;
    //     }

    //     if (file.size > 10 * 1024 * 1024) { // 10MB limit
    //         alert('File size must be less than 10MB');
    //         return;
    //     }

    //     originalFile = file;
        
    //     // Show controls
    //     uploadArea.classList.add('d-none');
    //     compressionControls.classList.remove('d-none');

    //     // Preview original image
    //     const reader = new FileReader();
    //     reader.onload = (e) => {
    //         document.getElementById('originalImage').src = e.target.result;
    //     };
    //     reader.readAsDataURL(file);
    // }
    
    
    
    // Handle File
    function handleFile(file) {
        // Validate file
        if (!file.type.startsWith('image/')) {
            alert('Please select an image file');
            return;
        }
    
        // Allow up to 60MB images
        const maxSizeMB = 60;
        if (file.size > maxSizeMB * 1024 * 1024) {
            alert(`File size must be less than ${maxSizeMB}MB`);
            return;
        }
    
        originalFile = file;
        
        // Show controls
        uploadArea.classList.add('d-none');
        compressionControls.classList.remove('d-none');
    
        // Preview original image
        const reader = new FileReader();
        reader.onload = (e) => {
            document.getElementById('originalImage').src = e.target.result;
        };
        reader.readAsDataURL(file);
    }

    
    

    // Update Quality Value Display
    function updateQualityValue() {
        qualityValue.textContent = qualitySlider.value + '%';
    }

    // Compress Image
    async function compressImage() {
        if (!originalFile) return;

        // Show loading
        compressionControls.classList.add('d-none');
        loadingState.classList.remove('d-none');

        try {
            const quality = qualitySlider.value / 100;
            
            // Determine output type
            let outputType = originalFile.type;
            if (selectedFormat !== 'original') {
                outputType = `image/${selectedFormat}`;
            }

            // Compress using canvas
            const compressed = await compressImageWithCanvas(originalFile, quality, outputType);
            
            compressedBlob = compressed;

            // Display results
            displayComparison();

        } catch (error) {
            console.error('Compression error:', error);
            alert('Error compressing image. Please try again.');
            resetTool();
        }
    }

    // Compress Image with Canvas
    function compressImageWithCanvas(file, quality, outputType) {
        return new Promise((resolve, reject) => {
            const reader = new FileReader();
            
            reader.onload = (e) => {
                const img = new Image();
                
                img.onload = () => {
                    const canvas = document.createElement('canvas');
                    const ctx = canvas.getContext('2d');
                    
                    canvas.width = img.width;
                    canvas.height = img.height;
                    
                    ctx.drawImage(img, 0, 0);
                    
                    canvas.toBlob((blob) => {
                        if (blob) {
                            resolve(blob);
                        } else {
                            reject(new Error('Compression failed'));
                        }
                    }, outputType, quality);
                };
                
                img.onerror = () => reject(new Error('Failed to load image'));
                img.src = e.target.result;
            };
            
            reader.onerror = () => reject(new Error('Failed to read file'));
            reader.readAsDataURL(file);
        });
    }

    // Display Comparison
    function displayComparison() {
        loadingState.classList.add('d-none');
        comparisonArea.classList.remove('d-none');

        // Display sizes
        const originalSize = originalFile.size;
        const compressedSize = compressedBlob.size;
        const savedBytes = originalSize - compressedSize;
        const savedPercent = ((savedBytes / originalSize) * 100).toFixed(1);

        document.getElementById('originalSize').textContent = formatBytes(originalSize);
        document.getElementById('compressedSize').textContent = formatBytes(compressedSize);
        document.getElementById('savedPercentage').textContent = savedPercent + '% saved';

        // Display compressed image
        const reader = new FileReader();
        reader.onload = (e) => {
            document.getElementById('compressedImage').src = e.target.result;
        };
        reader.readAsDataURL(compressedBlob);
    }

    // Format Bytes
    function formatBytes(bytes) {
        if (bytes === 0) return '0 Bytes';
        const k = 1024;
        const sizes = ['Bytes', 'KB', 'MB'];
        const i = Math.floor(Math.log(bytes) / Math.log(k));
        return Math.round(bytes / Math.pow(k, i) * 100) / 100 + ' ' + sizes[i];
    }

    // Download Compressed Image
    function downloadCompressedImage() {
        if (!compressedBlob) return;

        const url = URL.createObjectURL(compressedBlob);
        const a = document.createElement('a');
        a.href = url;
        
        // Generate filename
        const originalName = originalFile.name.split('.')[0];
        const extension = selectedFormat === 'original' ? originalFile.name.split('.').pop() : selectedFormat;
        a.download = `${originalName}_compressed.${extension}`;
        
        document.body.appendChild(a);
        a.click();
        document.body.removeChild(a);
        URL.revokeObjectURL(url);
    }

    // Reset Tool
    function resetTool() {
        originalFile = null;
        compressedBlob = null;
        selectedFormat = 'original';
        
        imageInput.value = '';
        qualitySlider.value = 80;
        updateQualityValue();
        document.getElementById('formatOriginal').checked = true;
        
        uploadArea.classList.remove('d-none');
        compressionControls.classList.add('d-none');
        loadingState.classList.add('d-none');
        comparisonArea.classList.add('d-none');
    }

    // Initialize on load
    if (document.readyState === 'loading') {
        document.addEventListener('DOMContentLoaded', init);
    } else {
        init();
    }

})();