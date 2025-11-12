/**
 * Meta Length Checker Tool
 * Real-time character counter and Google preview
 */

document.addEventListener('DOMContentLoaded', function() {
    // Elements
    const companyName = document.getElementById('companyName');
    const pageTitle = document.getElementById('pageTitle');
    const pageUrl = document.getElementById('pageUrl');
    const metaDescription = document.getElementById('metaDescription');
    
    // Preview elements
    const previewCompany = document.getElementById('previewCompany');
    const previewTitle = document.getElementById('previewTitle');
    const previewUrl = document.getElementById('previewUrl');
    const previewDescription = document.getElementById('previewDescription');
    
    // Counter elements
    const titleCharCount = document.getElementById('titleCharCount');
    const descCharCount = document.getElementById('descCharCount');
    const titleProgress = document.getElementById('titleProgress');
    const descProgress = document.getElementById('descProgress');
    
    // Status elements
    const titleStatus = document.getElementById('titleStatus');
    const descStatus = document.getElementById('descStatus');
    const titleAdvice = document.getElementById('titleAdvice');
    const descAdvice = document.getElementById('descAdvice');
    
    // Buttons
    const downloadReport = document.getElementById('downloadReport');
    const resetForm = document.getElementById('resetForm');

    // Default values
    const defaultValues = {
        company: 'Online Website Tools',
        title: 'Online Website Tools Meta Length Checker - Digital Marketing Tool',
        url: 'https://onlinewebsitetools/tools/meta-length-checker',
        description: 'Meta length checker, snippet tool... we have it all! An awesome description will help boost your CTR and make you stand out in the search results! Try it today!'
    };

    // Initialize with default values
    initializeDefaults();

    // Event listeners
    companyName.addEventListener('input', updatePreview);
    pageTitle.addEventListener('input', updateTitle);
    pageUrl.addEventListener('input', updatePreview);
    metaDescription.addEventListener('input', updateDescription);
    downloadReport.addEventListener('click', handleDownload);
    resetForm.addEventListener('click', handleReset);

    // Initialize
    function initializeDefaults() {
        companyName.value = defaultValues.company;
        pageTitle.value = defaultValues.title;
        pageUrl.value = defaultValues.url;
        metaDescription.value = defaultValues.description;

        updateTitle();
        updateDescription();
        updatePreview();
    }
    
    console.log(initializeDefaults());

    // Update Preview for company name & URL
    function updatePreview() {
        previewCompany.textContent = companyName.value || 'Your Company';
        previewUrl.textContent = pageUrl.value || 'https://example.com';
    }

    // Update Title Preview & Counters
    function updateTitle() {
        const title = pageTitle.value.trim();
        const length = title.length;

        titleCharCount.textContent = length;
        previewTitle.textContent = title || 'Your Page Title Will Appear Here';

        const percent = Math.min((length / 60) * 100, 100);
        titleProgress.style.width = percent + '%';

        // Color & Status
        if (length === 0) {
            titleProgress.className = 'progress-bar bg-secondary';
            titleStatus.className = 'badge bg-secondary';
            titleStatus.textContent = 'Not Set';
            titleAdvice.textContent = 'Enter a title to see recommendations';
        } else if (length < 50) {
            titleProgress.className = 'progress-bar bg-warning';
            titleStatus.className = 'badge bg-warning';
            titleStatus.textContent = 'Too Short';
            titleAdvice.textContent = 'Add more characters — aim for 50–60.';
        } else if (length <= 60) {
            titleProgress.className = 'progress-bar bg-success';
            titleStatus.className = 'badge bg-success';
            titleStatus.textContent = 'Perfect';
            titleAdvice.textContent = 'Good length! Your title fits perfectly.';
        } else {
            titleProgress.className = 'progress-bar bg-danger';
            titleStatus.className = 'badge bg-danger';
            titleStatus.textContent = 'Too Long';
            titleAdvice.textContent = 'Shorten to under 60 characters.';
        }
    }

    // Update Description Preview & Counters
    function updateDescription() {
        const desc = metaDescription.value.trim();
        const length = desc.length;

        descCharCount.textContent = length;
        previewDescription.textContent = desc || 'Your meta description will appear here.';

        const percent = Math.min((length / 160) * 100, 100);
        descProgress.style.width = percent + '%';

        // Color & Status
        if (length === 0) {
            descProgress.className = 'progress-bar bg-secondary';
            descStatus.className = 'badge bg-secondary';
            descStatus.textContent = 'Not Set';
            descAdvice.textContent = 'Enter a description to see recommendations';
        } else if (length < 150) {
            descProgress.className = 'progress-bar bg-warning';
            descStatus.className = 'badge bg-warning';
            descStatus.textContent = 'Too Short';
            descAdvice.textContent = 'Add more content — aim for 150–160.';
        } else if (length <= 160) {
            descProgress.className = 'progress-bar bg-success';
            descStatus.className = 'badge bg-success';
            descStatus.textContent = 'Perfect';
            descAdvice.textContent = 'Excellent! Description is the ideal length.';
        } else {
            descProgress.className = 'progress-bar bg-danger';
            descStatus.className = 'badge bg-danger';
            descStatus.textContent = 'Too Long';
            descAdvice.textContent = 'Try shortening below 160 characters.';
        }
    }

    // Reset Form
    function handleReset() {
        companyName.value = '';
        pageTitle.value = '';
        pageUrl.value = '';
        metaDescription.value = '';

        titleCharCount.textContent = '0';
        descCharCount.textContent = '0';

        titleProgress.style.width = '0%';
        descProgress.style.width = '0%';

        previewCompany.textContent = 'Your Company';
        previewTitle.textContent = 'Your Page Title Will Appear Here';
        previewUrl.textContent = 'https://example.com';
        previewDescription.textContent = 'Your meta description will appear here.';

        titleStatus.className = 'badge bg-secondary';
        titleStatus.textContent = 'Not Set';
        descStatus.className = 'badge bg-secondary';
        descStatus.textContent = 'Not Set';
        titleAdvice.textContent = 'Enter a title to see recommendations';
        descAdvice.textContent = 'Enter a description to see recommendations';
    }

    // Download Report (as text file)
    function handleDownload() {
        const report = `
Meta Length Checker Report
----------------------------
Company: ${companyName.value}
Title: ${pageTitle.value} (${pageTitle.value.length} chars)
Description: ${metaDescription.value} (${metaDescription.value.length} chars)
URL: ${pageUrl.value}
----------------------------
Title Status: ${titleStatus.textContent}
Description Status: ${descStatus.textContent}
        `;

        const blob = new Blob([report], { type: 'text/plain' });
        const link = document.createElement('a');
        link.href = URL.createObjectURL(blob);
        link.download = 'meta-length-report.txt';
        link.click();
    }
});
