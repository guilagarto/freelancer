<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>FreelaApp - Conectando Clientes e Profissionais</title>
    <!-- Importa o Tailwind CSS para estilização moderna -->
    <script src="https://cdn.tailwindcss.com"></script>
    <script async src="https://pagead2.googlesyndication.com/pagead/js/adsbygoogle.js?client=ca-pub-2225154349342173"
     crossorigin="anonymous"></script>
</head>
<body class="bg-gray-50 text-gray-800 flex flex-col min-h-screen">

    <!-- Barra de Navegação -->
    <nav class="bg-white shadow-sm border-b border-gray-100 sticky top-0 z-50">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
                   <!-- Links do Menu Otimizados e Compactos para Mobile -->
            <!-- Reduzido o gap no celular (gap-2) e ampliado no PC (md:gap-4) -->
                        <!-- Links do Menu - Ajustados para NUNCA sumirem no Celular -->
            <!-- Usamos text-[11px] para celular e text-sm no PC para caber tudo perfeitamente lado a lado -->
            <div class="flex items-center gap-2.5 md:gap-5">
                <a href="/" class="text-[11px] md:text-sm text-gray-600 hover:text-indigo-600 font-medium transition">Início</a>
                <a href="/profissionais" class="text-[11px] md:text-sm text-gray-600 hover:text-indigo-600 font-medium transition">Buscar</a>
                <a href="/noticias" class="text-[11px] md:text-sm text-gray-600 hover:text-indigo-600 font-medium transition">Vagas</a>
                <a href="/sobre" class="text-[11px] md:text-sm text-gray-600 hover:text-indigo-600 font-medium transition">Sobre</a>
                
                <span class="h-4 w-px bg-gray-200 block"></span>

                <?php if (isset($_SESSION['admin_id'])): ?>
                    <!-- Administrador Logado -->
                    <a href="/admin/painel" class="text-[10px] md:text-xs bg-gray-900 text-amber-400 px-2 py-1 rounded-lg font-bold border border-amber-500/30">Admin 👑</a>
                    <a href="/admin/sair" class="text-[11px] md:text-xs text-red-500 hover:underline">Sair</a>

                <?php elseif (isset($_SESSION['user_id'])): ?>
                    <!-- Usuário Comum Logado -->
                    <?php if ($_SESSION['user_type'] === 'professional'): ?>
                        <a href="/painel" class="bg-indigo-50 text-indigo-700 px-2 py-1 rounded-lg text-[10px] md:text-xs font-bold border border-indigo-100">Painel 🛠️</a>
                    <?php else: ?>
                        <a href="/meus-pedidos" class="text-[11px] md:text-sm text-indigo-600 font-semibold">Pedidos 📋</a>
                    <?php endif; ?>
                    
                    <!-- Exibe apenas um botão compacto de Sair no celular para não amassar a tela -->
                    <a href="/sair" class="text-[11px] md:text-xs text-red-600 font-medium transition ml-1">Sair</a>

                <?php else: ?>
                    <!-- Visitante Deslogado -->
                    <a href="/login" class="bg-indigo-600 text-white px-2.5 py-1.5 rounded-lg text-[11px] md:text-xs font-medium hover:bg-indigo-700 transition shadow-xs">Entrar</a>
                <?php endif; ?>
            </div>


    </div>
</nav>


    <!-- Conteúdo Principal do Site -->
    <main class="flex-grow">
