<?php require_once 'header.php'; ?>

<section class="max-w-md mx-auto px-4 py-12">
    <div class="bg-white p-8 rounded-2xl shadow-sm border border-gray-100">
        <h2 class="text-2xl font-bold text-gray-900 text-center">Acesse sua conta</h2>
        <p class="text-sm text-gray-500 text-center mt-1">Insira seus dados para entrar no painel</p>

        <!-- Exibe mensagem de erro caso o login falhe -->
        <?php if (isset($_GET['erro'])): ?>
            <div class="bg-red-50 text-red-600 p-3 rounded-lg text-xs font-medium mt-4 border border-red-100">
                ❌ E-mail ou senha incorretos.
            </div>
        <?php endif; ?>

        <form action="/freela-app/public/login/entrar" method="POST" class="mt-6 space-y-4">
            <div>
                <label class="block text-sm font-medium text-gray-700">E-mail</label>
                <input type="email" name="email" required class="mt-1 block w-full px-3 py-2 bg-gray-50 border border-gray-200 rounded-lg text-sm focus:outline-none focus:border-indigo-500 focus:bg-white transition">
            </div>

            <div>
                <label class="block text-sm font-medium text-gray-700">Senha</label>
                <input type="password" name="password" required class="mt-1 block w-full px-3 py-2 bg-gray-50 border border-gray-200 rounded-lg text-sm focus:outline-none focus:border-indigo-500 focus:bg-white transition">
            </div>

            <button type="submit" class="w-full bg-indigo-600 text-white py-2.5 rounded-lg font-medium text-sm hover:bg-indigo-700 transition shadow-xs mt-2 cursor-pointer">
                Entrar 🚀
            </button>
            
            <p class="text-xs text-center text-gray-400 mt-4">
                Não tem uma conta? <a href="/freela-app/public/cadastrar" class="text-indigo-600 hover:underline">Cadastre-se</a>
            </p>
        </form>
    </div>
</section>

<?php require_once 'footer.php'; ?>
