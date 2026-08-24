<?php require_once 'header.php'; ?>

<!-- Seção Sobre a Empresa -->
<section class="max-w-4xl mx-auto px-4 py-12">
    <div class="text-center mb-12">
        <h1 class="text-4xl font-extrabold text-gray-900 tracking-tight">Sobre o FreelaApp</h1>
        <p class="text-md text-gray-500 mt-2">Conectando contratantes aos melhores profissionais liberais do mercado.</p>
    </div>

    <div class="bg-white p-8 rounded-2xl shadow-sm border border-gray-100 space-y-6 text-gray-600 leading-relaxed">
        <p>O <strong>FreelaApp</strong> nasceu com a missão de valorizar o trabalho autônomo e facilitar a vida de quem precisa de serviços rápidos e qualificados. Seja você um eletricista, programador, encanador ou professor particular, nossa plataforma oferece o espaço ideal para você divulgar suas habilidades e fechar negócios direto pelo WhatsApp.</p>
        <p>Para o cliente, eliminamos intermediários e burocracias: você navega pelas categorias, analisa as notas reais de serviços anteriores prestados e escolhe o profissional ideal em poucos cliques.</p>
    </div>
</section>

<!-- Seção Formulário de Contato -->
<section class="max-w-xl mx-auto px-4 py-12 border-t border-gray-100">
    <div class="bg-white p-8 rounded-2xl shadow-sm border border-gray-100">
        <h2 class="text-2xl font-bold text-gray-900 text-center">Fale Conosco</h2>
        <p class="text-sm text-gray-500 text-center mt-1">Dúvidas, críticas ou sugestões? Envie uma mensagem.</p>

        <?php if (isset($_GET['contato']) && $_GET['contato'] === 'sucesso'): ?>
            <div class="bg-emerald-50 text-emerald-700 p-4 rounded-xl text-sm font-medium mt-4 border border-emerald-100 text-center">
                ✉️ Mensagem enviada com sucesso! Responderemos em breve.
            </div>
        <?php endif; ?>

        <form action="/freela-app/public/contato/enviar" method="POST" class="mt-6 space-y-4">
            <div>
                <label class="block text-sm font-medium text-gray-700">Seu Nome</label>
                <input type="text" name="name" required class="mt-1 block w-full px-3 py-2 bg-gray-50 border border-gray-200 rounded-lg text-sm focus:outline-none focus:border-indigo-500 focus:bg-white transition">
            </div>

            <div>
                <label class="block text-sm font-medium text-gray-700">E-mail para Retorno</label>
                <input type="email" name="email" required class="mt-1 block w-full px-3 py-2 bg-gray-50 border border-gray-200 rounded-lg text-sm focus:outline-none focus:border-indigo-500 focus:bg-white transition">
            </div>

            <div>
                <label class="block text-sm font-medium text-gray-700">Mensagem</label>
                <textarea name="message" rows="4" required class="mt-1 block w-full px-3 py-2 bg-gray-50 border border-gray-200 rounded-lg text-sm focus:outline-none focus:border-indigo-500 focus:bg-white transition" placeholder="Escreva aqui o que você precisa..."></textarea>
            </div>

            <button type="submit" class="w-full bg-indigo-600 text-white py-2.5 rounded-lg font-medium text-sm hover:bg-indigo-700 transition shadow-xs cursor-pointer">
                Enviar Mensagem 🚀
            </button>
        </form>
    </div>
</section>

<?php require_once 'footer.php'; ?>
