// Image Crop Tool Logic
(function() {
    'use strict';

    // DOM Elements
    const imageInput = document.getElementById('imageInput');
    const uploadArea = document.getElementById('uploadArea');
    const cropEditor = document.getElementById('cropEditor');
    const resultArea = document.getElementById('resultArea');
    const cropCanvas = document.getElementById('cropCanvas');
    const cropBox = document.getElementById('cropBox');
    const ctx = cropCanvas.getContext('2d');

    // Control elements
    const cropWidthInput = document.getElementById('cropWidth');
    const cropHeightInput = document.getElementById('cropHeight');
    const cropXInput = document.getElementById('cropX');
    const cropYInput = document.getElementById('cropY');
    const lockAspectCheck = document.getElementById('lockAspect');
    const applyCropBtn = document.getElementById('applyCropBtn');
    const resetCropBtn = document.getElementById('resetCropBtn');
    const downloadBtn = document.getElementById('downloadBtn');
    const cropAnotherBtn = document.getElementById('cropAnotherBtn');

    // Transform buttons
    const rotateLeftBtn = document.getElementById('rotateLeftBtn');
    const rotateRightBtn = document.getElementById('rotateRightBtn');
    const flipHorizontalBtn = document.getElementById('flipHorizontalBtn');
    const flipVerticalBtn = document.getElementById('flipVerticalBtn');

    // State
    let originalImage = null;
    let currentImage = null;
    let cropData = {
        x: 50,
        y: 50,
        width: 200,
        height: 200
    };
    let aspectRatio = null;
    let isDragging = false;
    let dragHandle = null;
    let startX = 0;
    let startY = 0;
    let rotation = 0;
    let flipH = false;
    let flipV = false;

    // Initialize
    function init() {
        setupEventListeners();
        setupDragAndDrop();
    }

    // Event Listeners
    function setupEventListeners() {
        imageInput.addEventListener('change', handleFileSelect);
        applyCropBtn.addEventListener('click', applyCrop);
        resetCropBtn.addEventListener('click', resetCrop);
        downloadBtn.addEventListener('click', downloadImage);
        cropAnotherBtn.addEventListener('click', resetTool);

        // Ratio buttons
        document.querySelectorAll('.ratio-btn').forEach(btn => {
            btn.addEventListener('click', (e) => {
                document.querySelectorAll('.ratio-btn').forEach(b => b.classList.remove('active'));
                e.target.classList.add('active');
                setAspectRatio(e.target.dataset.ratio);
            });
        });

        // Input changes
        cropWidthInput.addEventListener('change', updateCropFromInputs);
        cropHeightInput.addEventListener('change', updateCropFromInputs);
        cropXInput.addEventListener('change', updateCropFromInputs);
        cropYInput.addEventListener('change', updateCropFromInputs);

        // Transform buttons
        rotateLeftBtn.addEventListener('click', () => rotateImage(-90));
        rotateRightBtn.addEventListener('click', () => rotateImage(90));
        flipHorizontalBtn.addEventListener('click', () => flipImage('h'));
        flipVerticalBtn.addEventListener('click', () => flipImage('v'));

        // Crop box dragging
        setupCropBoxDragging();
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
    function handleFile(file) {
        if (!file.type.startsWith('image/')) {
            alert('Please select an image file');
            return;
        }

        if (file.size > 10 * 1024 * 1024) {
            alert('File size must be less than 10MB');
            return;
        }

        const reader = new FileReader();
        reader.onload = (e) => {
            const img = new Image();
            img.onload = () => {
                originalImage = img;
                currentImage = img;
                loadImageToCanvas();
                uploadArea.classList.add('d-none');
                cropEditor.classList.remove('d-none');
            };
            img.src = e.target.result;
        };
        reader.readAsDataURL(file);
    }

    // Load Image to Canvas
    function loadImageToCanvas() {
        const maxWidth = 800;
        const maxHeight = 600;
        let width = currentImage.width;
        let height = currentImage.height;

        // Scale down if too large
        if (width > maxWidth || height > maxHeight) {
            const ratio = Math.min(maxWidth / width, maxHeight / height);
            width *= ratio;
            height *= ratio;
        }

        cropCanvas.width = width;
        cropCanvas.height = height;

        // Apply transformations
        ctx.save();
        ctx.translate(width / 2, height / 2);
        ctx.rotate(rotation * Math.PI / 180);
        ctx.scale(flipH ? -1 : 1, flipV ? -1 : 1);
        ctx.drawImage(currentImage, -width / 2, -height / 2, width, height);
        ctx.restore();

        // Initialize crop box
        cropData = {
            x: width * 0.1,
            y: height * 0.1,
            width: width * 0.8,
            height: height * 0.8
        };

        updateCropBox();
        updateInputs();
        document.getElementById('originalDimensions').textContent = `${currentImage.width} × ${currentImage.height} px`;
    }

    // Update Crop Box Position
    function updateCropBox() {
        cropBox.style.left = cropData.x + 'px';
        cropBox.style.top = cropData.y + 'px';
        cropBox.style.width = cropData.width + 'px';
        cropBox.style.height = cropData.height + 'px';
    }

    // Update Inputs
    function updateInputs() {
        cropWidthInput.value = Math.round(cropData.width);
        cropHeightInput.value = Math.round(cropData.height);
        cropXInput.value = Math.round(cropData.x);
        cropYInput.value = Math.round(cropData.y);
    }

    // Update Crop from Inputs
    function updateCropFromInputs() {
        cropData.width = parseInt(cropWidthInput.value) || cropData.width;
        cropData.height = parseInt(cropHeightInput.value) || cropData.height;
        cropData.x = parseInt(cropXInput.value) || cropData.x;
        cropData.y = parseInt(cropYInput.value) || cropData.y;

        // Constrain to canvas
        cropData.x = Math.max(0, Math.min(cropData.x, cropCanvas.width - cropData.width));
        cropData.y = Math.max(0, Math.min(cropData.y, cropCanvas.height - cropData.height));

        updateCropBox();
    }

    // Set Aspect Ratio
    function setAspectRatio(ratio) {
        if (ratio === 'free') {
            aspectRatio = null;
            lockAspectCheck.checked = false;
        } else {
            const [w, h] = ratio.split(':').map(Number);
            aspectRatio = w / h;
            lockAspectCheck.checked = true;
            
            // Adjust crop box to match ratio
            const centerX = cropData.x + cropData.width / 2;
            const centerY = cropData.y + cropData.height / 2;
            
            if (cropData.width / cropData.height > aspectRatio) {
                cropData.width = cropData.height * aspectRatio;
            } else {
                cropData.height = cropData.width / aspectRatio;
            }
            
            cropData.x = centerX - cropData.width / 2;
            cropData.y = centerY - cropData.height / 2;
            
            updateCropBox();
            updateInputs();
        }
    }

    // Setup Crop Box Dragging
    function setupCropBoxDragging() {
        const handles = cropBox.querySelectorAll('.crop-handle');
        
        handles.forEach(handle => {
            handle.addEventListener('mousedown', startDrag);
        });

        cropBox.addEventListener('mousedown', startMove);
        document.addEventListener('mousemove', drag);
        document.addEventListener('mouseup', stopDrag);
    }

    function startDrag(e) {
        if (e.target.classList.contains('crop-handle')) {
            e.stopPropagation();
            isDragging = true;
            dragHandle = e.target;
            startX = e.clientX;
            startY = e.clientY;
        }
    }

    function startMove(e) {
        if (e.target === cropBox) {
            isDragging = true;
            dragHandle = 'move';
            startX = e.clientX;
            startY = e.clientY;
        }
    }

    function drag(e) {
        if (!isDragging) return;

        const dx = e.clientX - startX;
        const dy = e.clientY - startY;

        if (dragHandle === 'move') {
            cropData.x += dx;
            cropData.y += dy;
            
            // Constrain
            cropData.x = Math.max(0, Math.min(cropData.x, cropCanvas.width - cropData.width));
            cropData.y = Math.max(0, Math.min(cropData.y, cropCanvas.height - cropData.height));
        } else if (dragHandle) {
            resizeCropBox(dragHandle, dx, dy);
        }

        startX = e.clientX;
        startY = e.clientY;
        updateCropBox();
        updateInputs();
    }

    function stopDrag() {
        isDragging = false;
        dragHandle = null;
    }

    function resizeCropBox(handle, dx, dy) {
        const classes = handle.className;
        
        if (classes.includes('nw')) {
            cropData.x += dx;
            cropData.y += dy;
            cropData.width -= dx;
            cropData.height -= dy;
        } else if (classes.includes('ne')) {
            cropData.y += dy;
            cropData.width += dx;
            cropData.height -= dy;
        } else if (classes.includes('sw')) {
            cropData.x += dx;
            cropData.width -= dx;
            cropData.height += dy;
        } else if (classes.includes('se')) {
            cropData.width += dx;
            cropData.height += dy;
        } else if (classes.includes('n')) {
            cropData.y += dy;
            cropData.height -= dy;
        } else if (classes.includes('s')) {
            cropData.height += dy;
        } else if (classes.includes('e')) {
            cropData.width += dx;
        } else if (classes.includes('w')) {
            cropData.x += dx;
            cropData.width -= dx;
        }

        // Maintain aspect ratio if locked
        if (lockAspectCheck.checked && aspectRatio) {
            if (classes.includes('e') || classes.includes('w')) {
                cropData.height = cropData.width / aspectRatio;
            } else {
                cropData.width = cropData.height * aspectRatio;
            }
        }

        // Minimum size
        cropData.width = Math.max(50, cropData.width);
        cropData.height = Math.max(50, cropData.height);

        // Constrain to canvas
        cropData.x = Math.max(0, Math.min(cropData.x, cropCanvas.width - cropData.width));
        cropData.y = Math.max(0, Math.min(cropData.y, cropCanvas.height - cropData.height));
    }

    // Rotate Image
    function rotateImage(degrees) {
        rotation = (rotation + degrees) % 360;
        
        // Swap canvas dimensions if rotating 90 or 270
        if (Math.abs(degrees) === 90) {
            const temp = cropCanvas.width;
            cropCanvas.width = cropCanvas.height;
            cropCanvas.height = temp;
        }
        
        loadImageToCanvas();
    }

    // Flip Image
    function flipImage(direction) {
        if (direction === 'h') {
            flipH = !flipH;
        } else {
            flipV = !flipV;
        }
        loadImageToCanvas();
    }

    // Reset Crop
    function resetCrop() {
        rotation = 0;
        flipH = false;
        flipV = false;
        aspectRatio = null;
        lockAspectCheck.checked = false;
        document.querySelectorAll('.ratio-btn').forEach(b => b.classList.remove('active'));
        document.querySelector('[data-ratio="free"]').classList.add('active');
        loadImageToCanvas();
    }

    // Apply Crop
    function applyCrop() {
        // Create output canvas
        const outputCanvas = document.createElement('canvas');
        const outputCtx = outputCanvas.getContext('2d');

        // Calculate scale factor
        const scaleX = currentImage.width / cropCanvas.width;
        const scaleY = currentImage.height / cropCanvas.height;

        // Set output dimensions
        outputCanvas.width = cropData.width * scaleX;
        outputCanvas.height = cropData.height * scaleY;

        // Draw cropped portion
        outputCtx.drawImage(
            cropCanvas,
            cropData.x, cropData.y, cropData.width, cropData.height,
            0, 0, outputCanvas.width, outputCanvas.height
        );

        // Display result
        const croppedDataUrl = outputCanvas.toDataURL('image/png');
        document.getElementById('croppedImage').src = croppedDataUrl;
        document.getElementById('croppedDimensions').textContent = 
            `${Math.round(outputCanvas.width)} × ${Math.round(outputCanvas.height)} px`;

        // Calculate file size (approximate)
        const base64Length = croppedDataUrl.length - 'data:image/png;base64,'.length;
        const sizeInBytes = (base64Length * 3) / 4;
        document.getElementById('croppedFileSize').textContent = formatBytes(sizeInBytes);

        // Store for download
        window.croppedCanvas = outputCanvas;

        // Show result area
        cropEditor.classList.add('d-none');
        resultArea.classList.remove('d-none');
    }

    // Download Image
    function downloadImage() {
        if (!window.croppedCanvas) return;

        const format = document.querySelector('input[name="downloadFormat"]:checked').value;
        const mimeType = `image/${format}`;
        
        window.croppedCanvas.toBlob((blob) => {
            const url = URL.createObjectURL(blob);
            const a = document.createElement('a');
            a.href = url;
            a.download = `cropped-image.${format}`;
            document.body.appendChild(a);
            a.click();
            document.body.removeChild(a);
            URL.revokeObjectURL(url);
        }, mimeType);

        // Update format display
        document.getElementById('croppedFormat').textContent = format.toUpperCase();
    }

    // Reset Tool
    function resetTool() {
        originalImage = null;
        currentImage = null;
        rotation = 0;
        flipH = false;
        flipV = false;
        aspectRatio = null;
        
        imageInput.value = '';
        lockAspectCheck.checked = false;
        document.querySelectorAll('.ratio-btn').forEach(b => b.classList.remove('active'));
        document.querySelector('[data-ratio="free"]').classList.add('active');
        document.getElementById('formatPNG').checked = true;
        
        uploadArea.classList.remove('d-none');
        cropEditor.classList.add('d-none');
        resultArea.classList.add('d-none');
    }

    // Format Bytes
    function formatBytes(bytes) {
        if (bytes === 0) return '0 Bytes';
        const k = 1024;
        const sizes = ['Bytes', 'KB', 'MB'];
        const i = Math.floor(Math.log(bytes) / Math.log(k));
        return Math.round(bytes / Math.pow(k, i) * 100) / 100 + ' ' + sizes[i];
    }

    // Initialize on load
    if (document.readyState === 'loading') {
        document.addEventListener('DOMContentLoaded', init);
    } else {
        init();
    }

})();