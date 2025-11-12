<?php get_header(); ?>

<style>
    /* ==========================================
   CATEGORY TABS
========================================== */

.category-tabs-wrapper {
    max-width: 900px;
    margin: 0 auto;
}

.category-tabs {
    border-bottom: none;
    gap: 0.75rem;
    flex-wrap: wrap;
    padding: 0;
}

.category-tabs .nav-item {
    margin-bottom: 0.75rem;
}

.category-tabs .nav-link {
    background: var(--white);
    border: 2px solid #e5e7eb;
    color: var(--dark-color);
    font-weight: 600;
    padding: 0.875rem 1.75rem;
    border-radius: 50px;
    transition: var(--transition);
    display: flex;
    align-items: center;
    white-space: nowrap;
}

.category-tabs .nav-link:hover {
    border-color: var(--primary-light);
    background: rgba(37, 99, 235, 0.05);
    transform: translateY(-2px);
}

.category-tabs .nav-link.active {
    background: linear-gradient(135deg, var(--primary-color) 0%, var(--primary-dark) 100%);
    border-color: var(--primary-color);
    color: var(--white);
    box-shadow: 0 4px 12px rgba(37, 99, 235, 0.3);
}

.category-tabs .nav-link i {
    font-size: 1.125rem;
}

.category-tabs .badge {
    font-size: 0.7rem;
    padding: 0.25rem 0.5rem;
    font-weight: 600;
}

/* Tool Category Badge */
.tool-category-badge {
    position: absolute;
    top: 1rem;
    right: 1rem;
    z-index: 1;
}

.tool-category-badge .badge {
    padding: 0.5rem 0.875rem;
    font-size: 0.75rem;
    font-weight: 600;
    border-radius: 50px;
}

.bg-primary-soft {
    background-color: rgba(37, 99, 235, 0.1) !important;
    color: var(--primary-color) !important;
}

/* Tab Content Animation */
.tab-pane {
    animation: fadeIn 0.3s ease-in-out;
}

@keyframes fadeIn {
    from {
        opacity: 0;
        transform: translateY(10px);
    }
    to {
        opacity: 1;
        transform: translateY(0);
    }
}

/* Coming Soon Message */
.coming-soon-message {
    padding: 4rem 2rem;
}

.coming-soon-message i {
    opacity: 0.3;
}

.coming-soon-message h3 {
    font-size: 1.75rem;
    font-weight: 700;
    color: var(--dark-color);
    margin-bottom: 0.75rem;
}

.coming-soon-message p {
    font-size: 1.125rem;
    max-width: 400px;
    margin: 0 auto;
}

/* Responsive Category Tabs */
@media (max-width: 768px) {
    .category-tabs {
        justify-content: flex-start !important;
        gap: 0.5rem;
    }

    .category-tabs .nav-link {
        padding: 0.75rem 1.25rem;
        font-size: 0.875rem;
    }

    .category-tabs .nav-link i {
        font-size: 1rem;
    }

    .category-tabs .badge {
        display: none;
    }
}

@media (max-width: 576px) {
    .category-tabs .nav-link {
        padding: 0.625rem 1rem;
    }
    
    .tool-category-badge {
        top: 0.75rem;
        right: 0.75rem;
    }
}

/* Warning Soft Badge */
.bg-warning-soft {
    background-color: rgba(255, 193, 7, 0.15) !important;
    color: #f59e0b !important;
}
</style>

<!-- Hero Section with Gradient -->
<section class="hero-section">
    <div class="container">
        <div class="row align-items-center min-vh-50">
            <div class="col-lg-8 mx-auto text-center">
                <div class="hero-badge mb-3">
                    <span class="badge bg-primary-soft">100% Free & Secure</span>
                </div>
                <h1 class="hero-title mb-4">
                    Transform Your Images <br/>
                    <span class="text-gradient">Instantly & Free</span>
                </h1>
                <p class="hero-subtitle mb-4">
                    Professional image tools that work right in your browser. <br/>
                    No uploads, no registration, no hassle.
                </p>
                <div class="hero-stats d-flex justify-content-center gap-4 flex-wrap">
                    <div class="stat-item">
                        <div class="stat-number">100%</div>
                        <div class="stat-label">Private</div>
                    </div>
                    <div class="stat-item">
                        <div class="stat-number">Fast</div>
                        <div class="stat-label">Processing</div>
                    </div>
                    <div class="stat-item">
                        <div class="stat-number">10+</div>
                        <div class="stat-label">Free Tools</div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Wave Divider -->
    <div class="wave-divider">
        <svg viewBox="0 0 1200 120" preserveAspectRatio="none">
            <path d="M321.39,56.44c58-10.79,114.16-30.13,172-41.86,82.39-16.72,168.19-17.73,250.45-.39C823.78,31,906.67,72,985.66,92.83c70.05,18.48,146.53,26.09,214.34,3V0H0V27.35A600.21,600.21,0,0,0,321.39,56.44Z"></path>
        </svg>
    </div>
