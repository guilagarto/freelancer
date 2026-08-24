<?php require_once 'header.php'; ?>

<section class="max-w-2xl mx-auto px-4 py-12">
    <div class="bg-white p-8 rounded-2xl shadow-sm border border-gray-100">
        
        <!-- Cabeçalho do Painel -->
        <div class="border-b border-gray-100 pb-4 mb-6">
            <h2 class="text-2xl font-bold text-gray-900">Meu Painel Profissional</h2>
            <p class="text-sm text-gray-500 mt-1">Mantenha seu perfil atualizado para atrair mais clientes na plataforma.</p>
        </div>

        <!-- Mensagem de Alerta Verde quando os dados e a imagem são salvos com sucesso -->
        <?php if (isset($_GET['salvo'])): ?>
            <div class="bg-emerald-50 text-emerald-700 p-4 rounded-xl text-sm font-medium mb-6 border border-emerald-100 flex items-center gap-2">
                <span>✨</span> Perfil e foto atualizados com sucesso!
            </div>
        <?php endif; ?>

        <!-- Formulário com ENCTYPE ativado para permitir o upload da imagem para o PHP -->
        <form action="/freela-app/public/painel/salvar" method="POST" enctype="multipart/form-data" class="space-y-5">
            
            <!-- ÁREA DE UPLOAD E PREVIEW DA FOTO -->
            <div class="flex items-center gap-4 bg-gray-50 p-4 rounded-xl border border-gray-200/60">
                <!-- Círculo de Preview Inteligente -->
                <div class="w-16 h-16 bg-indigo-100 text-indigo-700 rounded-full flex items-center justify-center font-bold text-xl overflow-hidden shadow-xs shrink-0 border border-indigo-200/50">
                    <?php if (!empty($profile['avatar']) && file_exists(__DIR__ . '/../../public/uploads/' . $profile['avatar'])): ?>
                        <!-- Se o profissional já tiver uma foto salva na pasta de uploads, mostra ela -->
                        <img src="/freela-app/public/uploads/<?php echo $profile['avatar']; ?>" class="w-full h-full object-cover">
                    <?php else: ?>
                        <!-- Se não tiver foto, mostra dinamicamente a primeira letra do nome dele -->
                        <?php echo strtoupper(substr($_SESSION['user_name'], 0, 1)); ?>
                    <?php endif; ?>
                </div>
                
                <!-- Campo de Seleção do Arquivo no Computador -->
                <div class="flex-grow">
                    <label class="block text-sm font-medium text-gray-700">Foto de Perfil ou Logotipo</label>
                    <input type="file" name="avatar" accept="image/png, image/jpeg, image/jpg" 
                           class="mt-1 block w-full text-xs text-gray-500 file:mr-4 file:py-1.5 file:px-3 file:rounded-lg file:border-0 file:text-xs file:font-semibold file:bg-indigo-50 file:text-indigo-700 hover:file:bg-indigo-100 transition cursor-pointer">
                    <p class="text-[10px] text-gray-400 mt-1">Formatos aceitos: JPG, JPEG ou PNG.</p>
                </div>
            </div>

            <!-- CAMPO: CATEGORIA PROFISSIONAL -->
            <div>
                <label class="block text-sm font-medium text-gray-700">Categoria / Profissão</label>
                <input type="text" name="category" placeholder="Ex: Eletricista, Desenvolvedor Web, Pintor, Designer..." required 
                       value="<?php echo htmlspecialchars($profile['category'] ?? ''); ?>"
                       class="mt-1 block w-full px-3 py-2 bg-gray-50 border border-gray-200 rounded-lg text-sm focus:outline-none focus:border-indigo-500 focus:bg-white transition">
            </div>

            <!-- CAMPOS EM DUAS COLUNAS: PREÇO E WHATSAPP -->
            <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                <!-- PREÇO POR HORA -->
                <div>
                    <label class="block text-sm font-medium text-gray-700">Preço por Hora (R$)</label>
                    <input type="number" name="price_per_hour" step="0.01" placeholder="0.00" required 
                           value="<?php echo htmlspecialchars($profile['price_per_hour'] ?? ''); ?>"
                           class="mt-1 block w-full px-3 py-2 bg-gray-50 border border-gray-200 rounded-lg text-sm focus:outline-none focus:border-indigo-500 focus:bg-white transition">
                </div>
                
                <!-- WHATSAPP -->
                <div>
                    <label class="block text-sm font-medium text-gray-700">WhatsApp (Apenas números com DDD)</label>
                    <input type="text" name="phone" placeholder="Ex: 11999999999" required 
                           value="<?php echo htmlspecialchars($profile['phone'] ?? ''); ?>"
                           class="mt-1 block w-full px-3 py-2 bg-gray-50 border border-gray-200 rounded-lg text-sm focus:outline-none focus:border-indigo-500 focus:bg-white transition">
                </div>
            </div>

            <!-- CAMPO: BIOGRAFIA / DESCRIÇÃO DOS SERVIÇOS -->
            <div>
                <label class="block text-sm font-medium text-gray-700">Biografia / Descrição dos seus Serviços</label>
                <textarea name="bio" rows="4" placeholder="Conte um pouco sobre sua experiência, especialidades, regiões que atende e ferramentas que utiliza..." required 
                          class="mt-1 block w-full px-3 py-2 bg-gray-50 border border-gray-200 rounded-lg text-sm focus:outline-none focus:border-indigo-500 focus:bg-white transition"><?php echo htmlspecialchars($profile['bio'] ?? ''); ?></textarea>
            </div>

            <!-- BOTÕES DE AÇÃO -->
            <div class="flex justify-end gap-3 pt-4 border-t border-gray-100">
                <a href="/freela-app/public/profissionais" class="px-4 py-2 border border-gray-200 text-gray-700 text-sm font-medium rounded-lg hover:bg-gray-50 transition">
                    Ver na Busca Pública
                </a>
                <button type="submit" class="bg-indigo-600 text-white px-5 py-2 rounded-lg font-medium text-sm hover:bg-indigo-700 transition shadow-xs cursor-pointer">
                    Salvar Alterações 💾
                </button>
            </div>

        </form>
    </div>
</section>

<?php require_once 'footer.php'; ?>
