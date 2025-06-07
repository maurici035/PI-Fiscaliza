<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Fiscaliza+ | Gerenciar Denúncias</title>
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
            font-family: Arial, sans-serif;
        }

        body {
            background-color: #f0f2f5;
        }

        .container {
            display: flex;
            min-height: 100vh;
        }

        /* Main content styling */
        .main-content {
            flex: 1;
            padding: 20px;
        }

        .header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 30px;
        }

        .logo {
            color: #0288d1;
            font-size: 24px;
            font-weight: bold;
        }

        .profile-section {
            display: flex;
            flex-direction: column;
            align-items: center;
            margin-bottom: 30px;
        }

        .profile-img {
            width: 125px;
            height: 125px;
            border-radius: 50%;
            object-fit: cover;
            margin-bottom: 15px;
        }

        .profile-name {
            background-color: #0288d1;
            color: white;
            padding: 8px 20px;
            border-radius: 20px;
            font-weight: bold;
        }

        .tabs {
            margin-bottom: 20px;
        }

        .tab {
            display: inline-block;
            padding: 8px 15px;
            background-color: #0288d1;
            color: white;
            border-radius: 20px;
            font-size: 14px;
            margin-right: 10px;
            cursor: pointer;
        }

        .gallery {
            display: grid;
            grid-template-columns: repeat(auto-fill, minmax(200px, 1fr));
            gap: 20px;
            margin-bottom: 30px;
        }

        .gallery-item {
            position: relative;
            border-radius: 10px;
            overflow: hidden;
            cursor: pointer;
        }

        .gallery-img {
            width: 100%;
            height: 160px;
            object-fit: cover;
        }

        .visualize-btn {
            position: absolute;
            bottom: 10px;
            left: 50%;
            transform: translateX(-50%);
            background-color: #00e676;
            color: white;
            border: none;
            padding: 5px 15px;
            border-radius: 20px;
            cursor: pointer;
            font-size: 14px;
        }

        .settings-icon {
            width: 40px;
            height: 40px;
            border-radius: 50%;
            display: flex;
            justify-content: center;
            align-items: center;
            font-size: 22px;
            color: #333;
            background-color: transparent;
        }

        .footer {
            display: flex;
            justify-content: center;
            align-items: center;
            padding: 20px;
            background-color: #333;
            color: white;
            margin-top: 40px;
        }

        .footer-logo {
            width: 80px;
            margin-right: 20px;
        }

        .footer-text {
            text-align: right;
            font-size: 12px;
        }
    </style>
    <script src="../../public/js/sidebar-loader.js"></script>
    <link rel="icon" href="../assets/logo-menor.png" type="image/png">
</head>
<body>
    <div id="sidebar-container"></div>
 

        <!-- Main Content -->
        <div class="main-content">
            <!-- Header -->
            <div class="header">
                <div class="logo">Fiscaliza+</div>
                <div class="settings-icon">⚙️</div>
            </div>

            <!-- Profile Section -->
            <div class="profile-section">
                <img src="/api/placeholder/125/125" alt="Profile" class="profile-img">
                <div class="profile-name">Maria Rita</div>
            </div>

            <!-- Tabs Section -->
            <div class="tabs">
                <div class="tab">Concluídas</div>
            </div>

            <!-- Gallery Section - Concluídas -->
            <div class="gallery" id="gallery-completed">
                <!-- Gallery items will be dynamically added here -->
            </div>

            <!-- Tabs Section -->
            <div class="tabs">
                <div class="tab">Não Aceitas</div>
            </div>

            <!-- Gallery Section - Não Aceitas -->
            <div class="gallery" id="gallery-rejected">
                <!-- Gallery items will be dynamically added here -->
            </div>

            <!-- Footer -->
            <div class="footer">
                <img src="/api/placeholder/80/80" alt="Logo" class="footer-logo">
                <div class="footer-text">
                    © 2019 Lift Media. All Rights Reserved.
                </div>
            </div>
        </div>
    </div>

    <script>
        // Sample data for completed reports
        const completedReports = [
            { id: 1, imageUrl: "/api/placeholder/200/160" },
            { id: 2, imageUrl: "/api/placeholder/200/160" },
            { id: 3, imageUrl: "/api/placeholder/200/160" },
            { id: 4, imageUrl: "/api/placeholder/200/160" },
            { id: 5, imageUrl: "/api/placeholder/200/160" },
            { id: 6, imageUrl: "/api/placeholder/200/160" }
        ];

        // Sample data for rejected reports
        const rejectedReports = [
            { id: 7, imageUrl: "/api/placeholder/200/160" },
            { id: 8, imageUrl: "/api/placeholder/200/160" },
            { id: 9, imageUrl: "/api/placeholder/200/160" },
            { id: 10, imageUrl: "/api/placeholder/200/160" },
            { id: 11, imageUrl: "/api/placeholder/200/160" },
            { id: 12, imageUrl: "/api/placeholder/200/160" }
        ];

        // Function to create gallery items
        function createGalleryItems(reports, galleryId) {
            const gallery = document.getElementById(galleryId);
            
            reports.forEach(report => {
                const galleryItem = document.createElement('div');
                galleryItem.className = 'gallery-item';
                
                const img = document.createElement('img');
                img.src = report.imageUrl;
                img.className = 'gallery-img';
                img.alt = 'Report ' + report.id;
                
                const button = document.createElement('button');
                button.className = 'visualize-btn';
                button.textContent = 'Visualizar';
                
                galleryItem.appendChild(img);
                galleryItem.appendChild(button);
                gallery.appendChild(galleryItem);
            });
        }

        // Initialize galleries
        document.addEventListener('DOMContentLoaded', function() {
            createGalleryItems(completedReports, 'gallery-completed');
            createGalleryItems(rejectedReports, 'gallery-rejected');
        });
    </script>
</body>
</html>