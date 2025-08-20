<?php
$nome = $email = $senha = $confirmar_senha = '';
$erros = [];
$sucesso = false;

function limpar_dados($dados) {
    $dados = trim($dados);
    $dados = stripslashes($dados);
    $dados = htmlspecialchars($dados);
    return $dados;
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (empty($_POST["nome"])) {
        $erros['nome'] = "O nome completo é obrigatório.";
    } else {
        $nome = limpar_dados($_POST["nome"]);
    }

    if (empty($_POST["email"])) {
        $erros['email'] = "O e-mail é obrigatório.";
    } else {
        $email = limpar_dados($_POST["email"]);
        if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            $erros['email'] = "Formato de e-mail inválido.";
        }
    }

    if (empty($_POST["senha"])) {
        $erros['senha'] = "A senha é obrigatória.";
    } else {
        $senha = limpar_dados($_POST["senha"]);
        if (strlen($senha) < 6) {
            $erros['senha'] = "A senha deve ter no mínimo 6 caracteres.";
        }
    }

    if (empty($_POST["confirmar-senha"])) {
        $erros['confirmar_senha'] = "A confirmação de senha é obrigatória.";
    } else {
        $confirmar_senha = limpar_dados($_POST["confirmar-senha"]);
        if ($senha !== $confirmar_senha) {
            $erros['confirmar_senha'] = "As senhas não coincidem.";
        }
    }

    if (empty($erros)) {
        $senha_hash = password_hash($senha, PASSWORD_DEFAULT);
        
        $sucesso = true;
    }
}
?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cadastre-se</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Bebas+Neue&family=Poppins:wght@300;400;600&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link href="https://unpkg.com/aos@2.3.1/dist/aos.css" rel="stylesheet">
    <script src="https://cdn.tailwindcss.com"></script>
    <style>
        :root {
            --cor-fundo: #1B1B1B;
            --vermelho-vibrante: #FF3B30;
            --vermelho-escuro: #8B0000;
            --cinza-claro: #E0E0E0;
        }
        
        body {
            font-family: 'Poppins', sans-serif;
            color: white;
            background-color: var(--cor-fundo);
        }
        
        .titulo-impacto {
            font-family: 'Bebas Neue', sans-serif;
            letter-spacing: 0.1em;
        }
        
        .float-label input:focus + .label,
        .float-label input:not(:placeholder-shown) + .label {
            @apply -top-2 text-xs font-semibold text-white;
        }
        
        .float-label .label {
            @apply transition-all duration-300 ease-in-out absolute left-0 top-1/2 -translate-y-1/2 cursor-text pointer-events-none text-gray-400;
        }
        
        @keyframes shake {
            0%, 100% { transform: translateX(0); }
            10%, 30%, 50%, 70%, 90% { transform: translateX(-5px); }
            20%, 40%, 60%, 80% { transform: translateX(5px); }
        }
        
        .shake {
            animation: shake 0.5s ease-in-out;
        }
    </style>
