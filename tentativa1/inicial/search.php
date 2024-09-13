<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <title>Ares Suplementos</title>
</head>
<body>
    <header class="navbar navbar-expand-lg navbar-light bg-light">
        <a class="navbar-brand" href="#">Ares Suplementos</a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarNav">
            <ul class="navbar-nav">
                <li class="nav-item active">
                    <a class="nav-link" href="main.html">Início <span class="sr-only">(current)</span></a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="produtos.html">Produtos</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="#contact">Contato</a>
                </li>
            </ul>
        </div>
    </header>

<?php
// Conexão com o banco de dados
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "suplementos";

$conn = new mysqli($servername, $username, $password, $dbname);

// Verificar a conexão
if ($conn->connect_error) {
    die("Falha na conexão: " . $conn->connect_error);
}

// Consultar produtos mais visitados
$sql = "SELECT id, nome, preco, imagem FROM produtos WHERE destaque = 1";
$result = $conn->query($sql);
?>

    <section id="products" data-anime="right">
        <div id="carouselExampleIndicators" class="carousel slide" data-ride="carousel">
            <ol class="carousel-indicators">
                <?php if ($result->num_rows > 0): ?>
                    <?php for ($i = 0; $i < $result->num_rows; $i++): ?>
                        <li data-target="#carouselExampleIndicators" data-slide-to="<?php echo $i; ?>" class="<?php echo $i == 0 ? 'active' : ''; ?>"></li>
                    <?php endfor; ?>
                <?php endif; ?>
            </ol>
            <div class="carousel-inner">
                <?php
                if ($result->num_rows > 0) {
                    $active = true;
                    while ($row = $result->fetch_assoc()) {
                        ?>
                        <div class="carousel-item <?php if ($active) { echo 'active'; $active = false; } ?>">
                            <div class="card m-2" style="width: 18rem;">
                                <div class="container">
                                    <img src="<?php echo $row['imagem']; ?>" class="card-img-top img-fluid" alt="">
                                    <div class="card-body">
                                        <h3 class="card-title text-center"><?php echo $row['nome']; ?></h3>
                                        <hr>
                                        <h5>R$<?php echo number_format($row['preco'], 2, ',', '.'); ?></h5>
                                        <p class="card-text">2x R$<?php echo number_format($row['preco'] / 2, 2, ',', '.'); ?></p>
                                        <p class="card-text text-success">Frete grátis</p>
                                        <a href="produto.php?id=<?php echo $row['id']; ?>" class="btn btn-success btn-lg">Comprar</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <?php
                    }
                } else {
                    echo "<p class='text-center'>Nenhum produto encontrado.</p>";
                }
                ?>
            </div>
            <a class="carousel-control-prev" href="#carouselExampleIndicators" role="button" data-slide="prev">
                <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                <span class="sr-only">Anterior</span>
            </a>
            <a class="carousel-control-next" href="#carouselExampleIndicators" role="button" data-slide="next">
                <span class="carousel-control-next-icon" aria-hidden="true"></span>
                <span class="sr-only">Próximo</span>
            </a>
        </div>
    </section>

    <footer class="text-center">
        <div class="container">
            <div class="row">
                <div class="col">
                    <p>&copy; 2024 Suplementos TOP. Todos os direitos reservados.</p>
                </div>
            </div>
        </div>
    </footer>

    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>

<?php
$conn->close();
?>
