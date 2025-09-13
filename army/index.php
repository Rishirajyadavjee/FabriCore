<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="utf-8" />
<meta name="viewport" content="width=device-width,initial-scale=1" />
<title>Army Fabric AI Dashboard</title>
<link href="style.css" rel="stylesheet">
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

<style>
/* Enhanced CSS - Add this to your existing style.css or include inline */
:root {
    --primary-dark: #0f1419;
    --primary-green: #1a4d3a;
    --accent-gold: #d4af37;
    --accent-olive: #8b9f35;
    --text-light: #ffffff;
    --text-muted: #b8c5d1;
    --border-subtle: rgba(255, 255, 255, 0.1);
    --glass-bg: rgba(255, 255, 255, 0.05);
    --success: #22c55e;
    --warning: #f59e0b;
    --danger: #ef4444;
    --shadow-soft: 0 4px 20px rgba(0, 0, 0, 0.15);
    --shadow-strong: 0 8px 40px rgba(0, 0, 0, 0.3);
}

* {
    margin: 0;
    padding: 0;
    box-sizing: border-box;
}

body {
    font-family: 'Segoe UI', -apple-system, BlinkMacSystemFont, 'Roboto', 'Helvetica Neue', sans-serif;
    background: linear-gradient(135deg, var(--primary-dark) 0%, var(--primary-green) 50%, var(--primary-dark) 100%);
    color: var(--text-light);
    min-height: 100vh;
    position: relative;
    overflow-x: hidden;
}

body::before {
    content: '';
    position: fixed;
    top: 0;
    left: 0;
    width: 100%;
    height: 100%;
    background: 
        radial-gradient(circle at 20% 50%, rgba(212, 175, 55, 0.08) 0%, transparent 50%),
        radial-gradient(circle at 80% 20%, rgba(139, 159, 53, 0.08) 0%, transparent 50%),
        radial-gradient(circle at 40% 80%, rgba(26, 77, 58, 0.08) 0%, transparent 50%);
    pointer-events: none;
    z-index: -1;
}

/* Header Enhancements */
.header {
    background: rgba(15, 20, 25, 0.95);
    backdrop-filter: blur(20px);
    border-bottom: 2px solid var(--border-subtle);
    position: sticky;
    top: 0;
    z-index: 1000;
    box-shadow: var(--shadow-strong);
    transition: all 0.3s ease;
}

.header-content {
    max-width: 1400px;
    margin: 0 auto;
    display: flex;
    justify-content: space-between;
    align-items: center;
    padding: 1.5rem 2rem;
    position: relative;
}

.header h1 {
    font-size: 1.8rem;
    font-weight: 800;
    background: linear-gradient(135deg, var(--accent-gold), var(--accent-olive));
    -webkit-background-clip: text;
    -webkit-text-fill-color: transparent;
    background-clip: text;
    text-shadow: 0 0 30px rgba(212, 175, 55, 0.3);
    position: relative;
}

.header h1::before {
    content: '🎖️';
    position: absolute;
    left: -3rem;
    top: 50%;
    transform: translateY(-50%);
    font-size: 2rem;
    animation: glow 2s ease-in-out infinite alternate;
}

@keyframes glow {
    from { filter: drop-shadow(0 0 5px rgba(212, 175, 55, 0.5)); }
    to { filter: drop-shadow(0 0 20px rgba(212, 175, 55, 0.8)); }
}

.user-info {
    display: flex;
    align-items: center;
    gap: 1.5rem;
    background: var(--glass-bg);
    backdrop-filter: blur(10px);
    padding: 0.75rem 1.5rem;
    border-radius: 12px;
    border: 1px solid var(--border-subtle);
}

.user-info span {
    font-weight: 600;
    color: var(--text-muted);
    display: flex;
    align-items: center;
    gap: 0.5rem;
    font-size: 0.95rem;
}

