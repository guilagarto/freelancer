<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>FreelaApp - Conectando Clientes e Profissionais</title>
    <!-- Importa o Tailwind CSS para estilização moderna -->
    <script src="https://cdn.tailwindcss.com"></script>

</head>
<body class="bg-gray-50 text-gray-800 flex flex-col min-h-screen">

    <!-- Barra de Navegação -->
    <nav class="bg-white shadow-sm border-b border-gray-100 sticky top-0 z-50">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex justify-between h-16 items-center">
            
            <!-- Logotipo apontando direto para a raiz pública -->
            <a href="/" class="flex items-center gap-2 cursor-pointer">
                <span class="text-2xl">🚀</span>
                <span class="text-xl font-bold text-indigo-600 tracking-tight">FreelaApp</span>
            </a>
            
            <!-- Links do Menu totalmente limpos para a Internet -->
            <div class="flex items-center gap-4">
                <a href="/" class="text-sm text-gray-600 hover:text-indigo-600 font-medium transition">Início</a>
                <a href="/profissionais" class="text-sm text-gray-600 hover:text-indigo-600 font-medium transition">Profissionais</a>
                <a href="/noticias" class="text-sm text-gray-600 hover:text-indigo-600 font-medium transition">Notícias & Vagas</a>
                <a href="/sobre" class="text-sm text-gray-600 hover:text-indigo-600 font-medium transition">Sobre/Contato</a>
                
                <!-- Links com travas de sessão dinâmicas -->
                <?php if (isset($_SESSION['admin_id'])): ?>
                    <a href="/admin/painel" class="text-xs bg-gray-900 text-amber-400 px-3 py-1.5 rounded-lg font-bold border border-amber-500/30 hover:bg-gray-800 transition">Painel Admin 👑</a>
                    <a href="/admin/sair" class="text-xs text-red-500 hover:text-red-600 font-medium transition">Sair</a>

                <?php elseif (isset($_SESSION['user_id'])): ?>
                    <?php if ($_SESSION['user_type'] === 'professional'): ?>
                        <a href="/painel" class="bg-indigo-50 text-indigo-700 px-4 py-2 rounded-xl text-xs font-bold border border-indigo-100 hover:bg-indigo-100 transition">Meu Painel 🛠️</a>
                    <?php else: ?>
                        <a href="/meus-pedidos" class="text-sm text-indigo-600 hover:text-indigo-700 font-semibold transition">Meus Pedidos 📋</a>
                    <?php endif; ?>
                    
                    <span class="text-xs font-semibold text-gray-700 max-w-[120px] truncate">Olá, <?php echo htmlspecialchars($_SESSION['user_name']); ?> 👋</span>
                    <a href="/sair" class="text-xs text-red-600 hover:text-red-700 font-medium transition">Sair</a>

                <?php else: ?>
                    <a href="/login" class="bg-indigo-600 text-white px-4 py-2 rounded-xl text-sm font-medium hover:bg-indigo-700 transition shadow-xs cursor-pointer">Entrar</a>
                <?php endif; ?>
            </div>

        </div>
    </div>
</nav>


    <!-- Conteúdo Principal do Site -->
    <main class="flex-grow">
