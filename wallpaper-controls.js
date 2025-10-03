// wallpaper-control.js
class WallpaperControls {
    constructor() {
        this.init();
    }
    
    init() {
        this.createControls();
        this.loadPreference();
        this.addEventListeners();
    }
    
    createControls() {
        const controlsHTML = `
            <div class="wallpaper-controls" style="position:fixed; left:12px; bottom:12px; z-index:9998; background:rgba(0,0,0,0.5); padding:8px; border-radius:8px;">
                <h4 style="color:white; margin:0 0 6px 0; font-size:14px;">Papel de Parede</h4>
                <div class="wallpaper-buttons">
                    <button class="btn btn-outline" data-wallpaper="none">Sem Fundo</button>
                    <button class="btn btn-outline" data-wallpaper="local">Local</button>
                    <button class="btn btn-outline" data-wallpaper="online">Online</button>
                </div>
            </div>
        `;
        
        document.body.insertAdjacentHTML('beforeend', controlsHTML);
    }
    
    addEventListeners() {
        const buttons = document.querySelectorAll('[data-wallpaper]');
        
        buttons.forEach(button => {
            button.addEventListener('click', (e) => {
                const type = e.target.getAttribute('data-wallpaper');
                this.setWallpaper(type);
                this.savePreference(type);
                // ativo visual
                buttons.forEach(b => b.classList.remove('btn-primary'));
                e.target.classList.add('btn-primary');
            });
        });
    }
    
    setWallpaper(type) {
        document.body.classList.remove('wallpaper-local', 'wallpaper-online', 'wallpaper-none');
        if (type === 'local') {
            document.body.classList.add('wallpaper-local');
            document.documentElement.style.setProperty('--local-wallpaper', "url('img/wallpaper.jpg')");
            document.body.style.setProperty('--wp', "url('img/wallpaper.jpg')");
            document.body.style.backgroundImage = "";
            // apply via inline style class not strictly necessary because we use body::before in css
        } else if (type === 'online') {
            document.body.classList.add('wallpaper-online');
        } else {
            document.body.classList.add('wallpaper-none');
        }
    }
    
    savePreference(type) {
        localStorage.setItem('wallpaperPreference', type);
    }
    
    loadPreference() {
        const preference = localStorage.getItem('wallpaperPreference') || 'online';
        this.setWallpaper(preference);
        
        // Atualiza o botão ativo
        const buttons = document.querySelectorAll('[data-wallpaper]');
        buttons.forEach(button => {
            button.classList.remove('btn-primary');
            if (button.getAttribute('data-wallpaper') === preference) {
                button.classList.add('btn-primary');
            }
        });
    }
}

document.addEventListener('DOMContentLoaded', () => {
    // apenas inicializa se o componente estiver presente
    if (typeof WallpaperControls !== 'undefined') {
        try {
            new WallpaperControls();
        } catch (e) {
            // não quebrar página
            console.error(e);
        }
    } else {
        new WallpaperControls();
    }
});
