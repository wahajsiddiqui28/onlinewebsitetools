// Image to PDF Converter
(function() {
    'use strict';

    // DOM Elements
    const imageInput = document.getElementById('imageInput');
    const uploadArea = document.getElementById('uploadArea');
    const editorArea = document.getElementById('editorArea');
    const loadingState = document.getElementById('loadingState');
    const successState = document.getElementById('successState');
    const imagesList = document.getElementById('imagesList');
    const imageCount = document.getElementById('imageCount');
    const clearAllBtn = document.getElementById('clearAllBtn');
    const addMoreBtn = document.getElementById('addMoreBtn');
    const generatePdfBtn = document.getElementById('generatePdfBtn');
    const downloadPdfBtn = document.getElementById('downloadPdfBtn');
    const createAnotherBtn = document.getElementById('createAnotherBtn');
    const imageQuality = document.getElementById('imageQuality');
    const qualityDisplay = document.getElementById('qualityDisplay');
    const progressBar = document.getElementById('progressBar');

    // State
    let images = [];
    let pdfBlob = null;

    // Initialize
    function init() {
        setupEventListeners();
        setupDragAndDrop();
    }

    // Event Listeners
    function setupEventListeners() {
        imageInput.addEventListener('change', handleFileSelect);
        clearAllBtn.addEventListener('click', clearAll);
        addMoreBtn.addEventListener('click', () => imageInput.click());
        generatePdfBtn.addEventListener('click', generatePDF);
        downloadPdfBtn.addEventListener('click', downloadPDF);
        createAnotherBtn.addEventListener('click', reset);
        imageQuality.addEventListener('input', updateQualityDisplay);
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
            const files = Array.from(e.dataTransfer.files);
            handleFiles(files);
        });

        dropZone.addEventListener('click', (e) => {
            if (e.target.tagName !== 'BUTTON') {
                imageInput.click();
            }
        });
    }

    // Handle File Selection
    function handleFileSelect(e) {
        const files = Array.from(e.target.files);
        handleFiles(files);
    }

    // Handle Files
    function handleFiles(files) {
        const imageFiles = files.filter(file => file.type.startsWith('image/'));

        if (imageFiles.length === 0) {
            alert('Please select valid image files');
            return;
        }

        if (images.length + imageFiles.length > 20) {
            alert('Maximum 20 images allowed');
            return;
        }

        imageFiles.forEach(file => {
            const reader = new FileReader();
            reader.onload = (e) => {
                const img = {
                    id: Date.now() + Math.random(),
                    src: e.target.result,
                    name: file.name,
                    size: file.size
                };
                images.push(img);
                addImageToList(img);
                updateUI();
            };
            reader.readAsDataURL(file);
        });

        uploadArea.classList.add('d-none');
        editorArea.classList.remove('d-none');
    }

    // Add Image to List
    function addImageToList(img) {
        const imageCard = document.createElement('div');
        imageCard.className = 'image-card';
        imageCard.draggable = true;
        imageCard.dataset.id = img.id;

        imageCard.innerHTML = `
            <div class="image-card-inner">
                <div class="drag-handle">
                    <i class="bi bi-grip-vertical"></i>
                </div>
                <div class="image-preview">
                    <img src="${img.src}"  alt="${img.name}" style="width: 100% !important;">
                </div>
                <div class="image-info">
                    <div class="image-name">${truncateName(img.name)}</div>
                    <div class="image-size">${formatBytes(img.size)}</div>
                </div>
                <button class="btn btn-sm btn-outline-danger remove-btn" onclick="window.removeImage('${img.id}')">
                    <i class="bi bi-trash"></i>
                </button>
            </div>
        `;

        imagesList.appendChild(imageCard);
        setupDragEvents(imageCard);
    }

    // Setup Drag Events for Reordering
    function setupDragEvents(card) {
        card.addEventListener('dragstart', handleDragStart);
        card.addEventListener('dragover', handleDragOver);
        card.addEventListener('drop', handleDrop);
        card.addEventListener('dragend', handleDragEnd);
    }

    let draggedElement = null;

    function handleDragStart(e) {
        draggedElement = this;
        this.classList.add('dragging');
    }

    function handleDragOver(e) {
        e.preventDefault();
        const afterElement = getDragAfterElement(imagesList, e.clientY);
        if (afterElement == null) {
            imagesList.appendChild(draggedElement);
        } else {
            imagesList.insertBefore(draggedElement, afterElement);
        }
    }

    function handleDrop(e) {
        e.preventDefault();
    }

    function handleDragEnd() {
        this.classList.remove('dragging');
        updateImagesOrder();
    }

    function getDragAfterElement(container, y) {
        const draggableElements = [...container.querySelectorAll('.image-card:not(.dragging)')];

        return draggableElements.reduce((closest, child) => {
            const box = child.getBoundingClientRect();
            const offset = y - box.top - box.height / 2;

            if (offset < 0 && offset > closest.offset) {
                return { offset: offset, element: child };
            } else {
                return closest;
            }
        }, { offset: Number.NEGATIVE_INFINITY }).element;
    }

    // Update Images Order
    function updateImagesOrder() {
        const cards = imagesList.querySelectorAll('.image-card');
        const newOrder = [];
        
        cards.forEach(card => {
            const id = parseFloat(card.dataset.id);
            const img = images.find(i => i.id === id);
            if (img) newOrder.push(img);
        });
        
        images = newOrder;
    }

    // Remove Image
    window.removeImage = function(id) {
        const numId = parseFloat(id);
        images = images.filter(img => img.id !== numId);
        
        const card = imagesList.querySelector(`[data-id="${id}"]`);
        if (card) card.remove();
        
        updateUI();
        
        if (images.length === 0) {
            reset();
        }
    };

    // Clear All
    function clearAll() {
        if (confirm('Remove all images?')) {
            images = [];
            imagesList.innerHTML = '';
            reset();
        }
    }

    // Update UI
    function updateUI() {
        imageCount.textContent = images.length;
        generatePdfBtn.disabled = images.length === 0;
    }

    // Update Quality Display
    function updateQualityDisplay() {
        qualityDisplay.textContent = imageQuality.value + '%';
    }

    // Generate PDF
    async function generatePDF() {
        if (images.length === 0) return;

        // Show loading
        editorArea.classList.add('d-none');
        loadingState.classList.remove('d-none');

        try {
            // Import jsPDF library
            const { jsPDF } = window.jspdf;
            
            // Get settings
            const pageSize = document.getElementById('pageSize').value;
            const orientation = document.querySelector('input[name="orientation"]:checked').value;
            const imageFit = document.getElementById('imageFit').value;
            const onePerPage = document.getElementById('oneImagePerPage').checked;
            const addPageNumbers = document.getElementById('addPageNumbers').checked;
            const quality = imageQuality.value / 100;

            // Margins
            const marginTop = parseInt(document.getElementById('marginTop').value);
            const marginBottom = parseInt(document.getElementById('marginBottom').value);
            const marginLeft = parseInt(document.getElementById('marginLeft').value);
            const marginRight = parseInt(document.getElementById('marginRight').value);

            // Create PDF
            const pdf = new jsPDF({
                orientation: orientation,
                unit: 'mm',
                format: pageSize
            });

            const pageWidth = pdf.internal.pageSize.getWidth();
            const pageHeight = pdf.internal.pageSize.getHeight();
            const contentWidth = pageWidth - marginLeft - marginRight;
            const contentHeight = pageHeight - marginTop - marginBottom;

            // Add images
            for (let i = 0; i < images.length; i++) {
                // Update progress
                const progress = ((i + 1) / images.length) * 100;
                progressBar.style.width = progress + '%';

                if (i > 0 && onePerPage) {
                    pdf.addPage();
                }

                const img = images[i];
                
                // Get image dimensions
                const imgData = await loadImage(img.src);
                const imgWidth = imgData.width;
                const imgHeight = imgData.height;
                const imgRatio = imgWidth / imgHeight;
                const pageRatio = contentWidth / contentHeight;

                let finalWidth, finalHeight, x, y;

                if (imageFit === 'contain') {
                    // Fit image within page maintaining aspect ratio
                    if (imgRatio > pageRatio) {
                        finalWidth = contentWidth;
                        finalHeight = contentWidth / imgRatio;
                    } else {
                        finalHeight = contentHeight;
                        finalWidth = contentHeight * imgRatio;
                    }
                    x = marginLeft + (contentWidth - finalWidth) / 2;
                    y = marginTop + (contentHeight - finalHeight) / 2;
                } else if (imageFit === 'cover') {
                    // Fill page, may crop image
                    if (imgRatio > pageRatio) {
                        finalHeight = contentHeight;
                        finalWidth = contentHeight * imgRatio;
                    } else {
                        finalWidth = contentWidth;
                        finalHeight = contentWidth / imgRatio;
                    }
                    x = marginLeft + (contentWidth - finalWidth) / 2;
                    y = marginTop + (contentHeight - finalHeight) / 2;
                } else {
                    // Stretch to fit
                    finalWidth = contentWidth;
                    finalHeight = contentHeight;
                    x = marginLeft;
                    y = marginTop;
                }

                pdf.addImage(img.src, 'JPEG', x, y, finalWidth, finalHeight, undefined, 'FAST', 0);

                // Add page numbers
                if (addPageNumbers) {
                    pdf.setFontSize(10);
                    pdf.setTextColor(150);
                    pdf.text(`${i + 1} / ${images.length}`, pageWidth / 2, pageHeight - 5, { align: 'center' });
                }
            }

            // Save PDF
            pdfBlob = pdf.output('blob');

            // Show success
            loadingState.classList.add('d-none');
            successState.classList.remove('d-none');

            // Update stats
            document.getElementById('totalPages').textContent = images.length;
            document.getElementById('pdfSize').textContent = formatBytes(pdfBlob.size);

        } catch (error) {
            console.error('Error generating PDF:', error);
            alert('Error generating PDF. Please try again.');
            loadingState.classList.add('d-none');
            editorArea.classList.remove('d-none');
        }
    }

    // Load Image Helper
    function loadImage(src) {
        return new Promise((resolve, reject) => {
            const img = new Image();
            img.onload = () => resolve(img);
            img.onerror = reject;
            img.src = src;
        });
    }

    // Download PDF
    function downloadPDF() {
        if (!pdfBlob) return;

        const url = URL.createObjectURL(pdfBlob);
        const a = document.createElement('a');
        a.href = url;
        a.download = `images-to-pdf-${Date.now()}.pdf`;
        document.body.appendChild(a);
        a.click();
        document.body.removeChild(a);
        URL.revokeObjectURL(url);
    }

    // Reset Tool
    function reset() {
        images = [];
        pdfBlob = null;
        imagesList.innerHTML = '';
        imageInput.value = '';
        
        uploadArea.classList.remove('d-none');
        editorArea.classList.add('d-none');
        loadingState.classList.add('d-none');
        successState.classList.add('d-none');
        
        progressBar.style.width = '0%';
        updateUI();
    }

    // Utility Functions
    function formatBytes(bytes) {
        if (bytes === 0) return '0 Bytes';
        const k = 1024;
        const sizes = ['Bytes', 'KB', 'MB'];
        const i = Math.floor(Math.log(bytes) / Math.log(k));
        return Math.round(bytes / Math.pow(k, i) * 100) / 100 + ' ' + sizes[i];
    }

    function truncateName(name, maxLength = 30) {
        if (name.length <= maxLength) return name;
        const ext = name.split('.').pop();
        const nameWithoutExt = name.substring(0, name.lastIndexOf('.'));
        const truncated = nameWithoutExt.substring(0, maxLength - ext.length - 4) + '...';
        return truncated + '.' + ext;
    }

    // Initialize on load
    if (document.readyState === 'loading') {
        document.addEventListener('DOMContentLoaded', init);
    } else {
        init();
    }

})();