<?php
/**
 * Template Name: Meta Tag Generator
 * Description: Generate SEO meta tags for websites
 */

get_header();
?>

<div class="tool-page meta-tag-generator-page">
    <!-- Tool Header -->
    <section class="tool-header py-5 bg-light">
        <div class="container">
            <div class="row align-items-center">
                <div class="col-lg-8 mx-auto text-center">
                    <div class="tool-breadcrumb mb-3">
                        <a href="<?php echo home_url(); ?>" class="text-muted">Home</a>
                        <span class="mx-2 text-muted">/</span>
                        <span class="text-primary">Meta Tag Generator</span>
                    </div>
                    <h1 class="tool-page-title mb-3">
                        <i class="bi bi-code-square text-primary me-2"></i>
                        Meta Tag Generator
                    </h1>
                    <p class="tool-page-description">
                        Generate SEO-optimized meta tags for your website. Includes title, description, Open Graph, and Twitter Cards.
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
                    
                    <!-- Input Form -->
                    <div class="card shadow-sm mb-4">
                        <div class="card-body p-4">
                            <h5 class="card-title mb-4">
                                <i class="bi bi-pencil-square me-2"></i> Enter Your Website Details
                            </h5>

                            <form id="metaTagForm">
                                <!-- Basic Meta Tags -->
                                <div class="meta-section mb-4">
                                    <h6 class="section-title mb-3">
                                        <i class="bi bi-tag-fill text-primary me-2"></i>
                                        Basic Meta Tags
                                    </h6>

                                    <div class="mb-3">
                                        <label for="pageTitle" class="form-label">
                                            Page Title <span class="text-danger">*</span>
                                            <span class="char-count" id="titleCount">0/60</span>
                                        </label>
                                        <input type="text" class="form-control" id="pageTitle" placeholder="Enter your page title" maxlength="60" required>
                                        <small class="form-text text-muted">Recommended: 50-60 characters</small>
                                    </div>

                                    <div class="mb-3">
                                        <label for="metaDescription" class="form-label">
                                            Meta Description <span class="text-danger">*</span>
                                            <span class="char-count" id="descCount">0/160</span>
                                        </label>
                                        <textarea class="form-control" id="metaDescription" rows="3" placeholder="Enter your meta description" maxlength="160" required></textarea>
                                        <small class="form-text text-muted">Recommended: 150-160 characters</small>
                                    </div>

                                    <div class="mb-3">
                                        <label for="keywords" class="form-label">Keywords (Optional)</label>
                                        <input type="text" class="form-control" id="keywords" placeholder="keyword1, keyword2, keyword3">
                                        <small class="form-text text-muted">Separate keywords with commas</small>
                                    </div>

                                    <div class="mb-3">
                                        <label for="author" class="form-label">Author (Optional)</label>
                                        <input type="text" class="form-control" id="author" placeholder="Enter author name">
                                    </div>
                                </div>

                                <!-- Open Graph Tags -->
                                <div class="meta-section mb-4">
                                    <h6 class="section-title mb-3">
                                        <i class="bi bi-facebook text-primary me-2"></i>
                                        Open Graph Tags (Facebook, LinkedIn)
                                    </h6>

                                    <div class="mb-3">
                                        <label for="ogTitle" class="form-label">OG Title</label>
                                        <input type="text" class="form-control" id="ogTitle" placeholder="Same as page title or custom">
                                        <small class="form-text text-muted">Leave empty to use page title</small>
                                    </div>

                                    <div class="mb-3">
                                        <label for="ogDescription" class="form-label">OG Description</label>
                                        <textarea class="form-control" id="ogDescription" rows="2" placeholder="Same as meta description or custom"></textarea>
                                        <small class="form-text text-muted">Leave empty to use meta description</small>
                                    </div>

                                    <div class="mb-3">
                                        <label for="ogImage" class="form-label">OG Image URL <span class="text-danger">*</span></label>
                                        <input type="url" class="form-control" id="ogImage" placeholder="https://example.com/image.jpg" required>
                                        <small class="form-text text-muted">Recommended size: 1200x630 pixels</small>
                                    </div>

                                    <div class="mb-3">
                                        <label for="ogUrl" class="form-label">Page URL <span class="text-danger">*</span></label>
                                        <input type="url" class="form-control" id="ogUrl" placeholder="https://example.com/page" required>
                                    </div>

                                    <div class="mb-3">
                                        <label for="ogType" class="form-label">OG Type</label>
                                        <select class="form-select" id="ogType">
                                            <option value="website">Website</option>
                                            <option value="article">Article</option>
                                            <option value="product">Product</option>
                                            <option value="video">Video</option>
                                        </select>
                                    </div>

                                    <div class="mb-3">
                                        <label for="siteName" class="form-label">Site Name</label>
                                        <input type="text" class="form-control" id="siteName" placeholder="Your Website Name">
                                    </div>
                                </div>

                                <!-- Twitter Card Tags -->
                                <div class="meta-section mb-4">
                                    <h6 class="section-title mb-3">
                                        <i class="bi bi-twitter text-primary me-2"></i>
                                        Twitter Card Tags
                                    </h6>

                                    <div class="mb-3">
                                        <label for="twitterCard" class="form-label">Card Type</label>
                                        <select class="form-select" id="twitterCard">
                                            <option value="summary_large_image">Summary with Large Image</option>
                                            <option value="summary">Summary</option>
                                            <option value="app">App</option>
                                            <option value="player">Player</option>
                                        </select>
                                    </div>

                                    <div class="mb-3">
                                        <label for="twitterSite" class="form-label">Twitter Username (Optional)</label>
                                        <input type="text" class="form-control" id="twitterSite" placeholder="@yourusername">
                                    </div>

                                    <div class="mb-3">
                                        <label for="twitterCreator" class="form-label">Content Creator (Optional)</label>
                                        <input type="text" class="form-control" id="twitterCreator" placeholder="@creator">
                                    </div>
                                </div>

                                <!-- Additional Settings -->
                                <div class="meta-section mb-4">
                                    <h6 class="section-title mb-3">
                                        <i class="bi bi-gear-fill text-primary me-2"></i>
                                        Additional Settings
                                    </h6>

                                    <div class="row">
                                        <div class="col-md-6 mb-3">
                                            <label for="viewport" class="form-label">Viewport</label>
                                            <select class="form-select" id="viewport">
                                                <option value="width=device-width, initial-scale=1.0">Responsive (Recommended)</option>
                                                <option value="width=1024">Fixed Width</option>
                                            </select>
                                        </div>

                                        <div class="col-md-6 mb-3">
                                            <label for="robots" class="form-label">Robots</label>
                                            <select class="form-select" id="robots">
                                                <option value="index, follow">Index, Follow (Default)</option>
                                                <option value="noindex, follow">No Index, Follow</option>
                                                <option value="index, nofollow">Index, No Follow</option>
                                                <option value="noindex, nofollow">No Index, No Follow</option>
                                            </select>
                                        </div>
                                    </div>

                                    <div class="mb-3">
                                        <label for="canonical" class="form-label">Canonical URL (Optional)</label>
                                        <input type="url" class="form-control" id="canonical" placeholder="https://example.com/canonical-page">
                                        <small class="form-text text-muted">Use if this page is duplicate content</small>
                                    </div>

                                    <div class="form-check mb-2">
                                        <input class="form-check-input" type="checkbox" id="includeCharset" checked>
                                        <label class="form-check-label" for="includeCharset">
                                            Include Charset (UTF-8)
                                        </label>
                                    </div>

                                    <div class="form-check mb-2">
                                        <input class="form-check-input" type="checkbox" id="includeLanguage" checked>
                                        <label class="form-check-label" for="includeLanguage">
                                            Include Language (en)
                                        </label>
                                    </div>
                                </div>

                                <!-- Generate Button -->
                                <div class="d-grid">
                                    <button type="submit" class="btn btn-primary btn-lg">
                                        <i class="bi bi-code-slash me-2"></i> Generate Meta Tags
                                    </button>
                                </div>
                            </form>
                        </div>
                    </div>

                    <!-- Generated Code -->
                    <div id="generatedCodeSection" class="d-none">
                        <div class="card shadow-sm mb-4">
                            <div class="card-body p-4">
                                <div class="d-flex justify-content-between align-items-center mb-3">
                                    <h5 class="card-title mb-0">
                                        <i class="bi bi-check-circle-fill text-success me-2"></i> Generated Meta Tags
                                    </h5>
                                    <button class="btn btn-outline-primary btn-sm" id="copyAllBtn">
                                        <i class="bi bi-clipboard me-1"></i> Copy All
                                    </button>
                                </div>

                                <div class="code-output">
                                    <pre><code id="generatedCode" class="language-html"></code></pre>
                                </div>

                                <div class="alert alert-info mt-3">
                                    <i class="bi bi-info-circle me-2"></i>
                                    <strong>How to use:</strong> Copy the generated code and paste it inside the <code>&lt;head&gt;</code> section of your HTML document.
                                </div>
                            </div>
                        </div>

                        <!-- Preview Section -->
                        <div class="card shadow-sm">
                            <div class="card-body p-4">
                                <h5 class="card-title mb-4">
                                    <i class="bi bi-eye me-2"></i> Social Media Preview
                                </h5>

                                <div class="row g-4">
                                    <!-- Facebook Preview -->
                                    <div class="col-md-6">
                                        <h6 class="preview-title">
                                            <i class="bi bi-facebook text-primary me-2"></i> Facebook Preview
                                        </h6>
                                        <div class="social-preview facebook-preview">
                                            <div class="preview-image" id="fbPreviewImage">
                                                <img src="" alt="Preview" width="100%" style="display:none;">
                                                <div class="placeholder-image">
                                                    <i class="bi bi-image"></i>
                                                </div>
                                            </div>
                                            <div class="preview-content">
                                                <div class="preview-url" id="fbPreviewUrl">example.com</div>
                                                <div class="preview-title-text" id="fbPreviewTitle">Your Title Here</div>
                                                <div class="preview-description" id="fbPreviewDesc">Your description will appear here</div>
                                            </div>
                                        </div>
                                    </div>

                                    <!-- Twitter Preview -->
                                    <div class="col-md-6">
                                        <h6 class="preview-title">
                                            <i class="bi bi-twitter text-info me-2"></i> Twitter Preview
                                        </h6>
                                        <div class="social-preview twitter-preview">
                                            <div class="preview-image" id="twPreviewImage">
                                                <img src="" alt="Preview"  width="100%" style="display:none;">
                                                <div class="placeholder-image">
                                                    <i class="bi bi-image"></i>
                                                </div>
                                            </div>
                                            <div class="preview-content">
                                                <div class="preview-title-text" id="twPreviewTitle">Your Title Here</div>
                                                <div class="preview-description" id="twPreviewDesc">Your description will appear here</div>
                                                <div class="preview-url" id="twPreviewUrl">example.com</div>
                                            </div>
                                        </div>
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
                    <h2 class="text-center mb-5">Meta Tag Best Practices</h2>
                    <div class="row g-4">
                        <div class="col-md-4">
                            <div class="practice-card">
                                <div class="practice-icon">
                                    <i class="bi bi-speedometer2 text-primary"></i>
                                </div>
                                <h5>Title Length</h5>
                                <p class="text-muted">Keep titles between 50-60 characters to avoid truncation in search results.</p>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="practice-card">
                                <div class="practice-icon">
                                    <i class="bi bi-text-paragraph text-primary"></i>
                                </div>
                                <h5>Description Length</h5>
                                <p class="text-muted">Meta descriptions should be 150-160 characters for optimal display.</p>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="practice-card">
                                <div class="practice-icon">
                                    <i class="bi bi-image text-primary"></i>
                                </div>
                                <h5>Image Size</h5>
                                <p class="text-muted">Use 1200x630px images for best social media sharing results.</p>
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
                                    What are meta tags?
                                </button>
                            </h3>
                            <div id="faq1" class="accordion-collapse collapse show" data-bs-parent="#faqAccordion">
                                <div class="accordion-body">
                                    Meta tags are HTML elements that provide information about your webpage to search engines and social media platforms. They help improve SEO and control how your content appears when shared.
                                </div>
                            </div>
                        </div>
                        <div class="accordion-item">
                            <h3 class="accordion-header">
                                <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#faq2">
                                    Why are Open Graph tags important?
                                </button>
                            </h3>
                            <div id="faq2" class="accordion-collapse collapse" data-bs-parent="#faqAccordion">
                                <div class="accordion-body">
                                    Open Graph tags control how your content appears when shared on Facebook, LinkedIn, and other social platforms. They ensure your links display with proper titles, descriptions, and images.
                                </div>
                            </div>
                        </div>
                        <div class="accordion-item">
                            <h3 class="accordion-header">
                                <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#faq3">
                                    Where do I add these meta tags?
                                </button>
                            </h3>
                            <div id="faq3" class="accordion-collapse collapse" data-bs-parent="#faqAccordion">
                                <div class="accordion-body">
                                    Place all meta tags inside the <code>&lt;head&gt;</code> section of your HTML document, before the closing <code>&lt;/head&gt;</code> tag.
                                </div>
                            </div>
                        </div>
                        <div class="accordion-item">
                            <h3 class="accordion-header">
                                <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#faq4">
                                    Do meta tags guarantee better rankings?
                                </button>
                            </h3>
                            <div id="faq4" class="accordion-collapse collapse" data-bs-parent="#faqAccordion">
                                <div class="accordion-body">
                                    Meta tags alone don't guarantee rankings, but they're an essential part of SEO. They help search engines understand your content and improve click-through rates from search results.
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