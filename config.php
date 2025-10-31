<?php
// Configurações do wallpaper
define('WALLPAPER_PATH', __DIR__ . '/img/wallpaper.jpg');
define('WALLPAPER_PATH_WEB', 'img/wallpaper.jpg');
define('DEFAULT_WALLPAPER', 'https://images.unsplash.com/photo-1503376780353-7e6692767b70?ixlib=rb-4.0.3&auto=format&fit=crop&w=2070&q=80');

function getWallpaperStyle() {
    $localPath = WALLPAPER_PATH;
    $webPath = WALLPAPER_PATH_WEB;
    $defaultWallpaper = DEFAULT_WALLPAPER;
    
    // Verifica se o arquivo local existe
    if (file_exists($localPath)) {
        $wallpaperUrl = $webPath;
    } else {
        $wallpaperUrl = $defaultWallpaper;
    }
    
    return "
        <style>
            body::before {
                content: '';
                position: fixed;
                top: 0;
                left: 0;
                width: 100%;
                height: 100%;
                background: 
                    radial-gradient(circle at 20% 80%, rgba(30, 122, 76, 0.08) 0%, transparent 50%),
                    radial-gradient(circle at 80% 20%, rgba(42, 157, 111, 0.05) 0%, transparent 50%),
                    linear-gradient(rgba(10, 10, 10, 0.85), rgba(15, 15, 15, 0.90)), 
                    url('{$wallpaperUrl}') center/cover no-repeat;
                z-index: -1;
            }
        </style>
    ";
}
?>