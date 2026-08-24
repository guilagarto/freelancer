<?php require_once 'header.php'; ?>

<section class="max-w-4xl mx-auto px-4 py-12">
    <h2 class="text-2xl font-bold text-gray-900 mb-6">Minhas Contratações</h2>

    <div class="space-y-4">
        <?php if (empty($orders)): ?>
            <div class="p-8 text-center bg-white rounded-2xl border border-gray-100 text-gray-500">
                Você ainda não contratou nenhum profissional.
            </div>
        <?php else: ?>
            <?php foreach ($orders as $order): ?>
                <div class="bg-white border border-gray-100 rounded-2xl p-6 shadow-xs flex flex-col md:flex-row md:items-center md:justify-between gap-4">
                    <div>
                        <h3 class="font-bold text-gray-900"><?php echo htmlspecialchars($order['professional_name']); ?></h3>
                        <p class="text-xs text-indigo-600 font-semibold mt-0.5">🛠️ <?php echo htmlspecialchars($order['category']); ?></p>
                        <p class="text-xs text-gray-400 mt-2">Contratado em: <?php echo date('d/m/Y', strtotime($order['created_at'])); ?></p>
                    </div>

                    <div class="flex flex-col items-end gap-2">
                        <!-- STATUS: EM ANDAMENTO -->
                        <?php if ($order['status'] === 'em_andamento'): ?>
                            <span class="bg-amber-50 text-amber-700 text-xs px-2.5 py-1 rounded-full font-medium">🔨 Em andamento</span>
                            <form action="/freela-app/public/contrato/concluir" method="POST">
                                <input type="hidden" name="contract_id" value="<?php echo $order['id']; ?>">
                                <button type="submit" class="text-xs bg-indigo-600 text-white px-3 py-1.5 rounded-lg hover:bg-indigo-700 transition">Marcar como Concluído</button>
                            </form>

                        <!-- STATUS: CONCLUÍDO (LIBERA AVALIAÇÃO) -->
                        <?php elseif ($order['status'] === 'concluido' && !$order['already_reviewed']): ?>
                            <span class="bg-emerald-50 text-emerald-700 text-xs px-2.5 py-1 rounded-full font-medium mb-1">✅ Concluído</span>
                            
                            <!-- Formulário de Avaliação Pós-Serviço -->
                            <details class="bg-gray-50 rounded-xl p-3 text-xs w-64 cursor-pointer">
                                <summary class="font-medium text-gray-600 select-none">⭐ Avaliar este Trabalho</summary>
                                <form action="/freela-app/public/avaliar/salvar" method="POST" class="space-y-2 mt-2">
                                    <input type="hidden" name="professional_id" value="<?php echo $order['professional_id']; ?>">
                                    <input type="hidden" name="contract_id" value="<?php echo $order['id']; ?>">
                                    <input type="hidden" name="client_name" value="<?php echo $_SESSION['user_name']; ?>">
                                    
                                    <select name="rating" required class="w-full p-1.5 bg-white border border-gray-200 rounded">
                                        <option value="5">5 Estrelas (Excelente)</option>
                                        <option value="4">4 Estrelas (Muito Bom)</option>
                                        <option value="3">3 Estrelas (Regular)</option>
                                        <option value="2">2 Estrelas (Ruim)</option>
                                        <option value="1">1 Estrela (Péssimo)</option>
                                    </select>
                                    <input type="text" name="comment" placeholder="Como foi o serviço?" required class="w-full p-1.5 bg-white border border-gray-200 rounded">
                                    <button type="submit" class="w-full bg-gray-900 text-white p-1 rounded font-medium hover:bg-gray-800 transition">Enviar Nota</button>
                                </form>
                            </details>
                        
                        <?php else: ?>
                            <span class="bg-gray-100 text-gray-500 text-xs px-2.5 py-1 rounded-full font-medium">🎉 Serviço Avaliado</span>
                        <?php endif; ?>
                    </div>
                </div>
            <?php endforeach; ?>
        <?php endif; ?>
    </div>
</section>

<?php require_once 'footer.php'; ?>
