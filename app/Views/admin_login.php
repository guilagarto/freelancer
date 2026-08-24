<?php require_once 'header.php'; ?>

<section class="max-w-md mx-auto px-4 py-16">
    <div class="bg-gray-900 text-white p-8 rounded-2xl shadow-xl border border-gray-800">
        <div class="text-center mb-6">
            <span class="text-3xl">🔒</span>
            <h2 class="text-xl font-bold mt-2">Área Restrita - Administrador</h2>
            <p class="text-xs text-gray-400 mt-1">Insira suas credenciais de gerenciamento</p>
        </div>

        <?php if (isset($_GET['erro'])): ?>
            <div class="bg-red-950 text-red-400 p-3 rounded-lg text-xs font-medium mb-4 border border-red-900/50">
                ❌ Login inválido ou acesso negado.
            </div>
        <?php endif; ?>

        <form action="/freela-app/public/admin/login/entrar" method="POST" class="space-y-4 text-gray-900">
            <div>
                <label class="block text-xs font-medium text-gray-300 mb-1">E-mail Administrativo</label>
                <input type="email" name="email" required class="w-full px-3 py-2 bg-gray-800 border border-gray-700 text-white rounded-lg text-sm focus:outline-none focus:border-indigo-500 transition">
            </div>

            <div>
                <label class="block text-xs font-medium text-gray-300 mb-1">Senha de Segurança</label>
                <input type="password" name="password" required class="w-full px-3 py-2 bg-gray-800 border border-gray-700 text-white rounded-lg text-sm focus:outline-none focus:border-indigo-500 transition">
            </div>

            <button type="submit" class="w-full bg-indigo-600 hover:bg-indigo-700 text-white py-2.5 rounded-lg font-medium text-sm transition shadow-md mt-2 cursor-pointer">
                Autenticar Painel 🔑
            </button>
        </form>
    </div>
</section>

<?php require_once 'footer.php'; ?>
