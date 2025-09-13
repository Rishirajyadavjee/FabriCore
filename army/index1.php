<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="utf-8" />
<meta name="viewport" content="width=device-width,initial-scale=1" />
<title>Army Fabric AI Dashboard</title>
<link href="style.css" rel="stylesheet">
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
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
</body>
</html>