.logout-btn {
    background: linear-gradient(135deg, var(--danger), #dc2626);
    border: none;
    color: white;
    padding: 0.75rem 1.5rem;
    border-radius: 8px;
    font-weight: 600;
    cursor: pointer;
    transition: all 0.3s ease;
    box-shadow: 0 4px 15px rgba(239, 68, 68, 0.3);
    font-size: 0.9rem;
}

.logout-btn:hover {
    transform: translateY(-2px);
    box-shadow: 0 6px 25px rgba(239, 68, 68, 0.4);
}

/* Navigation Tabs Enhancement */
.nav-tabs {
    background: linear-gradient(90deg, rgba(26, 77, 58, 0.4), rgba(139, 159, 53, 0.3), rgba(26, 77, 58, 0.4));
    backdrop-filter: blur(15px);
    border-bottom: 1px solid var(--border-subtle);
    display: flex;
    justify-content: center;
    padding: 0;
    position: relative;
    overflow-x: auto;
    scrollbar-width: none;
    -ms-overflow-style: none;
}

.nav-tabs::-webkit-scrollbar {
    display: none;
}

.nav-tabs::before {
    content: '';
    position: absolute;
    top: 0;
    left: 0;
    right: 0;
    height: 1px;
    background: linear-gradient(90deg, transparent, var(--accent-gold), transparent);
}

.nav-tab {
    padding: 1.2rem 2rem;
    cursor: pointer;
    transition: all 0.4s cubic-bezier(0.4, 0, 0.2, 1);
    border-bottom: 3px solid transparent;
    color: var(--text-muted);
    font-weight: 600;
    white-space: nowrap;
    position: relative;
    display: flex;
    align-items: center;
    gap: 0.75rem;
    font-size: 0.95rem;
}

.nav-tab::before {
    content: '';
    position: absolute;
    top: 0;
    left: 0;
    right: 0;
    bottom: 0;
    background: linear-gradient(135deg, var(--primary-green), var(--accent-olive));
    opacity: 0;
    transition: opacity 0.3s ease;
    border-radius: 0;
}

.nav-tab:hover {
    color: var(--text-light);
    transform: translateY(-2px);
}

.nav-tab:hover::before {
    opacity: 0.1;
}

.nav-tab.active {
    background: linear-gradient(135deg, var(--primary-green), var(--accent-olive));
    color: var(--text-light);
    border-bottom-color: var(--accent-gold);
    box-shadow: 0 4px 20px rgba(26, 77, 58, 0.4);
    position: relative;
}

.nav-tab.active::after {
    content: '';
    position: absolute;
    bottom: -1px;
    left: 50%;
    transform: translateX(-50%);
    width: 60%;
    height: 3px;
    background: linear-gradient(90deg, transparent, var(--accent-gold), transparent);
    border-radius: 2px;
}

/* Main Container Enhancement */
.main-container {
    max-width: 1400px;
    margin: 0 auto;
    padding: 2rem;
    position: relative;
}

/* Alert Container */
#alertContainer {
    position: fixed;
    top: 1rem;
    right: 1rem;
    z-index: 2000;
    max-width: 400px;
}

/* Enhanced Cards and General Styling */
.card, .dashboard-card, .content-card {
    background: var(--glass-bg);
    backdrop-filter: blur(20px);
    border: 1px solid var(--border-subtle);
    border-radius: 16px;
    padding: 2rem;
    transition: all 0.4s cubic-bezier(0.4, 0, 0.2, 1);
    position: relative;
    overflow: hidden;
    box-shadow: var(--shadow-soft);
    margin-bottom: 1.5rem;
}

.card::before, .dashboard-card::before, .content-card::before {
    content: '';
    position: absolute;
    top: 0;
    left: 0;
    right: 0;
    height: 1px;
    background: linear-gradient(90deg, transparent, var(--accent-gold), transparent);
}

.card:hover, .dashboard-card:hover, .content-card:hover {
    transform: translateY(-8px);
    box-shadow: var(--shadow-strong);
    border-color: rgba(212, 175, 55, 0.3);
}

/* Grid Layouts */
.dashboard-grid, .metrics-grid, .content-grid {
    display: grid;
    grid-template-columns: repeat(auto-fit, minmax(300px, 1fr));
    gap: 1.5rem;
    margin-bottom: 2rem;
}

/* Enhanced Buttons */
.btn, button:not(.logout-btn) {
    background: linear-gradient(135deg, var(--primary-green), var(--accent-olive));
    border: 1px solid var(--border-subtle);
    color: var(--text-light);
    padding: 0.75rem 1.5rem;
    border-radius: 10px;
    font-weight: 600;
    cursor: pointer;
    transition: all 0.3s ease;
    display: inline-flex;
    align-items: center;
    gap: 0.5rem;
    font-size: 0.9rem;
    backdrop-filter: blur(10px);
}

.btn:hover, button:not(.logout-btn):hover {
    transform: translateY(-2px);
    box-shadow: 0 8px 25px rgba(26, 77, 58, 0.4);
    border-color: var(--accent-gold);
}

.btn-primary {
    background: linear-gradient(135deg, var(--accent-gold), var(--warning));
}

.btn-secondary {
    background: rgba(255, 255, 255, 0.1);
    backdrop-filter: blur(10px);
}

