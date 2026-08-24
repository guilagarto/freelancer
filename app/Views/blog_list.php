<?php require_once 'header.php'; ?>

<section class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-8 md:py-12">
    <div class="text-center max-w-xl mx-auto mb-8 md:mb-12">
        <h2 class="text-2xl md:text-3xl font-extrabold text-gray-900 tracking-tight">Painel de Oportunidades & Notícias</h2>
        <p class="text-sm text-gray-500 mt-2">Fique por dentro das últimas vagas do mercado e novidades para trabalhadores liberais.</p>
    </div>

    <!-- INJEÇÃO DE PROPAGANDA GOOGLE ADSENSE NO TOPO (Se adapta ao tamanho do celular) -->
    <div class="overflow-hidden max-w-full">
        <?php require 'ads_block.php'; ?>
    </div>

    <!-- grid-cols-1 garante exibição em coluna única vertical no celular, virando 2 colunas no PC (md:grid-cols-2) -->
    <div class="grid grid-cols-1 md:grid-cols-2 gap-4 md:gap-8 mt-6">
        <?php if (empty($posts)): ?>
            <div class="col-span-1 md:col-span-2 text-center py-12 bg-white rounded-2xl border border-gray-100">
                <p class="text-gray-500 font-medium text-sm">Nenhuma notícia ou vaga publicada no momento.</p>
            </div>
        <?php else: ?>
            <?php foreach ($posts as $post): ?>
                <div class="bg-white border border-gray-100 rounded-2xl p-5 md:p-6 shadow-xs hover:shadow-md transition flex flex-col justify-between">
                    <div>
                        <!-- Cabeçalho do Post Mobile -->
                        <div class="flex justify-between items-center mb-3">
                            <?php if ($post['type'] === 'vaga'): ?>
                                <span class="bg-red-50 text-red-700 text-[10px] md:text-xs font-bold px-2 py-0.5 rounded-md">💼 Vaga Urgente</span>
                            <?php elseif ($post['type'] === 'oportunidade'): ?>
                                <span class="bg-amber-50 text-amber-700 text-[10px] md:text-xs font-bold px-2 py-0.5 rounded-md">🚀 Oportunidade</span>
                            <?php else: ?>
                                <span class="bg-blue-50 text-blue-700 text-[10px] md:text-xs font-bold px-2 py-0.5 rounded-md">📰 Notícia</span>
                            <?php endif; ?>
                            
                            <span class="text-[10px] md:text-xs text-gray-400"><?php echo date('d/m/Y', strtotime($post['created_at'])); ?></span>
                        </div>

                        <h3 class="text-lg md:text-xl font-bold text-gray-900 leading-snug mb-2"><?php echo htmlspecialchars($post['title']); ?></h3>
                        <p class="text-xs md:text-sm text-gray-500 leading-relaxed whitespace-pre-line"><?php echo htmlspecialchars($post['content']); ?></p>
                    </div>
                    
                    <div class="border-t border-gray-50 pt-3 mt-4 flex justify-end">
                        <button class="text-xs font-semibold text-indigo-600 hover:text-indigo-700 transition cursor-pointer">Ler Artigo Completo &rarr;</button>
                    </div>
                </div>
            <?php endforeach; ?>
        <?php endif; ?>
    </div>
</section>

<?php require_once 'footer.php'; ?>
