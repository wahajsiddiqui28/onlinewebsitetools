<?php
/**
 * Template Name: Image to PDF
 * Description: Convert images to PDF format
 */

get_header();
?>

<div class="tool-page image-to-pdf-page">
    <!-- Tool Header -->
    <section class="tool-header py-5 bg-light">
        <div class="container">
            <div class="row align-items-center">
                <div class="col-lg-8 mx-auto text-center">
                    <div class="tool-breadcrumb mb-3">
                        <a href="<?php echo home_url(); ?>" class="text-muted">Home</a>
                        <span class="mx-2 text-muted">/</span>
                        <span class="text-primary">Image to PDF</span>
                    </div>
                    <h1 class="tool-page-title mb-3">
                        <i class="bi bi-file-earmark-pdf text-primary me-2"></i>
                        Image to PDF Converter
                    </h1>
                    <p class="tool-page-description">
                        Convert multiple images to a single PDF file. Supports JPEG, PNG, WebP and more.
                    </p>
                </div>
            </div>
        </div>
    </section>

    <!-- Tool Interface -->
    <section class="tool-interface py-5">
        <div class="container">
            <div class="row">
                <div class="col-lg-10 mx-auto">
                    
                    <!-- Upload Area -->
                    <div id="uploadArea" class="upload-area">
                        <div class="upload-area-inner">
                            <i class="bi bi-cloud-upload upload-icon"></i>
                            <h3 class="upload-title">Drop your images here</h3>
                            <p class="upload-subtitle">or click to browse (multiple selection supported)</p>
                            <input type="file" id="imageInput" accept="image/*" multiple class="d-none">
                            <button class="btn btn-primary btn-lg mt-3" onclick="document.getElementById('imageInput').click()">
                                <i class="bi bi-folder2-open me-2"></i> Choose Images
                            </button>
                            <p class="upload-note mt-3">
                                <i class="bi bi-info-circle me-1"></i> 
                                Supports: JPEG, PNG, WebP, GIF | Max 20 images per PDF
                            </p>
                        </div>
                    </div>

                    <!-- Images Preview & Settings -->
                    <div id="editorArea" class="editor-area d-none">
                        <div class="row g-4">
                            <!-- Left Side - Images List -->
                            <div class="col-lg-8">
                                <div class="card shadow-sm">
                                    <div class="card-body p-4">
                                        <div class="d-flex justify-content-between align-items-center mb-3">
                                            <h5 class="card-title mb-0">
                                                <i class="bi bi-images me-2"></i> 
                                                Images (<span id="imageCount">0</span>)
                                            </h5>
                                            <button class="btn btn-outline-danger btn-sm" id="clearAllBtn">
                                                <i class="bi bi-trash me-1"></i> Clear All
                                            </button>
                                        </div>

                                        <!-- Sortable Images List -->
                                        <div id="imagesList" class="images-list">
                                            <!-- Images will be added here dynamically -->
                                        </div>

                                        <!-- Add More Button -->
                                        <div class="text-center mt-3">
                                            <button class="btn btn-outline-primary" id="addMoreBtn">
                                                <i class="bi bi-plus-circle me-2"></i> Add More Images
                                            </button>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <!-- Right Side - PDF Settings -->
                            <div class="col-lg-4">
                                <div class="card shadow-sm mb-3">
                                    <div class="card-body">
                                        <h5 class="card-title mb-3">
                                            <i class="bi bi-gear me-2"></i> PDF Settings
                                        </h5>

                                        <!-- Page Size -->
                                        <div class="setting-group mb-3">
                                            <label class="setting-label mb-2">Page Size</label>
                                            <select class="form-select" id="pageSize">
                                                <option value="a4">A4 (210 x 297 mm)</option>
                                                <option value="letter">Letter (8.5 x 11 in)</option>
                                                <option value="legal">Legal (8.5 x 14 in)</option>
                                                <option value="a3">A3 (297 x 420 mm)</option>
                                                <option value="a5">A5 (148 x 210 mm)</option>
                                            </select>
                                        </div>

                                        <!-- Orientation -->
                                        <div class="setting-group mb-3">
                                            <label class="setting-label mb-2">Orientation</label>
                                            <div class="btn-group w-100" role="group">
                                                <input type="radio" class="btn-check" name="orientation" id="orientPortrait" value="portrait" checked>
                                                <label class="btn btn-outline-primary" for="orientPortrait">
                                                    <i class="bi bi-phone"></i> Portrait
                                                </label>
                                                
                                                <input type="radio" class="btn-check" name="orientation" id="orientLandscape" value="landscape">
                                                <label class="btn btn-outline-primary" for="orientLandscape">
                                                    <i class="bi bi-laptop"></i> Landscape
                                                </label>
                                            </div>
                                        </div>

                                        <!-- Image Fit -->
                                        <div class="setting-group mb-3">
                                            <label class="setting-label mb-2">Image Fit</label>
                                            <select class="form-select" id="imageFit">
                                                <option value="contain">Fit to Page (Maintain Ratio)</option>
                                                <option value="cover">Fill Page (May Crop)</option>
                                                <option value="stretch">Stretch to Fit</option>
                                            </select>
                                        </div>

                                        <!-- Margins -->
                                        <div class="setting-group mb-3">
                                            <label class="setting-label mb-2">Margins (mm)</label>
                                            <div class="row g-2">
                                                <div class="col-6">
                                                    <input type="number" class="form-control form-control-sm" id="marginTop" value="10" min="0" max="50" placeholder="Top">
                                                </div>
                                                <div class="col-6">
                                                    <input type="number" class="form-control form-control-sm" id="marginBottom" value="10" min="0" max="50" placeholder="Bottom">
                                                </div>
                                                <div class="col-6">
                                                    <input type="number" class="form-control form-control-sm" id="marginLeft" value="10" min="0" max="50" placeholder="Left">
                                                </div>
                                                <div class="col-6">
                                                    <input type="number" class="form-control form-control-sm" id="marginRight" value="10" min="0" max="50" placeholder="Right">
                                                </div>
                                            </div>
                                        </div>

                                        <!-- Image Quality -->
                                        <div class="setting-group mb-3">
                                            <label class="setting-label mb-2">
                                                Image Quality
                                                <span class="badge bg-primary ms-1" id="qualityDisplay">95%</span>
                                            </label>
                                            <input type="range" class="form-range" id="imageQuality" min="50" max="100" value="95" step="5">
                                            <div class="d-flex justify-content-between text-muted small">
                                                <span>Smaller</span>
                                                <span>Better</span>
                                            </div>
                                        </div>

                                        <!-- Options -->
                                        <div class="setting-group mb-3">
                                            <div class="form-check mb-2">
                                                <input class="form-check-input" type="checkbox" id="oneImagePerPage" checked>
                                                <label class="form-check-label" for="oneImagePerPage">
                                                    One image per page
                                                </label>
                                            </div>
                                            <div class="form-check">
                                                <input class="form-check-input" type="checkbox" id="addPageNumbers">
                                                <label class="form-check-label" for="addPageNumbers">
                                                    Add page numbers
                                                </label>
                                            </div>
                                        </div>

                                        <!-- Generate Button -->
                                        <div class="d-grid">
                                            <button class="btn btn-success btn-lg" id="generatePdfBtn" disabled>
                                                <i class="bi bi-file-earmark-pdf me-2"></i> Generate PDF
                                            </button>
                                        </div>
                                    </div>
                                </div>

                                <!-- Info Card -->
                                <div class="card shadow-sm">
                                    <div class="card-body">
                                        <h6 class="card-title">
                                            <i class="bi bi-lightbulb text-warning me-2"></i> Tips
                                        </h6>
                                        <ul class="tips-list">
                                            <li>Drag images to reorder them</li>
                                            <li>Use A4 for documents</li>
                                            <li>Portrait for vertical images</li>
                                            <li>Higher quality = larger file</li>
                                        </ul>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Loading State -->
                    <div id="loadingState" class="loading-state d-none">
                        <div class="card shadow-sm">
                            <div class="card-body p-5 text-center">
                                <div class="spinner-border text-primary mb-3" style="width: 3rem; height: 3rem;" role="status">
                                    <span class="visually-hidden">Loading...</span>
                                </div>
                                <h5>Creating your PDF...</h5>
                                <p class="text-muted mb-0">Please wait while we process your images</p>
                                <div class="progress mt-3" style="height: 8px;">
                                    <div class="progress-bar progress-bar-striped progress-bar-animated" id="progressBar" style="width: 0%"></div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Success State -->
                    <div id="successState" class="success-state d-none">
                        <div class="card shadow-sm">
                            <div class="card-body p-5 text-center">
                                <div class="success-icon mb-3">
                                    <i class="bi bi-check-circle-fill text-success"></i>
                                </div>
                                <h3 class="mb-3">PDF Created Successfully!</h3>
                                <p class="text-muted mb-4">Your PDF is ready to download</p>

                                <div class="row g-3 mb-4 justify-content-center">
                                    <div class="col-auto">
                                        <div class="stat-box">
                                            <div class="stat-label">Pages</div>
                                            <div class="stat-value" id="totalPages">0</div>
                                        </div>
                                    </div>
                                    <div class="col-auto">
                                        <div class="stat-box">
                                            <div class="stat-label">File Size</div>
                                            <div class="stat-value" id="pdfSize">0 KB</div>
                                        </div>
                                    </div>
                                </div>

                                <div class="d-flex gap-3 justify-content-center">
                                    <button class="btn btn-success btn-lg" id="downloadPdfBtn">
                                        <i class="bi bi-download me-2"></i> Download PDF
                                    </button>
                                    <button class="btn btn-outline-primary btn-lg" id="createAnotherBtn">
                                        <i class="bi bi-plus-circle me-2"></i> Create Another
                                    </button>
                                </div>
                            </div>
                        </div>
                    </div>

                </div>
            </div>
        </div>
    </section>

    <!-- Features Section -->
    <section class="tool-features py-5 bg-light">
        <div class="container">
            <div class="row">
                <div class="col-lg-10 mx-auto">
                    <h2 class="text-center mb-5">Why Use Our Image to PDF Tool?</h2>
                    <div class="row g-4">
                        <div class="col-md-3">
                            <div class="feature-step text-center">
                                <div class="step-icon mb-3">
                                    <i class="bi bi-images fs-1 text-primary"></i>
                                </div>
                                <h5>Multiple Images</h5>
                                <p class="text-muted small">Combine up to 20 images in one PDF</p>
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="feature-step text-center">
                                <div class="step-icon mb-3">
                                    <i class="bi bi-arrows-move fs-1 text-primary"></i>
                                </div>
                                <h5>Drag & Reorder</h5>
                                <p class="text-muted small">Easily arrange your images</p>
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="feature-step text-center">
                                <div class="step-icon mb-3">
                                    <i class="bi bi-gear-fill fs-1 text-primary"></i>
                                </div>
                                <h5>Customizable</h5>
                                <p class="text-muted small">Choose size, orientation, margins</p>
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="feature-step text-center">
                                <div class="step-icon mb-3">
                                    <i class="bi bi-shield-check fs-1 text-primary"></i>
                                </div>
                                <h5>100% Private</h5>
                                <p class="text-muted small">All processing in your browser</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Use Cases -->
    <section class="use-cases py-5">
        <div class="container">
            <div class="row">
                <div class="col-lg-10 mx-auto">
                    <h2 class="text-center mb-5">Perfect For</h2>
                    <div class="row g-4">
                        <div class="col-md-4">
                            <div class="use-case-card">
                                <i class="bi bi-file-text text-primary"></i>
                                <h5>Documents</h5>
                                <p>Convert scanned documents to PDF format</p>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="use-case-card">
                                <i class="bi bi-receipt text-primary"></i>
                                <h5>Receipts & Invoices</h5>
                                <p>Organize receipts in a single PDF file</p>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="use-case-card">
                                <i class="bi bi-book text-primary"></i>
                                <h5>Photo Albums</h5>
                                <p>Create photo albums and portfolios</p>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="use-case-card">
                                <i class="bi bi-card-image text-primary"></i>
                                <h5>Presentations</h5>
                                <p>Convert slides or screenshots to PDF</p>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="use-case-card">
                                <i class="bi bi-journal-text text-primary"></i>
                                <h5>Reports</h5>
                                <p>Compile charts and graphs into reports</p>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="use-case-card">
                                <i class="bi bi-envelope text-primary"></i>
                                <h5>Email Attachments</h5>
                                <p>Send multiple images as one file</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- FAQ Section -->
    <section class="tool-faq py-5 bg-light">
        <div class="container">
            <div class="row">
                <div class="col-lg-8 mx-auto">
                    <h2 class="text-center mb-5">Frequently Asked Questions</h2>
                    <div class="accordion" id="faqAccordion">
                        <div class="accordion-item">
                            <h3 class="accordion-header">
                                <button class="accordion-button" type="button" data-bs-toggle="collapse" data-bs-target="#faq1">
                                    How many images can I convert at once?
                                </button>
                            </h3>
                            <div id="faq1" class="accordion-collapse collapse show" data-bs-parent="#faqAccordion">
                                <div class="accordion-body">
                                    You can convert up to 20 images in a single PDF file. For best results, keep the total under 50MB.
                                </div>
                            </div>
                        </div>
                        <div class="accordion-item">
                            <h3 class="accordion-header">
                                <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#faq2">
                                    What image formats are supported?
                                </button>
                            </h3>
                            <div id="faq2" class="accordion-collapse collapse" data-bs-parent="#faqAccordion">
                                <div class="accordion-body">
                                    We support JPEG, PNG, WebP, GIF, and most other common image formats.
                                </div>
                            </div>
                        </div>
                        <div class="accordion-item">
                            <h3 class="accordion-header">
                                <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#faq3">
                                    Are my images uploaded to your server?
                                </button>
                            </h3>
                            <div id="faq3" class="accordion-collapse collapse" data-bs-parent="#faqAccordion">
                                <div class="accordion-body">
                                    No! All conversion happens in your browser. Your images never leave your device, ensuring 100% privacy.
                                </div>
                            </div>
                        </div>
                        <div class="accordion-item">
                            <h3 class="accordion-header">
                                <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#faq4">
                                    Can I change the order of images?
                                </button>
                            </h3>
                            <div id="faq4" class="accordion-collapse collapse" data-bs-parent="#faqAccordion">
                                <div class="accordion-body">
                                    Yes! Simply drag and drop images to reorder them before generating the PDF.
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
</div>

<?php get_footer(); ?>