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
    <nav class="bg-white shadow-sm border-b border-gray-100">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex justify-between h-16 items-center">
                <div class="flex items-center gap-2">
                    <span class="text-2xl">🚀</span>
                    <span class="text-xl font-bold text-indigo-600 tracking-tight">FreelaApp</span>
                </div>
                <div class="flex items-center gap-4">
    <a href="/freela-app/public/" class="text-gray-600 hover:text-indigo-600 font-medium transition">Início</a>
    <a href="/freela-app/public/profissionais" class="text-gray-600 hover:text-indigo-600 font-medium transition">Profissionais</a>
    <a href="/freela-app/public/noticias" class="text-gray-600 hover:text-indigo-600 font-medium transition">Notícias & Vagas</a> <!-- NOVO LINK -->
    <a href="/freela-app/public/sobre" class="text-gray-600 hover:text-indigo-600 font-medium transition">Sobre/Contato</a>
    <?php if (isset($_SESSION['user_id']) && $_SESSION['user_type'] === 'client'): ?>
    <a href="/freela-app/public/meus-pedidos" class="text-gray-600 hover:text-indigo-600 font-medium transition">Meus Pedidos 📋</a>
<?php endif; ?>
    <?php if (isset($_SESSION['user_id'])): ?>
        <!-- Menu se o profissional/cliente estiver LOGADO -->
        <?php if ($_SESSION['user_type'] === 'professional'): ?>
    <a href="/freela-app/public/painel" class="text-indigo-600 hover:text-indigo-700 font-semibold transition">Meu Painel 🛠️</a>
<?php else: ?>
    <span class="text-sm font-semibold text-gray-700">Olá, <?php echo htmlspecialchars($_SESSION['user_name']); ?> 👋</span>
<?php endif; ?>

        <a href="/freela-app/public/sair" class="text-sm text-red-600 hover:text-red-700 font-medium transition">Sair</a>
    <?php else: ?>
        <!-- Menu se estiver DESLOGADO -->
        <a href="/freela-app/public/login" class="bg-indigo-600 text-white px-4 py-2 rounded-lg font-medium hover:bg-indigo-700 transition shadow-xs">Entrar</a>
    <?php endif; ?>
</div>

            </div>
        </div>
    </nav>

    <!-- Conteúdo Principal do Site -->
    <main class="flex-grow">
