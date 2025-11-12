<?php
/**
 * Template Name: PDF Compressor
 * Description: Compress PDF files to reduce size
 */

get_header();
?>

<div class="tool-page pdf-compressor-page">
    <!-- Tool Header -->
    <section class="tool-header py-5 bg-light">
        <div class="container">
            <div class="row align-items-center">
                <div class="col-lg-8 mx-auto text-center">
                    <div class="tool-breadcrumb mb-3">
                        <a href="<?php echo home_url(); ?>" class="text-muted">Home</a>
                        <span class="mx-2 text-muted">/</span>
                        <span class="text-primary">PDF Compressor</span>
                    </div>
                    <h1 class="tool-page-title mb-3">
                        <i class="bi bi-file-earmark-zip text-primary me-2"></i>
                        PDF Compressor
                    </h1>
                    <p class="tool-page-description">
                        Reduce PDF file size up to 90% while maintaining quality. Fast, free, and secure.
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
                            <i class="bi bi-file-earmark-pdf upload-icon"></i>
                            <h3 class="upload-title">Drop your PDF here</h3>
                            <p class="upload-subtitle">or click to browse</p>
                            <input type="file" id="pdfInput" accept=".pdf,application/pdf" class="d-none">
                            <button class="btn btn-primary btn-lg mt-3" onclick="document.getElementById('pdfInput').click()">
                                <i class="bi bi-folder2-open me-2"></i> Choose PDF File
                            </button>
                            <p class="upload-note mt-3">
                                <i class="bi bi-info-circle me-1"></i> 
                                Max file size: 50MB | Supports: PDF files only
                            </p>
                        </div>
                    </div>

                    <!-- Editor Area -->
                    <div id="editorArea" class="editor-area d-none">
                        <div class="row g-4">
                            <!-- Left Side - PDF Preview -->
                            <div class="col-lg-8">
                                <div class="card shadow-sm">
                                    <div class="card-body p-4">
                                        <h5 class="card-title mb-3">
                                            <i class="bi bi-file-earmark-pdf me-2"></i> 
                                            Original PDF
                                        </h5>

                                        <!-- PDF Info -->
                                        <div class="pdf-info-card mb-3">
                                            <div class="row g-3">
                                                <div class="col-md-6">
                                                    <div class="info-item">
                                                        <span class="info-label">File Name:</span>
                                                        <span class="info-value" id="fileName">document.pdf</span>
                                                    </div>
                                                </div>
                                                <div class="col-md-3">
                                                    <div class="info-item">
                                                        <span class="info-label">Pages:</span>
                                                        <span class="info-value" id="pageCount">0</span>
                                                    </div>
                                                </div>
                                                <div class="col-md-3">
                                                    <div class="info-item">
                                                        <span class="info-label">Original Size:</span>
                                                        <span class="info-value text-danger" id="originalSize">0 KB</span>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>

                                        <!-- PDF Preview (First Page) -->
                                        <div class="pdf-preview-container">
                                            <canvas id="pdfPreviewCanvas" class="pdf-preview-canvas"></canvas>
                                            <div class="text-center mt-2">
                                                <small class="text-muted">Preview of first page</small>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <!-- Right Side - Compression Settings -->
                            <div class="col-lg-4">
                                <div class="card shadow-sm mb-3">
                                    <div class="card-body">
                                        <h5 class="card-title mb-3">
                                            <i class="bi bi-sliders me-2"></i> Compression Settings
                                        </h5>

                                        <!-- Compression Level -->
                                        <div class="setting-group mb-4">
                                            <label class="setting-label mb-3">Compression Level</label>
                                            
                                            <div class="compression-presets mb-3">
                                                <input type="radio" class="btn-check" name="compressionLevel" id="levelLow" value="low" checked>
                                                <label class="preset-btn" for="levelLow">
                                                    <i class="bi bi-star"></i>
                                                    <span class="preset-title">Low</span>
                                                    <span class="preset-desc">Best quality</span>
                                                    <span class="preset-compression">~30% smaller</span>
                                                </label>

                                                <input type="radio" class="btn-check" name="compressionLevel" id="levelMedium" value="medium">
                                                <label class="preset-btn" for="levelMedium">
                                                    <i class="bi bi-stars"></i>
                                                    <span class="preset-title">Medium</span>
                                                    <span class="preset-desc">Balanced</span>
                                                    <span class="preset-compression">~60% smaller</span>
                                                </label>

                                                <input type="radio" class="btn-check" name="compressionLevel" id="levelHigh" value="high">
                                                <label class="preset-btn" for="levelHigh">
                                                    <i class="bi bi-lightning"></i>
                                                    <span class="preset-title">High</span>
                                                    <span class="preset-desc">Maximum compression</span>
                                                    <span class="preset-compression">~90% smaller</span>
                                                </label>
                                            </div>
                                        </div>

                                        <!-- Image Quality -->
                                        <div class="setting-group mb-3">
                                            <label class="setting-label mb-2">
                                                Image Quality
                                                <span class="badge bg-primary ms-1" id="qualityDisplay">80%</span>
                                            </label>
                                            <input type="range" class="form-range" id="imageQuality" min="30" max="100" value="80" step="10">
                                            <div class="d-flex justify-content-between text-muted small">
                                                <span>Lower Quality</span>
                                                <span>Higher Quality</span>
                                            </div>
                                        </div>

                                        <!-- Options -->
                                        <div class="setting-group mb-4">
                                            <label class="setting-label mb-2">Options</label>
                                            <div class="form-check mb-2">
                                                <input class="form-check-input" type="checkbox" id="removeMetadata" checked>
                                                <label class="form-check-label" for="removeMetadata">
                                                    Remove metadata
                                                </label>
                                            </div>
                                            <div class="form-check">
                                                <input class="form-check-input" type="checkbox" id="optimizeImages" checked>
                                                <label class="form-check-label" for="optimizeImages">
                                                    Optimize images
                                                </label>
                                            </div>
                                        </div>

                                        <!-- Compress Button -->
                                        <div class="d-grid gap-2">
                                            <button class="btn btn-success btn-lg" id="compressPdfBtn">
                                                <i class="bi bi-file-earmark-zip me-2"></i> Compress PDF
                                            </button>
                                            <button class="btn btn-outline-danger" id="cancelBtn">
                                                <i class="bi bi-x-circle me-2"></i> Cancel
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
                                            <li>Start with low compression</li>
                                            <li>Check preview after compression</li>
                                            <li>Higher quality = larger file size</li>
                                            <li>Image-heavy PDFs compress more</li>
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
                                <h5>Compressing your PDF...</h5>
                                <p class="text-muted mb-0">This may take a few moments</p>
                                <div class="progress mt-3" style="height: 8px;">
                                    <div class="progress-bar progress-bar-striped progress-bar-animated" id="progressBar" style="width: 0%"></div>
                                </div>
                                <p class="text-muted small mt-2" id="progressText">Processing...</p>
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
                                <h3 class="mb-3">PDF Compressed Successfully!</h3>
                                <p class="text-muted mb-4">Your compressed PDF is ready to download</p>

                                <!-- Compression Stats -->
                                <div class="compression-stats mb-4">
                                    <div class="row g-3 justify-content-center">
                                        <div class="col-auto">
                                            <div class="stat-box">
                                                <div class="stat-label">Original Size</div>
                                                <div class="stat-value text-danger" id="statOriginalSize">0 MB</div>
                                            </div>
                                        </div>
                                        <div class="col-auto d-flex align-items-center">
                                            <i class="bi bi-arrow-right fs-2 text-muted"></i>
                                        </div>
                                        <div class="col-auto">
                                            <div class="stat-box">
                                                <div class="stat-label">Compressed Size</div>
                                                <div class="stat-value text-success" id="statCompressedSize">0 MB</div>
                                            </div>
                                        </div>
                                        <div class="col-12">
                                            <div class="saved-space">
                                                <span class="badge bg-success-soft fs-5 px-4 py-2">
                                                    <i class="bi bi-check-circle me-2"></i>
                                                    Reduced by <strong id="savedPercentage">0%</strong>
                                                </span>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="d-flex gap-3 justify-content-center">
                                    <button class="btn btn-success btn-lg" id="downloadCompressedBtn">
                                        <i class="bi bi-download me-2"></i> Download Compressed PDF
                                    </button>
                                    <button class="btn btn-outline-primary btn-lg" id="compressAnotherBtn">
                                        <i class="bi bi-plus-circle me-2"></i> Compress Another
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
                    <h2 class="text-center mb-5">Why Use Our PDF Compressor?</h2>
                    <div class="row g-4">
                        <div class="col-md-3">
                            <div class="feature-step text-center">
                                <div class="step-icon mb-3">
                                    <i class="bi bi-lightning-charge fs-1 text-primary"></i>
                                </div>
                                <h5>Fast Compression</h5>
                                <p class="text-muted small">Compress in seconds</p>
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="feature-step text-center">
                                <div class="step-icon mb-3">
                                    <i class="bi bi-graph-down fs-1 text-primary"></i>
                                </div>
                                <h5>Up to 90% Smaller</h5>
                                <p class="text-muted small">Reduce file size dramatically</p>
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="feature-step text-center">
                                <div class="step-icon mb-3">
                                    <i class="bi bi-stars fs-1 text-primary"></i>
                                </div>
                                <h5>Quality Control</h5>
                                <p class="text-muted small">Choose your compression level</p>
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="feature-step text-center">
                                <div class="step-icon mb-3">
                                    <i class="bi bi-shield-check fs-1 text-primary"></i>
                                </div>
                                <h5>100% Secure</h5>
                                <p class="text-muted small">Files never leave your browser</p>
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
                                <i class="bi bi-envelope text-primary"></i>
                                <h5>Email Attachments</h5>
                                <p>Reduce file size to meet email limits</p>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="use-case-card">
                                <i class="bi bi-cloud-upload text-primary"></i>
                                <h5>Cloud Storage</h5>
                                <p>Save storage space in cloud services</p>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="use-case-card">
                                <i class="bi bi-globe text-primary"></i>
                                <h5>Website Uploads</h5>
                                <p>Faster uploads and downloads</p>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="use-case-card">
                                <i class="bi bi-archive text-primary"></i>
                                <h5>Archiving</h5>
                                <p>Store more documents in less space</p>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="use-case-card">
                                <i class="bi bi-share text-primary"></i>
                                <h5>File Sharing</h5>
                                <p>Share large documents easily</p>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="use-case-card">
                                <i class="bi bi-phone text-primary"></i>
                                <h5>Mobile Devices</h5>
                                <p>Save space on phones and tablets</p>
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
                                    How much can I compress a PDF?
                                </button>
                            </h3>
                            <div id="faq1" class="accordion-collapse collapse show" data-bs-parent="#faqAccordion">
                                <div class="accordion-body">
                                    Compression depends on the original PDF content. Image-heavy PDFs can be compressed up to 90%, while text-based PDFs may see 30-50% reduction.
                                </div>
                            </div>
                        </div>
                        <div class="accordion-item">
                            <h3 class="accordion-header">
                                <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#faq2">
                                    Will compression affect quality?
                                </button>
                            </h3>
                            <div id="faq2" class="accordion-collapse collapse" data-bs-parent="#faqAccordion">
                                <div class="accordion-body">
                                    You can control the quality level. Low compression maintains near-original quality, while high compression reduces file size more but may slightly affect image quality.
                                </div>
                            </div>
                        </div>
                        <div class="accordion-item">
                            <h3 class="accordion-header">
                                <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#faq3">
                                    Is my PDF file safe?
                                </button>
                            </h3>
                            <div id="faq3" class="accordion-collapse collapse" data-bs-parent="#faqAccordion">
                                <div class="accordion-body">
                                    Absolutely! All compression happens in your browser. Your PDF never leaves your device, ensuring complete privacy and security.
                                </div>
                            </div>
                        </div>
                        <div class="accordion-item">
                            <h3 class="accordion-header">
                                <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#faq4">
                                    What is the maximum file size?
                                </button>
                            </h3>
                            <div id="faq4" class="accordion-collapse collapse" data-bs-parent="#faqAccordion">
                                <div class="accordion-body">
                                    You can compress PDF files up to 50MB. For best performance, we recommend files under 20MB.
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