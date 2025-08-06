<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Calendário</title>
    <style>
        *{
            margin: 0;
            box-sizing: border-box;
            color: white;
        }
        body {
            font-family: Arial, sans-serif;
            margin: 20px;
            height: 100vh;
            text-align: center;
            background-color: black;
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: center;
        }
        table {
            border-collapse: collapse;
            width: 60%;
            border: solid 3px rgb(21, 21, 21);
            border-radius: 1rem;
        }
        th, td {
            border: solid 3px rgb(21, 21, 21);
            padding: 10px;
            text-align: center;
        }
        th {
            background-color: rgb(255, 119, 0);
        }
        td {
            height: 50px;
        }
        td:hover {
            background-color:rgb(21, 21, 21);
        }
        form{
            padding: 2rem;
        }
        .botaomes{
            width: 10rem;
            height: 3rem;
            border-radius: 10px;
            border: none;
            background-color:rgb(231, 128, 3);
            font-weight: bold;
            font-size: 1rem;
            color: white;
        }
        .top{
            height: 5rem;
            background-color: rgb(255, 119, 0);
            width: 60%;
            display: flex;
            align-items: center;
            justify-content: center;
            border: solid 3px rgb(255, 119, 0);
            border-bottom: none;
        }
        #ano{
            width: 10rem;
            height: 3rem;
            border-radius: 10px;
        }
        #mes{
            width: 10rem;
            height: 3rem;
            border-radius: 10px;
        }
        select option[disabled] {
        color: gray;
    }
        select {
            width: 10rem;
            height: 3rem;
            border-radius: 10px;
        }
        button {
            width: 10rem;
            height: 3rem;
            border-radius: 10px;
            background-color: rgb(255, 119, 0);
            color: white;
            border: none;
            cursor: pointer;
            transition: ease-in-out 0.3s;
        }
        button:hover {
            background-color: rgb(255, 149, 0);
        }
    </style>
    <script>
        function validarFormulario() {
            const mes = document.getElementById('mes').value;
            const ano = document.getElementById('ano').value;

            if (mes === "" || ano === "") {
                alert("Por favor, selecione um mês e um ano.");
                return false; // Impede o envio do formulário
            }
            return true; // Permite o envio do formulário
        }
    </script>
</head>
<body>
    <?php
    // Verifica se o formulário foi enviado
    if (isset($_GET['mes']) && isset($_GET['ano'])) {
        $mes = $_GET['mes']; // Obtém o mês selecionado
        $ano = $_GET['ano']; // Obtém o ano selecionado
    } else {
        $mes = date('m'); // Mês atual
        $ano = date('Y'); // Ano atual
    }

    // Descobrir o primeiro dia do mês
    $primeiroDia = mktime(0, 0, 0, $mes, 1, $ano);

    // Nome do mês
    $nomeMes = date('F', $primeiroDia);

    // Descobrir o dia da semana do primeiro dia do mês (0 = Domingo, 6 = Sábado)
    $diaSemana = date('w', $primeiroDia);

    // Descobrir o número de dias no mês
    $diasNoMes = cal_days_in_month(CAL_GREGORIAN, $mes, $ano);
    ?>
    <!-- Exibição do calendário -->
    <h2 class="top"><?php echo $nomeMes . " " . $ano; ?></h2>
    <table>
        <tr>
            <th>Dom</th>
            <th>Seg</th>
            <th>Ter</th>
            <th>Qua</th>
            <th>Qui</th>
            <th>Sex</th>
            <th>Sáb</th>
        </tr>
        <tr>
            <?php
            // Adicionar células vazias até o primeiro dia do mês
            for ($i = 0; $i < $diaSemana; $i++) {
                echo "<td class='empty'></td>";
            }

            // Preencher os dias do mês
            for ($dia = 1; $dia <= $diasNoMes; $dia++) {
                echo "<td>$dia</td>";

                // Quebrar a linha na tabela após sábado
                if (($dia + $diaSemana) % 7 == 0) {
                    echo "</tr><tr>";
                }
            }

            // Completar a última semana com células vazias, se necessário
            while (($dia + $diaSemana) % 7 != 0) {
                echo "<td class='empty'></td>";
                $dia++;
            }
            ?>
        </tr>
    </table>
    <form method="GET" onsubmit="return validarFormulario()">
        <label for="mes">Mês:</label>
        <select name="mes" id="mes">
            <option value="" disabled <?php echo (!isset($_GET['mes']) || $_GET['mes'] == "") ? "selected" : ""; ?>>Selecione o mês</option>
            <?php
            for ($i = 1; $i <= 12; $i++) {
                $selected = (isset($_GET['mes']) && $_GET['mes'] == $i) ? "selected" : "";
                echo "<option value='$i' $selected>" . date('F', mktime(0, 0, 0, $i, 1)) . "</option>";
            }
            ?>
        </select>

        <label for="ano">Ano:</label>
        <select name="ano" id="ano">
            <option value="" disabled <?php echo (!isset($_GET['ano']) || $_GET['ano'] == "") ? "selected" : ""; ?>>Selecione o ano</option>
            <?php
            for ($i = 1900; $i <= 2100; $i++){
                $selected = (isset($_GET['ano']) && $_GET['ano'] == $i) ? "selected" : "";
                echo "<option value='$i' $selected>$i</option>";
            }
            ?>
        </select>

        <button type="submit">Gerar</button>
    </form>
</body>
</html>