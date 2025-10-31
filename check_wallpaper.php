<?php
// check_wallpaper.php
$wallpaper_path = __DIR__ . '/img/wallpaper.jpg';

echo "<h1>Verificando Wallpaper</h1>";
echo "<p>Caminho: " . $wallpaper_path . "</p>";

if (file_exists($wallpaper_path)) {
    echo "<p style='color: green;'>✅ Arquivo wallpaper.jpg EXISTE</p>";
    echo "<p>Tamanho: " . filesize($wallpaper_path) . " bytes</p>";
    echo "<img src='img/wallpaper.jpg' style='max-width: 500px; border: 2px solid green;'>";
} else {
    echo "<p style='color: red;'>❌ Arquivo wallpaper.jpg NÃO ENCONTRADO</p>";
    echo "<p>Verifique se o arquivo está na pasta img/</p>";
}
?>