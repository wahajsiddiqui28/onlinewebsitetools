<?php
/**
 * Template Name: Meta Length Checker
 * Description: Check title and meta description length with live preview
 */

get_header();
?>

<div class="tool-page meta-length-checker-page">
    <!-- Tool Header -->
    <section class="tool-header py-5 bg-light">
        <div class="container">
            <div class="row align-items-center">
                <div class="col-lg-8 mx-auto text-center">
                    <div class="tool-breadcrumb mb-3">
                        <a href="<?php echo home_url(); ?>" class="text-muted">Home</a>
                        <span class="mx-2 text-muted">/</span>
                        <span class="text-primary">Meta Length Checker</span>
                    </div>
                    <h1 class="tool-page-title mb-3">
                        <i class="bi bi-rulers text-primary me-2"></i>
                        Title Tag and Meta Description Length Tool
                    </h1>
                    <p class="tool-page-description">
                        This tool updates as you type. Add some content and preview your result.
                    </p>
                    <p class="text-muted small">Last Updated March 2023</p>
                </div>
            </div>
        </div>
    </section>

    <!-- Tool Interface -->
    <section class="tool-interface py-5">
        <div class="container">
            <div class="row">
                <div class="col-lg-10 mx-auto">
                    <div class="row g-4">
                        
                        <!-- Left Side - Input Form -->
                        <div class="col-lg-6">
                            <div class="card shadow-sm sticky-top" style="top: 20px;">
                                <div class="card-body p-4">
                                    <h5 class="card-title mb-4">
                                        <i class="bi bi-pencil-square me-2"></i> 
                                        Enter Your Content
                                    </h5>

                                    <!-- Company Name -->
                                    <div class="mb-4">
                                        <label for="companyName" class="form-label fw-semibold">
                                            Company Name
                                        </label>
                                        <input 
                                            type="text" 
                                            class="form-control form-control-lg" 
                                            id="companyName" 
                                            placeholder="Online Website Tools"
                                            value="Online Website Tools"
                                        >
                                    </div>

                                    <!-- Title -->
                                    <div class="mb-4">
                                        <label for="pageTitle" class="form-label fw-semibold d-flex justify-content-between align-items-center">
                                            <span>Title</span>
                                            <span class="char-counter">
                                                <span id="titleCharCount" class="fw-bold">0</span>
                                                <span class="text-muted">/ 60</span>
                                            </span>
                                        </label>
                                        <input 
                                            type="text" 
                                            class="form-control form-control-lg" 
                                            id="pageTitle" 
                                            placeholder="Online Website Tools Meta Length Checker - Digital Marketing Tool"
                                            maxlength="100"
                                        >
                                        <div class="progress mt-2" style="height: 4px;">
                                            <div id="titleProgress" class="progress-bar" role="progressbar" style="width: 0%"></div>
                                        </div>
                                        <small class="text-muted">Recommended: 50-60 characters</small>
                                    </div>

                                    <!-- Link -->
                                    <div class="mb-4">
                                        <label for="pageUrl" class="form-label fw-semibold">
                                            Link
                                        </label>
                                        <input 
                                            type="url" 
                                            class="form-control form-control-lg" 
                                            id="pageUrl" 
                                            placeholder="https://mrs.digital/tools/meta-length-checker"
                                            value="https://mrs.digital/tools/meta-length-checker"
                                        >
                                    </div>

                                    <!-- Description -->
                                    <div class="mb-4">
                                        <label for="metaDescription" class="form-label fw-semibold d-flex justify-content-between align-items-center">
                                            <span>Description (160 chars)</span>
                                            <span class="char-counter">
                                                <span id="descCharCount" class="fw-bold">0</span>
                                                <span class="text-muted">/ 160</span>
                                            </span>
                                        </label>
                                        <textarea 
                                            class="form-control" 
                                            id="metaDescription" 
                                            rows="4"
                                            placeholder="Meta length checker, snippet tool... we have it all! An awesome description will help boost your CTR and make you stand out in the search results! Try it today!"
                                            maxlength="320"
                                        ></textarea>
                                        <div class="progress mt-2" style="height: 4px;">
                                            <div id="descProgress" class="progress-bar" role="progressbar" style="width: 0%"></div>
                                        </div>
                                        <small class="text-muted">Recommended: 150-160 characters</small>
                                    </div>

                                    <!-- Download Button -->
                                    <div class="d-grid gap-2">
                                        <button class="btn btn-primary btn-lg" id="downloadReport">
                                            <i class="bi bi-download me-2"></i> Download Report
                                        </button>
                                        <button class="btn btn-outline-secondary" id="resetForm">
                                            <i class="bi bi-arrow-clockwise me-2"></i> Reset
                                        </button>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Right Side - Live Preview -->
                        <div class="col-lg-6">
                            <div class="card shadow-sm mb-4">
                                <div class="card-body p-4">
                                    <h5 class="card-title mb-4">
                                        <i class="bi bi-eye me-2"></i> 
                                        Live Google Search Preview
                                    </h5>

                                    <!-- Google Search Preview -->
                                    <div class="google-preview-container">
                                        <!-- Search Bar Mock -->
                                        <div class="google-search-bar mb-4">
                                            <i class="bi bi-search text-muted"></i>
                                            <span class="text-muted ms-2" id="previewSearchQuery">your search query</span>
                                        </div>

                                        <!-- Search Result Preview -->
                                        <div class="google-result-item">
                                            <!-- Favicon & Company -->
                                            <div class="result-header mb-1">
                                                <div class="result-favicon">
                                                    <i class="bi bi-globe"></i>
                                                </div>
                                                <div class="result-breadcrumb">
                                                    <span id="previewCompany">Online Website Tools</span>
                                                    <span class="mx-1">›</span>
                                                    <span class="text-muted">Tools</span>
                                                </div>
                                            </div>

                                            <!-- Title -->
                                            <div class="result-title mb-1">
                                                <a href="#" id="previewTitle" class="preview-link">
                                                    Online Website Tools Meta Length Checker - Digital Marketing Tool
                                                </a>
                                            </div>

                                            <!-- URL -->
                                            <div class="result-url mb-2">
                                                <span id="previewUrl">https://mrs.digital/tools/meta-length-checker</span>
                                            </div>

                                            <!-- Description -->
                                            <div class="result-description">
                                                <span id="previewDescription">
                                                    Meta length checker, snippet tool... we have it all! An awesome description will help boost your CTR and make you stand out in the search results! Try it today!
                                                </span>
                                            </div>
                                        </div>

                                        <!-- Additional Results (Blurred) -->
                                        <div class="google-result-item blurred mt-3">
                                            <div class="result-header mb-1">
                                                <div class="result-favicon">
                                                    <i class="bi bi-globe"></i>
                                                </div>
                                                <div class="result-breadcrumb">
                                                    <span>Example Site</span>
                                                </div>
                                            </div>
                                            <div class="result-title mb-1">
                                                <a href="#" class="preview-link">Another Search Result Title</a>
                                            </div>
                                            <div class="result-url mb-2">
                                                https://example.com/page
                                            </div>
                                            <div class="result-description">
                                                This is another search result that appears below yours...
                                            </div>
                                        </div>

                                        <div class="google-result-item blurred mt-3">
                                            <div class="result-header mb-1">
                                                <div class="result-favicon">
                                                    <i class="bi bi-globe"></i>
                                                </div>
                                                <div class="result-breadcrumb">
                                                    <span>Another Site</span>
                                                </div>
                                            </div>
                                            <div class="result-title mb-1">
                                                <a href="#" class="preview-link">Third Search Result Example</a>
                                            </div>
                                            <div class="result-url mb-2">
                                                https://another-site.com/example
                                            </div>
                                            <div class="result-description">
                                                More search results appear here in the actual Google search...
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <!-- Character Count Info -->
                            <div class="card shadow-sm">
                                <div class="card-body p-4">
                                    <h6 class="card-title mb-3">
                                        <i class="bi bi-info-circle text-primary me-2"></i>
                                        Optimization Status
                                    </h6>
                                    
                                    <div class="status-item mb-3">
                                        <div class="d-flex justify-content-between align-items-center mb-1">
                                            <span class="fw-semibold">Title Length</span>
                                            <span id="titleStatus" class="badge bg-secondary">Not Set</span>
                                        </div>
                                        <p class="small text-muted mb-0">
                                            <i class="bi bi-lightbulb me-1"></i>
                                            <span id="titleAdvice">Enter a title to see recommendations</span>
                                        </p>
                                    </div>

                                    <div class="status-item">
                                        <div class="d-flex justify-content-between align-items-center mb-1">
                                            <span class="fw-semibold">Description Length</span>
                                            <span id="descStatus" class="badge bg-secondary">Not Set</span>
                                        </div>
                                        <p class="small text-muted mb-0">
                                            <i class="bi bi-lightbulb me-1"></i>
                                            <span id="descAdvice">Enter a description to see recommendations</span>
                                        </p>
                                    </div>
                                </div>
                            </div>
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Best Practices Section -->
    <section class="best-practices py-5 bg-light">
        <div class="container">
            <div class="row">
                <div class="col-lg-10 mx-auto">
                    <h2 class="text-center mb-5">SEO Best Practices</h2>
                    <div class="row g-4">
                        <div class="col-md-6">
                            <div class="practice-card">
                                <div class="practice-icon">
                                    <i class="bi bi-card-heading text-primary"></i>
                                </div>
                                <h5>Title Tag Tips</h5>
                                <ul class="practice-list">
                                    <li>Keep between 50-60 characters</li>
                                    <li>Include your primary keyword</li>
                                    <li>Make it compelling and clickable</li>
                                    <li>Add brand name at the end</li>
                                    <li>Avoid keyword stuffing</li>
                                </ul>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="practice-card">
                                <div class="practice-icon">
                                    <i class="bi bi-text-paragraph text-primary"></i>
                                </div>
                                <h5>Meta Description Tips</h5>
                                <ul class="practice-list">
                                    <li>Keep between 150-160 characters</li>
                                    <li>Write a clear call-to-action</li>
                                    <li>Include target keywords naturally</li>
                                    <li>Make it engaging and unique</li>
                                    <li>Accurately describe page content</li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Features Section -->
    <section class="tool-features py-5">
        <div class="container">
            <div class="row">
                <div class="col-lg-10 mx-auto">
                    <h2 class="text-center mb-5">Why Use This Tool?</h2>
                    <div class="row g-4">
                        <div class="col-md-3">
                            <div class="feature-step text-center">
                                <div class="step-icon mb-3">
                                    <i class="bi bi-eye fs-1 text-primary"></i>
                                </div>
                                <h5>Live Preview</h5>
                                <p class="text-muted small">See exactly how your snippet will appear</p>
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="feature-step text-center">
                                <div class="step-icon mb-3">
                                    <i class="bi bi-speedometer fs-1 text-primary"></i>
                                </div>
                                <h5>Real-Time Update</h5>
                                <p class="text-muted small">Preview updates as you type</p>
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="feature-step text-center">
                                <div class="step-icon mb-3">
                                    <i class="bi bi-check2-circle fs-1 text-primary"></i>
                                </div>
                                <h5>Character Counter</h5>
                                <p class="text-muted small">Know exactly your character count</p>
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="feature-step text-center">
                                <div class="step-icon mb-3">
                                    <i class="bi bi-lightbulb fs-1 text-primary"></i>
                                </div>
                                <h5>Smart Suggestions</h5>
                                <p class="text-muted small">Get optimization recommendations</p>
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
                                    What is the ideal title tag length?
                                </button>
                            </h3>
                            <div id="faq1" class="accordion-collapse collapse show" data-bs-parent="#faqAccordion">
                                <div class="accordion-body">
                                    The ideal title tag length is between 50-60 characters. Google typically displays up to 60 characters in search results, though this can vary based on pixel width.
                                </div>
                            </div>
                        </div>
                        <div class="accordion-item">
                            <h3 class="accordion-header">
                                <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#faq2">
                                    How long should meta descriptions be?
                                </button>
                            </h3>
                            <div id="faq2" class="accordion-collapse collapse" data-bs-parent="#faqAccordion">
                                <div class="accordion-body">
                                    Meta descriptions should be between 150-160 characters. Google may show up to 160 characters on desktop and slightly less on mobile devices.
                                </div>
                            </div>
                        </div>
                        <div class="accordion-item">
                            <h3 class="accordion-header">
                                <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#faq3">
                                    Does Google always use my meta description?
                                </button>
                            </h3>
                            <div id="faq3" class="accordion-collapse collapse" data-bs-parent="#faqAccordion">
                                <div class="accordion-body">
                                    No, Google may choose to display different text from your page if it better matches the user's search query. However, writing good meta descriptions increases the chances they'll be used.
                                </div>
                            </div>
                        </div>
                        <div class="accordion-item">
                            <h3 class="accordion-header">
                                <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#faq4">
                                    Do meta tags affect SEO rankings?
                                </button>
                            </h3>
                            <div id="faq4" class="accordion-collapse collapse" data-bs-parent="#faqAccordion">
                                <div class="accordion-body">
                                    Title tags are an important ranking factor. Meta descriptions don't directly impact rankings but can significantly improve click-through rates, which indirectly helps SEO.
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