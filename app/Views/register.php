<?php require_once 'header.php'; ?>

<section class="max-w-md mx-auto px-4 py-12">
    <div class="bg-white p-8 rounded-2xl shadow-sm border border-gray-100">
        <h2 class="text-2xl font-bold text-gray-900 text-center">Crie sua conta grátis</h2>
        <p class="text-sm text-gray-500 text-center mt-1">Encontre trabalho ou contrate profissionais</p>

        <!-- O formulário envia os dados via POST para a rota /cadastrar/salvar -->
        <form action="/freela-app/public/cadastrar/salvar" method="POST" class="mt-6 space-y-4">
            
            <div>
                <label class="block text-sm font-medium text-gray-700">Nome Completo</label>
                <input type="text" name="name" required class="mt-1 block w-full px-3 py-2 bg-gray-50 border border-gray-200 rounded-lg text-sm focus:outline-none focus:border-indigo-500 focus:bg-white transition">
            </div>

            <div>
                <label class="block text-sm font-medium text-gray-700">E-mail</label>
                <input type="email" name="email" required class="mt-1 block w-full px-3 py-2 bg-gray-50 border border-gray-200 rounded-lg text-sm focus:outline-none focus:border-indigo-500 focus:bg-white transition">
            </div>

            <div>
                <label class="block text-sm font-medium text-gray-700">Senha</label>
                <input type="password" name="password" required class="mt-1 block w-full px-3 py-2 bg-gray-50 border border-gray-200 rounded-lg text-sm focus:outline-none focus:border-indigo-500 focus:bg-white transition">
            </div>

            <div>
                <label class="block text-sm font-medium text-gray-700">O que você busca na plataforma?</label>
                <select name="user_type" required class="mt-1 block w-full px-3 py-2 bg-gray-50 border border-gray-200 rounded-lg text-sm focus:outline-none focus:border-indigo-500 focus:bg-white transition">
                    <option value="client">Quero contratar profissionais (Cliente)</option>
                    <option value="professional">Quero oferecer meus serviços (Trabalhador Autônomo)</option>
                </select>
            </div>

            <button type="submit" class="w-full bg-indigo-600 text-white py-2.5 rounded-lg font-medium text-sm hover:bg-indigo-700 transition shadow-xs mt-2 cursor-pointer">
                Finalizar Cadastro 🚀
            </button>
        </form>
    </div>
</section>

<?php require_once 'footer.php'; ?>
