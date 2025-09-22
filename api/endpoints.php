<?php
require_once 'config.php';

header('Content-Type: application/json');
header('Access-Control-Allow-Origin: *');
header('Access-Control-Allow-Methods: GET, POST, PUT, DELETE');
header('Access-Control-Allow-Headers: Content-Type');

$method = $_SERVER['REQUEST_METHOD'];
$request = $_GET['action'] ?? '';

try {
    switch ($request) {
        // MEDIA ENDPOINTS
        case 'get_media':
            echo json_encode(loadData(MEDIA_DATA_FILE));
            break;
            
        case 'add_media':
            if ($method === 'POST') {
                $media = loadData(MEDIA_DATA_FILE);
                
                $newMedia = [
                    'id' => generateId(),
                    'title_en' => sanitizeInput($_POST['title_en']),
                    'title_ar' => sanitizeInput($_POST['title_ar']),
                    'category' => sanitizeInput($_POST['category']),
                    'description_en' => sanitizeInput($_POST['description_en']),
                    'description_ar' => sanitizeInput($_POST['description_ar']),
                    'youtube_url' => sanitizeInput($_POST['youtube_url']),
                    'external_link' => sanitizeInput($_POST['external_link']),
                    'date' => $_POST['date'] ?: date('Y-m-d'),
                    'thumbnail' => null,
                    'created_at' => date('Y-m-d H:i:s')
                ];
                
                // Handle file upload
                if (isset($_FILES['thumbnail']) && $_FILES['thumbnail']['error'] === UPLOAD_ERR_OK) {
                    $newMedia['thumbnail'] = handleFileUpload($_FILES['thumbnail']);
                }
                
                $media[] = $newMedia;
                saveData(MEDIA_DATA_FILE, $media);
                updateWebsiteMedia();
                
                echo json_encode(['success' => true, 'message' => 'Media added successfully', 'data' => $newMedia]);
            }
            break;
            
        case 'delete_media':
            if ($method === 'POST') {
                $media = loadData(MEDIA_DATA_FILE);
                $id = $_POST['id'];
                
                $media = array_filter($media, function($item) use ($id) {
                    return $item['id'] !== $id;
                });
                
                saveData(MEDIA_DATA_FILE, array_values($media));
                updateWebsiteMedia();
                
                echo json_encode(['success' => true, 'message' => 'Media deleted successfully']);
            }
            break;
            
        // ARTICLES ENDPOINTS
        case 'get_articles':
            echo json_encode(loadData(ARTICLES_DATA_FILE));
            break;
            
        case 'add_article':
            if ($method === 'POST') {
                $articles = loadData(ARTICLES_DATA_FILE);
                
                $newArticle = [
                    'id' => generateId(),
                    'title_en' => sanitizeInput($_POST['title_en']),
                    'title_ar' => sanitizeInput($_POST['title_ar']),
                    'source' => sanitizeInput($_POST['source']),
                    'excerpt_en' => sanitizeInput($_POST['excerpt_en']),
                    'excerpt_ar' => sanitizeInput($_POST['excerpt_ar']),
                    'article_url' => sanitizeInput($_POST['article_url']),
                    'pub_date' => $_POST['pub_date'] ?: date('Y-m-d'),
                    'featured' => (int)$_POST['featured'],
                    'created_at' => date('Y-m-d H:i:s')
                ];
                
                $articles[] = $newArticle;
                saveData(ARTICLES_DATA_FILE, $articles);
                updateWebsiteArticles();
                
                echo json_encode(['success' => true, 'message' => 'Article added successfully', 'data' => $newArticle]);
            }
            break;
            
        // PROJECTS ENDPOINTS
        case 'get_projects':
            echo json_encode(loadData(PROJECTS_DATA_FILE));
            break;
            
        case 'add_project':
            if ($method === 'POST') {
                $projects = loadData(PROJECTS_DATA_FILE);
                
                $newProject = [
                    'id' => generateId(),
                    'name_en' => sanitizeInput($_POST['name_en']),
                    'name_ar' => sanitizeInput($_POST['name_ar']),
                    'role_en' => sanitizeInput($_POST['role_en']),
                    'role_ar' => sanitizeInput($_POST['role_ar']),
                    'year' => sanitizeInput($_POST['year']),
                    'achievement_en' => sanitizeInput($_POST['achievement_en']),
                    'achievement_ar' => sanitizeInput($_POST['achievement_ar']),
                    'description_en' => sanitizeInput($_POST['description_en']),
                    'description_ar' => sanitizeInput($_POST['description_ar']),
                    'logo' => null,
                    'created_at' => date('Y-m-d H:i:s')
                ];
                
                // Handle file upload
                if (isset($_FILES['logo']) && $_FILES['logo']['error'] === UPLOAD_ERR_OK) {
                    $newProject['logo'] = handleFileUpload($_FILES['logo']);
                }
                
                $projects[] = $newProject;
                saveData(PROJECTS_DATA_FILE, $projects);
                updateWebsiteProjects();
                
                echo json_encode(['success' => true, 'message' => 'Project added successfully', 'data' => $newProject]);
            }
            break;
            
        // AWARDS ENDPOINTS
        case 'get_awards':
            echo json_encode(loadData(AWARDS_DATA_FILE));
            break;
            
        case 'add_award':
            if ($method === 'POST') {
                $awards = loadData(AWARDS_DATA_FILE);
                
                $newAward = [
                    'id' => generateId(),
                    'title_en' => sanitizeInput($_POST['title_en']),
                    'title_ar' => sanitizeInput($_POST['title_ar']),
                    'year' => (int)$_POST['year'],
                    'category_en' => sanitizeInput($_POST['category_en']),
                    'category_ar' => sanitizeInput($_POST['category_ar']),
                    'icon' => null,
                    'created_at' => date('Y-m-d H:i:s')
                ];
                
                // Handle file upload
                if (isset($_FILES['icon']) && $_FILES['icon']['error'] === UPLOAD_ERR_OK) {
                    $newAward['icon'] = handleFileUpload($_FILES['icon']);
                }
                
                $awards[] = $newAward;
                saveData(AWARDS_DATA_FILE, $awards);
                updateWebsiteAwards();
                
                echo json_encode(['success' => true, 'message' => 'Award added successfully', 'data' => $newAward]);
            }
            break;
            
        // TIMELINE ENDPOINTS
        case 'get_timeline':
            echo json_encode(loadData(TIMELINE_DATA_FILE));
            break;
            
        case 'add_timeline':
            if ($method === 'POST') {
                $timeline = loadData(TIMELINE_DATA_FILE);
                
                $newEvent = [
                    'id' => generateId(),
                    'period' => sanitizeInput($_POST['period']),
                    'company_en' => sanitizeInput($_POST['company_en']),
                    'company_ar' => sanitizeInput($_POST['company_ar']),
                    'title_en' => sanitizeInput($_POST['title_en']),
                    'title_ar' => sanitizeInput($_POST['title_ar']),
                    'description_en' => sanitizeInput($_POST['description_en']),
                    'description_ar' => sanitizeInput($_POST['description_ar']),
                    'created_at' => date('Y-m-d H:i:s')
                ];
                
                $timeline[] = $newEvent;
                saveData(TIMELINE_DATA_FILE, $timeline);
                updateWebsiteTimeline();
                
                echo json_encode(['success' => true, 'message' => 'Timeline event added successfully', 'data' => $newEvent]);
            }
            break;
            
        // SETTINGS ENDPOINTS
        case 'get_settings':
            echo json_encode(loadData(SETTINGS_DATA_FILE));
            break;
            
        case 'save_settings':
            if ($method === 'POST') {
                $settings = [
                    'site_title_en' => sanitizeInput($_POST['site_title_en']),
                    'site_title_ar' => sanitizeInput($_POST['site_title_ar']),
                    'email' => sanitizeInput($_POST['email']),
                    'linkedin' => sanitizeInput($_POST['linkedin']),
                    'karazah_subscribers' => sanitizeInput($_POST['karazah_subscribers']) ?: '715K+',
                    'karazah_views' => sanitizeInput($_POST['karazah_views']) ?: '301M+',
                    'radio_listeners' => sanitizeInput($_POST['radio_listeners']) ?: '500K+',
                    'experience_years' => sanitizeInput($_POST['experience_years']) ?: '25+',
                    'updated_at' => date('Y-m-d H:i:s')
                ];
                
                saveData(SETTINGS_DATA_FILE, $settings);
                updateWebsiteSettings($settings);
                
                echo json_encode(['success' => true, 'message' => 'Settings saved successfully', 'data' => $settings]);
            }
            break;
            
        // STATS ENDPOINTS
        case 'get_stats':
            $media = loadData(MEDIA_DATA_FILE);
            $articles = loadData(ARTICLES_DATA_FILE);
            $projects = loadData(PROJECTS_DATA_FILE);
            $awards = loadData(AWARDS_DATA_FILE);
            
            echo json_encode([
                'media_count' => count($media),
                'articles_count' => count($articles),
                'projects_count' => count($projects),
                'awards_count' => count($awards)
            ]);
            break;
            
        default:
            http_response_code(404);
            echo json_encode(['error' => 'Endpoint not found']);
            break;
    }
} catch (Exception $e) {
    http_response_code(500);
    echo json_encode(['error' => $e->getMessage()]);
}

