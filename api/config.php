<?php
// Configuration file for the CMS
define('DATA_DIR', __DIR__ . '/data/');
define('UPLOAD_DIR', __DIR__ . '/../uploads/');
define('WEBSITE_DIR', __DIR__ . '/../');

// Create directories if they don't exist
if (!file_exists(DATA_DIR)) {
    mkdir(DATA_DIR, 0755, true);
}

if (!file_exists(UPLOAD_DIR)) {
    mkdir(UPLOAD_DIR, 0755, true);
}

// Database file paths
define('MEDIA_DATA_FILE', DATA_DIR . 'media.json');
define('ARTICLES_DATA_FILE', DATA_DIR . 'articles.json');
define('PROJECTS_DATA_FILE', DATA_DIR . 'projects.json');
define('AWARDS_DATA_FILE', DATA_DIR . 'awards.json');
define('TIMELINE_DATA_FILE', DATA_DIR . 'timeline.json');
define('SETTINGS_DATA_FILE', DATA_DIR . 'settings.json');

// Default settings
$default_settings = [
    'site_title_en' => 'Obai Sukar | Syrian-American Media Pioneer & Sound Engineer',
    'site_title_ar' => 'أبي سكر | رائد الإعلام السوري الأمريكي ومهندس الصوت',
    'email' => 'obai@obaisukar.com',
    'linkedin' => 'https://linkedin.com/in/obaisukar',
    'karazah_subscribers' => '715K+',
    'karazah_views' => '301M+',
    'radio_listeners' => '500K+',
    'experience_years' => '25+'
];

// Initialize data files if they don't exist
function initializeDataFiles() {
    global $default_settings;
    
    $files = [
        MEDIA_DATA_FILE => [],
        ARTICLES_DATA_FILE => [],
        PROJECTS_DATA_FILE => [],
        AWARDS_DATA_FILE => [],
        TIMELINE_DATA_FILE => [],
        SETTINGS_DATA_FILE => $default_settings
    ];
    
    foreach ($files as $file => $default_data) {
        if (!file_exists($file)) {
            file_put_contents($file, json_encode($default_data, JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE));
        }
    }
}

// Helper functions
function loadData($file) {
    if (file_exists($file)) {
        $data = file_get_contents($file);
        return json_decode($data, true) ?: [];
    }
    return [];
}

function saveData($file, $data) {
    return file_put_contents($file, json_encode($data, JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE));
}

function generateId() {
    return uniqid(time(), true);
}

function sanitizeInput($input) {
    return htmlspecialchars(trim($input), ENT_QUOTES, 'UTF-8');
}

function handleFileUpload($file, $allowedTypes = ['image/jpeg', 'image/png', 'image/gif']) {
    if (!isset($file['tmp_name']) || empty($file['tmp_name'])) {
        return null;
    }
    
    if ($file['error'] !== UPLOAD_ERR_OK) {
        throw new Exception('File upload error: ' . $file['error']);
    }
    
    $mimeType = mime_content_type($file['tmp_name']);
    if (!in_array($mimeType, $allowedTypes)) {
        throw new Exception('Invalid file type. Allowed types: ' . implode(', ', $allowedTypes));
    }
    
    $extension = pathinfo($file['name'], PATHINFO_EXTENSION);
    $filename = generateId() . '.' . $extension;
    $filepath = UPLOAD_DIR . $filename;
    
    if (move_uploaded_file($file['tmp_name'], $filepath)) {
        return 'uploads/' . $filename;
    }
    
    throw new Exception('Failed to move uploaded file');
}

// Initialize on include
initializeDataFiles();
?>