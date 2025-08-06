<!DOCTYPE html>
<html lang="pt-br">
<head>
  <meta charset="UTF-8">
  <title>Mega-Sena</title>
  <style>
    body {
      font-family: Arial, sans-serif;
      background: #fff0f0;
      display: flex;
      align-items: center;
      justify-content: center;
      height: 100vh;
      margin: 0;
      text-align: center;
      gap: 4rem;
    }

    h1 {
      color:rgb(205, 119, 119);
      font-size: 3em;
      font-family: impact;
    }

    .numeros {
      display: flex;
      gap: 15px;
      margin: 20px 0;
      flex-wrap: wrap;
      justify-content: center;
      width: 20vw;
    }

    .bola {
      background-color: #d63031;
      color: white;
      font-size: 1.5em;
      width: 100px;
      height: 100px;
      border-radius: 50%;
      display: flex;
      align-items: center;
      justify-content: center;
      box-shadow: 2px 2px 8px rgba(0, 0, 0, 0.3);
      animation: aparecer 0.5s ease-in-out forwards;
      opacity: 0;
    }

    @keyframes aparecer {
      0% {
        transform: scale(0.2);
        opacity: 0;
      }
      100% {
        transform: scale(1);
        opacity: 1;
      }
    }

    .btn-sortear {
      font-size: 1em;
      padding: 8px 20px;
      background-color: #c0392b;
      color: white;
      border: none;
      border-radius: 5px;
      cursor: pointer;
      margin-top: 10px;
      transition: background-color 0.3s ease;
      width: 109%;
      height: 50px;
    }

    .btn-sortear:hover {
      background-color: #e74c3c;
    }

    #formulario {
      display: flex;
      flex-direction: column;
      align-items: center;
      margin-bottom: 20px;
    }

    #formulario input {
      padding: 8px 20px;
      margin-bottom: 10px;
      border: 3px solid rgb(237, 237, 237);
      border-radius: 15px;
      width: 100%;
      height: 40px;
      font-size: 1rem;
      font-weight: bold;
      color: #333;
      outline: none;
    }
  </style>
</head>
<body>
    <div class="contain">
        <h1>Sorteio da Mega-Sena</h1>

        <form id="formulario" method="POST">
            <label for="quantidadeInput" style="margin-bottom: 5px; font-size: 1.1rem; font-style:italic; color: #333;">Digite a quantidade de bolas:</label>
            <input type="number" id="quantidadeInput" name="quantidade" placeholder="Quantidade entre 6 e 10" min="6" max="10" />
            <button class="btn-sortear" type="submit">Sortear</button>
        </form>
    </div>

  <div class="numeros">
    <?php
      function gerarNumerosUnicos($quantidade, $min = 1, $max = 60) {
          $numerosSorteados = [];

          while (count($numerosSorteados) < $quantidade) {
              $num = rand($min, $max);
              if (!in_array($num, $numerosSorteados)) {
                  $numerosSorteados[] = $num;
              }
          }

          sort($numerosSorteados);
          return $numerosSorteados;
      }

      $quantidadeDeBolas = 6;

      if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['quantidade'])) {
          $entrada = (int)$_POST['quantidade'];
          if ($entrada >= 6 && $entrada <= 10) {
              $quantidadeDeBolas = $entrada;
          }
      }

      $resultado = gerarNumerosUnicos($quantidadeDeBolas);

      foreach ($resultado as $index => $numero) {
          // Atraso de animação para cada bola (em segundos)
          $delay = $index * 0.2;
          echo "<div class='bola' style='animation-delay: {$delay}s;'>$numero</div>";
      }
    ?>
  </div>
</body>
</html>