/* Enhanced Input Fields */
input, select, textarea {
    background: rgba(255, 255, 255, 0.05);
    border: 1px solid var(--border-subtle);
    color: var(--text-light);
    padding: 0.75rem 1rem;
    border-radius: 8px;
    transition: all 0.3s ease;
    font-size: 0.9rem;
}

input:focus, select:focus, textarea:focus {
    outline: none;
    border-color: var(--accent-gold);
    box-shadow: 0 0 0 3px rgba(212, 175, 55, 0.1);
    background: rgba(255, 255, 255, 0.08);
}

/* Enhanced Tables */
table {
    width: 100%;
    border-collapse: collapse;
    background: rgba(255, 255, 255, 0.02);
    border-radius: 12px;
    overflow: hidden;
    box-shadow: var(--shadow-soft);
}

th, td {
    padding: 1rem;
    text-align: left;
    border-bottom: 1px solid var(--border-subtle);
}

th {
    background: linear-gradient(135deg, var(--primary-green), var(--accent-olive));
    font-weight: 600;
    color: var(--text-light);
}

tr:hover {
    background: rgba(255, 255, 255, 0.03);
}

/* Progress Bars */
.progress-bar, .progress {
    width: 100%;
    height: 8px;
    background: rgba(255, 255, 255, 0.1);
    border-radius: 4px;
    overflow: hidden;
    margin: 1rem 0;
}

.progress-fill, .progress-inner {
    height: 100%;
    background: linear-gradient(135deg, var(--success), var(--accent-olive));
    border-radius: 4px;
    transition: width 0.8s cubic-bezier(0.4, 0, 0.2, 1);
}

/* Status Indicators */
.status-indicator, .status-badge {
    display: inline-block;
    width: 10px;
    height: 10px;
    border-radius: 50%;
    margin-right: 0.5rem;
    animation: pulse 2s infinite;
}

.status-operational, .status-success { background: var(--success); }
.status-warning { background: var(--warning); }
.status-critical, .status-error { background: var(--danger); }

@keyframes pulse {
    0% { box-shadow: 0 0 0 0 rgba(34, 197, 94, 0.7); }
    70% { box-shadow: 0 0 0 10px rgba(34, 197, 94, 0); }
    100% { box-shadow: 0 0 0 0 rgba(34, 197, 94, 0); }
}

/* Enhanced Alerts */
.alert {
    background: rgba(34, 197, 94, 0.1);
    border: 1px solid var(--success);
    border-radius: 12px;
    padding: 1rem 1.5rem;
    margin-bottom: 1rem;
    display: flex;
    align-items: center;
    gap: 1rem;
    backdrop-filter: blur(10px);
    animation: slideIn 0.3s ease;
}

.alert-warning {
    background: rgba(245, 158, 11, 0.1);
    border-color: var(--warning);
}

.alert-error, .alert-danger {
    background: rgba(239, 68, 68, 0.1);
    border-color: var(--danger);
}

@keyframes slideIn {
    from { transform: translateX(100%); opacity: 0; }
    to { transform: translateX(0); opacity: 1; }
}

/* Enhanced Metrics */
.metric-card, .metric {
    text-align: center;
    background: var(--glass-bg);
    backdrop-filter: blur(20px);
    border: 1px solid var(--border-subtle);
    border-radius: 16px;
    padding: 2rem;
    transition: all 0.3s ease;
}

.metric-value, .metric-number {
    font-size: 3rem;
    font-weight: 800;
    background: linear-gradient(135deg, var(--accent-gold), var(--accent-olive));
    -webkit-background-clip: text;
    -webkit-text-fill-color: transparent;
    background-clip: text;
    margin-bottom: 0.5rem;
    text-shadow: 0 0 30px rgba(212, 175, 55, 0.3);
}

.metric-label, .metric-description {
    color: var(--text-muted);
    font-weight: 600;
    text-transform: uppercase;
    font-size: 0.85rem;
    letter-spacing: 1px;
}

/* Mobile Responsiveness */
@media (max-width: 768px) {
    .header-content {
        flex-direction: column;
        gap: 1rem;
        text-align: center;
        padding: 1rem;
    }

    .header h1 {
        font-size: 1.4rem;
    }

    .header h1::before {
        display: none;
    }

    .nav-tabs {
        overflow-x: auto;
        justify-content: flex-start;
    }

    .nav-tab {
        padding: 1rem 1.5rem;
        font-size: 0.85rem;
    }

    .main-container {
        padding: 1rem;
    }

    .dashboard-grid, .metrics-grid, .content-grid {
        grid-template-columns: 1fr;
        gap: 1rem;
    }

    .card, .dashboard-card, .content-card {
        padding: 1.5rem;
    }

    .user-info {
        flex-direction: column;
        gap: 1rem;
    }
}

