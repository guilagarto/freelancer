<?php require_once 'header.php'; ?>

<section class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-12">
    
    <!-- Título da Página -->
    <div class="text-center max-w-xl mx-auto mb-8">
        <h2 class="text-3xl font-extrabold text-gray-900 tracking-tight">Profissionais Disponíveis</h2>
        <p class="text-md text-gray-500 mt-2">Navegue pelas categorias ou escolha o profissional ideal para o seu projeto.</p>
        
        <?php if (isset($_GET['avaliado'])): ?>
            <div class="bg-emerald-50 text-emerald-700 p-3 rounded-xl text-sm font-medium mt-4 border border-emerald-100 inline-block">
                ⭐ Obrigado! Sua avaliação foi registrada com sucesso.
            </div>
        <?php endif; ?>
    </div>

    <!-- NAVEGAÇÃO / FILTROS POR CATEGORIA (BOTÕES) -->
    <div class="flex flex-wrap justify-center gap-2 mb-12 border-b border-gray-100 pb-6">
        <!-- Botão para limpar o filtro e ver todos -->
        <a href="/freela-app/public/profissionais" 
           class="px-4 py-2 rounded-xl text-xs font-semibold transition <?php echo empty($selectedCategory) ? 'bg-indigo-600 text-white shadow-xs' : 'bg-gray-100 text-gray-600 hover:bg-gray-200'; ?>">
            🌐 Ver Todos
        </a>

        <!-- Gera dinamicamente um botão para cada categoria que existe no banco -->
        <?php foreach ($categoriesList as $cat): ?>
            <a href="/freela-app/public/profissionais?categoria=<?php echo urlencode($cat); ?>" 
               class="px-4 py-2 rounded-xl text-xs font-semibold transition <?php echo ($selectedCategory === $cat) ? 'bg-indigo-600 text-white shadow-xs' : 'bg-gray-100 text-gray-600 hover:bg-gray-200'; ?>">
                📁 <?php echo htmlspecialchars($cat); ?>
            </a>
        <?php endforeach; ?>
    </div>
        </div> <!-- Fim dos botões de filtro -->

    <!-- INJEÇÃO DO ANÚNCIO NO TOPO DA BUSCA -->
    <?php require 'ads_block.php'; ?>

    <!-- EXIBIÇÃO AGRUPADA E SEPARADA POR CATEGORIAS -->
    <div class="space-y-16">


    <!-- EXIBIÇÃO AGRUPADA E SEPARADA POR CATEGORIAS -->
    <div class="space-y-16">
        
        <?php if (empty($groupedProfessionals)): ?>
            <div class="text-center py-12 bg-white rounded-2xl border border-gray-100">
                <span class="text-4xl">📭</span>
                <p class="text-gray-500 mt-2 font-medium">Nenhum profissional encontrado nesta categoria.</p>
            </div>
        <?php else: ?>
            
            <!-- Loop que passa por cada CATEGORIA isolada -->
            <?php foreach ($groupedProfessionals as $categoryTitle => $listProf): ?>
                <div>
                    <!-- Título de Divisão da Categoria -->
                    <div class="flex items-center gap-3 mb-6 border-l-4 border-indigo-600 pl-3">
                        <h3 class="text-xl font-bold text-gray-900 uppercase tracking-wide text-sm"><?php echo htmlspecialchars($categoryTitle); ?></h3>
                        <span class="bg-indigo-50 text-indigo-700 text-xs font-bold px-2 py-0.5 rounded-full"><?php echo count($listProf); ?> disponíveis</span>
                    </div>

                    <!-- Grade interna contendo os profissionais daquela categoria específica -->
                    <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                        
                        <?php foreach ($listProf as $prof): ?>
                            <div class="bg-white border border-gray-100 rounded-2xl p-6 shadow-xs hover:shadow-md transition flex flex-col justify-between">
                                <div>
                                    
                                    <div class="flex items-center gap-3 mb-3">
                                        <div class="w-12 h-12 bg-indigo-50 text-indigo-600 rounded-xl flex items-center justify-center font-bold text-lg overflow-hidden shrink-0">
                                            <?php if (!empty($prof['avatar']) && file_exists(__DIR__ . '/../../public/uploads/' . $prof['avatar'])): ?>
                                                <img src="/freela-app/public/uploads/<?php echo $prof['avatar']; ?>" class="w-full h-full object-cover">
                                            <?php else: ?>
                                                <?php echo strtoupper(substr($prof['name'], 0, 1)); ?>
                                            <?php endif; ?>
                                        </div>
                                        <div>
                                            <h3 class="font-bold text-gray-900"><?php echo htmlspecialchars($prof['name']); ?></h3>
                                            <span class="inline-block bg-indigo-50 text-indigo-700 text-[10px] font-bold px-2 py-0.5 rounded-md mt-0.5">
                                                🟢 Ativo
                                            </span>
                                        </div>
                                    </div>                                    <div class="flex items-center gap-1 mb-3 text-sm">
                                        <span class="text-amber-500 font-bold"><?php echo $prof['rating_average']; ?></span>
                                        <span class="text-amber-400 select-none">
                                            <?php 
                                            $stars = round($prof['rating_average']);
                                            echo str_repeat('★', $stars) . str_repeat('☆', 5 - $stars);
                                            ?>
                                        </span>
                                        <span class="text-gray-400 text-xs">(<?php echo $prof['rating_total']; ?>)</span>
                                    </div>

                                    <p class="text-sm text-gray-500 mb-4 line-clamp-3">
                                        <?php echo $prof['bio'] ? htmlspecialchars($prof['bio']) : 'Este profissional liberal ainda não adicionou uma descrição ao perfil.'; ?>
                                    </p>

                                    <!-- Depoimentos do Profissional -->
                                    <div class="mt-4 mb-6 pt-4 border-t border-gray-50">
                                        <h4 class="text-[10px] font-bold text-gray-400 mb-2 uppercase tracking-wider">Últimos Depoimentos:</h4>
                                        <?php if (empty($prof['comments'])): ?>
                                            <p class="text-xs text-gray-400 italic">Nenhum comentário por enquanto.</p>
                                        <?php else: ?>
                                            <div class="space-y-2 max-h-32 overflow-y-auto pr-1">
                                                <?php foreach (array_slice($prof['comments'], 0, 2) as $com): ?>
                                                    <div class="bg-gray-50/70 p-2 rounded-xl border border-gray-100/50">
                                                        <div class="flex justify-between items-center mb-0.5">
                                                            <span class="text-[11px] font-bold text-gray-800"><?php echo htmlspecialchars($com['client_name']); ?></span>
                                                            <span class="text-[10px] text-amber-500 font-medium"><?php echo str_repeat('★', $com['rating']); ?></span>
                                                        </div>
                                                        <p class="text-[11px] text-gray-500 leading-tight">"<?php echo htmlspecialchars($com['comment']); ?>"</p>
                                                    </div>
                                                <?php endforeach; ?>
                                            </div>
                                        <?php endif; ?>
                                    </div>
                                </div>

                                <div>
                                    <div class="border-t border-gray-100 pt-4 flex items-center justify-between">
                                        <div>
                                            <span class="text-xs text-gray-400 block">Preço/Hora</span>
                                            <span class="text-lg font-bold text-gray-900">
                                                R$ <?php echo $prof['price_per_hour'] ? number_format($prof['price_per_hour'], 2, ',', '.') : 'A combinar'; ?>
                                            </span>
                                        </div>
                                        
                                        <form action="/freela-app/public/contratar/disparar" method="POST" class="m-0">
                                            <input type="hidden" name="professional_id" value="<?php echo $prof['id']; ?>">
                                            <input type="hidden" name="phone" value="<?php echo $prof['phone']; ?>">
                                            <button type="submit" class="bg-emerald-600 hover:bg-emerald-700 text-white px-4 py-2 rounded-xl text-sm font-medium transition cursor-pointer flex items-center gap-1">
                                                💬 Contratar
                                            </button>
                                        </form>
                                    </div>
                                </div>

                            </div>
                        <?php endforeach; ?>
                        
                    </div> <!-- Fim da grade interna -->
                </div>
            <?php endforeach; ?> <!-- Fim do loop de categorias -->

        <?php endif; ?>
    </div>
</section>

<?php require_once 'footer.php'; ?>


