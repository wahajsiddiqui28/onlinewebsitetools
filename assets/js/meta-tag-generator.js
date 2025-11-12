// Meta Tag Generator Tool
(function() {
    'use strict';

    // DOM Elements
    const form = document.getElementById('metaTagForm');
    const generatedCodeSection = document.getElementById('generatedCodeSection');
    const generatedCode = document.getElementById('generatedCode');
    const copyAllBtn = document.getElementById('copyAllBtn');

    // Input elements
    const pageTitle = document.getElementById('pageTitle');
    const metaDescription = document.getElementById('metaDescription');
    const keywords = document.getElementById('keywords');
    const author = document.getElementById('author');
    const ogTitle = document.getElementById('ogTitle');
    const ogDescription = document.getElementById('ogDescription');
    const ogImage = document.getElementById('ogImage');
    const ogUrl = document.getElementById('ogUrl');
    const ogType = document.getElementById('ogType');
    const siteName = document.getElementById('siteName');
    const twitterCard = document.getElementById('twitterCard');
    const twitterSite = document.getElementById('twitterSite');
    const twitterCreator = document.getElementById('twitterCreator');
    const viewport = document.getElementById('viewport');
    const robots = document.getElementById('robots');
    const canonical = document.getElementById('canonical');
    const includeCharset = document.getElementById('includeCharset');
    const includeLanguage = document.getElementById('includeLanguage');

    // Character counters
    const titleCount = document.getElementById('titleCount');
    const descCount = document.getElementById('descCount');

    // Initialize
    function init() {
        setupEventListeners();
        setupCharacterCounters();
    }

    // Event Listeners
    function setupEventListeners() {
        form.addEventListener('submit', handleFormSubmit);
        copyAllBtn.addEventListener('click', copyToClipboard);

        // Auto-fill OG fields
        pageTitle.addEventListener('input', () => {
            if (!ogTitle.value) updatePreview();
        });

        metaDescription.addEventListener('input', () => {
            if (!ogDescription.value) updatePreview();
        });

        ogImage.addEventListener('input', updatePreview);
        ogUrl.addEventListener('input', updatePreview);
    }

    // Character Counters
    function setupCharacterCounters() {
        pageTitle.addEventListener('input', () => {
            const count = pageTitle.value.length;
            titleCount.textContent = `${count}/60`;
            titleCount.style.color = count > 60 ? '#dc3545' : count > 50 ? '#ffc107' : '#6c757d';
        });

        metaDescription.addEventListener('input', () => {
            const count = metaDescription.value.length;
            descCount.textContent = `${count}/160`;
            descCount.style.color = count > 160 ? '#dc3545' : count > 150 ? '#ffc107' : '#6c757d';
        });
    }

    // Handle Form Submit
    function handleFormSubmit(e) {
        e.preventDefault();

        if (!form.checkValidity()) {
            form.classList.add('was-validated');
            return;
        }

        generateMetaTags();
        updatePreview();
        
        // Scroll to result
        generatedCodeSection.classList.remove('d-none');
        generatedCodeSection.scrollIntoView({ behavior: 'smooth', block: 'start' });
    }

    // Generate Meta Tags
    function generateMetaTags() {
        let html = '';

        // Charset
        if (includeCharset.checked) {
            html += '<meta charset="UTF-8">\n';
        }

        // Viewport
        html += `<meta name="viewport" content="${viewport.value}">\n\n`;

        // Basic Meta Tags
        html += `<!-- Basic Meta Tags -->\n`;
        html += `<title>${escapeHtml(pageTitle.value)}</title>\n`;
        html += `<meta name="description" content="${escapeHtml(metaDescription.value)}">\n`;

        if (keywords.value.trim()) {
            html += `<meta name="keywords" content="${escapeHtml(keywords.value)}">\n`;
        }

        if (author.value.trim()) {
            html += `<meta name="author" content="${escapeHtml(author.value)}">\n`;
        }

        html += `<meta name="robots" content="${robots.value}">\n`;

        if (includeLanguage.checked) {
            html += `<meta http-equiv="content-language" content="en">\n`;
        }

        if (canonical.value.trim()) {
            html += `<link rel="canonical" href="${escapeHtml(canonical.value)}">\n`;
        }

        // Open Graph Tags
        html += `\n<!-- Open Graph / Facebook -->\n`;
        html += `<meta property="og:type" content="${ogType.value}">\n`;
        html += `<meta property="og:url" content="${escapeHtml(ogUrl.value)}">\n`;
        html += `<meta property="og:title" content="${escapeHtml(ogTitle.value || pageTitle.value)}">\n`;
        html += `<meta property="og:description" content="${escapeHtml(ogDescription.value || metaDescription.value)}">\n`;
        html += `<meta property="og:image" content="${escapeHtml(ogImage.value)}">\n`;

        if (siteName.value.trim()) {
            html += `<meta property="og:site_name" content="${escapeHtml(siteName.value)}">\n`;
        }

        // Twitter Card Tags
        html += `\n<!-- Twitter -->\n`;
        html += `<meta property="twitter:card" content="${twitterCard.value}">\n`;
        html += `<meta property="twitter:url" content="${escapeHtml(ogUrl.value)}">\n`;
        html += `<meta property="twitter:title" content="${escapeHtml(ogTitle.value || pageTitle.value)}">\n`;
        html += `<meta property="twitter:description" content="${escapeHtml(ogDescription.value || metaDescription.value)}">\n`;
        html += `<meta property="twitter:image" content="${escapeHtml(ogImage.value)}">\n`;

        if (twitterSite.value.trim()) {
            html += `<meta property="twitter:site" content="${escapeHtml(twitterSite.value)}">\n`;
        }

        if (twitterCreator.value.trim()) {
            html += `<meta property="twitter:creator" content="${escapeHtml(twitterCreator.value)}">\n`;
        }

        generatedCode.textContent = html;
    }

    // Update Preview
    function updatePreview() {
        const title = ogTitle.value || pageTitle.value;
        const description = ogDescription.value || metaDescription.value;
        const imageUrl = ogImage.value;
        const url = ogUrl.value;

        // Extract domain from URL
        let domain = 'example.com';
        try {
            const urlObj = new URL(url);
            domain = urlObj.hostname;
        } catch (e) {
            // Invalid URL, use default
        }

        // Facebook Preview
        document.getElementById('fbPreviewTitle').textContent = title || 'Your Title Here';
        document.getElementById('fbPreviewDesc').textContent = description || 'Your description will appear here';
        document.getElementById('fbPreviewUrl').textContent = domain;

        const fbImg = document.querySelector('#fbPreviewImage img');
        const fbPlaceholder = document.querySelector('#fbPreviewImage .placeholder-image');
        
        if (imageUrl) {
            fbImg.src = imageUrl;
            fbImg.style.display = 'block';
            fbPlaceholder.style.display = 'none';
        } else {
            fbImg.style.display = 'none';
            fbPlaceholder.style.display = 'flex';
        }

        // Twitter Preview
        document.getElementById('twPreviewTitle').textContent = title || 'Your Title Here';
        document.getElementById('twPreviewDesc').textContent = description || 'Your description will appear here';
        document.getElementById('twPreviewUrl').textContent = domain;

        const twImg = document.querySelector('#twPreviewImage img');
        const twPlaceholder = document.querySelector('#twPreviewImage .placeholder-image');
        
        if (imageUrl) {
            twImg.src = imageUrl;
            twImg.style.display = 'block';
            twPlaceholder.style.display = 'none';
        } else {
            twImg.style.display = 'none';
            twPlaceholder.style.display = 'flex';
        }
    }

    // Copy to Clipboard
    function copyToClipboard() {
        const code = generatedCode.textContent;
        
        navigator.clipboard.writeText(code).then(() => {
            // Change button text temporarily
            const originalHTML = copyAllBtn.innerHTML;
            copyAllBtn.innerHTML = '<i class="bi bi-check-lg me-1"></i> Copied!';
            copyAllBtn.classList.remove('btn-outline-primary');
            copyAllBtn.classList.add('btn-success');

            setTimeout(() => {
                copyAllBtn.innerHTML = originalHTML;
                copyAllBtn.classList.remove('btn-success');
                copyAllBtn.classList.add('btn-outline-primary');
            }, 2000);
        }).catch(err => {
            alert('Failed to copy. Please select and copy manually.');
        });
    }

    // Escape HTML
    function escapeHtml(text) {
        const div = document.createElement('div');
        div.textContent = text;
        return div.innerHTML;
    }

    // Initialize on load
    if (document.readyState === 'loading') {
        document.addEventListener('DOMContentLoaded', init);
    } else {
        init();
    }

})();