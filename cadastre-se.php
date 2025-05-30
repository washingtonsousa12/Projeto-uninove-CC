<?php
session_start();

$mensagem = '';
if (isset($_SESSION['mensagem'])) {
    $mensagem = $_SESSION['mensagem'];
    unset($_SESSION['mensagem']);
}
?>
<!DOCTYPE html>
<html lang="pt-br">

<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Cadastro - Viajante Livre</title>
  <link rel="stylesheet" href="assets/css/style.css" />
  <style>
  /* Estilo básico para o toast */
  #toast {
    display: none;
    position: fixed;
    bottom: 20px;
    left: 50%;
    transform: translateX(-50%);
    background-color: #333;
    color: white;
    padding: 15px 25px;
    border-radius: 5px;
    z-index: 9999;
    font-family: Arial, sans-serif;
    font-size: 16px;
    box-shadow: 0 4px 8px rgba(0, 0, 0, 0.2);
  }
  </style>
</head>

<body>
  <header class="header">
    <nav>
      <ul class="content">
        <li><a href="#inicio" title="Inicio">Inicio</a></li>
        <li><a href="#sobre" title="Sobre">Sobre</a></li>
        <li><a href="#missao" title="Missão e Visão">Missão e Visão</a></li>
        <li><a href="#servicos" title="Serviços">Serviços</a></li>
        <li><a href="#contact" title="Contato">Contato</a></li>
      </ul>
    </nav>
  </header>

  <main class="signup-section">
    <div class="signup-container">
      <h2>Crie sua conta</h2>
      <p>Junte-se à Viajante Livre e viva experiências inesquecíveis.</p>

      <form action="inc/processa-cadastro.php" method="post" class="signup-form">
        <div class="form-group">
          <label for="nome">Nome completo</label>
          <input type="text" id="nome" name="nome" required />
        </div>

        <div class="form-group">
          <label for="email">E-mail</label>
          <input type="email" id="email" name="email" required />
        </div>

        <div class="form-group">
          <label for="senha">Senha</label>
          <input type="password" id="senha" name="senha" required />
        </div>

        <div class="form-group">
          <label for="confirmar-senha">Confirmar senha</label>
          <input type="password" id="confirmar-senha" name="confirmar_senha" required />
        </div>

        <button type="submit" class="btn btn-primary">Cadastrar</button>
      </form>

      <p class="already-registered">Já tem uma conta? <a href="login.php">Faça login</a></p>
    </div>
  </main>

  <footer class="footer">
    <p class="content"><?php echo date("Y"); ?> <strong>viajante-livre Turismo</strong>
      <span>Av. dos Fulanos de Tais, 18801 - sala 1620 Santo Amaro - São Paulo - SP. CEP: 04.054-100 <br>Todos os direitos reservados.</span>
    </p>
  </footer>

  <!-- Toast container -->
  <div id="toast"></div>

  <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
  <script>
  function showToast(msg, type = 'success') {
    const toast = $('#toast');
    toast.text(msg);
    if (type === 'success') {
      toast.css('background-color', '#4CAF50'); // verde
    } else {
      toast.css('background-color', '#f44336'); // vermelho
    }
    toast.fadeIn(400).delay(3000).fadeOut(400);
  }

  $(document).ready(function() {
    const mensagem = <?php echo json_encode($mensagem); ?>;
    if (mensagem) {
      let tipo = 'success';
      const msgLower = mensagem.toLowerCase();
      if (msgLower.includes('erro') || msgLower.includes('preencha') || msgLower.includes('email já cadastrado')) {
        tipo = 'error';
      }
      showToast(mensagem, tipo);
    }
  });
  </script>
</body>

</html>