</section>

<!-- Tools Section with Categories -->
<section class="tools-section py-5">
    <div class="container">
        <div class="section-header text-center mb-5">
            <h2 class="section-title">Choose Your Tool</h2>
            <p class="section-subtitle">Select from our collection of powerful tools organized by category</p>
        </div>

        <!-- Category Pills/Tabs -->
        <div class="category-tabs-wrapper mb-5">
            <ul class="nav nav-pills category-tabs justify-content-center" id="toolCategories" role="tablist">
                <li class="nav-item" role="presentation">
                    <button class="nav-link active" id="all-tab" data-bs-toggle="pill" data-bs-target="#all-tools" type="button" role="tab">
                        <i class="bi bi-grid-3x3-gap me-2"></i>
                        All Tools
                    </button>
                </li>
                <li class="nav-item" role="presentation">
                    <button class="nav-link" id="image-tab" data-bs-toggle="pill" data-bs-target="#image-tools" type="button" role="tab">
                        <i class="bi bi-image me-2"></i>
                        Image Tools
                    </button>
                </li>
                <li class="nav-item" role="presentation">
                    <button class="nav-link" id="video-tab" data-bs-toggle="pill" data-bs-target="#video-tools" type="button" role="tab">
                        <i class="bi bi-play-circle me-2"></i>
                        Video Tools
                        <span class="badge bg-secondary ms-1">Soon</span>
                    </button>
                </li>
                <li class="nav-item" role="presentation">
                    <button class="nav-link" id="pdf-tab" data-bs-toggle="pill" data-bs-target="#pdf-tools" type="button" role="tab">
                        <i class="bi bi-file-pdf me-2"></i>
                        PDF Tools
                        <span class="badge bg-secondary ms-1">Soon</span>
                    </button>
                </li>
                <!-- Add this tab button in category tabs -->
                <li class="nav-item" role="presentation">
                    <button class="nav-link" id="seo-tab" data-bs-toggle="pill" data-bs-target="#seo-tools" type="button" role="tab">
                        <i class="bi bi-search me-2"></i>
                        SEO Tools
                    </button>
                </li>
            </ul>
        </div>

        <!-- Tab Content -->
        <div class="tab-content" id="toolCategoriesContent">
            
            <!-- All Tools Tab -->
            <div class="tab-pane fade show active" id="all-tools" role="tabpanel">
                <div class="row g-4">
                    
                    <!-- Image Compressor -->
                    <div class="col-md-6 col-lg-4">
                        <div class="tool-card">
                            <div class="tool-card-inner">
                                <div class="tool-category-badge">
                                    <span class="badge bg-primary-soft">Image</span>
                                </div>
                                <div class="tool-icon-wrapper">
                                    <div class="tool-icon-bg"></div>
                                    <i class="bi bi-file-earmark-zip tool-icon"></i>
                                </div>
                                <h3 class="tool-title">Image Compressor</h3>
                                <p class="tool-description">Reduce image file size up to 90% without losing quality</p>
                                <ul class="tool-features">
                                    <li><i class="bi bi-check-circle-fill"></i> All formats supported</li>
                                    <li><i class="bi bi-check-circle-fill"></i> Quality control slider</li>
                                </ul>
                                <a href="<?php echo home_url('/image-compressor'); ?>" class="tool-btn">
                                    Use Tool <i class="bi bi-arrow-right"></i>
                                </a>
                            </div>
                        </div>
                    </div>

                    <!-- Crop Image -->
                    <div class="col-md-6 col-lg-4">
                        <div class="tool-card">
                            <div class="tool-card-inner">
                                <div class="tool-category-badge">
                                    <span class="badge bg-primary-soft">Image</span>
                                </div>
                                <div class="tool-icon-wrapper">
                                    <div class="tool-icon-bg"></div>
                                    <i class="bi bi-crop tool-icon"></i>
                                </div>
                                <h3 class="tool-title">Crop Image</h3>
                                <p class="tool-description">Crop and trim images to perfect dimensions with custom ratios</p>
                                <ul class="tool-features">
                                    <li><i class="bi bi-check-circle-fill"></i> Multiple aspect ratios</li>
                                    <li><i class="bi bi-check-circle-fill"></i> Rotate & flip options</li>
                                </ul>
                                <a href="<?php echo home_url('/crop-image'); ?>" class="tool-btn">
                                    Use Tool <i class="bi bi-arrow-right"></i>
                                </a>
                            </div>
                        </div>
                    </div>

                    <!-- Image Resizer -->
                    <div class="col-md-6 col-lg-4">
                        <div class="tool-card">
                            <div class="tool-card-inner">
                                <div class="tool-category-badge">
                                    <span class="badge bg-primary-soft">Image</span>
                                </div>
                                <div class="tool-icon-wrapper">
                                    <div class="tool-icon-bg"></div>
                                    <i class="bi bi-aspect-ratio tool-icon"></i>
                                </div>
                                <h3 class="tool-title">Image Resizer</h3>
                                <p class="tool-description">Resize images to any dimension while maintaining quality</p>
                                <ul class="tool-features">
                                    <li><i class="bi bi-check-circle-fill"></i> Custom dimensions</li>
                                    <li><i class="bi bi-check-circle-fill"></i> Preset sizes available</li>
                                </ul>
                                <a href="<?php echo home_url('/image-resizer'); ?>" class="tool-btn">
                                    Use Tool <i class="bi bi-arrow-right"></i>
                                </a>
                            </div>
                        </div>
                    </div>

                    <!-- Crop PNG -->
                    <div class="col-md-6 col-lg-4">
                        <div class="tool-card">
                            <div class="tool-card-inner">
                                <div class="tool-category-badge">
                                    <span class="badge bg-primary-soft">Image</span>
                                </div>
                                <div class="tool-icon-wrapper">
                                    <div class="tool-icon-bg"></div>
                                    <i class="bi bi-scissors tool-icon"></i>
                                </div>
                                <h3 class="tool-title">Crop PNG</h3>
                                <p class="tool-description">Crop PNG images while preserving transparency perfectly</p>
                                <ul class="tool-features">
                                    <li><i class="bi bi-check-circle-fill"></i> Keep transparency</li>
                                    <li><i class="bi bi-check-circle-fill"></i> Precision cropping</li>
                                </ul>
                                <a href="<?php echo home_url('/crop-png'); ?>" class="tool-btn">
                                    Use Tool <i class="bi bi-arrow-right"></i>
                                </a>
                            </div>
                        </div>
                    </div>

                    <!-- Format Converter -->
                    <div class="col-md-6 col-lg-4">
                        <div class="tool-card">
                            <div class="tool-card-inner">
                                <div class="tool-category-badge">
                                    <span class="badge bg-primary-soft">Image</span>
                                </div>
                                <div class="tool-icon-wrapper">
                                    <div class="tool-icon-bg"></div>
                                    <i class="bi bi-arrow-left-right tool-icon"></i>
                                </div>
                                <h3 class="tool-title">Image Format Converter</h3>
                                <p class="tool-description">Convert images between JPEG, PNG, WebP and other formats</p>
                                <ul class="tool-features">
                                    <li><i class="bi bi-check-circle-fill"></i> Multiple formats</li>
                                    <li><i class="bi bi-check-circle-fill"></i> Batch conversion</li>
                                </ul>
                                <a href="<?php echo home_url('/image-converter'); ?>" class="tool-btn">
                                    Use Tool <i class="bi bi-arrow-right"></i>
                                </a>
                            </div>
                        </div>
                    </div>

                    <!-- Image Filters -->
                    <div class="col-md-6 col-lg-4">
                        <div class="tool-card">
                            <div class="tool-card-inner">
                                <div class="tool-category-badge">
                                    <span class="badge bg-primary-soft">Image</span>
                                </div>
                                <div class="tool-icon-wrapper">
                                    <div class="tool-icon-bg"></div>
                                    <i class="bi bi-palette tool-icon"></i>
                                </div>
                                <h3 class="tool-title">Image Filters</h3>
                                <p class="tool-description">Apply filters, effects and adjustments to your images</p>
                                <ul class="tool-features">
                                    <li><i class="bi bi-check-circle-fill"></i> 20+ filter effects</li>
                                    <li><i class="bi bi-check-circle-fill"></i> Real-time preview</li>
                                </ul>
                                <a href="<?php echo home_url('/image-filters'); ?>" class="tool-btn">
                                    Coming Soon <i class="bi bi-arrow-right"></i>
                                </a>
                            </div>
                        </div>
                    </div>

                </div>
            </div>

            <!-- Image Tools Tab -->
            <div class="tab-pane fade" id="image-tools" role="tabpanel">
                <div class="row g-4">
                    
                    <!-- Only Image Tools (Same as above but without category badge) -->
                    <div class="col-md-6 col-lg-4">
                        <div class="tool-card">
                            <div class="tool-card-inner">
                                <div class="tool-icon-wrapper">
                                    <div class="tool-icon-bg"></div>
                                    <i class="bi bi-file-earmark-zip tool-icon"></i>
                                </div>
                                <h3 class="tool-title">Image Compressor</h3>
                                <p class="tool-description">Reduce image file size up to 90% without losing quality</p>
                                <ul class="tool-features">
                                    <li><i class="bi bi-check-circle-fill"></i> All formats supported</li>
                                    <li><i class="bi bi-check-circle-fill"></i> Quality control slider</li>
                                </ul>
                                <a href="<?php echo home_url('/image-compressor'); ?>" class="tool-btn">
                                    Use Tool <i class="bi bi-arrow-right"></i>
                                </a>
                            </div>
                        </div>
                    </div>

                    <div class="col-md-6 col-lg-4">
                        <div class="tool-card">
                            <div class="tool-card-inner">
                                <div class="tool-icon-wrapper">
                                    <div class="tool-icon-bg"></div>
                                    <i class="bi bi-crop tool-icon"></i>
                                </div>
                                <h3 class="tool-title">Crop Image</h3>
                                <p class="tool-description">Crop and trim images to perfect dimensions with custom ratios</p>
                                <ul class="tool-features">
                                    <li><i class="bi bi-check-circle-fill"></i> Multiple aspect ratios</li>
                                    <li><i class="bi bi-check-circle-fill"></i> Rotate & flip options</li>
                                </ul>
                                <a href="<?php echo home_url('/crop-image'); ?>" class="tool-btn">
                                    Use Tool <i class="bi bi-arrow-right"></i>
                                </a>
                            </div>
                        </div>
                    </div>

                    <div class="col-md-6 col-lg-4">
                        <div class="tool-card">
                            <div class="tool-card-inner">
                                <div class="tool-icon-wrapper">
                                    <div class="tool-icon-bg"></div>
                                    <i class="bi bi-aspect-ratio tool-icon"></i>
                                </div>
                                <h3 class="tool-title">Image Resizer</h3>
                                <p class="tool-description">Resize images to any dimension while maintaining quality</p>
                                <ul class="tool-features">
                                    <li><i class="bi bi-check-circle-fill"></i> Custom dimensions</li>
                                    <li><i class="bi bi-check-circle-fill"></i> Preset sizes available</li>
                                </ul>
                                <a href="<?php echo home_url('/image-resizer'); ?>" class="tool-btn">
                                    Use Tool <i class="bi bi-arrow-right"></i>
                                </a>
                            </div>
                        </div>
                    </div>

                    <div class="col-md-6 col-lg-4">
                        <div class="tool-card">
                            <div class="tool-card-inner">
                                <div class="tool-icon-wrapper">
                                    <div class="tool-icon-bg"></div>
                                    <i class="bi bi-scissors tool-icon"></i>
                                </div>
                                <h3 class="tool-title">Crop PNG</h3>
                                <p class="tool-description">Crop PNG images while preserving transparency perfectly</p>
                                <ul class="tool-features">
                                    <li><i class="bi bi-check-circle-fill"></i> Keep transparency</li>
                                    <li><i class="bi bi-check-circle-fill"></i> Precision cropping</li>
                                </ul>
                                <a href="<?php echo home_url('/crop-png'); ?>" class="tool-btn">
                                    Use Tool <i class="bi bi-arrow-right"></i>
                                </a>
                            </div>
                        </div>
                    </div>

                    <div class="col-md-6 col-lg-4">
                        <div class="tool-card">
                            <div class="tool-card-inner">
                                <div class="tool-icon-wrapper">
                                    <div class="tool-icon-bg"></div>
                                    <i class="bi bi-arrow-left-right tool-icon"></i>
                                </div>
                                <h3 class="tool-title">Image Format Converter</h3>
                                <p class="tool-description">Convert images between JPEG, PNG, WebP and other formats</p>
                                <ul class="tool-features">
                                    <li><i class="bi bi-check-circle-fill"></i> Multiple formats</li>
                                    <li><i class="bi bi-check-circle-fill"></i> Batch conversion</li>
                                </ul>
                                <a href="<?php echo home_url('/image-converter'); ?>" class="tool-btn">
                                    Use Tool <i class="bi bi-arrow-right"></i>
                                </a>
                            </div>
                        </div>
                    </div>

                    <div class="col-md-6 col-lg-4">
                        <div class="tool-card">
                            <div class="tool-card-inner">
                                <div class="tool-icon-wrapper">
                                    <div class="tool-icon-bg"></div>
                                    <i class="bi bi-palette tool-icon"></i>
                                </div>
                                <h3 class="tool-title">Image Filters</h3>
                                <p class="tool-description">Apply filters, effects and adjustments to your images</p>
                                <ul class="tool-features">
                                    <li><i class="bi bi-check-circle-fill"></i> 20+ filter effects</li>
                                    <li><i class="bi bi-check-circle-fill"></i> Real-time preview</li>
                                </ul>
                                <a href="<?php echo home_url('/image-filters'); ?>" class="tool-btn">
                                    Coming Soon <i class="bi bi-arrow-right"></i>
                                </a>
                            </div>
                        </div>
                    </div>

                </div>
            </div>

            <!-- Video Tools Tab (Coming Soon) -->
            <div class="tab-pane fade" id="video-tools" role="tabpanel">
                <div class="coming-soon-message text-center py-5">
                    <i class="bi bi-play-circle display-1 text-primary mb-3"></i>
                    <h3>Video Tools Coming Soon!</h3>
                    <p class="text-muted">We're working on amazing video editing tools for you.</p>
                </div>
            </div>

            <!-- PDF Tools Tab -->
            <div class="tab-pane fade" id="pdf-tools" role="tabpanel">
                <div class="row g-4">
                    
                    <!-- Image to PDF -->
                    <div class="col-md-6 col-lg-4">
                        <div class="tool-card">
                            <div class="tool-card-inner">
                                <div class="tool-category-badge">
                                    <span class="badge bg-danger-soft">PDF</span>
                                </div>
                                <div class="tool-icon-wrapper">
                                    <div class="tool-icon-bg"></div>
                                    <i class="bi bi-file-earmark-pdf tool-icon"></i>
                                </div>
                                <h3 class="tool-title">Image to PDF</h3>
                                <p class="tool-description">Convert multiple images into a single PDF file</p>
                                <ul class="tool-features">
                                    <li><i class="bi bi-check-circle-fill"></i> Multiple images support</li>
                                    <li><i class="bi bi-check-circle-fill"></i> Drag to reorder</li>
                                </ul>
                                <a href="<?php echo home_url('/image-to-pdf'); ?>" class="tool-btn">
                                    Use Tool <i class="bi bi-arrow-right"></i>
                                </a>
                            </div>
                        </div>
                    </div>
            
                    <!-- PDF Compressor (NEW) -->
                    <div class="col-md-6 col-lg-4">
                        <div class="tool-card">
                            <div class="tool-card-inner">
                                <div class="tool-category-badge">
                                    <span class="badge bg-danger-soft">PDF</span>
                                </div>
                                <div class="tool-icon-wrapper">
                                    <div class="tool-icon-bg"></div>
                                    <i class="bi bi-file-earmark-zip tool-icon"></i>
                                </div>
                                <h3 class="tool-title">PDF Compressor</h3>
                                <p class="tool-description">Reduce PDF file size while maintaining quality</p>
                                <ul class="tool-features">
                                    <li><i class="bi bi-check-circle-fill"></i> Up to 90% compression</li>
                                    <li><i class="bi bi-check-circle-fill"></i> Adjustable quality</li>
                                </ul>
                                <a href="<?php echo home_url('/pdf-compressor'); ?>" class="tool-btn">
                                    Use Tool <i class="bi bi-arrow-right"></i>
                                </a>
                            </div>
                        </div>
                    </div>
            
                    <!-- More PDF tools coming soon -->
                    <div class="col-12 text-center mt-4">
                        <p class="text-muted">More PDF tools coming soon: Merge PDF, Split PDF</p>
                    </div>
            
                </div>
            </div>
            
            <!-- In SEO Tools Tab -->
            <div class="tab-pane fade" id="seo-tools" role="tabpanel">
                <div class="row g-4">
                    
                    <!-- Meta Tag Generator -->
                    <div class="col-md-6 col-lg-4">
                        <div class="tool-card">
                            <div class="tool-card-inner">
                                <div class="tool-category-badge">
                                    <span class="badge bg-warning-soft">SEO</span>
                                </div>
                                <div class="tool-icon-wrapper">
                                    <div class="tool-icon-bg"></div>
                                    <i class="bi bi-code-square tool-icon"></i>
                                </div>
                                <h3 class="tool-title">Meta Tag Generator</h3>
                                <p class="tool-description">Generate SEO meta tags, Open Graph, and Twitter Cards</p>
                                <ul class="tool-features">
                                    <li><i class="bi bi-check-circle-fill"></i> Complete meta tags</li>
                                    <li><i class="bi bi-check-circle-fill"></i> Social preview</li>
                                </ul>
                                <a href="<?php echo home_url('/meta-tag-generator'); ?>" class="tool-btn">
                                    Use Tool <i class="bi bi-arrow-right"></i>
                                </a>
                            </div>
                        </div>
                    </div>
                    
                    
                    <!-- Meta Length Checker (NEW) -->
                    <div class="col-md-6 col-lg-4">
                        <div class="tool-card">
                            <div class="tool-card-inner">
                                <div class="tool-category-badge">
                                    <span class="badge bg-warning-soft">SEO</span>
                                </div>
                                <div class="tool-icon-wrapper">
                                    <div class="tool-icon-bg"></div>
                                    <i class="bi bi-rulers tool-icon"></i>
                                </div>
                                <h3 class="tool-title">Meta Length Checker</h3>
                                <p class="tool-description">Check title and meta description length with live preview</p>
                                <ul class="tool-features">
                                    <li><i class="bi bi-check-circle-fill"></i> Live Google preview</li>
                                    <li><i class="bi bi-check-circle-fill"></i> Character counter</li>
                                </ul>
                                <a href="<?php echo home_url('/meta-length-checker'); ?>" class="tool-btn">
                                    Use Tool <i class="bi bi-arrow-right"></i>
                                </a>
                            </div>
                        </div>
                    </div>

            
                </div>
            </div>

        </div>
    </div>
