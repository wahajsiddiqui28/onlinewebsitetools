<?php
/**
 * Template Name: Crop Image
 * Description: Crop images online with custom dimensions
 */

get_header();
?>

<div class="tool-page crop-image-page">
    <!-- Tool Header -->
    <section class="tool-header py-5 bg-light">
        <div class="container">
            <div class="row align-items-center">
                <div class="col-lg-8 mx-auto text-center">
                    <div class="tool-breadcrumb mb-3">
                        <a href="<?php echo home_url(); ?>" class="text-muted">Home</a>
                        <span class="mx-2 text-muted">/</span>
                        <span class="text-primary">Crop Image</span>
                    </div>
                    <h1 class="tool-page-title mb-3">
                        <i class="bi bi-crop text-primary me-2"></i>
                        Crop Image Online
                    </h1>
                    <p class="tool-page-description">
                        Crop, trim, and cut your images to perfect dimensions. Free and easy to use.
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
                                Supports: JPEG, PNG, WebP, GIF | Max size: 10MB
                            </p>
                        </div>
                    </div>

                    <!-- Crop Editor -->
                    <div id="cropEditor" class="crop-editor d-none">
                        <div class="row g-4">
                            <!-- Left Side - Image Preview -->
                            <div class="col-lg-8">
                                <div class="card shadow-sm">
                                    <div class="card-body p-3">
                                        <div class="crop-container">
                                            <canvas id="cropCanvas"></canvas>
                                            <div id="cropBox" class="crop-box">
                                                <div class="crop-handle crop-handle-nw"></div>
                                                <div class="crop-handle crop-handle-ne"></div>
                                                <div class="crop-handle crop-handle-sw"></div>
                                                <div class="crop-handle crop-handle-se"></div>
                                                <div class="crop-handle crop-handle-n"></div>
                                                <div class="crop-handle crop-handle-s"></div>
                                                <div class="crop-handle crop-handle-e"></div>
                                                <div class="crop-handle crop-handle-w"></div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <!-- Right Side - Controls -->
                            <div class="col-lg-4">
                                <div class="card shadow-sm mb-3">
                                    <div class="card-body">
                                        <h5 class="card-title mb-3">
                                            <i class="bi bi-gear me-2"></i> Crop Settings
                                        </h5>

                                        <!-- Aspect Ratio Presets -->
                                        <div class="setting-group mb-3">
                                            <label class="setting-label mb-2">Aspect Ratio</label>
                                            <div class="ratio-buttons">
                                                <button class="btn btn-sm btn-outline-primary ratio-btn active" data-ratio="free">
                                                    Free
                                                </button>
                                                <button class="btn btn-sm btn-outline-primary ratio-btn" data-ratio="1:1">
                                                    1:1
                                                </button>
                                                <button class="btn btn-sm btn-outline-primary ratio-btn" data-ratio="4:3">
                                                    4:3
                                                </button>
                                                <button class="btn btn-sm btn-outline-primary ratio-btn" data-ratio="16:9">
                                                    16:9
                                                </button>
                                                <button class="btn btn-sm btn-outline-primary ratio-btn" data-ratio="3:2">
                                                    3:2
                                                </button>
                                                <button class="btn btn-sm btn-outline-primary ratio-btn" data-ratio="9:16">
                                                    9:16
                                                </button>
                                            </div>
                                        </div>

                                        <!-- Custom Dimensions -->
                                        <div class="setting-group mb-3">
                                            <label class="setting-label mb-2">Crop Dimensions</label>
                                            <div class="row g-2">
                                                <div class="col-6">
                                                    <label class="form-label small text-muted">Width (px)</label>
                                                    <input type="number" id="cropWidth" class="form-control" placeholder="Width">
                                                </div>
                                                <div class="col-6">
                                                    <label class="form-label small text-muted">Height (px)</label>
                                                    <input type="number" id="cropHeight" class="form-control" placeholder="Height">
                                                </div>
                                            </div>
                                        </div>

                                        <!-- Position -->
                                        <div class="setting-group mb-3">
                                            <label class="setting-label mb-2">Position</label>
                                            <div class="row g-2">
                                                <div class="col-6">
                                                    <label class="form-label small text-muted">X Position</label>
                                                    <input type="number" id="cropX" class="form-control" placeholder="X">
                                                </div>
                                                <div class="col-6">
                                                    <label class="form-label small text-muted">Y Position</label>
                                                    <input type="number" id="cropY" class="form-control" placeholder="Y">
                                                </div>
                                            </div>
                                        </div>

                                        <!-- Lock Aspect Ratio -->
                                        <div class="setting-group mb-3">
                                            <div class="form-check form-switch">
                                                <input class="form-check-input" type="checkbox" id="lockAspect">
                                                <label class="form-check-label" for="lockAspect">
                                                    Lock Aspect Ratio
                                                </label>
                                            </div>
                                        </div>

                                        <!-- Image Info -->
                                        <div class="setting-group mb-3 bg-light p-3 rounded">
                                            <div class="small text-muted mb-1">Original Size</div>
                                            <div class="fw-bold" id="originalDimensions">0 × 0 px</div>
                                        </div>

                                        <!-- Action Buttons -->
                                        <div class="d-grid gap-2">
                                            <button class="btn btn-primary" id="applyCropBtn">
                                                <i class="bi bi-check-circle me-2"></i> Apply Crop
                                            </button>
                                            <button class="btn btn-outline-secondary" id="resetCropBtn">
                                                <i class="bi bi-arrow-counterclockwise me-2"></i> Reset
                                            </button>
                                        </div>
                                    </div>
                                </div>

                                <!-- Quick Actions -->
                                <div class="card shadow-sm">
                                    <div class="card-body">
                                        <h6 class="card-title mb-3">Quick Actions</h6>
                                        <div class="d-grid gap-2">
                                            <button class="btn btn-sm btn-outline-primary" id="rotateLeftBtn">
                                                <i class="bi bi-arrow-counterclockwise me-1"></i> Rotate Left
                                            </button>
                                            <button class="btn btn-sm btn-outline-primary" id="rotateRightBtn">
                                                <i class="bi bi-arrow-clockwise me-1"></i> Rotate Right
                                            </button>
                                            <button class="btn btn-sm btn-outline-primary" id="flipHorizontalBtn">
                                                <i class="bi bi-arrows-expand me-1"></i> Flip Horizontal
                                            </button>
                                            <button class="btn btn-sm btn-outline-primary" id="flipVerticalBtn">
                                                <i class="bi bi-arrows-collapse me-1"></i> Flip Vertical
                                            </button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Result Area -->
                    <div id="resultArea" class="result-area d-none mt-4">
                        <div class="card shadow-sm">
                            <div class="card-body p-4">
                                <h5 class="card-title mb-4">
                                    <i class="bi bi-check-circle-fill text-success me-2"></i> Cropped Image
                                </h5>

                                <!-- Cropped Image Preview -->
                                <div class="row g-4 mb-4">
                                    <div class="col-md-6 mx-auto">
                                        <div class="cropped-preview-box">
                                            <img id="croppedImage" src="" alt="Cropped" class="img-fluid rounded">
                                        </div>
                                    </div>
                                </div>

                                <!-- Result Info -->
                                <div class="row g-3 mb-4">
                                    <div class="col-md-4">
                                        <div class="stat-card bg-light p-3 rounded text-center">
                                            <div class="stat-label text-muted small">Cropped Size</div>
                                            <div class="stat-value text-primary fw-bold" id="croppedDimensions">0 × 0</div>
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="stat-card bg-light p-3 rounded text-center">
                                            <div class="stat-label text-muted small">File Size</div>
                                            <div class="stat-value text-dark fw-bold" id="croppedFileSize">0 KB</div>
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="stat-card bg-light p-3 rounded text-center">
                                            <div class="stat-label text-muted small">Format</div>
                                            <div class="stat-value text-dark fw-bold" id="croppedFormat">PNG</div>
                                        </div>
                                    </div>
                                </div>

                                <!-- Download Options -->
                                <div class="download-options mb-3">
                                    <label class="form-label fw-bold">Download Format</label>
                                    <div class="btn-group w-100" role="group">
                                        <input type="radio" class="btn-check" name="downloadFormat" id="formatPNG" value="png" checked>
                                        <label class="btn btn-outline-primary" for="formatPNG">PNG</label>
                                        
                                        <input type="radio" class="btn-check" name="downloadFormat" id="formatJPEG" value="jpeg">
                                        <label class="btn btn-outline-primary" for="formatJPEG">JPEG</label>
                                        
                                        <input type="radio" class="btn-check" name="downloadFormat" id="formatWebP" value="webp">
                                        <label class="btn btn-outline-primary" for="formatWebP">WebP</label>
                                    </div>
                                </div>

                                <!-- Action Buttons -->
                                <div class="d-flex gap-3">
                                    <button class="btn btn-success btn-lg flex-fill" id="downloadBtn">
                                        <i class="bi bi-download me-2"></i> Download Image
                                    </button>
                                    <button class="btn btn-outline-primary btn-lg" id="cropAnotherBtn">
                                        <i class="bi bi-plus-circle me-2"></i> Crop Another
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
                    <h2 class="text-center mb-5">Crop Features</h2>
                    <div class="row g-4">
                        <div class="col-md-3">
                            <div class="feature-step text-center">
                                <div class="step-icon mb-3">
                                    <i class="bi bi-aspect-ratio fs-1 text-primary"></i>
                                </div>
                                <h5>Custom Dimensions</h5>
                                <p class="text-muted small">Set exact width and height in pixels</p>
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="feature-step text-center">
                                <div class="step-icon mb-3">
                                    <i class="bi bi-square fs-1 text-primary"></i>
                                </div>
                                <h5>Aspect Ratios</h5>
                                <p class="text-muted small">1:1, 4:3, 16:9 and more presets</p>
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="feature-step text-center">
                                <div class="step-icon mb-3">
                                    <i class="bi bi-arrow-clockwise fs-1 text-primary"></i>
                                </div>
                                <h5>Rotate & Flip</h5>
                                <p class="text-muted small">Rotate and flip images easily</p>
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="feature-step text-center">
                                <div class="step-icon mb-3">
                                    <i class="bi bi-download fs-1 text-primary"></i>
                                </div>
                                <h5>Multiple Formats</h5>
                                <p class="text-muted small">Download as PNG, JPEG or WebP</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- How to Use -->
    <section class="how-to-use py-5">
        <div class="container">
            <div class="row">
                <div class="col-lg-8 mx-auto">
                    <h2 class="text-center mb-5">How to Crop Images</h2>
                    <div class="row g-4">
                        <div class="col-md-4">
                            <div class="how-step">
                                <div class="step-number">1</div>
                                <h5>Upload Image</h5>
                                <p class="text-muted">Click or drag to upload your image</p>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="how-step">
                                <div class="step-number">2</div>
                                <h5>Adjust Crop Area</h5>
                                <p class="text-muted">Drag handles to select area to keep</p>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="how-step">
                                <div class="step-number">3</div>
                                <h5>Download</h5>
                                <p class="text-muted">Save your perfectly cropped image</p>
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
                                    Can I crop images for free?
                                </button>
                            </h3>
                            <div id="faq1" class="accordion-collapse collapse show" data-bs-parent="#faqAccordion">
                                <div class="accordion-body">
                                    Yes! Our image crop tool is completely free with no watermarks or limitations.
                                </div>
                            </div>
                        </div>
                        <div class="accordion-item">
                            <h3 class="accordion-header">
                                <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#faq2">
                                    What aspect ratios are supported?
                                </button>
                            </h3>
                            <div id="faq2" class="accordion-collapse collapse" data-bs-parent="#faqAccordion">
                                <div class="accordion-body">
                                    We support free crop, square (1:1), 4:3, 16:9, 3:2, 9:16, and custom dimensions.
                                </div>
                            </div>
                        </div>
                        <div class="accordion-item">
                            <h3 class="accordion-header">
                                <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#faq3">
                                    Is my image uploaded to your server?
                                </button>
                            </h3>
                            <div id="faq3" class="accordion-collapse collapse" data-bs-parent="#faqAccordion">
                                <div class="accordion-body">
                                    No! All cropping happens in your browser. Your images never leave your device.
                                </div>
                            </div>
                        </div>
                        <div class="accordion-item">
                            <h3 class="accordion-header">
                                <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#faq4">
                                    Can I rotate the image before cropping?
                                </button>
                            </h3>
                            <div id="faq4" class="accordion-collapse collapse" data-bs-parent="#faqAccordion">
                                <div class="accordion-body">
                                    Yes! Use the quick actions panel to rotate left/right or flip horizontal/vertical.
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