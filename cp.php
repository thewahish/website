<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Control Panel | Obai Sukar Content Management</title>
    <style>
        @font-face {
            font-family: 'Roboto';
            src: url('./Fonts/Roboto-Regular.ttf') format('truetype');
            font-weight: 400;
            font-style: normal;
        }
        
        @font-face {
            font-family: 'Roboto';
            src: url('./Fonts/Roboto-Medium.ttf') format('truetype');
            font-weight: 500;
            font-style: normal;
        }
        
        @font-face {
            font-family: 'Roboto';
            src: url('./Fonts/Roboto-Black.ttf') format('truetype');
            font-weight: 900;
            font-style: normal;
        }
        
        :root {
            --deep-indigo: #292663;
            --warm-gold: #FBB04C;
            --sky-blue: #00AEEF;
            --vivid-magenta: #EC008C;
            --purple-plum: #92278F;
            --white: #FFFFFF;
            --light-gray: #F8F9FA;
            --text-dark: #292663;
            --text-light: #666666;
            --border-light: #E8F4FD;
            --success: #28a745;
            --warning: #ffc107;
            --danger: #dc3545;
        }

        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: 'Roboto', Arial, sans-serif;
            background: var(--light-gray);
            color: var(--text-dark);
            line-height: 1.6;
        }

        /* Header */
        .cp-header {
            background: linear-gradient(135deg, var(--deep-indigo), var(--sky-blue));
            color: var(--white);
            padding: 2rem;
            text-align: center;
            position: relative;
            overflow: hidden;
        }

        .cp-header::before {
            content: '';
            position: absolute;
            top: -50%;
            right: -50%;
            width: 200%;
            height: 200%;
            background: linear-gradient(45deg, transparent, rgba(255, 255, 255, 0.1), transparent);
            animation: shimmer 3s infinite;
        }

        @keyframes shimmer {
            0% { transform: translateX(-100%) translateY(-100%) rotate(45deg); }
            100% { transform: translateX(100%) translateY(100%) rotate(45deg); }
        }

        .cp-title {
            font-size: 2.5rem;
            font-weight: 900;
            margin-bottom: 0.5rem;
            position: relative;
            z-index: 1;
        }

        .cp-subtitle {
            font-size: 1.1rem;
            opacity: 0.9;
            position: relative;
            z-index: 1;
        }

        /* Navigation Tabs */
        .cp-nav {
            background: var(--white);
            padding: 1rem 2rem;
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
            display: flex;
            gap: 2rem;
            overflow-x: auto;
        }

        .nav-tab {
            padding: 0.8rem 1.5rem;
            background: transparent;
            border: none;
            color: var(--text-dark);
            font-weight: 500;
            cursor: pointer;
            border-radius: 25px;
            transition: all 0.3s ease;
            white-space: nowrap;
        }

        .nav-tab.active,
        .nav-tab:hover {
            background: var(--deep-indigo);
            color: var(--white);
            transform: translateY(-2px);
        }

        /* Main Content */
        .cp-container {
            max-width: 1200px;
            margin: 2rem auto;
            padding: 0 2rem;
        }

        .tab-content {
            display: none;
            animation: fadeIn 0.5s ease;
        }

        .tab-content.active {
            display: block;
        }

        @keyframes fadeIn {
            from { opacity: 0; transform: translateY(20px); }
            to { opacity: 1; transform: translateY(0); }
        }

        /* Cards */
        .content-card {
            background: var(--white);
            border-radius: 20px;
            padding: 2rem;
            margin-bottom: 2rem;
            box-shadow: 0 10px 30px rgba(0, 0, 0, 0.1);
            border: 1px solid var(--border-light);
        }

        .card-title {
            font-size: 1.5rem;
            color: var(--deep-indigo);
            margin-bottom: 1.5rem;
            font-weight: 600;
        }

        /* Forms */
        .form-grid {
            display: grid;
            gap: 1.5rem;
        }

        .form-row {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 1.5rem;
        }

        .form-group {
            display: flex;
            flex-direction: column;
        }

        .form-label {
            margin-bottom: 0.5rem;
            font-weight: 600;
            color: var(--text-dark);
        }

        .form-input,
        .form-textarea,
        .form-select {
            padding: 1rem;
            border: 2px solid var(--border-light);
            border-radius: 10px;
            font-family: inherit;
            font-size: 1rem;
            transition: all 0.3s ease;
        }

        .form-input:focus,
        .form-textarea:focus,
        .form-select:focus {
            outline: none;
            border-color: var(--sky-blue);
            box-shadow: 0 0 0 3px rgba(0, 174, 239, 0.1);
        }

        .form-textarea {
            min-height: 120px;
            resize: vertical;
        }

        .file-upload {
            position: relative;
            display: inline-block;
            cursor: pointer;
            width: 100%;
        }

        .file-upload input[type="file"] {
            position: absolute;
            opacity: 0;
            width: 100%;
            height: 100%;
            cursor: pointer;
        }

        .file-upload-label {
            display: flex;
            align-items: center;
            justify-content: center;
            padding: 2rem;
            border: 2px dashed var(--border-light);
            border-radius: 10px;
            background: var(--light-gray);
            transition: all 0.3s ease;
            text-align: center;
            font-weight: 500;
        }

        .file-upload:hover .file-upload-label {
            border-color: var(--sky-blue);
            background: rgba(0, 174, 239, 0.05);
        }

        .file-preview {
            margin-top: 1rem;
            padding: 1rem;
            background: var(--light-gray);
            border-radius: 10px;
            display: none;
        }

        /* Buttons */
        .btn {
            padding: 1rem 2rem;
            border: none;
            border-radius: 25px;
            font-weight: 600;
            cursor: pointer;
            transition: all 0.3s ease;
            text-decoration: none;
            display: inline-flex;
            align-items: center;
            justify-content: center;
            gap: 0.5rem;
        }

        .btn-primary {
            background: linear-gradient(135deg, var(--sky-blue), var(--deep-indigo));
            color: var(--white);
        }

        .btn-secondary {
            background: var(--light-gray);
            color: var(--text-dark);
            border: 2px solid var(--border-light);
        }

        .btn-success {
            background: var(--success);
            color: var(--white);
        }

        .btn-warning {
            background: var(--warning);
            color: var(--text-dark);
        }

        .btn-danger {
            background: var(--danger);
            color: var(--white);
        }

        .btn:hover {
            transform: translateY(-2px);
            box-shadow: 0 5px 15px rgba(0, 0, 0, 0.2);
        }

        .btn-group {
            display: flex;
            gap: 1rem;
            justify-content: flex-end;
            margin-top: 2rem;
        }

        /* Content List */
        .content-list {
            display: grid;
            gap: 1rem;
        }

        .content-item {
            background: var(--white);
            border: 2px solid var(--border-light);
            border-radius: 15px;
            padding: 1.5rem;
            display: flex;
            align-items: center;
            justify-content: space-between;
            transition: all 0.3s ease;
        }

        .content-item:hover {
            border-color: var(--sky-blue);
            transform: translateY(-2px);
        }

        .content-info {
            flex: 1;
        }

        .content-title {
            font-weight: 600;
            color: var(--deep-indigo);
            margin-bottom: 0.5rem;
        }

        .content-meta {
            color: var(--text-light);
            font-size: 0.9rem;
        }

        .content-actions {
            display: flex;
            gap: 0.5rem;
        }

        .action-btn {
            padding: 0.5rem 1rem;
            border: none;
            border-radius: 15px;
            cursor: pointer;
            font-size: 0.9rem;
            transition: all 0.3s ease;
        }

        .action-btn.edit {
            background: var(--warning);
            color: var(--text-dark);
        }

        .action-btn.delete {
            background: var(--danger);
            color: var(--white);
        }

        .action-btn:hover {
            transform: scale(1.05);
        }

        /* Stats Dashboard */
        .stats-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(200px, 1fr));
            gap: 1.5rem;
            margin-bottom: 2rem;
        }

        .stat-card {
            background: linear-gradient(135deg, var(--sky-blue), var(--deep-indigo));
            color: var(--white);
            padding: 2rem;
            border-radius: 20px;
            text-align: center;
            position: relative;
            overflow: hidden;
        }

        .stat-card::before {
            content: '';
            position: absolute;
            top: -50%;
            right: -50%;
            width: 200%;
            height: 200%;
            background: linear-gradient(45deg, transparent, rgba(255, 255, 255, 0.1), transparent);
            animation: shimmer 4s infinite;
        }

        .stat-number {
            font-size: 2.5rem;
            font-weight: 900;
            margin-bottom: 0.5rem;
            position: relative;
            z-index: 1;
        }

        .stat-label {
            font-size: 1rem;
            opacity: 0.9;
            position: relative;
            z-index: 1;
        }

        /* Notifications */
        .notification {
            padding: 1rem 1.5rem;
            border-radius: 10px;
            margin-bottom: 1rem;
            display: none;
            align-items: center;
            justify-content: space-between;
        }

        .notification.success {
            background: rgba(40, 167, 69, 0.1);
            color: var(--success);
            border: 1px solid var(--success);
        }

        .notification.error {
            background: rgba(220, 53, 69, 0.1);
            color: var(--danger);
            border: 1px solid var(--danger);
        }

        .notification.show {
            display: flex;
        }

        /* Loading */
        .loading {
            display: none;
            text-align: center;
            padding: 2rem;
            color: var(--text-light);
        }

        .loading.show {
            display: block;
        }

        /* Mobile Responsive */
        @media (max-width: 768px) {
            .cp-nav {
                flex-direction: column;
                gap: 1rem;
            }

            .form-row {
                grid-template-columns: 1fr;
            }

            .content-item {
                flex-direction: column;
                align-items: flex-start;
                gap: 1rem;
            }

            .content-actions {
                width: 100%;
                justify-content: flex-end;
            }

            .btn-group {
                flex-direction: column;
            }

            .stats-grid {
                grid-template-columns: 1fr;
            }
        }
    </style>