@media (max-width: 480px) {
    .nav-tab {
        padding: 0.75rem 1rem;
        font-size: 0.8rem;
        gap: 0.5rem;
    }

    .metric-value, .metric-number {
        font-size: 2rem;
    }

    .card, .dashboard-card, .content-card {
        padding: 1rem;
    }
}

/* Loading States */
.loading {
    display: inline-block;
    width: 20px;
    height: 20px;
    border: 3px solid rgba(255, 255, 255, 0.3);
    border-radius: 50%;
    border-top-color: var(--accent-gold);
    animation: spin 1s linear infinite;
}

@keyframes spin {
    to { transform: rotate(360deg); }
}

/* Custom Scrollbars */
::-webkit-scrollbar {
    width: 8px;
    height: 8px;
}

::-webkit-scrollbar-track {
    background: rgba(255, 255, 255, 0.05);
    border-radius: 4px;
}

::-webkit-scrollbar-thumb {
    background: linear-gradient(135deg, var(--accent-gold), var(--accent-olive));
    border-radius: 4px;
}

::-webkit-scrollbar-thumb:hover {
    background: linear-gradient(135deg, var(--accent-olive), var(--accent-gold));
}

/* Smooth page transitions */
.fade-enter-active, .fade-leave-active {
    transition: opacity 0.3s ease;
}

.fade-enter, .fade-leave-to {
    opacity: 0;
}

/* Enhanced tooltips */
[data-tooltip] {
    position: relative;
    cursor: help;
}

[data-tooltip]:hover::after {
    content: attr(data-tooltip);
    position: absolute;
    bottom: 125%;
    left: 50%;
    transform: translateX(-50%);
    background: var(--primary-dark);
    color: var(--text-light);
    padding: 0.5rem 1rem;
    border-radius: 8px;
    font-size: 0.85rem;
    white-space: nowrap;
    z-index: 1000;
    border: 1px solid var(--border-subtle);
    box-shadow: var(--shadow-soft);
}
</style>
</head>
<body>
<div class="header">
    <div class="header-content">
        <h1>AI/ML Fabric Selection & Supply Chain Optimization</h1>
        <div class="user-info">
            <span>🪖 Officer Dashboard</span>
            <button class="logout-btn" onclick="logout()">Logout</button>
        </div>
    </div>
</div>
<div class="nav-tabs">
    <div class="nav-tab active" onclick="switchTab('analysis')">🔬 Fabric Analysis</div>
    <div class="nav-tab" onclick="switchTab('comparison')">📊 Multi-Climate Comparison</div>
    <div class="nav-tab" onclick="switchTab('sustainability')">🌱 Sustainability</div>
    <div class="nav-tab" onclick="switchTab('supply-chain')">🚚 Supply Chain</div>
    <div class="nav-tab" onclick="switchTab('reports')">📄 Reports</div>
</div>
<div class="main-container">
    <div id="alertContainer"></div>
    <?php include __DIR__ . '/tabs/analysis.php'; ?>
    <?php include __DIR__ . '/tabs/comparison.php'; ?>
    <?php include __DIR__ . '/tabs/sustainability.php'; ?>
    <?php include __DIR__ . '/tabs/supply-chain.php'; ?>
    <?php include __DIR__ . '/tabs/reports.php'; ?>
</div>
<script src="script.js"></script>

<script>
// Enhanced JavaScript functionality
document.addEventListener('DOMContentLoaded', function() {
    // Initialize animations
    initializeAnimations();
    
    // Setup enhanced interactions
    setupEnhancedInteractions();
    
    // Initialize tooltips
    initializeTooltips();
});

function initializeAnimations() {
    // Animate cards on load
    const cards = document.querySelectorAll('.card, .dashboard-card, .content-card');
    cards.forEach((card, index) => {
        card.style.opacity = '0';
        card.style.transform = 'translateY(30px)';
        setTimeout(() => {
            card.style.transition = 'opacity 0.6s ease, transform 0.6s ease';
            card.style.opacity = '1';
            card.style.transform = 'translateY(0)';
        }, index * 150);
    });

    // Animate progress bars
    setTimeout(() => {
        const progressBars = document.querySelectorAll('.progress-fill, .progress-inner');
        progressBars.forEach(bar => {
            const targetWidth = bar.style.width || bar.getAttribute('data-width') || '0%';
            bar.style.width = '0%';
            setTimeout(() => {
                bar.style.width = targetWidth;
            }, 500);
        });
    }, 1000);
}

