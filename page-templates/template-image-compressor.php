<?php
/**
 * Template Name: Image Compressor
 * Description: Compress images online
 */

get_header();
?>

<div class="tool-page image-compressor-page">
    <!-- Tool Header -->
    <section class="tool-header py-5 bg-light">
        <div class="container">
            <div class="row align-items-center">
                <div class="col-lg-8 mx-auto text-center">
                    <div class="tool-breadcrumb mb-3">
                        <a href="<?php echo home_url(); ?>" class="text-muted">Home</a>
                        <span class="mx-2 text-muted">/</span>
                        <span class="text-primary">Image Compressor</span>
                    </div>
                    <h1 class="tool-page-title mb-3">
                        <i class="bi bi-file-earmark-zip text-primary me-2"></i>
                        Image Compressor
                    </h1>
                    <p class="tool-page-description">
                        Reduce image file size up to 90% without losing quality. Supports JPEG, PNG, WebP and more.
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
                            <h3 class="upload-title">Drop your image here</h3>
                            <p class="upload-subtitle">or click to browse</p>
                            <input type="file" id="imageInput" accept="image/*" class="d-none">
                            <button class="btn btn-primary btn-lg mt-3" onclick="document.getElementById('imageInput').click()">
                                <i class="bi bi-folder2-open me-2"></i> Choose Image
                            </button>
                            <p class="upload-note mt-3">
                                <i class="bi bi-info-circle me-1"></i> 
                                Supports: JPEG, PNG, WebP, GIF | Max size: 60MB
                            </p>
                        </div>
                    </div>

                    <!-- Compression Controls -->
                    <div id="compressionControls" class="compression-controls d-none">
                        <div class="card shadow-sm">
                            <div class="card-body p-4">
                                <h5 class="card-title mb-4">
                                    <i class="bi bi-sliders me-2"></i> Compression Settings
                                </h5>
                                
                                <!-- Quality Slider -->
                                <div class="setting-group mb-4">
                                    <div class="d-flex justify-content-between align-items-center mb-2">
                                        <label class="setting-label">Quality Level</label>
                                        <span class="quality-value badge bg-primary" id="qualityValue">80%</span>
                                    </div>
                                    <input type="range" class="form-range" id="qualitySlider" min="10" max="100" value="80" step="5">
                                    <div class="d-flex justify-content-between text-muted small mt-1">
                                        <span>Smaller Size</span>
                                        <span>Better Quality</span>
                                    </div>
                                </div>

                                <!-- Format Selection -->
                                <div class="setting-group mb-4">
                                    <label class="setting-label mb-2">Output Format</label>
                                    <div class="btn-group w-100" role="group">
                                        <input type="radio" class="btn-check" name="outputFormat" id="formatOriginal" value="original" checked>
                                        <label class="btn btn-outline-primary" for="formatOriginal">Original</label>
                                        
                                        <input type="radio" class="btn-check" name="outputFormat" id="formatJPEG" value="jpeg">
                                        <label class="btn btn-outline-primary" for="formatJPEG">JPEG</label>
                                        
                                        <input type="radio" class="btn-check" name="outputFormat" id="formatPNG" value="png">
                                        <label class="btn btn-outline-primary" for="formatPNG">PNG</label>
                                        
                                        <input type="radio" class="btn-check" name="outputFormat" id="formatWebP" value="webp">
                                        <label class="btn btn-outline-primary" for="formatWebP">WebP</label>
                                    </div>
                                </div>

                                <!-- Action Buttons -->
                                <div class="d-flex gap-3">
                                    <button class="btn btn-primary btn-lg flex-fill" id="compressBtn">
                                        <i class="bi bi-gear-fill me-2"></i> Compress Image
                                    </button>
                                    <button class="btn btn-outline-secondary btn-lg" id="resetBtn">
                                        <i class="bi bi-arrow-counterclockwise"></i>
                                    </button>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Loading State -->
                    <div id="loadingState" class="loading-state d-none">
                        <div class="card shadow-sm">
                            <div class="card-body p-5 text-center">
                                <div class="spinner-border text-primary mb-3" role="status">
                                    <span class="visually-hidden">Loading...</span>
                                </div>
                                <h5>Compressing your image...</h5>
                                <p class="text-muted mb-0">This will take just a moment</p>
                            </div>
                        </div>
                    </div>

                    <!-- Comparison Area -->
                    <div id="comparisonArea" class="comparison-area d-none">
                        <div class="card shadow-sm">
                            <div class="card-body p-4">
                                <h5 class="card-title mb-4">
                                    <i class="bi bi-image me-2"></i> Compression Result
                                </h5>

                                <!-- Stats Cards -->
                                <div class="row g-3 mb-4">
                                    <div class="col-md-4">
                                        <div class="stat-card bg-light p-3 rounded">
                                            <div class="stat-label text-muted small">Original Size</div>
                                            <div class="stat-value text-dark fw-bold" id="originalSize">0 KB</div>
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="stat-card bg-light p-3 rounded">
                                            <div class="stat-label text-muted small">Compressed Size</div>
                                            <div class="stat-value text-primary fw-bold" id="compressedSize">0 KB</div>
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="stat-card bg-success bg-opacity-10 p-3 rounded">
                                            <div class="stat-label text-muted small">Saved</div>
                                            <div class="stat-value text-success fw-bold" id="savedPercentage">0%</div>
                                        </div>
                                    </div>
                                </div>

                                <!-- Image Comparison -->
                                <div class="row g-3 mb-4">
                                    <div class="col-md-6">
                                        <div class="image-preview-box">
                                            <div class="image-label">Original</div>
                                            <img id="originalImage" src="" alt="Original" class="img-fluid rounded">
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="image-preview-box">
                                            <div class="image-label">Compressed</div>
                                            <img id="compressedImage" src="" alt="Compressed" class="img-fluid rounded">
                                        </div>
                                    </div>
                                </div>

                                <!-- Download Button -->
                                <div class="d-flex gap-3">
                                    <button class="btn btn-success btn-lg flex-fill" id="downloadBtn">
                                        <i class="bi bi-download me-2"></i> Download Compressed Image
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
                    <h2 class="text-center mb-5">How It Works</h2>
                    <div class="row g-4">
                        <div class="col-md-4">
                            <div class="feature-step text-center">
                                <div class="step-number">1</div>
                                <h4>Upload Image</h4>
                                <p class="text-muted">Select or drag & drop your image file</p>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="feature-step text-center">
                                <div class="step-number">2</div>
                                <h4>Adjust Settings</h4>
                                <p class="text-muted">Choose quality level and output format</p>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="feature-step text-center">
                                <div class="step-number">3</div>
                                <h4>Download</h4>
                                <p class="text-muted">Get your optimized image instantly</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- FAQ Section -->
    <section class="tool-faq py-5">
        <div class="container">
            <div class="row">
                <div class="col-lg-8 mx-auto">
                    <h2 class="text-center mb-5">Frequently Asked Questions</h2>
                    <div class="accordion" id="faqAccordion">
                        <div class="accordion-item">
                            <h3 class="accordion-header">
                                <button class="accordion-button" type="button" data-bs-toggle="collapse" data-bs-target="#faq1">
                                    Is my image secure?
                                </button>
                            </h3>
                            <div id="faq1" class="accordion-collapse collapse show" data-bs-parent="#faqAccordion">
                                <div class="accordion-body">
                                    Yes! All compression happens in your browser. Your images never leave your device.
                                </div>
                            </div>
                        </div>
                        <div class="accordion-item">
                            <h3 class="accordion-header">
                                <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#faq2">
                                    What formats are supported?
                                </button>
                            </h3>
                            <div id="faq2" class="accordion-collapse collapse" data-bs-parent="#faqAccordion">
                                <div class="accordion-body">
                                    We support JPEG, PNG, WebP, GIF and most common image formats.
                                </div>
                            </div>
                        </div>
                        <div class="accordion-item">
                            <h3 class="accordion-header">
                                <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#faq3">
                                    Will compression reduce quality?
                                </button>
                            </h3>
                            <div id="faq3" class="accordion-collapse collapse" data-bs-parent="#faqAccordion">
                                <div class="accordion-body">
                                    You control the quality level. At 80% quality, the difference is barely noticeable but file size reduces significantly.
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