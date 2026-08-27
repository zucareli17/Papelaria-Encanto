-- ============================================================
-- Papelaria Encanto — schema.sql
-- Banco de dados básico: categorias, produtos e contatos
-- ============================================================

CREATE DATABASE IF NOT EXISTS papelaria_encanto
  CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci;

USE papelaria_encanto;

-- --------------------------------------------------------------
-- Tabela: categorias
-- --------------------------------------------------------------
CREATE TABLE IF NOT EXISTS categorias (
  id INT AUTO_INCREMENT PRIMARY KEY,
  nome VARCHAR(60) NOT NULL,
  slug VARCHAR(60) NOT NULL UNIQUE,
  icone VARCHAR(10) DEFAULT '📎'
) ENGINE=InnoDB;

-- --------------------------------------------------------------
-- Tabela: produtos
-- --------------------------------------------------------------
CREATE TABLE IF NOT EXISTS produtos (
  id INT AUTO_INCREMENT PRIMARY KEY,
  categoria_id INT NOT NULL,
  nome VARCHAR(120) NOT NULL,
  descricao VARCHAR(255) NOT NULL,
  preco DECIMAL(10,2) NOT NULL,
  cor_etiqueta VARCHAR(20) DEFAULT 'amarelo', -- amarelo | rosa | verde (cor da fita washi do card)
  destaque TINYINT(1) NOT NULL DEFAULT 0,
  criado_em TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
  FOREIGN KEY (categoria_id) REFERENCES categorias(id)
) ENGINE=InnoDB;

-- --------------------------------------------------------------
-- Tabela: contatos (leads do formulário)
-- --------------------------------------------------------------
CREATE TABLE IF NOT EXISTS contatos (
  id INT AUTO_INCREMENT PRIMARY KEY,
  nome VARCHAR(120) NOT NULL,
  email VARCHAR(150) NOT NULL,
  telefone VARCHAR(30),
  assunto VARCHAR(150),
  mensagem TEXT NOT NULL,
  criado_em TIMESTAMP DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB;

-- --------------------------------------------------------------
-- Dados de exemplo — categorias
-- --------------------------------------------------------------
INSERT INTO categorias (nome, slug, icone) VALUES
('Cadernos & Blocos', 'cadernos', '📓'),
('Canetas & Escrita', 'canetas', '🖊️'),
('Artesanato & DIY', 'artesanato', '✂️'),
('Organização & Planners', 'planners', '🗓️'),
('Presentes & Papelaria fina', 'presentes', '🎁');

-- --------------------------------------------------------------
-- Dados de exemplo — produtos
-- --------------------------------------------------------------
INSERT INTO produtos (categoria_id, nome, descricao, preco, cor_etiqueta, destaque) VALUES
(1, 'Caderno Pontilhado Kraft', 'Capa dura kraft, 120 folhas, ideal para bullet journal', 42.90, 'amarelo', 1),
(1, 'Bloco de Notas Adesivo', 'Kit com 6 blocos coloridos autoadesivos', 18.50, 'rosa', 0),
(2, 'Caneta Nanquim 0.4mm', 'Ponta fina, tinta pigmentada à prova d’água', 12.90, 'verde', 1),
(2, 'Kit Canetas Coloridas Gel', 'Estojo com 24 cores vibrantes', 39.90, 'rosa', 1),
(3, 'Fita Washi Tape - Kit 10un', 'Estampas florais e geométricas, 15mm', 29.90, 'amarelo', 1),
(3, 'Kit Scrapbook Iniciante', 'Papéis, adesivos e moldes para o primeiro álbum', 54.90, 'verde', 0),
(4, 'Planner Semanal 2026', 'Capa em tecido, espiral duplo, metas e hábitos', 67.90, 'rosa', 1),
(4, 'Organizador de Mesa Bambu', 'Compartimentos para canetas, clipes e post-its', 45.00, 'amarelo', 0),
(5, 'Cartão Artesanal Personalizado', 'Papel algodão 300g, envelope incluso', 15.90, 'verde', 0),
(5, 'Caixa Presente Kraft M', 'Ideal para kits de papelaria, com laço de juta', 22.90, 'rosa', 0);
