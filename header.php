<header class="site-header">
  <div class="container nav">
    <a href="index.php" class="logo">Papelaria <span>Encanto</span></a>

    <button class="nav-toggle" aria-label="Abrir menu">
      <span></span><span></span><span></span>
    </button>

    <nav class="nav-links">
      <a href="index.php#sobre">Sobre</a>
      <a href="index.php#produtos" class="<?= ($paginaAtual ?? '') === 'index' ? 'ativo' : '' ?>">Destaques</a>
      <a href="produtos.php" class="<?= ($paginaAtual ?? '') === 'produtos' ? 'ativo' : '' ?>">Catálogo</a>
      <a href="index.php#contato" class="<?= ($paginaAtual ?? '') === 'contato' ? 'ativo' : '' ?>">Contato</a>
      <a href="index.php#contato" class="btn btn-primary" style="padding:10px 18px;">Fale conosco</a>
    </nav>
  </div>
</header>
