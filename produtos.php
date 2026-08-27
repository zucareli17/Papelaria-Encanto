<?php
require_once __DIR__ . '/config/db.php';
$paginaAtual = 'produtos';

$pdo = conectarBanco();
$categorias = $pdo->query("SELECT * FROM categorias ORDER BY nome")->fetchAll();

$categoriaSlug = $_GET['categoria'] ?? null;

if ($categoriaSlug) {
    $stmt = $pdo->prepare("
      SELECT p.*, c.nome AS categoria_nome, c.slug AS categoria_slug
      FROM produtos p
      JOIN categorias c ON c.id = p.categoria_id
      WHERE c.slug = :slug
      ORDER BY p.nome
    ");
    $stmt->execute(['slug' => $categoriaSlug]);
} else {
    $stmt = $pdo->query("
      SELECT p.*, c.nome AS categoria_nome, c.slug AS categoria_slug
      FROM produtos p
      JOIN categorias c ON c.id = p.categoria_id
      ORDER BY c.nome, p.nome
    ");
}
$produtos = $stmt->fetchAll();
?>
<!DOCTYPE html>
<html lang="pt-BR">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Catálogo — Papelaria Encanto</title>
<link rel="stylesheet" href="css/style.css">
</head>
<body>

<?php include __DIR__ . '/includes/header.php'; ?>

<section class="produtos" style="padding-top:60px;">
  <div class="container">
    <span class="eyebrow">Catálogo completo</span>
    <h2 class="section-title" style="margin-bottom:28px;">Tudo que temos na loja</h2>

    <div class="filtros">
      <a href="produtos.php" class="<?= !$categoriaSlug ? 'ativo' : '' ?>">Todas</a>
      <?php foreach ($categorias as $cat): ?>
        <a href="produtos.php?categoria=<?= urlencode($cat['slug']) ?>"
           class="<?= $categoriaSlug === $cat['slug'] ? 'ativo' : '' ?>">
          <?= htmlspecialchars($cat['icone']) ?> <?= htmlspecialchars($cat['nome']) ?>
        </a>
      <?php endforeach; ?>
    </div>

    <div class="grid-produtos">
      <?php if (empty($produtos)): ?>
        <p class="produtos-vazio">Nenhum produto encontrado nessa categoria.</p>
      <?php else: ?>
        <?php foreach ($produtos as $p): ?>
          <div class="card-produto">
            <span class="fita <?= htmlspecialchars($p['cor_etiqueta']) ?>"></span>
            <span class="categoria-label"><?= htmlspecialchars($p['categoria_nome']) ?></span>
            <h3><?= htmlspecialchars($p['nome']) ?></h3>
            <p><?= htmlspecialchars($p['descricao']) ?></p>
            <div class="rodape-card">
              <span class="preco">R$ <?= number_format($p['preco'], 2, ',', '.') ?></span>
              <?php if ($p['destaque']): ?><span class="destaque-badge">destaque</span><?php endif; ?>
            </div>
          </div>
        <?php endforeach; ?>
      <?php endif; ?>
    </div>
  </div>
</section>

<?php include __DIR__ . '/includes/footer.php'; ?>
</body>
</html>