</head>
<body class="bg-[#1B1B1B] min-h-screen flex items-center justify-center">

    <div class="flex flex-col md:flex-row w-full max-w-6xl mx-auto my-10 bg-[#1B1B1B] rounded-3xl overflow-hidden shadow-2xl">

        <div class="md:w-2/5 p-8 sm:p-12 md:p-16 flex flex-col justify-between items-center bg-[#8B0000] text-center" data-aos="fade-right" data-aos-duration="1000">
            <div>
                <div class="w-32 h-32 md:w-40 md:h-40 bg-white/20 rounded-full flex items-center justify-center mb-6 border-4 border-white border-opacity-30">
                    <svg class="w-20 h-20 text-white opacity-70" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><path d="M10 9a3 3 0 100-6 3 3 0 000 6zm-7 9a7 7 0 1114 0H3z" clip-rule="evenodd" fill-rule="evenodd"></path></svg>
                </div>
                <h1 class="text-4xl sm:text-5xl md:text-6xl text-white titulo-impacto mb-4" data-aos="fade-in" data-aos-delay="400">
                    BEM-VINDO!
                </h1>
                <p class="text-white text-sm opacity-90 leading-relaxed" data-aos="fade-in" data-aos-delay="600">
                    Estamos criando uma experiência única para você. Cadastre-se agora para mergulhar em um mundo de design e criatividade.
                </p>
            </div>

            <div class="mt-8 flex space-x-6">
                <a href="#" class="text-white hover:text-[#FF3B30] transition-transform duration-300 hover:scale-125" data-aos="zoom-in" data-aos-delay="800"><i class="fab fa-dribbble fa-xl"></i></a>
                <a href="#" class="text-white hover:text-[#FF3B30] transition-transform duration-300 hover:scale-125" data-aos="zoom-in" data-aos-delay="900"><i class="fab fa-behance fa-xl"></i></a>
                <a href="#" class="text-white hover:text-[#FF3B30] transition-transform duration-300 hover:scale-125" data-aos="zoom-in" data-aos-delay="1000"><i class="fab fa-instagram fa-xl"></i></a>
            </div>
        </div>

        <div class="md:w-3/5 p-8 sm:p-12 md:p-16 flex flex-col justify-center" data-aos="fade-left" data-aos-duration="1000">
            <h2 class="text-4xl text-white font-bold mb-8 titulo-impacto">CRIE SUA CONTA</h2>

            <form id="form-cadastro" class="space-y-6" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>" method="post">

                <div class="relative float-label">
                    <input type="text" id="nome-completo" name="nome" placeholder=" " value="<?php echo htmlspecialchars($nome); ?>" class="w-full bg-transparent border-b-2 border-white/50 text-white placeholder-transparent focus:outline-none focus:border-[#FF3B30] transition-all duration-300 p-2 text-lg <?php echo isset($erros['nome']) ? 'border-[#FF3B30]' : ''; ?>">
                    <label for="nome-completo" class="label text-gray-400">Nome Completo</label>
                    <span class="text-[#FF3B30] text-sm mt-1 block h-5 opacity-0 transition-opacity duration-300 <?php echo isset($erros['nome']) ? 'opacity-100 shake' : ''; ?>" id="erro-nome"><?php echo $erros['nome'] ?? ''; ?></span>
                </div>

                <div class="relative float-label">
                    <input type="email" id="email" name="email" placeholder=" " value="<?php echo htmlspecialchars($email); ?>" class="w-full bg-transparent border-b-2 border-white/50 text-white placeholder-transparent focus:outline-none focus:border-[#FF3B30] transition-all duration-300 p-2 text-lg <?php echo isset($erros['email']) ? 'border-[#FF3B30]' : ''; ?>">
                    <label for="email" class="label text-gray-400">E-mail</label>
                    <span class="text-[#FF3B30] text-sm mt-1 block h-5 opacity-0 transition-opacity duration-300 <?php echo isset($erros['email']) ? 'opacity-100 shake' : ''; ?>" id="erro-email"><?php echo $erros['email'] ?? ''; ?></span>
                </div>

                <div class="relative float-label">
                    <input type="password" id="senha" name="senha" placeholder=" " class="w-full bg-transparent border-b-2 border-white/50 text-white placeholder-transparent focus:outline-none focus:border-[#FF3B30] transition-all duration-300 p-2 text-lg <?php echo isset($erros['senha']) ? 'border-[#FF3B30]' : ''; ?>">
                    <label for="senha" class="label text-gray-400">Senha</label>
                    <span class="text-[#FF3B30] text-sm mt-1 block h-5 opacity-0 transition-opacity duration-300 <?php echo isset($erros['senha']) ? 'opacity-100 shake' : ''; ?>" id="erro-senha"><?php echo $erros['senha'] ?? ''; ?></span>
                </div>

                <div class="relative float-label">
                    <input type="password" id="confirmar-senha" name="confirmar-senha" placeholder=" " class="w-full bg-transparent border-b-2 border-white/50 text-white placeholder-transparent focus:outline-none focus:border-[#FF3B30] transition-all duration-300 p-2 text-lg <?php echo isset($erros['confirmar_senha']) ? 'border-[#FF3B30]' : ''; ?>">
                    <label for="confirmar-senha" class="label text-gray-400">Confirmar Senha</label>
                    <span class="text-[#FF3B30] text-sm mt-1 block h-5 opacity-0 transition-opacity duration-300 <?php echo isset($erros['confirmar_senha']) ? 'opacity-100 shake' : ''; ?>" id="erro-confirmar-senha"><?php echo $erros['confirmar_senha'] ?? ''; ?></span>
                </div>

                <button type="submit" class="w-full py-4 text-white font-bold rounded-full bg-[#FF3B30] shadow-lg shadow-[#FF3B30]/50 hover:bg-[#FF665E] transition-all duration-300 transform hover:scale-105 mt-8 titulo-impacto text-lg">
                    CRIAR CONTA
                </button>
            </form>

            <p class="text-center text-sm text-[#E0E0E0] mt-6">
                Já tem uma conta? <a href="#" class="font-bold text-[#FF3B30] hover:underline">Faça login.</a>
            </p>
        </div>
    </div>

    <div id="modal-sucesso" class="fixed inset-0 bg-black bg-opacity-80 flex items-center justify-center hidden opacity-0 transition-opacity duration-500 <?php echo $sucesso ? 'block opacity-100' : ''; ?>">
        <div class="bg-[#FF3B30] text-white p-8 sm:p-12 rounded-2xl text-center shadow-2xl scale-90 opacity-0 transition-all duration-500 transform <?php echo $sucesso ? 'scale-100 opacity-100' : ''; ?>">
            <h3 class="text-3xl font-bold mb-4 titulo-impacto">CADASTRO REALIZADO COM SUCESSO!</h3>
            <p class="text-white/80">Você será redirecionado em breve.</p>
        </div>
    </div>

    <script src="https://unpkg.com/aos@2.3.1/dist/aos.js"></script>
    <script>
        AOS.init({
            once: true,
            offset: 50
        });

        <?php if ($sucesso): ?>
            setTimeout(() => {
                window.location.href = 'site.php';
            }, 3000);
        <?php endif; ?>
    </script>
</body>
</html>