// Functions to update website files
function updateWebsiteSettings($settings) {
    $websiteFile = WEBSITE_DIR . 'obai_sukar_website.html';
    if (!file_exists($websiteFile)) return;
    
    $content = file_get_contents($websiteFile);
    
    // Update title
    $content = preg_replace(
        '/<title>.*?<\/title>/s',
        '<title>' . $settings['site_title_ar'] . '</title>',
        $content
    );
    
    // Update email
    $content = preg_replace(
        '/obai@obaisukar\.com/',
        $settings['email'],
        $content
    );
    
    // Update stats
    $content = preg_replace(
        '/<div class="stat-number">715K\+<\/div>/',
        '<div class="stat-number">' . $settings['karazah_subscribers'] . '</div>',
        $content
    );
    
    $content = preg_replace(
        '/<div class="stat-number">301M\+<\/div>/',
        '<div class="stat-number">' . $settings['karazah_views'] . '</div>',
        $content
    );
    
    file_put_contents($websiteFile, $content);
}

function updateWebsiteMedia() {
    $mediaFile = WEBSITE_DIR . 'media-gallery.html';
    if (!file_exists($mediaFile)) return;
    
    $media = loadData(MEDIA_DATA_FILE);
    $content = file_get_contents($mediaFile);
    
    // Generate media cards HTML
    $mediaHtml = '';
    foreach ($media as $item) {
        $mediaHtml .= generateMediaCardHtml($item);
    }
    
    // Replace existing media grid content
    $pattern = '/(<div class="media-grid" id="mediaGrid">).*?(<\/div>)/s';
    $replacement = '$1' . $mediaHtml . '$2';
    $content = preg_replace($pattern, $replacement, $content);
    
    file_put_contents($mediaFile, $content);
}

