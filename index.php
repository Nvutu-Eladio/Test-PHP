<?php
include "db_connect.php";
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

        <a href="add_new.php" class="btn btn-dark mb-3">Adicionar Produtos</a>

        <table class="table table-hover text-center">
  <thead class="table-dark">
    <tr>
      <th scope="col">ID</th>
      <th scope="col">Nome do Produto</th>
      <th scope="col">SKU</th>
      <th scope="col">Imagem</th>
      <th scope="col">Descrição</th>
      <th scope="col">Action</th>
    </tr>
  </thead>
  <tbody>

    <?php
        //Dados do Produto
        $sql = "SELECT * FROM `product`";
        $result = mysqli_query($conn, $sql);
        while ($row = mysqli_fetch_array($result)) {
          $img=$row['fotos'];  
    ?>
        <tr>
        <th><?php echo $row['idProduct'] ?></th>
        <th><?php echo $row['prodName'] ?></th>
        <th><?php echo $row['SKU'] ?></th>
        
        <th><img src="uploads/<?php echo $img?>"></th>
        
        <th><?php echo $row['descricao'] ?></th>
        
        <td>
            <a href="edit.php?idProduct=<?php echo $row['idProduct'] ?>" class="link-dark"><i class="fa-solid fa-pen-to-square fs-5 me-4"></i></a>

            <a href="delete.php?idProduct=<?php echo $row['idProduct'] ?>" class="link-dark"><i class="fa-solid fa-trash fs-5"></i></a>
            
        </td>
        </tr>
        
    <?php 
        }
    ?>
        
  </tbody>
</table>
   </div>



    <!-- Boostrap -->
<script src="https://cdn.jsdelivr.net/npm/jquery@3.5.1/dist/jquery.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-Fy6S3B9q64WdZWQUiU+q4/2Lc9npb8tCaSX9FK7E8HnRr0Jz8D6OP9dO5Vg3Q9ct" crossorigin="anonymous"></script>

</body>
</html>