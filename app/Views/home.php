<?php require_once 'header.php'; ?>

<!-- Seção Principal (Hero) - Otimizada para Celular -->
<section class="max-w-7xl mx-auto px-4 py-12 md:py-24 text-center">
    <span class="bg-indigo-50 text-indigo-700 text-xs md:text-sm font-semibold px-3 py-1 rounded-full inline-block">
        A plataforma do trabalhador autônomo
    </span>
    
    <!-- Reduzido o tamanho da fonte em telas pequenas (text-3xl) e ampliado em telas grandes (md:text-6xl) -->
    <h1 class="text-3xl md:text-6xl font-extrabold text-gray-900 mt-4 tracking-tight leading-tight md:leading-none">
        Precisa de um <span class="text-indigo-600">Profissional</span> Liberal?
    </h1>
    <p class="text-base md:text-xl text-gray-500 mt-4 md:mt-6 max-w-2xl mx-auto px-2">
        Encontre profissionais qualificados perto de você ou cadastre seus serviços freelancers de forma simples, rápida e segura.
    </p>

    <!-- Botões de Ação Principais: Em celulares eles ficam um embaixo do outro (w-full) e em computadores lado a lado (sm:w-auto) -->
    <div class="mt-8 md:mt-10 flex flex-col sm:flex-row justify-center gap-3 px-4 sm:px-0">
        <a href="/profissionais" class="w-full sm:w-auto bg-indigo-600 text-white px-6 py-4 rounded-xl font-semibold text-base md:text-lg hover:bg-indigo-700 transition shadow-md text-center">
            🔍 Encontrar Profissional
        </a>
        <a href="/cadastrar" class="w-full sm:w-auto bg-white text-gray-700 border border-gray-200 px-6 py-4 rounded-xl font-semibold text-base md:text-lg hover:bg-gray-50 transition shadow-xs text-center">
            🛠️ Quero Oferecer Serviços
        </a>
    </div>
</section>

<!-- Seção de Categorias Populares: Mantido em 2 colunas no celular para não espremer o texto -->
<section class="bg-white border-t border-gray-100 py-12 md:py-16">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <h2 class="text-xl md:text-2xl font-bold text-gray-900 text-center mb-8">Categorias Populares</h2>
        
        <!-- grid-cols-2 garante que no celular fique em duas colunas organizadas -->
        <div class="grid grid-cols-2 md:grid-cols-4 gap-4 md:gap-6">
            
            <div class="border border-gray-100 rounded-2xl p-4 md:p-6 text-center shadow-xs hover:shadow-md transition bg-gray-50/50 cursor-pointer">
                <div class="text-3xl md:text-4xl mb-2 md:mb-3">🧱</div>
                <h3 class="font-bold text-gray-800 text-sm md:text-base">Construção</h3>
                <p class="text-xs text-gray-400 mt-1">Reformas e obras</p>
            </div>

            <div class="border border-gray-100 rounded-2xl p-4 md:p-6 text-center shadow-xs hover:shadow-md transition bg-gray-50/50 cursor-pointer">
                <div class="text-3xl md:text-4xl mb-2 md:mb-3">⚡</div>
                <h3 class="font-bold text-gray-800 text-sm md:text-base">Manutenção</h3>
                <p class="text-xs text-gray-400 mt-1">Reparos elétricos</p>
            </div>

            <div class="border border-gray-100 rounded-2xl p-4 md:p-6 text-center shadow-xs hover:shadow-md transition bg-gray-50/50 cursor-pointer">
                <div class="text-3xl md:text-4xl mb-2 md:mb-3">💻</div>
                <h3 class="font-bold text-gray-800 text-sm md:text-base">Tecnologia</h3>
                <p class="text-xs text-gray-400 mt-1">Sistemas e design</p>
            </div>

            <div class="border border-gray-100 rounded-2xl p-4 md:p-6 text-center shadow-xs hover:shadow-md transition bg-gray-50/50 cursor-pointer">
                <div class="text-3xl md:text-4xl mb-2 md:mb-3">🔧</div>
                <h3 class="font-bold text-gray-800 text-sm md:text-base">Assistência</h3>
                <p class="text-xs text-gray-400 mt-1">Geral e suporte</p>
            </div>

        </div>
    </div>
</section>

<?php require_once 'footer.php'; ?>