function updateWebsiteArticles() {
    $articlesFile = WEBSITE_DIR . 'media-coverage.html';
    if (!file_exists($articlesFile)) return;
    
    $articles = loadData(ARTICLES_DATA_FILE);
    $content = file_get_contents($articlesFile);
    
    // Generate articles HTML
    $articlesHtml = '';
    foreach ($articles as $article) {
        $articlesHtml .= generateArticleCardHtml($article);
    }
    
    // Replace existing articles grid content
    $pattern = '/(<div class="articles-grid" id="articlesGrid">).*?(<\/div>)/s';
    $replacement = '$1' . $articlesHtml . '$2';
    $content = preg_replace($pattern, $replacement, $content);
    
    file_put_contents($articlesFile, $content);
}

function updateWebsiteProjects() {
    // This would update the projects section in the main website
    // Implementation depends on how you want to structure the projects display
}

function updateWebsiteAwards() {
    // This would update the awards section in the main website
    // Implementation depends on how you want to structure the awards display
}

function updateWebsiteTimeline() {
    // This would update the timeline section in the main website
    // Implementation depends on how you want to structure the timeline display
}

function generateMediaCardHtml($item) {
    $thumbnail = $item['thumbnail'] ? $item['thumbnail'] : '🎬';
    $playOverlay = $item['youtube_url'] ? '<div class="play-overlay">▶</div>' : '';
    $onclick = $item['youtube_url'] ? "onclick=\"openMedia('{$item['youtube_url']}')\""  : '';
    
    return "
    <div class=\"media-card\" data-category=\"{$item['category']}\">
        <div class=\"media-thumbnail\" $onclick>
            " . (is_file(WEBSITE_DIR . $item['thumbnail']) ? "<img src=\"{$item['thumbnail']}\" alt=\"{$item['title_en']}\">" : $thumbnail) . "
            $playOverlay
        </div>
        <div class=\"media-content\">
            <div class=\"media-category\" data-en=\"" . strtoupper($item['category']) . "\" data-ar=\"" . strtoupper($item['category']) . "\">" . strtoupper($item['category']) . "</div>
            <h3 class=\"media-title\" data-en=\"{$item['title_en']}\" data-ar=\"{$item['title_ar']}\">{$item['title_en']}</h3>
            <div class=\"media-date\" data-en=\"{$item['date']}\" data-ar=\"{$item['date']}\">{$item['date']}</div>
            <p class=\"media-description\" data-en=\"{$item['description_en']}\" data-ar=\"{$item['description_ar']}\">{$item['description_en']}</p>
            <a href=\"{$item['external_link']}\" class=\"media-link\" data-en=\"View Content\" data-ar=\"شاهد المحتوى\">View Content</a>
        </div>
    </div>";
}

function generateArticleCardHtml($article) {
    $featured = $article['featured'] ? 'featured-article' : 'article-card';
    
    return "
    <div class=\"$featured\">
        <div class=\"article-image\">📰</div>
        <div class=\"article-content\">
            <div class=\"article-source\" data-en=\"" . strtoupper($article['source']) . "\" data-ar=\"" . strtoupper($article['source']) . "\">" . strtoupper($article['source']) . "</div>
            <h3 class=\"article-title\" data-en=\"{$article['title_en']}\" data-ar=\"{$article['title_ar']}\">{$article['title_en']}</h3>
            <div class=\"article-date\" data-en=\"{$article['pub_date']}\" data-ar=\"{$article['pub_date']}\">{$article['pub_date']}</div>
            <p class=\"article-excerpt\" data-en=\"{$article['excerpt_en']}\" data-ar=\"{$article['excerpt_ar']}\">{$article['excerpt_en']}</p>
            <a href=\"{$article['article_url']}\" class=\"article-link\" data-en=\"Read Article\" data-ar=\"اقرأ المقال\">Read Article</a>
        </div>
    </div>";
}
?>