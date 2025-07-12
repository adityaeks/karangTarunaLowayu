/**
 * Visitor Counter Script
 * Script untuk mengambil dan memperbarui statistik pengunjung website
 */

// Function to format large numbers
function formatNumber(num) {
    if (num >= 1000000) {
        return (num / 1000000).toFixed(1) + 'M';
    }
    if (num >= 1000) {
        return (num / 1000).toFixed(1) + 'K';
    }
    return num;
}

// Function to update visitor statistics
function updateVisitorStats() {
    fetch('/api/visitor-stats')
        .then(response => response.json())
        .then(data => {
            // Update counters with animation
            animateCounter('total-visitors', data.total);
            animateCounter('today-visitors', data.today);
            animateCounter('online-visitors', data.online);
        })
        .catch(error => console.error('Error fetching visitor stats:', error));
}

// Function to animate counter
function animateCounter(elementId, targetValue) {
    const element = document.getElementById(elementId);
    if (!element) return;

    const currentValue = parseInt(element.getAttribute('data-value') || '0');
    element.setAttribute('data-value', targetValue);

    // If the difference is small, just update without animation
    if (Math.abs(targetValue - currentValue) < 5) {
        element.textContent = formatNumber(targetValue);
        return;
    }

    let startValue = currentValue;
    const duration = 1000; // Animation duration in milliseconds
    const startTime = performance.now();

    function updateCounter(timestamp) {
        const elapsed = timestamp - startTime;
        const progress = Math.min(elapsed / duration, 1);

        const currentCount = Math.floor(startValue + (targetValue - startValue) * progress);
        element.textContent = formatNumber(currentCount);

        if (progress < 1) {
            requestAnimationFrame(updateCounter);
        } else {
            element.textContent = formatNumber(targetValue);
        }
    }

    requestAnimationFrame(updateCounter);
}

// Update stats when page loads and every 30 seconds
document.addEventListener('DOMContentLoaded', function() {
    // Initial update
    updateVisitorStats();

    // Set interval for regular updates
    setInterval(updateVisitorStats, 30000);
});
