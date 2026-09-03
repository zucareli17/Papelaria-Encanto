<?php
require_once 'db.php';
$paginaAtual = 'index';


$pdo = conectarBanco();
$stmt = $pdo->query("
  SELECT p.*, c.nome AS categoria_nome
  FROM produtos p
  JOIN categorias c ON c.id = p.categoria_id
  WHERE p.destaque = 1
  ORDER BY p.criado_em DESC
  LIMIT 6
");
$destaques = $stmt->fetchAll();


$categorias = $pdo->query("SELECT * FROM categorias ORDER BY nome")->fetchAll();



print_r($categorias);


$status = $_GET['status'] ?? null;
?>
<!DOCTYPE html>
<html lang="pt-BR">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Papelaria Encanto — Papelaria de bairro com curadoria própria</title>
<meta name="description" content="Cadernos, canetas, kits de artesanato e planners com curadoria própria. Visite a Papelaria Encanto.">
<link rel="stylesheet" href="style.css">
</head>
<body>

<?php include 'header.php'; ?>

<!-- HERO -->
<section class="hero">
  <div class="container hero-grid">
    <div>
      <span class="hero-tag"> Papelaria de bairro desde 2014</span>
      <h1>Papel, tinta e <em>detalhe</em><br>em cada gaveta da sua rotina.</h1>
      <p class="lead">Cadernos que dão vontade de escrever, canetas que não falham
        e kits de artesanato para tardes bem gastas. Curadoria própria, entrega rápida.</p>
      <div class="hero-actions">
        <a href="#produtos" class="btn btn-primary">Ver produtos em destaque</a>
        <a href="#contato" class="btn btn-outline">Falar com a loja</a>
      </div>
    </div>

    <div class="hero-visual">
      <div class="tag-card">
        <span class="furo"></span>
        <h3>Caderno Pontilhado Kraft</h3>
        <p>Capa dura kraft, 120 folhas — o queridinho do bullet journal.</p>
        <div class="preco">R$ 42,90 <small>à vista</small></div>
      </div>
    </div>
  </div>
</section>


<section class="sobre" id="sobre">
  <div class="container sobre-grid reveal">
    <div>
      <span class="eyebrow">Nossa história</span>
      <h2 class="section-title">Uma papelaria pensada<br>por quem ama papel.</h2>
      <p class="section-lead">Começamos numa banca de feira, escolhendo caderno por
        caderno. Hoje seguimos do mesmo jeito: cada item do catálogo passa pela nossa
        curadoria antes de chegar até você.</p>

      <div class="categorias-chip">
        <?php foreach ($categorias as $cat): ?>
          <a href="produtos.php?categoria=<?= urlencode($cat['slug']) ?>">
            <?= htmlspecialchars($cat['icone']) ?> <?= htmlspecialchars($cat['nome']) ?>
          </a>
        <?php endforeach; ?>
      </div>
    </div>

    <div class="sobre-lista">
      <div class="sobre-item">
        <span class="icone">🚚</span>
        <div><h4>Entrega em até 48h</h4><p>Para toda a região metropolitana, com rastreio.</p></div>
      </div>
      <div class="sobre-item">
        <span class="icone">🖋️</span>
        <div><h4>Curadoria própria</h4><p>Selecionamos marcas nacionais e independentes.</p></div>
      </div>
      <div class="sobre-item">
        <span class="icone">💛</span>
        <div><h4>Compra que também é presente</h4><p>Embalagem para presente sem custo extra.</p></div>
      </div>
    </div>
  </div>
</section>


<section class="produtos" id="produtos">
  <div class="container">
    <div class="produtos-head reveal">
      <div>
        <span class="eyebrow">Direto do banco de dados</span>
        <h2 class="section-title">Destaques da semana</h2>
      </div>
      <a href="produtos.php" class="btn btn-dark">Ver catálogo completo</a>
    </div>

    <div class="grid-produtos">
      <?php if (empty($destaques)): ?>
        <p class="produtos-vazio">Nenhum produto em destaque no momento. Volte em breve!</p>
      <?php else: ?>
        <?php foreach ($destaques as $p): ?>
          <div class="card-produto reveal">
            <span class="fita <?= htmlspecialchars($p['cor_etiqueta']) ?>"></span>
            <span class="categoria-label"><?= htmlspecialchars($p['categoria_nome']) ?></span>
            <h3><?= htmlspecialchars($p['nome']) ?></h3>
            <p><?= htmlspecialchars($p['descricao']) ?></p>
            <div class="rodape-card">
              <span class="preco">R$ <?= number_format($p['preco'], 2, ',', '.') ?></span>
              <span class="destaque-badge">destaque</span>
            </div>
          </div>
        <?php endforeach; ?>
      <?php endif; ?>
    </div>
  </div>
</section>


<section class="depoimentos">
  <div class="container reveal">
    <span class="eyebrow" style="color:var(--giz-amarelo)">Quem já visitou</span>
    <h2 class="section-title">O que dizem sobre a loja</h2>

    <div class="depo-grid">
      <div class="depo-card">
        <div class="estrelas">★★★★★</div>
        <p>Comprei o planner e os cadernos pontilhados — qualidade de papel excelente,
          nada de tinta borrando.</p>
        <div class="autor">— Marina T.</div>
      </div>
      <div class="depo-card">
        <div class="estrelas">★★★★★</div>
        <p>Encontrei materiais de artesanato que não achava em outro lugar da cidade.
          Atendimento super atencioso.</p>
        <div class="autor">— Rafael A.</div>
      </div>
      <div class="depo-card">
        <div class="estrelas">★★★★★</div>
        <p>Virei cliente fixa: sempre levo algo pra presentear junto com minha compra
          de material de trabalho.</p>
        <div class="autor">— Beatriz L.</div>
      </div>
    </div>
  </div>
</section>


<section class="contato" id="contato">
  <div class="container reveal">
    <span class="eyebrow">Vamos conversar</span>
    <h2 class="section-title">Fale com a Papelaria Encanto</h2>
    <p class="section-lead" style="margin-bottom:36px;">Dúvidas sobre um produto, pedido
      por encomenda ou parceria com escolas — escreva pra gente.</p>

    <div class="contato-grid">
      <div class="contato-info-card">
        <h3>Nos visite</h3>
        <div class="contato-info-item">📍 Rua das Acácias, 245 — Centro</div>
        <div class="contato-info-item">📞 (11) 4002-8922</div>
        <div class="contato-info-item">✉️ ola@papelariaencanto.com.br</div>
        <div class="contato-info-item">🕘 Seg a sáb, 9h às 19h</div>
      </div>

      <div class="form-card">
        <?php if ($status === 'sucesso'): ?>
          <div class="alerta alerta-sucesso">Mensagem enviada! Vamos responder em breve. 💌</div>
        <?php elseif ($status === 'erro'): ?>
          <div class="alerta alerta-erro">Não foi possível enviar. Confira os campos e tente novamente.</div>
        <?php endif; ?>

        <form action="processa_contato.php" method="POST" novalidate>
          <div class="form-row">
            <div class="campo">
              <label for="nome">Nome</label>
              <input type="text" id="nome" name="nome" required>
            </div>
            <div class="campo">
              <label for="email">E-mail</label>
              <input type="email" id="email" name="email" required>
            </div>
          </div>
          <div class="form-row">
            <div class="campo">
              <label for="telefone">Telefone (opcional)</label>
              <input type="text" id="telefone" name="telefone">
            </div>
            <div class="campo">
              <label for="assunto">Assunto</label>
              <input type="text" id="assunto" name="assunto" placeholder="Ex: encomenda para escola">
            </div>
          </div>
          <div class="campo">
            <label for="mensagem">Mensagem</label>
            <textarea id="mensagem" name="mensagem" required></textarea>
          </div>
          <button type="submit" class="btn btn-primary">Enviar mensagem</button>
        </form>
      </div>
    </div>
  </div>
</section>

<?php include 'footer.php'; ?>
</body>
</html>
