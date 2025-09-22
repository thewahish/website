<?php
// Installation script for Obai Sukar CMS

echo "<h2>🚀 Installing Obai Sukar CMS...</h2>";

// Create necessary directories
$dirs = [
    'api/data',
    'uploads'
];

foreach ($dirs as $dir) {
    if (!is_dir($dir)) {
        if (mkdir($dir, 0755, true)) {
            echo "✅ Created directory: $dir<br>";
        } else {
            echo "❌ Failed to create directory: $dir<br>";
        }
    } else {
        echo "📁 Directory already exists: $dir<br>";
    }
}

// Set permissions
echo "<br><h3>Setting Permissions...</h3>";
$paths = ['api', 'uploads', 'api/data'];

foreach ($paths as $path) {
    if (is_dir($path)) {
        chmod($path, 0755);
        echo "✅ Set permissions for: $path<br>";
    }
}

// Initialize configuration
echo "<br><h3>Initializing Configuration...</h3>";
require_once 'api/config.php';
echo "✅ Configuration initialized<br>";

// Test API endpoints
echo "<br><h3>Testing API...</h3>";

// Test basic functionality
$testData = [
    'title_en' => 'Test Article',
    'title_ar' => 'مقال تجريبي',
    'source' => 'Test Source',
    'excerpt_en' => 'This is a test excerpt',
    'excerpt_ar' => 'هذا مقتطف تجريبي',
    'article_url' => 'https://example.com',
    'pub_date' => date('Y-m-d'),
    'featured' => 0
];

// Save test data
$articles = loadData(ARTICLES_DATA_FILE);
$articles[] = $testData;
if (saveData(ARTICLES_DATA_FILE, $articles)) {
    echo "✅ API test successful - data saved<br>";
} else {
    echo "❌ API test failed - could not save data<br>";
}

echo "<br><h3>🎉 Installation Complete!</h3>";
echo "<p><strong>Next Steps:</strong></p>";
echo "<ol>";
echo "<li>Open <a href='cp.php' target='_blank'>cp.php</a> in your browser</li>";
echo "<li>Add your content through the control panel</li>";
echo "<li>Your website will be automatically updated!</li>";
echo "</ol>";

echo "<br><p><strong>Important Notes:</strong></p>";
echo "<ul>";
echo "<li>Make sure you're running this on a PHP server (XAMPP, WAMP, etc.)</li>";
echo "<li>The uploads folder needs write permissions</li>";
echo "<li>Settings changes will update your main website files</li>";
echo "</ul>";

echo "<br><p style='color: green; font-weight: bold;'>🚀 Your CMS is ready to use!</p>";
?>