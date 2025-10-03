// lang-switcher.js
(() => {
    const translations = {
      pt: {
        // Navegação
        area_admin: "Área Administrativa",
        voltar_catalogo: "Voltar ao Catálogo",
        sair: "Sair",
        inicio: "Início",
        catalogo: "Catálogo",
        administracao: "Administração",
        entrar: "Entrar",
        cadastrar: "Cadastrar",
        
        // Formulários
        adicionar_novo: "Adicionar Novo Carro",
        adicionar_carro: "Adicionar Carro",
        titulo_carro: "Título do carro",
        descricao_carro: "Descrição do carro",
        imagem_carro: "Nome da imagem (ex: car6.jpg)",
        adicionar: "Adicionar",
        salvar: "Salvar Alterações",
        cancelar: "Cancelar",
        editar: "Editar",
        excluir: "Excluir",
        disponivel: "Disponível",
        
        // Listas e tabelas
        lista_carros: "Lista de Carros",
        id: "ID",
        titulo: "Título",
        descricao: "Descrição",
        imagem: "Imagem",
        acoes: "Ações",
        carros_disponiveis: "Carros Disponíveis",
        nossos_carros: "Nossos Carros",
        
        // Estados
        nenhum_carro: "Nenhum carro cadastrado.",
        nenhum_carro_disponivel: "Nenhum carro disponível no momento.",
        
        // Página inicial
        bem_vindo: "BEM VINDO",
        fazer_login: "Fazer login",
        ja_tem_conta: "Já tem conta? Entrar",
        nao_possui_cadastro: "Não possui cadastro? Cadastrar",
        
        // Descrições dos carros
        honda_civic_type_r: "Honda Civic Type-R",
        honda_civic_desc: "O Honda Civic Type-R é a versão mais extrema do Civic, equipado com um motor 2.0L VTEC Turbo que produz 320 cv. Com tração dianteira e câmbio manual de 6 velocidades, oferece performance excepcional com aerodinâmica agressiva, incluindo um grande spoiler traseiro e detalhes em vermelho que destacam seu caráter esportivo. Interior com bancos esportivos Recaro e tecnologia Honda CONNECT.",
        
        mitsubishi_evolution: "Mitsubishi Lancer Evolution",
        mitsubishi_evolution_desc: "Lenda dos ralis, o Lancer Evolution X conta com motor 2.0L MIVEC Turbo de 300 cv e tração integral S-AWC (Super All Wheel Control). Sistema de transmissão Twin-Clutch SST de 6 velocidades ou manual. Suspensão Bilstein, freios Brembo e diferencial traseiro ativo. Design agressivo com capô com entradas de ar e aerofólio característico.",
        
        chevrolet_corvette: "Chevrolet Corvette Stingray",
        chevrolet_corvette_desc: "O Corvette Stingray C8 revoluciona com motor central V8 6.2L LT2 que entrega 495 cv. Primeiro Corvette com motor central na história. Aceleração 0-100 km/h em 2.9 segundos. Câmbio automatizado de 8 velocidades, chassis de fibra de carbono e modos de condução que incluem Weather, Tour, Sport e Track. Interior premium com materiais de alta qualidade.",
        
        volkswagen_golf: "Volkswagen Golf GTI",
        volkswagen_golf_desc: "Ícone dos hot hatches, o Golf GTI possui motor 2.0L TSI de 245 cv com câmbio DSG de 7 velocidades ou manual de 6. Suspensão esportiva, diferencial de escorregamento limitado eletrônico VAQ e modo Race. Design com detalhes em vermelho, grades GTI específicas e rodas de 18'. Interior com bancos xadrez tartan e volante plano multifuncional.",
        
        subaru_wrx: "Subaru Impreza WRX STI",
        subaru_wrx_desc: "O Subaru Impreza WRX STI é uma lenda do mundo dos rallys, equipado com motor boxer EJ25 2.5L turbo de 305 cv e tração integral Symmetrical AWD. Sistema de controle de tração DCCD (Driver Controlled Center Differential), suspensão esportiva Bilstein, freios Brembo de 6 pistões e diferencial traseiro de deslizamento limitado. Câmbio manual de 6 velocidades de curso curto. Design icônico com grande spoiler traseiro, capô com intercooler e saídas de ar características.",
        
        bmw_e36: "BMW E36 M3",
        bmw_e36_desc: "O BMW E36 M3 é um ícone dos esportivos alemães, movido pelo motor S50B32 3.2L inline-6 que produz 321 cv. Câmbio manual de 6 velocidades ou SMG de primeira geração, tração traseira com diferencial de deslizamento limitado. Suspensão M específica com amortecedores esportivos, freios ventilados de grande diâmetro e direção de assistência variável.",
        
        // Textos da página inicial
        select_car_motors: "SELECT CAR MOTORS",
        bem_vindo_site: "AO NOSSO SITE",
        subtitulo_home: "Encontre carros esportivos e exclusivos — confira nosso catálogo.",
        ver_catalogo: "Ver Catálogo",
        area_administrativa: "Área Administrativa",
        
        // Mensagens de sucesso/erro
        carro_adicionado_sucesso: "Carro adicionado com sucesso!",
        carro_atualizado_sucesso: "Carro atualizado com sucesso!",
        cadastro_realizado_sucesso: "Cadastro realizado com sucesso! Faça login.",
        usuario_senha_invalidos: "Usuário ou senha inválidos!",
        todos_campos_obrigatorios: "Todos os campos são obrigatórios.",
        senha_minimo_caracteres: "A senha deve ter pelo menos 6 caracteres.",
        usuario_email_cadastrado: "Usuário ou e-mail já cadastrado.",
        
        // Placeholders
        placeholder_usuario: "Usuário",
        placeholder_senha: "Senha",
        placeholder_email: "E-mail",
        placeholder_nome_completo: "Nome completo",
        placeholder_senha_minimo: "Senha (mínimo 6 caracteres)",
        
        // Outros
        teste_drive_disponivel: "Disponível para teste drive",
        isaias_42_8: "Eu sou o Senhor; este é o meu nome! Não darei a outro a minha glória nem a imagens o meu louvor.",
        isaias: "Isaías 42:8"
      },
      en: {
        // Navigation
        area_admin: "Admin Area",
        voltar_catalogo: "Back to Catalog",
        sair: "Logout",
        inicio: "Home",
        catalogo: "Catalog",
        administracao: "Administration",
        entrar: "Login",
        cadastrar: "Register",
        
        // Forms
        adicionar_novo: "Add New Car",
        adicionar_carro: "Add Car",
        titulo_carro: "Car title",
        descricao_carro: "Car description",
        imagem_carro: "Image filename (eg: car6.jpg)",
        adicionar: "Add",
        salvar: "Save Changes",
        cancelar: "Cancel",
        editar: "Edit",
        excluir: "Delete",
        disponivel: "Available",
        
        // Lists and tables
        lista_carros: "Cars List",
        id: "ID",
        titulo: "Title",
        descricao: "Description",
        imagem: "Image",
        acoes: "Actions",
        carros_disponiveis: "Available Cars",
        nossos_carros: "Our Cars",
        
        // States
        nenhum_carro: "No cars registered.",
        nenhum_carro_disponivel: "No cars available at the moment.",
        
        // Home page
        bem_vindo: "WELCOME",
        fazer_login: "Login",
        ja_tem_conta: "Already have an account? Login",
        nao_possui_cadastro: "Don't have an account? Register",
        
        // Car descriptions
        honda_civic_type_r: "Honda Civic Type-R",
        honda_civic_desc: "The Honda Civic Type-R is the most extreme version of the Civic, equipped with a 2.0L VTEC Turbo engine producing 320 hp. With front-wheel drive and 6-speed manual transmission, it offers exceptional performance with aggressive aerodynamics, including a large rear spoiler and red details that highlight its sporty character. Interior with Recaro sports seats and Honda CONNECT technology.",
        
        mitsubishi_evolution: "Mitsubishi Lancer Evolution",
        mitsubishi_evolution_desc: "Rally legend, the Lancer Evolution X features a 2.0L MIVEC Turbo engine with 300 hp and S-AWC (Super All Wheel Control) all-wheel drive. 6-speed Twin-Clutch SST transmission or manual. Bilstein suspension, Brembo brakes and active rear differential. Aggressive design with hood air intakes and characteristic rear wing.",
        
        chevrolet_corvette: "Chevrolet Corvette Stingray",
        chevrolet_corvette_desc: "The Corvette Stingray C8 revolutionizes with a mid-engine V8 6.2L LT2 delivering 495 hp. First Corvette with mid-engine in history. 0-100 km/h acceleration in 2.9 seconds. 8-speed automated transmission, carbon fiber chassis and drive modes including Weather, Tour, Sport and Track. Premium interior with high-quality materials.",
        
        volkswagen_golf: "Volkswagen Golf GTI",
        volkswagen_golf_desc: "Icon of hot hatches, the Golf GTI has a 2.0L TSI engine with 245 hp with 7-speed DSG transmission or 6-speed manual. Sports suspension, electronic limited-slip differential VAQ and Race mode. Design with red details, specific GTI grilles and 18' wheels. Interior with tartan plaid seats and flat multifunction steering wheel.",
        
        subaru_wrx: "Subaru Impreza WRX STI",
        subaru_wrx_desc: "The Subaru Impreza WRX STI is a rally world legend, equipped with an EJ25 2.5L turbo boxer engine producing 305 hp and Symmetrical AWD all-wheel drive. DCCD (Driver Controlled Center Differential) traction control system, Bilstein sports suspension, 6-piston Brembo brakes and limited-slip rear differential. 6-speed short-throw manual transmission. Iconic design with large rear spoiler, intercooler hood and characteristic air outlets.",
        
        bmw_e36: "BMW E36 M3",
        bmw_e36_desc: "The BMW E36 M3 is an icon of German sports cars, powered by the S50B32 3.2L inline-6 engine producing 321 hp. 6-speed manual transmission or first-generation SMG, rear-wheel drive with limited-slip differential. M-specific suspension with sports dampers, large diameter ventilated brakes and variable assistance steering.",
        
        // Home page texts
        select_car_motors: "SELECT CAR MOTORS",
        bem_vindo_site: "TO OUR WEBSITE",
        subtitulo_home: "Find sports and exclusive cars — check out our catalog.",
        ver_catalogo: "View Catalog",
        area_administrativa: "Admin Area",
        
        // Success/error messages
        carro_adicionado_sucesso: "Car added successfully!",
        carro_atualizado_sucesso: "Car updated successfully!",
        cadastro_realizado_sucesso: "Registration completed successfully! Please login.",
        usuario_senha_invalidos: "Invalid username or password!",
        todos_campos_obrigatorios: "All fields are required.",
        senha_minimo_caracteres: "Password must be at least 6 characters.",
        usuario_email_cadastrado: "Username or email already registered.",
        
        // Placeholders
        placeholder_usuario: "Username",
        placeholder_senha: "Password",
        placeholder_email: "Email",
        placeholder_nome_completo: "Full name",
        placeholder_senha_minimo: "Password (minimum 6 characters)",
        
        // Others
        teste_drive_disponivel: "Available for test drive",
        isaias_42_8: "I am the Lord; that is my name! I will not yield my glory to another or my praise to idols.",
        isaias: "Isaiah 42:8"
      },
      es: {
        // Navegación
        area_admin: "Área Administrativa",
        voltar_catalogo: "Volver al Catálogo",
        sair: "Salir",
        inicio: "Inicio",
        catalogo: "Catálogo",
        administracao: "Administración",
        entrar: "Entrar",
        cadastrar: "Registrarse",
        
        // Formularios
        adicionar_novo: "Agregar Nuevo Auto",
        adicionar_carro: "Agregar Auto",
        titulo_carro: "Título del auto",
        descricao_carro: "Descripción del auto",
        imagem_carro: "Nombre de imagen (ej: car6.jpg)",
        adicionar: "Agregar",
        salvar: "Guardar Cambios",
        cancelar: "Cancelar",
        editar: "Editar",
        excluir: "Eliminar",
        disponivel: "Disponible",
        
        // Listas y tablas
        lista_carros: "Lista de Autos",
        id: "ID",
        titulo: "Título",
        descricao: "Descripción",
        imagem: "Imagen",
        acoes: "Acciones",
        carros_disponiveis: "Autos Disponibles",
        nossos_carros: "Nuestros Autos",
        
        // Estados
        nenhum_carro: "No hay autos registrados.",
        nenhum_carro_disponivel: "No hay autos disponibles en este momento.",
        
        // Página de inicio
        bem_vindo: "BIENVENIDO",
        fazer_login: "Iniciar sesión",
        ja_tem_conta: "¿Ya tienes cuenta? Iniciar sesión",
        nao_possui_cadastro: "¿No tienes cuenta? Registrarse",
        
        // Descripciones de autos
        honda_civic_type_r: "Honda Civic Type-R",
        honda_civic_desc: "El Honda Civic Type-R es la versión más extrema del Civic, equipado con un motor 2.0L VTEC Turbo que produce 320 cv. Con tracción delantera y transmisión manual de 6 velocidades, ofrece un rendimiento excepcional con aerodinámica agresiva, incluyendo un gran alerón trasero y detalles en rojo que destacan su carácter deportivo. Interior con asientos deportivos Recaro y tecnología Honda CONNECT.",
        
        mitsubishi_evolution: "Mitsubishi Lancer Evolution",
        mitsubishi_evolution_desc: "Leyenda de los rallys, el Lancer Evolution X cuenta con motor 2.0L MIVEC Turbo de 300 cv y tracción integral S-AWC (Super All Wheel Control). Sistema de transmisión Twin-Clutch SST de 6 velocidades o manual. Suspensión Bilstein, frenos Brembo y diferencial trasero activo. Diseño agresivo con capó con entradas de aire y alerón característico.",
        
        chevrolet_corvette: "Chevrolet Corvette Stingray",
        chevrolet_corvette_desc: "El Corvette Stingray C8 revoluciona con motor central V8 6.2L LT2 que entrega 495 cv. Primer Corvette con motor central en la historia. Aceleración 0-100 km/h en 2.9 segundos. Transmisión automatizada de 8 velocidades, chasis de fibra de carbono y modos de conducción que incluyen Weather, Tour, Sport y Track. Interior premium con materiales de alta calidad.",
        
        volkswagen_golf: "Volkswagen Golf GTI",
        volkswagen_golf_desc: "Ícono de los hot hatches, el Golf GTI posee motor 2.0L TSI de 245 cv con transmisión DSG de 7 velocidades o manual de 6. Suspensión deportiva, diferencial de deslizamiento limitado electrónico VAQ y modo Race. Diseño con detalles en rojo, rejillas GTI específicas y llantas de 18'. Interior con asientos de cuadros tartán y volante plano multifuncional.",
        
        subaru_wrx: "Subaru Impreza WRX STI",
        subaru_wrx_desc: "El Subaru Impreza WRX STI es una leyenda del mundo de los rallys, equipado con motor boxer EJ25 2.5L turbo de 305 cv y tracción integral Symmetrical AWD. Sistema de control de tracción DCCD (Driver Controlled Center Differential), suspensión deportiva Bilstein, frenos Brembo de 6 pistones y diferencial trasero de deslizamiento limitado. Transmisión manual de 6 velocidades de recorrido corto. Diseño icónico con gran alerón trasero, capó con intercooler y salidas de aire características.",
        
        bmw_e36: "BMW E36 M3",
        bmw_e36_desc: "El BMW E36 M3 es un ícono de los deportivos alemanes, movido por el motor S50B32 3.2L inline-6 que produce 321 cv. Transmisión manual de 6 velocidades o SMG de primera generación, tracción trasera con diferencial de deslizamiento limitado. Suspensión M específica con amortiguadores deportivos, frenos ventilados de gran diámetro y dirección de asistencia variable.",
        
        // Textos de la página de inicio
        select_car_motors: "SELECT CAR MOTORS",
        bem_vindo_site: "A NUESTRO SITIO",
        subtitulo_home: "Encuentra autos deportivos y exclusivos — consulta nuestro catálogo.",
        ver_catalogo: "Ver Catálogo",
        area_administrativa: "Área Administrativa",
        
        // Mensajes de éxito/error
        carro_adicionado_sucesso: "¡Auto agregado con éxito!",
        carro_atualizado_sucesso: "¡Auto actualizado con éxito!",
        cadastro_realizado_sucesso: "¡Registro realizado con éxito! Inicia sesión.",
        usuario_senha_invalidos: "¡Usuario o contraseña inválidos!",
        todos_campos_obrigatorios: "Todos los campos son obligatorios.",
        senha_minimo_caracteres: "La contraseña debe tener al menos 6 caracteres.",
        usuario_email_cadastrado: "Usuario o email ya registrado.",
        
        // Placeholders
        placeholder_usuario: "Usuario",
        placeholder_senha: "Contraseña",
        placeholder_email: "Correo electrónico",
        placeholder_nome_completo: "Nombre completo",
        placeholder_senha_minimo: "Contraseña (mínimo 6 caracteres)",
        
        // Otros
        teste_drive_disponivel: "Disponible para prueba de manejo",
        isaias_42_8: "Yo soy el Señor; ¡ése es mi nombre! No cederé mi gloria a otro ni mi alabanza a ídolos.",
        isaias: "Isaías 42:8"
      }
    };

    // Cria o botão flutuante
    function createSwitcher() {
      const wrapper = document.createElement('div');
      wrapper.id = 'lang-switcher';
      wrapper.style.position = 'fixed';
      wrapper.style.right = '12px';
      wrapper.style.bottom = '12px';
      wrapper.style.zIndex = 9999;
      wrapper.style.display = 'flex';
      wrapper.style.gap = '15px';
      wrapper.innerHTML = `
        <button class="btn btn-outline" data-lang="pt" title="Português">PT</button>
        <button class="btn btn-outline" data-lang="en" title="English">EN</button>
        <button class="btn btn-outline" data-lang="es" title="Español">ES</button>
      `;
      document.body.appendChild(wrapper);

      wrapper.addEventListener('click', (e) => {
        const btn = e.target.closest('button[data-lang]');
        if (!btn) return;
        const lang = btn.getAttribute('data-lang');
        setLang(lang);
        localStorage.setItem('siteLang', lang);
        // visual ativo
        wrapper.querySelectorAll('button').forEach(b => b.classList.remove('btn-primary'));
        btn.classList.add('btn-primary');
      });

      // define visual inicial
      const saved = localStorage.getItem('siteLang') || 'pt';
      const initialBtn = wrapper.querySelector(`button[data-lang="${saved}"]`);
      if (initialBtn) initialBtn.classList.add('btn-primary');
    }

    function translatePage(lang) {
      const dict = translations[lang] || translations.pt;
      
      // Traduz elementos com data-i18n
      document.querySelectorAll('[data-i18n]').forEach(node => {
        const key = node.getAttribute('data-i18n');
        if (!key) return;
        const text = dict[key];
        if (text !== undefined) {
          if (node.tagName === 'INPUT' || node.tagName === 'TEXTAREA') {
            node.setAttribute('placeholder', text);
          } else if (node.tagName === 'TITLE') {
            document.title = text + " - Select Car Motors";
          } else {
            node.textContent = text;
          }
        }
      });
      
      // Traduz placeholders específicos
      document.querySelectorAll('[data-i18n-placeholder]').forEach(node => {
        const key = node.getAttribute('data-i18n-placeholder');
        if (!key) return;
        const text = dict[key];
        if (text !== undefined) {
          node.setAttribute('placeholder', text);
        }
      });

      // Traduz textos dos carros no catálogo
      translateCarDescriptions(dict);
      
      // Traduz textos estáticos adicionais
      translateStaticTexts(dict);
    }

    function translateCarDescriptions(dict) {
      const cards = document.querySelectorAll('.card');
      cards.forEach(card => {
        const title = card.querySelector('h3');
        const description = card.querySelector('p');
        
        if (title && description) {
          const originalTitle = title.getAttribute('data-original-title') || title.textContent;
          title.setAttribute('data-original-title', originalTitle);
          
          // Mapeia títulos originais para chaves de tradução
          const titleMap = {
            'Honda Civic Type-R': 'honda_civic_type_r',
            'Mitsubishi Lancer Evolution': 'mitsubishi_evolution',
            'Chevrolet Corvette Stingray': 'chevrolet_corvette',
            'Volkswagen Golf GTI': 'volkswagen_golf',
            'Subaru Impreza WRX STI': 'subaru_wrx',
            'BMW E36 M3': 'bmw_e36'
          };

          const descMap = {
            'Honda Civic Type-R': 'honda_civic_desc',
            'Mitsubishi Lancer Evolution': 'mitsubishi_evolution_desc',
            'Chevrolet Corvette Stingray': 'chevrolet_corvette_desc',
            'Volkswagen Golf GTI': 'volkswagen_golf_desc',
            'Subaru Impreza WRX STI': 'subaru_wrx_desc',
            'BMW E36 M3': 'bmw_e36_desc'
          };

          const titleKey = titleMap[originalTitle];
          const descKey = descMap[originalTitle];

          if (titleKey && dict[titleKey]) {
            title.textContent = dict[titleKey];
          }

          if (descKey && dict[descKey]) {
            description.textContent = dict[descKey];
          }
        }
      });
    }

    function translateStaticTexts(dict) {
      // Traduz textos estáticos que não têm data-i18n
      const smallElements = document.querySelectorAll('small');
      smallElements.forEach(el => {
        if (el.textContent.includes('SELECT CAR MOTORS')) {
          el.textContent = dict.select_car_motors || 'SELECT CAR MOTORS';
        }
      });

      const subtitles = document.querySelectorAll('.sub');
      subtitles.forEach(el => {
        if (el.textContent.includes('Encontre carros esportivos')) {
          el.textContent = dict.subtitulo_home || 'Find sports and exclusive cars — check out our catalog.';
        }
      });

      // Traduz footer
      const footerParagraphs = document.querySelectorAll('footer p');
      if (footerParagraphs.length >= 2) {
        footerParagraphs[0].textContent = dict.isaias_42_8;
        footerParagraphs[1].textContent = dict.isaias;
      }

      // Traduz textos de teste drive
      const testDriveTexts = document.querySelectorAll('.card-details small');
      testDriveTexts.forEach(el => {
        el.textContent = dict.teste_drive_disponivel;
      });
    }

    function setLang(lang) {
      translatePage(lang);
    }

    // Init
    document.addEventListener('DOMContentLoaded', () => {
      createSwitcher();
      const lang = localStorage.getItem('siteLang') || 'pt';
      setLang(lang);
    });
  })();