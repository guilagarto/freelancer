<?php require_once 'header.php'; ?>

<!-- Seção Principal (Hero) -->
<section class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-16 md:py-24 text-center">
    <span class="bg-indigo-50 text-indigo-700 text-sm font-semibold px-3 py-1 rounded-full">A plataforma do trabalhador autônomo</span>
    <h1 class="text-4xl md:text-6xl font-extrabold text-gray-900 mt-4 tracking-tight leading-none">
        Precisa de um <span class="text-indigo-600">Pedreiro</span> ou Profissional?
    </h1>
    <p class="text-lg md:text-xl text-gray-500 mt-6 max-w-2xl mx-auto">
        Encontre profissionais qualificados perto de você ou cadastre seus serviços freelancers de forma simples, rápida e segura.
    </p>

    <!-- Botões de Ação Principais -->
    <div class="mt-10 flex flex-col sm:flex-row justify-center gap-4">
        <a href="/profissionais" class="bg-indigo-600 text-white px-8 py-4 rounded-xl font-semibold text-lg hover:bg-indigo-700 transition shadow-md hover:shadow-lg text-center">
    🔍 Encontrar Profissional
</a>

        <a href="/cadastrar" class="bg-white text-gray-700 border border-gray-200 px-8 py-4 rounded-xl font-semibold text-lg hover:bg-gray-50 transition shadow-xs text-center">
    🛠️ Quero Oferecer Serviços
</a>
    </div>
</section>

<!-- Seção de Categorias Populares -->
<section class="bg-white border-t border-gray-100 py-16">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <h2 class="text-2xl font-bold text-gray-900 text-center mb-10">Categorias mais procuradas</h2>
        <div class="grid grid-cols-2 md:grid-cols-4 gap-6">
            
            <!-- Card Pedreiro -->
            <div class="border border-gray-100 rounded-2xl p-6 text-center shadow-xs hover:shadow-md transition bg-gray-50/50 cursor-pointer">
                <div class="text-4xl mb-3">🧱</div>
                <h3 class="font-bold text-gray-800">Pedreiro</h3>
                <p class="text-sm text-gray-400 mt-1">Reformas e obras</p>
            </div>

            <!-- Card Eletricista -->
            <div class="border border-gray-100 rounded-2xl p-6 text-center shadow-xs hover:shadow-md transition bg-gray-50/50 cursor-pointer">
                <div class="text-4xl mb-3">⚡</div>
                <h3 class="font-bold text-gray-800">Eletricista</h3>
                <p class="text-sm text-gray-400 mt-1">Fiação e reparos</p>
            </div>

            <!-- Card Pintor -->
            <div class="border border-gray-100 rounded-2xl p-6 text-center shadow-xs hover:shadow-md transition bg-gray-50/50 cursor-pointer">
                <div class="text-4xl mb-3">🖌️</div>
                <h3 class="font-bold text-gray-800">Pintor</h3>
                <p class="text-sm text-gray-400 mt-1">Pinturas residenciais</p>
            </div>

            <!-- Card Encanador -->
            <div class="border border-gray-100 rounded-2xl p-6 text-center shadow-xs hover:shadow-md transition bg-gray-50/50 cursor-pointer">
                <div class="text-4xl mb-3">🔧</div>
                <h3 class="font-bold text-gray-800">Encanador</h3>
                <p class="text-sm text-gray-400 mt-1">Vazamentos e tubos</p>
            </div>

        </div>
    </div>
</section>

<?php require_once 'footer.php'; ?>
