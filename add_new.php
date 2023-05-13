<?php
    // include "db_conn.php";
    if (isset($_POST['submit'])){

$codigoProduto = $_POST['sku']; // Código do produto vindo do formulário
$pastaDestino = './uploads/' . $codigoProduto . '\\'; // Caminho da pasta de destino

// Verificar se o diretório de destino existe, caso contrário, criar o diretório
if (!is_dir($pastaDestino)) {
    mkdir($pastaDestino, 0777, true);
}

$nomeOriginal = $_FILES["file"]["name"];
$extensao = pathinfo($nomeOriginal, PATHINFO_EXTENSION);

// Gerar um nome único para o arquivo
$novoNome = uniqid() . '_' . time() . '.' . $extensao;

// Caminho completo para salvar o arquivo
$caminho = $pastaDestino . $novoNome;

// Mover o arquivo para o novo caminho
if (move_uploaded_file($_FILES["file"]["tmp_name"], $caminho)) {
    // O arquivo foi carregado com sucesso
    // Você pode salvar o caminho completo do arquivo no banco de dados ou realizar outras ações
    // ...
} else {
    // Ocorreu um erro ao carregar o arquivo
    // Lógica para lidar com o erro
    // ...
}

    require('db_connect.php');
    $var_prodName=mysqli_real_escape_string($conn,$_POST['prodName']);
    $var_fotos=$_FILES['file']['tmp_name'];
    $var_SKU=mysqli_real_escape_string($conn,$_POST['sku']);
    $var_descricao=mysqli_real_escape_string($conn,$_POST['desc']);

    if ($var_prodName===""OR $var_fotos===""OR $var_SKU===""  OR $var_descricao===""){
  
      ?>
  
      <script type="text/javascript">
        window.alert("Deve preencher todos os campos");
      </script>
  
      <?php
    }else{
  
      $isrt="INSERT INTO product
    (fotos,prodName,SKU,descricao) VALUES
    ('$caminho','$var_prodName','$var_SKU','$var_descricao')";
      $exec=mysqli_query($conn,$isrt) OR die(mysqli_connect_error($con));
      move_uploaded_file($_FILES["file"]["tmp_name"],$caminho);

    //Dados da variação
    $idProduct = mysqli_insert_id($conn); 
    $var_estoque=mysqli_real_escape_string($conn,$_POST['estoque']);
    $var_preco=mysqli_real_escape_string($conn,$_POST['preco']);
    $var_tipoVariacao=mysqli_real_escape_string($conn,$_POST['tipo_variacao']);
    $var_descVariacao=mysqli_real_escape_string($conn,$_POST['desc_variacao']);
    
    $sql = "INSERT INTO variacao
    (idProduct,Estoque,Tipo,Descricao) VALUES 
    ('$idProduct','$var_estoque', '$var_tipoVariacao', '$var_descVariacao')";
    $exe=mysqli_query($conn,$sql) OR die(mysqli_connect_error($con));
    ?>

  
      <script type="text/javascript">
        window.alert("dados inseridos com sucesso");
        window.location.href="./index.php";
      </script>
      <?php
  
  }
  ?>
 <?php
      }
    ?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <!-- Boostrap -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/css/bootstrap.min.css" integrity="sha384-xOolHFLEh07PJGoPkLv1IbcEPTNtaed2xpHsD9ESMhqIYd0nLMwNLD69Npy4HI+N" crossorigin="anonymous">

    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css" integrity="sha512-KfkfwYDsLkIlwQp6LFnl8zNdLGxu9YAA1QvwINks4PhcElQSvqcyVLLD9aMhXd13uQjoXtEKNosOWaZqXgel0g==" crossorigin="anonymous" referrerpolicy="no-referrer" />

    <title>Test PHP - CRUD APPLICATION</title>
</head>
<body>

    <nav class="navbar navbar-light justify-content-center fs-3 mb-5" style="background-color: #00ff5573;">
        Test PHP - CRUD APPLICATION
    </nav>


    <div class="container">
        <div class="text-center mb-4">
            <h3>Adicionar Novos Produtos</h3>
            <p class="text-muted">Completa todos os campos para adicionar novos produtos</p>
        </div>

        <div class="container d-flex justify-content-center">
            <form action="" method="post" enctype="multipart/form-data" style="width:50vw; min-width:300px">
            <div class="row-mb-3">

                <div class="mb-3">
                    <label class="form-label">Nome do Produto:</label>
                    <input type="text" class="form-control" name="prodName" placeholder="Caneta">
                </div>

                <div class="mb-3">
                    <label class="form-label">SKU:</label>
                    <input type="text" class="form-control" name="sku" placeholder="AB5789">
                </div>

                <div class="mb-3">
                    <label class="form-label">fotos:</label>
                    <input type="file" class="form-control" name="file" placeholder="fotos">
                </div>

                <div class="mb-3">
                    <label class="form-label">Descrição:</label>
                    <input type="text" class="form-control" name="desc" placeholder="Descrição">
                </div>

                <div class="mb-3">
                    <h3>Variação do Produto:</h3>
                    <label class="form-label">Estoque:</label>
                    <input type="number" class="form-control" name="estoque" placeholder="Estoque">
                </div>

                <div class="mb-3">
                    <label class="form-label">Preço:</label>
                    <input type="number" class="form-control" name="preco" placeholder="Preço">
                </div>

                <div class="mb-3">
                    <label class="form-label">Tipo de Variação:</label>
                    <input type="text" class="form-control" name="tipo_variacao" placeholder="Cor, Tamanho Ou Cor e Tamanho">
                </div>

                <div class="mb-3">
                    <label class="form-label">Descrição da Variação:</label>
                    <input type="text" class="form-control" name="desc_variacao" placeholder="Descrição da variação">
                </div>

                <div>
                    <button type="submit" class="btn btn-success" name="submit">Salvar</button>
                    <a href="index.php" class="btn btn-danger">Cancelar</a>
                </div>
            </div>
            </form>
        </div>
    </div>




    <!-- Boostrap -->
<script src="https://cdn.jsdelivr.net/npm/jquery@3.5.1/dist/jquery.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-Fy6S3B9q64WdZWQUiU+q4/2Lc9npb8tCaSX9FK7E8HnRr0Jz8D6OP9dO5Vg3Q9ct" crossorigin="anonymous"></script>

</body>
</html>