function setupEnhancedInteractions() {
    // Enhanced tab switching with smooth transitions
    const navTabs = document.querySelectorAll('.nav-tab');
    navTabs.forEach(tab => {
        tab.addEventListener('click', function(e) {
            // Remove active class from all tabs
            navTabs.forEach(t => t.classList.remove('active'));
            // Add active class to clicked tab
            this.classList.add('active');
            
            // Add ripple effect
            createRippleEffect(e, this);
        });
    });

    // Enhanced button interactions
    const buttons = document.querySelectorAll('.btn, button');
    buttons.forEach(button => {
        button.addEventListener('click', function(e) {
            createRippleEffect(e, this);
        });
    });
}

function createRippleEffect(e, element) {
    const ripple = document.createElement('span');
    const rect = element.getBoundingClientRect();
    const size = Math.max(rect.width, rect.height);
    const x = e.clientX - rect.left - size / 2;
    const y = e.clientY - rect.top - size / 2;
    
    ripple.style.cssText = `
        position: absolute;
        width: ${size}px;
        height: ${size}px;
        left: ${x}px;
        top: ${y}px;
        background: rgba(212, 175, 55, 0.3);
        border-radius: 50%;
        transform: scale(0);
        animation: ripple 0.6s ease-out;
        pointer-events: none;
        z-index: 1;
    `;
    
    element.style.position = 'relative';
    element.appendChild(ripple);
    
    setTimeout(() => {
        ripple.remove();
    }, 600);
    
    // Add ripple keyframes if not exists
    if (!document.getElementById('ripple-styles')) {
        const style = document.createElement('style');
        style.id = 'ripple-styles';
        style.textContent = `
            @keyframes ripple {
                to {
                    transform: scale(4);
                    opacity: 0;
                }
            }
        `;
        document.head.appendChild(style);
    }
}

function initializeTooltips() {
    const tooltipElements = document.querySelectorAll('[data-tooltip]');
    tooltipElements.forEach(element => {
        element.addEventListener('mouseenter', function() {
            this.style.position = 'relative';
        });
    });
}

// Enhanced alert system
function showEnhancedAlert(message, type = 'success', duration = 5000) {
    const alertContainer = document.getElementById('alertContainer');
    const alert = document.createElement('div');
    alert.className = `alert alert-${type}`;
    
    const icon = type === 'success' ? '✅' : 
                type === 'warning' ? '⚠️' : 
                type === 'error' ? '❌' : 'ℹ️';
    
    alert.innerHTML = `
        <span style="font-size: 1.2rem;">${icon}</span>
        <div>
            <strong>${message}</strong>
        </div>
        <button onclick="this.parentElement.remove()" style="margin-left: auto; background: none; border: none; color: inherit; font-size: 1.2rem; cursor: pointer;">×</button>
    `;
    
    alertContainer.appendChild(alert);
    
    setTimeout(() => {
        if (alert.parentElement) {
            alert.style.animation = 'slideOut 0.3s ease forwards';
            setTimeout(() => alert.remove(), 300);
        }
    }, duration);
    
    // Add slideOut animation if not exists
    if (!document.getElementById('slideout-styles')) {
        const style = document.createElement('style');
        style.id = 'slideout-styles';
        style.textContent = `
            @keyframes slideOut {
                to {
                    transform: translateX(100%);
                    opacity: 0;
                }
            }
        `;
        document.head.appendChild(style);
    }
}

// Keyboard shortcuts
document.addEventListener('keydown', function(e) {
    if (e.altKey) {
        switch(e.key) {
            case '1':
                e.preventDefault();
                document.querySelector('[onclick*="analysis"]')?.click();
                break;
            case '2':
                e.preventDefault();
                document.querySelector('[onclick*="comparison"]')?.click();
                break;
            case '3':
                e.preventDefault();
                document.querySelector('[onclick*="sustainability"]')?.click();
                break;
            case '4':
                e.preventDefault();
                document.querySelector('[onclick*="supply-chain"]')?.click();
                break;
            case '5':
                e.preventDefault();
                document.querySelector('[onclick*="reports"]')?.click();
                break;
        }
    }
});

// Enhanced logout function
function logout() {
    if (confirm('🛡️ Are you sure you want to logout from the Army Fabric AI System?')) {
        showEnhancedAlert('Logging out securely...', 'warning', 2000);
        setTimeout(() => {
            window.location.href = '/login.php';
        }, 2000);
    }
}

// Welcome message
setTimeout(() => {
    showEnhancedAlert('🎖️ Welcome to Army Fabric AI Dashboard. All systems operational.', 'success', 4000);
}, 1000);
</script>
</body>
</html>