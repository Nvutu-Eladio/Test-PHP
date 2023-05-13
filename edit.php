<?php
    include "db_connect.php";

    $id = isset($_GET["id"]) ? $_GET["id"] : "";

    if (isset($_POST["submit"])) {

    //Dados do Produto
    $var_prodName=mysqli_real_escape_string($conn,$_POST['prodName']);
    $var_fotos=$_FILES['file']['tmp_name'];
    $var_SKU=mysqli_real_escape_string($conn,$_POST['sku']);
    $var_descricao=mysqli_real_escape_string($conn,$_POST['desc']);

    $stmt = mysqli_prepare($conn, "UPDATE `product` SET `prodName`=?, `fotos`=?, `SKU`=?, `descricao`=? WHERE idProduct=?");
    mysqli_stmt_bind_param($stmt, "ssssi", $var_prodName, $var_fotos, $var_SKU, $var_descricao, $id);
    mysqli_stmt_execute($stmt);

        //Dados da Variação

    $var_estoque=mysqli_real_escape_string($conn,$_POST['estoque']);
    $var_tipo=mysqli_real_escape_string($conn,$_POST['tipo']);
    $var_descricao=mysqli_real_escape_string($conn,$_POST['descricao']);

    $sql = mysqli_prepare($conn, "UPDATE `variacao` SET `Estoque`=?, `tipo`=?, `Descricao`=?,  WHERE idProduct=?");
    mysqli_stmt_bind_param($sql, "ssssi", $var_estoque, $var_tipo, $var_descricao, $id);
    mysqli_stmt_execute($sql);


    if (mysqli_stmt_execute($stmt,$sql)) {
        echo "Data updated successfully";
    } else {
        echo "Failed to update data: " . mysqli_stmt_error($stmt);
    }

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
            <h3>Atualizar Produto</h3>
            <p class="text-muted">Clica em atualizar depois de preencher todos os campos</p>
        </div>
        
        <?php
        //Dados do Produto
       $sql = "SELECT * FROM product WHERE idProduct = ?";
       $stmt = mysqli_prepare($conn, $sql);
       mysqli_stmt_bind_param($stmt, "i", $id);
       mysqli_stmt_execute($stmt);
       $result = mysqli_stmt_get_result($stmt);
       $row = mysqli_fetch_assoc($result);

        //Dados da Variação
        $sql = "SELECT * FROM variacao WHERE idProduct = ?";
        $stmt = mysqli_prepare($conn, $sql);
        mysqli_stmt_bind_param($stmt, "i", $id);
        mysqli_stmt_execute($stmt);
        $result = mysqli_stmt_get_result($stmt);
        $row = mysqli_fetch_assoc($result);
        ?>

        <div class="container d-flex justify-content-center">
            <form action="" method="post" enctype="multipart/form-data" style="width:50vw; min-width:300px">
            <div class="row-mb-3">

                <div class="mb-3">
                    <label class="form-label">Nome do Produto:</label>
                    <input type="text" class="form-control" name="prodName" value="<?php echo isset($row['prodName']) ? $row['prodName'] : '' ?>">
                    
                </div>

                <div class="mb-3">
                    <label class="form-label">SKU:</label>
                    <input type="text" class="form-control" name="sku" value="<?php echo isset($row['SKU']) ? $row['SKU'] : '' ?>">
                </div>

                <div class="mb-3">
                    <label class="form-label">fotos:</label>
                    <input type="file" class="form-control" name="file" value="<?php echo "<img src='./uploads/".$row['fotos']."'>" ?>">
                </div>

                <div class="mb-3">
                    <label class="form-label">Descrição:</label>
                    <input type="text" class="form-control" name="desc" value="<?php echo isset($row['descricao']) ? $row['descricao'] : '' ?>">
                </div>

                <div class="mb-3">
                    <h3>Variação do Produto:</h3>
                    <label class="form-label">Estoque:</label>
                    <input type="number" class="form-control" name="estoque" value="<?php echo isset($row['descricao']) ? $row['descricao'] : '' ?>">
                </div>

                <div class="mb-3">
                    <label class="form-label">Preço:</label>
                    <input type="number" class="form-control" name="preco" value="<?php echo isset($row['preco']) ? $row['preco'] : '' ?>">
                </div>

                <div class="mb-3">
                    <label class="form-label">Tipo de Variação:</label>
                    <input type="text" class="form-control" name="tipo_variacao" value="<?php echo isset($row['tipo']) ? $row['tipo'] : '' ?>">
                </div>

                <div class="mb-3">
                    <label class="form-label">Descrição da Variação:</label>
                    <input type="text" class="form-control" name="desc_variacao" alue="<?php echo isset($row['descricao']) ? $row['descricao'] : '' ?>">
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