</section>

<!-- Features Section -->
<section class="features-section">
    <div class="container">
        <div class="section-header text-center mb-5">
            <h2 class="section-title">Why Choose Our Tools?</h2>
            <p class="section-subtitle">Built for speed, security, and simplicity</p>
        </div>
        
        <div class="row g-4">
            <div class="col-md-4">
                <div class="feature-card">
                    <div class="feature-icon-wrapper">
                        <i class="bi bi-shield-check feature-icon"></i>
                    </div>
                    <h4 class="feature-title">100% Secure & Private</h4>
                    <p class="feature-text">All processing happens in your browser. Your files never leave your device. No servers, no storage, no worries.</p>
                </div>
            </div>
            <div class="col-md-4">
                <div class="feature-card">
                    <div class="feature-icon-wrapper">
                        <i class="bi bi-lightning-charge feature-icon"></i>
                    </div>
                    <h4 class="feature-title">Lightning Fast</h4>
                    <p class="feature-text">No uploads or downloads needed. Process your images instantly without waiting for server responses.</p>
                </div>
            </div>
            <div class="col-md-4">
                <div class="feature-card">
                    <div class="feature-icon-wrapper">
                        <i class="bi bi-gift feature-icon"></i>
                    </div>
                    <h4 class="feature-title">Completely Free</h4>
                    <p class="feature-text">No hidden fees, no premium plans. Use all tools unlimited times without any registration required.</p>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- CTA Section -->
<section class="cta-section">
    <div class="container">
        <div class="cta-card">
            <div class="row align-items-center">
                <div class="col-lg-8">
                    <h2 class="cta-title">Ready to optimize your images?</h2>
                    <p class="cta-text">Choose any tool above and start processing your images instantly</p>
                </div>
                <div class="col-lg-4 text-lg-end">
                    <a href="#toolCategories" class="btn btn-light btn-lg">Get Started Free</a>
                </div>
            </div>
        </div>
    </div>
</section>

<?php get_footer(); ?>