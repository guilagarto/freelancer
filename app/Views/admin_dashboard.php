<?php require_once 'header.php'; ?>

<section class="max-w-6xl mx-auto px-4 py-12 grid grid-cols-1 md:grid-cols-3 gap-8">
    
    <!-- Coluna Esquerda: Formulário de Cadastro -->
    <div class="md:col-span-1 bg-white p-6 rounded-2xl border border-gray-100 shadow-sm h-fit">
        <div class="flex justify-between items-center border-b border-gray-100 pb-3 mb-4">
            <h2 class="text-lg font-bold text-gray-900">Nova Publicação</h2>
            <a href="/freela-app/public/admin/sair" class="text-xs text-red-600 hover:underline">Sair do Painel</a>
        </div>

        <?php if (isset($_GET['sucesso'])): ?>
            <div class="bg-emerald-50 text-emerald-700 p-3 rounded-lg text-xs font-medium mb-4 border border-emerald-100">
                🚀 Publicado com sucesso no Blog!
            </div>
        <?php endif; ?>

        <!-- NOVO ALERTA: Mensagem amarela de exclusão com sucesso -->
        <?php if (isset($_GET['excluido'])): ?>
            <div class="bg-amber-50 text-amber-700 p-3 rounded-lg text-xs font-medium mb-4 border border-amber-100">
                🗑️ Publicação removida com sucesso!
            </div>
        <?php endif; ?>

        <form action="/freela-app/public/admin/postar" method="POST" class="space-y-4">
            <div>
                <label class="block text-xs font-medium text-gray-700">Título do Post / Vaga</label>
                <input type="text" name="title" required placeholder="Ex: Contrata-se Pedreiro Urgente" class="mt-1 block w-full px-3 py-2 bg-gray-50 border border-gray-200 rounded-lg text-xs focus:outline-none focus:border-indigo-500 focus:bg-white transition">
            </div>

            <div>
                <label class="block text-xs font-medium text-gray-700">Tipo de Conteúdo</label>
                <select name="type" required class="mt-1 block w-full px-3 py-2 bg-gray-50 border border-gray-200 rounded-lg text-xs focus:outline-none focus:border-indigo-500 focus:bg-white transition">
                    <option value="vaga">💼 Vaga de Emprego</option>
                    <option value="noticia">📰 Notícia Geral / Dica</option>
                    <option value="oportunidade">🚀 Oportunidade Comercial</option>
                </select>
            </div>

            <div>
                <label class="block text-xs font-medium text-gray-700">Conteúdo do Artigo / Detalhes da Vaga</label>
                <textarea name="content" rows="6" required placeholder="Escreva os detalhes, requisitos e contatos..." class="mt-1 block w-full px-3 py-2 bg-gray-50 border border-gray-200 rounded-lg text-xs focus:outline-none focus:border-indigo-500 focus:bg-white transition"></textarea>
            </div>

            <button type="submit" class="w-full bg-gray-900 hover:bg-gray-800 text-white py-2 rounded-lg font-medium text-xs transition cursor-pointer">
                Publicar Agora ⚡
            </button>
        </form>
    </div>
    <!-- Coluna Direita: Lista de Postagens Atuais -->
    <div class="md:col-span-2 space-y-4">
        <h2 class="text-xl font-bold text-gray-900">Postagens Ativas no Site (<?php echo count($posts); ?>)</h2>
        
        <div class="space-y-3 max-h-[600px] overflow-y-auto pr-2">
            <?php if (empty($posts)): ?>
                <p class="text-sm text-gray-400 italic">Nenhuma publicação ativa encontrada.</p>
            <?php else: ?>
                <?php foreach ($posts as $post): ?>
                    <!-- Card da Postagem Ajustado com Flex para alinhar o botão de lixeira -->
                    <div class="bg-white p-4 rounded-xl border border-gray-100 shadow-xs flex justify-between items-center gap-4 hover:border-gray-200 transition">
                        <div class="flex-grow">
                            <div class="flex items-center gap-2 mb-1">
                                <span class="text-[10px] font-bold px-2 py-0.5 rounded uppercase <?php echo $post['type'] === 'vaga' ? 'bg-red-50 text-red-700' : 'bg-blue-50 text-blue-700'; ?>">
                                    <?php echo $post['type']; ?>
                                </span>
                                <span class="text-[10px] text-gray-400"><?php echo date('d/m/Y', strtotime($post['created_at'])); ?></span>
                            </div>
                            <h4 class="font-bold text-gray-800 text-sm"><?php echo htmlspecialchars($post['title']); ?></h4>
                            <p class="text-xs text-gray-500 line-clamp-2 mt-1"><?php echo htmlspecialchars($post['content']); ?></p>
                        </div>

                        <!-- NOVO: BOTÃO DE DELETAR COM CONFIRMAÇÃO EM JAVASCRIPT -->
                        <div class="shrink-0">
                            <a href="/freela-app/public/admin/postar/deletar?id=<?php echo $post['id']; ?>" 
                               onclick="return confirm('Tem certeza absoluta que deseja apagar esta publicação permanente do site?')" 
                               class="bg-red-50 text-red-600 p-2 rounded-xl border border-red-100/70 hover:bg-red-100 transition inline-block text-xs font-medium cursor-pointer"
                               title="Excluir Publicação">
                                🗑️ Apagar
                            </a>
                        </div>
                    </div>
                <?php endforeach; ?>
            <?php endif; ?>
        </div>
    </div>
</section>

<?php require_once 'footer.php'; ?>