</head>
<body>
    <!-- Header -->
    <div class="cp-header">
        <h1 class="cp-title">Content Management Panel</h1>
        <p class="cp-subtitle">Manage your media, articles, projects, and website content</p>
    </div>

    <!-- Navigation -->
    <div class="cp-nav">
        <button class="nav-tab active" onclick="showTab('dashboard')">📊 Dashboard</button>
        <button class="nav-tab" onclick="showTab('media')">🎬 Media Gallery</button>
        <button class="nav-tab" onclick="showTab('articles')">📰 Media Coverage</button>
        <button class="nav-tab" onclick="showTab('projects')">🚀 Projects</button>
        <button class="nav-tab" onclick="showTab('awards')">🏆 Awards</button>
        <button class="nav-tab" onclick="showTab('timeline')">📅 Timeline</button>
        <button class="nav-tab" onclick="showTab('settings')">⚙️ Settings</button>
    </div>

    <!-- Main Container -->
    <div class="cp-container">
        <!-- Notifications -->
        <div id="notification" class="notification">
            <span id="notificationText"></span>
            <button onclick="hideNotification()" style="background: none; border: none; color: inherit; cursor: pointer; font-size: 1.2rem;">×</button>
        </div>

        <!-- Loading -->
        <div id="loading" class="loading">
            <div>Loading...</div>
        </div>

        <!-- Dashboard Tab -->
        <div id="dashboard" class="tab-content active">
            <div class="stats-grid">
                <div class="stat-card">
                    <div class="stat-number" id="mediaCount">0</div>
                    <div class="stat-label">Media Items</div>
                </div>
                <div class="stat-card">
                    <div class="stat-number" id="articlesCount">0</div>
                    <div class="stat-label">Articles</div>
                </div>
                <div class="stat-card">
                    <div class="stat-number" id="projectsCount">0</div>
                    <div class="stat-label">Projects</div>
                </div>
                <div class="stat-card">
                    <div class="stat-number" id="awardsCount">0</div>
                    <div class="stat-label">Awards</div>
                </div>
            </div>

            <div class="content-card">
                <h2 class="card-title">Quick Actions</h2>
                <div class="btn-group">
                    <button class="btn btn-primary" onclick="showTab('media')">📹 Add Media</button>
                    <button class="btn btn-primary" onclick="showTab('articles')">📰 Add Article</button>
                    <button class="btn btn-primary" onclick="showTab('projects')">🚀 Add Project</button>
                    <button class="btn btn-success" onclick="showTab('settings')">⚙️ Settings</button>
                </div>
            </div>
        </div>

        <!-- Media Gallery Tab -->
        <div id="media" class="tab-content">
            <div class="content-card">
                <h2 class="card-title">Add New Media</h2>
                <form id="mediaForm" class="form-grid" enctype="multipart/form-data">
                    <div class="form-row">
                        <div class="form-group">
                            <label class="form-label">Title (English)</label>
                            <input type="text" class="form-input" name="title_en" required>
                        </div>
                        <div class="form-group">
                            <label class="form-label">Title (Arabic)</label>
                            <input type="text" class="form-input" name="title_ar" required>
                        </div>
                    </div>
                    
                    <div class="form-row">
                        <div class="form-group">
                            <label class="form-label">Category</label>
                            <select class="form-select" name="category" required>
                                <option value="">Select Category</option>
                                <option value="karazah">Karazah Channel</option>
                                <option value="radio">Radio Al-Kul</option>
                                <option value="documentaries">Documentaries</option>
                                <option value="interviews">Interviews</option>
                                <option value="projects">Projects</option>
                            </select>
                        </div>
                        <div class="form-group">
                            <label class="form-label">Date</label>
                            <input type="date" class="form-input" name="date">
                        </div>
                    </div>

                    <div class="form-row">
                        <div class="form-group">
                            <label class="form-label">Description (English)</label>
                            <textarea class="form-textarea" name="description_en" rows="4"></textarea>
                        </div>
                        <div class="form-group">
                            <label class="form-label">Description (Arabic)</label>
                            <textarea class="form-textarea" name="description_ar" rows="4"></textarea>
                        </div>
                    </div>

                    <div class="form-row">
                        <div class="form-group">
                            <label class="form-label">YouTube URL</label>
                            <input type="url" class="form-input" name="youtube_url" placeholder="https://www.youtube.com/watch?v=...">
                        </div>
                        <div class="form-group">
                            <label class="form-label">External Link</label>
                            <input type="url" class="form-input" name="external_link">
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="form-label">Thumbnail Image</label>
                        <div class="file-upload">
                            <input type="file" name="thumbnail" accept="image/*" onchange="previewFile(this, 'thumbnailPreview')">
                            <div class="file-upload-label">
                                📁 Click to upload thumbnail image
                            </div>
                        </div>
                        <div id="thumbnailPreview" class="file-preview"></div>
                    </div>

                    <div class="btn-group">
                        <button type="button" class="btn btn-secondary" onclick="clearForm('mediaForm')">Clear</button>
                        <button type="submit" class="btn btn-primary">💾 Save Media</button>
                    </div>
                </form>
            </div>

            <div class="content-card">
                <h2 class="card-title">Existing Media</h2>
                <div class="content-list" id="mediaList">
                    <!-- Existing media items will be loaded here -->
                </div>
            </div>
        </div>

        <!-- Media Coverage Tab -->
        <div id="articles" class="tab-content">
            <div class="content-card">
                <h2 class="card-title">Add New Article/Coverage</h2>
                <form id="articleForm" class="form-grid">
                    <div class="form-row">
                        <div class="form-group">
                            <label class="form-label">Title (English)</label>
                            <input type="text" class="form-input" name="title_en" required>
                        </div>
                        <div class="form-group">
                            <label class="form-label">Title (Arabic)</label>
                            <input type="text" class="form-input" name="title_ar" required>
                        </div>
                    </div>
                    
                    <div class="form-row">
                        <div class="form-group">
                            <label class="form-label">Source/Publication</label>
                            <input type="text" class="form-input" name="source" required placeholder="e.g., NPR, Al Jazeera, Washington Post">
                        </div>
                        <div class="form-group">
                            <label class="form-label">Publication Date</label>
                            <input type="date" class="form-input" name="pub_date">
                        </div>
                    </div>

                    <div class="form-row">
                        <div class="form-group">
                            <label class="form-label">Excerpt (English)</label>
                            <textarea class="form-textarea" name="excerpt_en" rows="4"></textarea>
                        </div>
                        <div class="form-group">
                            <label class="form-label">Excerpt (Arabic)</label>
                            <textarea class="form-textarea" name="excerpt_ar" rows="4"></textarea>
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="form-label">Article URL</label>
                        <input type="url" class="form-input" name="article_url" required>
                    </div>

                    <div class="form-group">
                        <label class="form-label">Featured Article</label>
                        <select class="form-select" name="featured">
                            <option value="0">No</option>
                            <option value="1">Yes</option>
                        </select>
                    </div>

                    <div class="btn-group">
                        <button type="button" class="btn btn-secondary" onclick="clearForm('articleForm')">Clear</button>
                        <button type="submit" class="btn btn-primary">📰 Save Article</button>
                    </div>
                </form>
            </div>

            <div class="content-card">
                <h2 class="card-title">Existing Articles</h2>
                <div class="content-list" id="articlesList">
                    <!-- Existing articles will be loaded here -->
                </div>
            </div>
        </div>

        <!-- Projects Tab -->
        <div id="projects" class="tab-content">
            <div class="content-card">
                <h2 class="card-title">Add New Project</h2>
                <form id="projectForm" class="form-grid" enctype="multipart/form-data">
                    <div class="form-row">
                        <div class="form-group">
                            <label class="form-label">Project Name (English)</label>
                            <input type="text" class="form-input" name="name_en" required>
                        </div>
                        <div class="form-group">
                            <label class="form-label">Project Name (Arabic)</label>
                            <input type="text" class="form-input" name="name_ar" required>
                        </div>
                    </div>
                    
                    <div class="form-row">
                        <div class="form-group">
                            <label class="form-label">Role (English)</label>
                            <input type="text" class="form-input" name="role_en" required>
                        </div>
                        <div class="form-group">
                            <label class="form-label">Role (Arabic)</label>
                            <input type="text" class="form-input" name="role_ar" required>
                        </div>
                    </div>

                    <div class="form-row">
                        <div class="form-group">
                            <label class="form-label">Year/Period</label>
                            <input type="text" class="form-input" name="year" placeholder="e.g., 2016 or 2015-2018">
                        </div>
                        <div class="form-group">
                            <label class="form-label">Achievement (English)</label>
                            <input type="text" class="form-input" name="achievement_en">
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="form-label">Achievement (Arabic)</label>
                        <input type="text" class="form-input" name="achievement_ar">
                    </div>

                    <div class="form-row">
                        <div class="form-group">
                            <label class="form-label">Description (English)</label>
                            <textarea class="form-textarea" name="description_en" rows="4"></textarea>
                        </div>
                        <div class="form-group">
                            <label class="form-label">Description (Arabic)</label>
                            <textarea class="form-textarea" name="description_ar" rows="4"></textarea>
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="form-label">Project Logo/Image</label>
                        <div class="file-upload">
                            <input type="file" name="logo" accept="image/*" onchange="previewFile(this, 'logoPreview')">
                            <div class="file-upload-label">
                                📁 Click to upload project logo
                            </div>
                        </div>
                        <div id="logoPreview" class="file-preview"></div>
                    </div>

                    <div class="btn-group">
                        <button type="button" class="btn btn-secondary" onclick="clearForm('projectForm')">Clear</button>
                        <button type="submit" class="btn btn-primary">🚀 Save Project</button>
                    </div>
                </form>
            </div>

            <div class="content-card">
                <h2 class="card-title">Existing Projects</h2>
                <div class="content-list" id="projectsList">
                    <!-- Existing projects will be loaded here -->
                </div>
            </div>
        </div>

        <!-- Awards Tab -->
        <div id="awards" class="tab-content">
            <div class="content-card">
                <h2 class="card-title">Add New Award</h2>
                <form id="awardForm" class="form-grid" enctype="multipart/form-data">
                    <div class="form-row">
                        <div class="form-group">
                            <label class="form-label">Award Title (English)</label>
                            <input type="text" class="form-input" name="title_en" required>
                        </div>
                        <div class="form-group">
                            <label class="form-label">Award Title (Arabic)</label>
                            <input type="text" class="form-input" name="title_ar" required>
                        </div>
                    </div>
                    
                    <div class="form-row">
                        <div class="form-group">
                            <label class="form-label">Year</label>
                            <input type="number" class="form-input" name="year" min="1990" max="2030" required>
                        </div>
                        <div class="form-group">
                            <label class="form-label">Category (English)</label>
                            <input type="text" class="form-input" name="category_en">
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="form-label">Category (Arabic)</label>
                        <input type="text" class="form-input" name="category_ar">
                    </div>

                    <div class="form-group">
                        <label class="form-label">Award Icon</label>
                        <div class="file-upload">
                            <input type="file" name="icon" accept="image/*" onchange="previewFile(this, 'iconPreview')">
                            <div class="file-upload-label">
                                📁 Click to upload award icon
                            </div>
                        </div>
                        <div id="iconPreview" class="file-preview"></div>
                    </div>

                    <div class="btn-group">
                        <button type="button" class="btn btn-secondary" onclick="clearForm('awardForm')">Clear</button>
                        <button type="submit" class="btn btn-primary">🏆 Save Award</button>
                    </div>
                </form>
            </div>

            <div class="content-card">
                <h2 class="card-title">Existing Awards</h2>
                <div class="content-list" id="awardsList">
                    <!-- Existing awards will be loaded here -->
                </div>
            </div>
        </div>

        <!-- Timeline Tab -->
        <div id="timeline" class="tab-content">
            <div class="content-card">
                <h2 class="card-title">Add Timeline Event</h2>
                <form id="timelineForm" class="form-grid">
                    <div class="form-row">
                        <div class="form-group">
                            <label class="form-label">Year/Period</label>
                            <input type="text" class="form-input" name="period" required placeholder="e.g., 2016-2018 or 2020-Present">
                        </div>
                        <div class="form-group">
                            <label class="form-label">Company (English)</label>
                            <input type="text" class="form-input" name="company_en" required>
                        </div>
                    </div>

                    <div class="form-row">
                        <div class="form-group">
                            <label class="form-label">Company (Arabic)</label>
                            <input type="text" class="form-input" name="company_ar" required>
                        </div>
                        <div class="form-group">
                            <label class="form-label">Title (English)</label>
                            <input type="text" class="form-input" name="title_en" required>
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="form-label">Title (Arabic)</label>
                        <input type="text" class="form-input" name="title_ar" required>
                    </div>

                    <div class="form-row">
                        <div class="form-group">
                            <label class="form-label">Description (English)</label>
                            <textarea class="form-textarea" name="description_en" rows="4" required></textarea>
                        </div>
                        <div class="form-group">
                            <label class="form-label">Description (Arabic)</label>
                            <textarea class="form-textarea" name="description_ar" rows="4" required></textarea>
                        </div>
                    </div>

                    <div class="btn-group">
                        <button type="button" class="btn btn-secondary" onclick="clearForm('timelineForm')">Clear</button>
                        <button type="submit" class="btn btn-primary">📅 Save Timeline Event</button>
                    </div>
                </form>
            </div>

            <div class="content-card">
                <h2 class="card-title">Existing Timeline Events</h2>
                <div class="content-list" id="timelineList">
                    <!-- Existing timeline events will be loaded here -->
                </div>
            </div>
        </div>

        <!-- Settings Tab -->
        <div id="settings" class="tab-content">
            <div class="content-card">
                <h2 class="card-title">Website Settings</h2>
                <form id="settingsForm" class="form-grid">
                    <div class="form-row">
                        <div class="form-group">
                            <label class="form-label">Site Title (English)</label>
                            <input type="text" class="form-input" name="site_title_en" value="">
                        </div>
                        <div class="form-group">
                            <label class="form-label">Site Title (Arabic)</label>
                            <input type="text" class="form-input" name="site_title_ar" value="">
                        </div>
                    </div>

                    <div class="form-row">
                        <div class="form-group">
                            <label class="form-label">Email</label>
                            <input type="email" class="form-input" name="email" value="">
                        </div>
                        <div class="form-group">
                            <label class="form-label">LinkedIn URL</label>
                            <input type="url" class="form-input" name="linkedin" value="">
                        </div>
                    </div>

                    <div class="form-row">
                        <div class="form-group">
                            <label class="form-label">Karazah Subscribers</label>
                            <input type="text" class="form-input" name="karazah_subscribers" value="">
                        </div>
                        <div class="form-group">
                            <label class="form-label">Karazah Views</label>
                            <input type="text" class="form-input" name="karazah_views" value="">
                        </div>
                    </div>

                    <div class="btn-group">
                        <button type="button" class="btn btn-warning" onclick="resetSettings()">🔄 Reset to Defaults</button>
                        <button type="submit" class="btn btn-success">💾 Save Settings</button>
                    </div>
                </form>
            </div>

            <div class="content-card">
                <h2 class="card-title">Data Management</h2>
                <div class="btn-group">
                    <button class="btn btn-secondary" onclick="exportData()">📊 Export All Data</button>
                    <button class="btn btn-danger" onclick="confirmClearData()">🗑️ Clear All Data</button>
                </div>
            </div>
        </div>
    </div>

    <script>
        // API Configuration
        const API_BASE = './api/endpoints.php';

        // Utility Functions
        function makeRequest(action, method = 'GET', data = null) {
            const url = `${API_BASE}?action=${action}`;
            const options = {
                method: method,
                headers: method === 'POST' && !(data instanceof FormData) ? { 'Content-Type': 'application/x-www-form-urlencoded' } : {}
            };

            if (data) {
                if (method === 'POST') {
                    options.body = data instanceof FormData ? data : new URLSearchParams(data);
                }
            }

            return fetch(url, options)
                .then(response => response.json())
                .catch(error => {
                    console.error('Request failed:', error);
                    throw error;
                });
        }

        function showLoading() {
            document.getElementById('loading').classList.add('show');
        }

        function hideLoading() {
            document.getElementById('loading').classList.remove('show');
        }

        // Tab Management
        function showTab(tabName) {
            // Hide all tabs
            const tabs = document.querySelectorAll('.tab-content');
            tabs.forEach(tab => tab.classList.remove('active'));
            
            // Remove active class from all nav tabs
            const navTabs = document.querySelectorAll('.nav-tab');
            navTabs.forEach(tab => tab.classList.remove('active'));
            
            // Show selected tab
            document.getElementById(tabName).classList.add('active');
            
            // Add active class to clicked nav tab
            event.target.classList.add('active');
            
            // Load data for the tab
            loadTabData(tabName);
        }

        function loadTabData(tabName) {
            switch(tabName) {
                case 'dashboard':
                    loadStats();
                    break;
                case 'media':
                    loadMediaList();
                    break;
                case 'articles':
                    loadArticlesList();
                    break;
                case 'projects':
                    loadProjectsList();
                    break;
                case 'awards':
                    loadAwardsList();
                    break;
                case 'timeline':
                    loadTimelineList();
                    break;
                case 'settings':
                    loadSettings();
                    break;
            }
        }

        // File Preview
        function previewFile(input, previewId) {
            const preview = document.getElementById(previewId);
            const file = input.files[0];
            
            if (file) {
                const reader = new FileReader();
                reader.onload = function(e) {
                    if (file.type.startsWith('image/')) {
                        preview.innerHTML = `<img src="${e.target.result}" style="max-width: 200px; max-height: 200px; border-radius: 10px;">`;
                    } else {
                        preview.innerHTML = `<p>📎 ${file.name}</p>`;
                    }
                    preview.style.display = 'block';
                };
                reader.readAsDataURL(file);
            } else {
                preview.style.display = 'none';
            }
        }

        // Form Management
        function clearForm(formId) {
            const form = document.getElementById(formId);
            form.reset();
            
            // Clear file previews
            const previews = form.querySelectorAll('.file-preview');
            previews.forEach(preview => {
                preview.style.display = 'none';
                preview.innerHTML = '';
            });
        }

        // Notifications
        function showNotification(message, type = 'success') {
            const notification = document.getElementById('notification');
            const notificationText = document.getElementById('notificationText');
            
            notification.className = `notification ${type} show`;
            notificationText.textContent = message;
            
            // Auto-hide after 5 seconds
            setTimeout(() => {
                hideNotification();
            }, 5000);
        }

        function hideNotification() {
            const notification = document.getElementById('notification');
            notification.classList.remove('show');
        }

        // Data Loading Functions
        function loadStats() {
            makeRequest('get_stats')
                .then(data => {
                    document.getElementById('mediaCount').textContent = data.media_count || 0;
                    document.getElementById('articlesCount').textContent = data.articles_count || 0;
                    document.getElementById('projectsCount').textContent = data.projects_count || 0;
                    document.getElementById('awardsCount').textContent = data.awards_count || 0;
                })
                .catch(error => {
                    console.error('Failed to load stats:', error);
                });
        }

        function loadMediaList() {
            makeRequest('get_media')
                .then(data => {
                    const mediaList = document.getElementById('mediaList');
                    if (data.length === 0) {
                        mediaList.innerHTML = '<p style="text-align: center; color: var(--text-light);">No media items found. Add your first media item above!</p>';
                        return;
                    }
                    
                    mediaList.innerHTML = data.map(item => `
                        <div class="content-item">
                            <div class="content-info">
                                <div class="content-title">${item.title_en}</div>
                                <div class="content-meta">Category: ${item.category} | Added: ${item.created_at}</div>
                            </div>
                            <div class="content-actions">
                                <button class="action-btn delete" onclick="deleteMedia('${item.id}')">Delete</button>
                            </div>
                        </div>
                    `).join('');
                })
                .catch(error => {
                    console.error('Failed to load media:', error);
                    showNotification('Failed to load media list', 'error');
                });
        }

        function loadArticlesList() {
            makeRequest('get_articles')
                .then(data => {
                    const articlesList = document.getElementById('articlesList');
                    if (data.length === 0) {
                        articlesList.innerHTML = '<p style="text-align: center; color: var(--text-light);">No articles found. Add your first article above!</p>';
                        return;
                    }
                    
                    articlesList.innerHTML = data.map(item => `
                        <div class="content-item">
                            <div class="content-info">
                                <div class="content-title">${item.title_en}</div>
                                <div class="content-meta">Source: ${item.source} | Published: ${item.pub_date}</div>
                            </div>
                            <div class="content-actions">
                                <button class="action-btn delete" onclick="deleteArticle('${item.id}')">Delete</button>
                            </div>
                        </div>
                    `).join('');
                })
                .catch(error => {
                    console.error('Failed to load articles:', error);
                });
        }

        function loadProjectsList() {
            makeRequest('get_projects')
                .then(data => {
                    const projectsList = document.getElementById('projectsList');
                    if (data.length === 0) {
                        projectsList.innerHTML = '<p style="text-align: center; color: var(--text-light);">No projects found. Add your first project above!</p>';
                        return;
                    }
                    
                    projectsList.innerHTML = data.map(item => `
                        <div class="content-item">
                            <div class="content-info">
                                <div class="content-title">${item.name_en}</div>
                                <div class="content-meta">Year: ${item.year} | Role: ${item.role_en}</div>
                            </div>
                            <div class="content-actions">
                                <button class="action-btn delete" onclick="deleteProject('${item.id}')">Delete</button>
                            </div>
                        </div>
                    `).join('');
                })
                .catch(error => {
                    console.error('Failed to load projects:', error);
                });
        }

        function loadAwardsList() {
            makeRequest('get_awards')
                .then(data => {
                    const awardsList = document.getElementById('awardsList');
                    if (data.length === 0) {
                        awardsList.innerHTML = '<p style="text-align: center; color: var(--text-light);">No awards found. Add your first award above!</p>';
                        return;
                    }
                    
                    awardsList.innerHTML = data.map(item => `
                        <div class="content-item">
                            <div class="content-info">
                                <div class="content-title">${item.title_en}</div>
                                <div class="content-meta">Year: ${item.year} | Category: ${item.category_en}</div>
                            </div>
                            <div class="content-actions">
                                <button class="action-btn delete" onclick="deleteAward('${item.id}')">Delete</button>
                            </div>
                        </div>
                    `).join('');
                })
                .catch(error => {
                    console.error('Failed to load awards:', error);
                });
        }

        function loadTimelineList() {
            makeRequest('get_timeline')
                .then(data => {
                    const timelineList = document.getElementById('timelineList');
                    if (data.length === 0) {
                        timelineList.innerHTML = '<p style="text-align: center; color: var(--text-light);">No timeline events found. Add your first event above!</p>';
                        return;
                    }
                    
                    timelineList.innerHTML = data.map(item => `
                        <div class="content-item">
                            <div class="content-info">
                                <div class="content-title">${item.title_en}</div>
                                <div class="content-meta">Period: ${item.period} | Company: ${item.company_en}</div>
                            </div>
                            <div class="content-actions">
                                <button class="action-btn delete" onclick="deleteTimelineEvent('${item.id}')">Delete</button>
                            </div>
                        </div>
                    `).join('');
                })
                .catch(error => {
                    console.error('Failed to load timeline:', error);
                });
        }

        function loadSettings() {
            makeRequest('get_settings')
                .then(data => {
                    const form = document.getElementById('settingsForm');
                    Object.keys(data).forEach(key => {
                        const input = form.querySelector(`[name="${key}"]`);
                        if (input) {
                            input.value = data[key] || '';
                        }
                    });
                })
                .catch(error => {
                    console.error('Failed to load settings:', error);
                });
        }

        // Form Submissions
        document.getElementById('mediaForm').addEventListener('submit', function(e) {
            e.preventDefault();
            showLoading();
            
            const formData = new FormData(this);
            
            makeRequest('add_media', 'POST', formData)
                .then(response => {
                    hideLoading();
                    if (response.success) {
                        showNotification(response.message);
                        clearForm('mediaForm');
                        loadMediaList();
                        loadStats();
                    } else {
                        showNotification(response.error || 'Failed to add media', 'error');
                    }
                })
                .catch(error => {
                    hideLoading();
                    showNotification('Failed to add media', 'error');
                });
        });

        document.getElementById('articleForm').addEventListener('submit', function(e) {
            e.preventDefault();
            showLoading();
            
            const formData = new FormData(this);
            
            makeRequest('add_article', 'POST', formData)
                .then(response => {
                    hideLoading();
                    if (response.success) {
                        showNotification(response.message);
                        clearForm('articleForm');
                        loadArticlesList();
                        loadStats();
                    } else {
                        showNotification(response.error || 'Failed to add article', 'error');
                    }
                })
                .catch(error => {
                    hideLoading();
                    showNotification('Failed to add article', 'error');
                });
        });

        document.getElementById('projectForm').addEventListener('submit', function(e) {
            e.preventDefault();
            showLoading();
            
            const formData = new FormData(this);
            
            makeRequest('add_project', 'POST', formData)
                .then(response => {
                    hideLoading();
                    if (response.success) {
                        showNotification(response.message);
                        clearForm('projectForm');
                        loadProjectsList();
                        loadStats();
                    } else {
                        showNotification(response.error || 'Failed to add project', 'error');
                    }
                })
                .catch(error => {
                    hideLoading();
                    showNotification('Failed to add project', 'error');
                });
        });

        document.getElementById('awardForm').addEventListener('submit', function(e) {
            e.preventDefault();
            showLoading();
            
            const formData = new FormData(this);
            
            makeRequest('add_award', 'POST', formData)
                .then(response => {
                    hideLoading();
                    if (response.success) {
                        showNotification(response.message);
                        clearForm('awardForm');
                        loadAwardsList();
                        loadStats();
                    } else {
                        showNotification(response.error || 'Failed to add award', 'error');
                    }
                })
                .catch(error => {
                    hideLoading();
                    showNotification('Failed to add award', 'error');
                });
        });

        document.getElementById('timelineForm').addEventListener('submit', function(e) {
            e.preventDefault();
            showLoading();
            
            const formData = new FormData(this);
            
            makeRequest('add_timeline', 'POST', formData)
                .then(response => {
                    hideLoading();
                    if (response.success) {
                        showNotification(response.message);
                        clearForm('timelineForm');
                        loadTimelineList();
                    } else {
                        showNotification(response.error || 'Failed to add timeline event', 'error');
                    }
                })
                .catch(error => {
                    hideLoading();
                    showNotification('Failed to add timeline event', 'error');
                });
        });

        document.getElementById('settingsForm').addEventListener('submit', function(e) {
            e.preventDefault();
            showLoading();
            
            const formData = new FormData(this);
            
            makeRequest('save_settings', 'POST', formData)
                .then(response => {
                    hideLoading();
                    if (response.success) {
                        showNotification(response.message);
                    } else {
                        showNotification(response.error || 'Failed to save settings', 'error');
                    }
                })
                .catch(error => {
                    hideLoading();
                    showNotification('Failed to save settings', 'error');
                });
        });

        // Delete Functions
        function deleteMedia(id) {
            if (confirm('Are you sure you want to delete this media item?')) {
                makeRequest('delete_media', 'POST', { id: id })
                    .then(response => {
                        if (response.success) {
                            showNotification('Media deleted successfully');
                            loadMediaList();
                            loadStats();
                        } else {
                            showNotification('Failed to delete media', 'error');
                        }
                    });
            }
        }

        // Initialize on load
        document.addEventListener('DOMContentLoaded', function() {
            loadStats();
            loadMediaList();
        });
    </script>
</body>
</html>