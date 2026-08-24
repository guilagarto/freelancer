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
                   <!-- Links do Menu Otimizados e Compactos para Mobile -->
            <!-- Reduzido o gap no celular (gap-2) e ampliado no PC (md:gap-4) -->
            <div class="flex items-center gap-2 md:gap-4">
                <a href="/" class="text-xs md:text-sm text-gray-600 hover:text-indigo-600 font-medium transition">Início</a>
                <a href="/profissionais" class="text-xs md:text-sm text-gray-600 hover:text-indigo-600 font-medium transition">Buscar</a>
                <a href="/noticias" class="text-xs md:text-sm text-gray-600 hover:text-indigo-600 font-medium transition hidden sm:inline-block">Vagas</a> <!-- Esconde esse link em telas muito pequenas para não esmagar o topo -->
                
                <?php if (isset($_SESSION['admin_id'])): ?>
                    <a href="/admin/painel" class="text-[10px] md:text-xs bg-gray-900 text-amber-400 px-2 py-1 rounded-lg font-bold border border-amber-500/30">Admin 👑</a>
                    <a href="/admin/sair" class="text-xs text-red-500 hover:underline">Sair</a>

                <?php elseif (isset($_SESSION['user_id'])): ?>
                    <?php if ($_SESSION['user_type'] === 'professional'): ?>
                        <a href="/painel" class="bg-indigo-50 text-indigo-700 px-2.5 py-1.5 rounded-lg text-[11px] font-bold border border-indigo-100">Painel 🛠️</a>
                    <?php else: ?>
                        <a href="/meus-pedidos" class="text-xs text-indigo-600 font-semibold">Pedidos 📋</a>
                    <?php endif; ?>
                    
                    <!-- Opcional: O nome do usuário fica escondido no celular (hidden) e aparece no PC (md:inline-block) para economizar espaço crítico de tela -->
                    <span class="text-xs font-semibold text-gray-700 max-w-[100px] truncate hidden md:inline-block">
                        Olá, <?php echo htmlspecialchars($_SESSION['user_name']); ?> 👋
                    </span>
                    <a href="/sair" class="text-xs text-red-600 font-medium transition ml-1">Sair</a>

                <?php else: ?>
                    <a href="/login" class="bg-indigo-600 text-white px-3 py-1.5 rounded-lg text-xs font-medium hover:bg-indigo-700 transition shadow-xs">Entrar</a>
                <?php endif; ?>
            </div>

    </div>
</nav>


    <!-- Conteúdo Principal do Site -->
    <main class="flex-grow">
