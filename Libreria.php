<?php
$DSN = 'mysql:host=localhost;dbname=mytrack';
$conn = new PDO($DSN,'root','');
?>

<!DOCTYPE html>
<html lang="it" dir="ltr">
  <head>
    <meta charset="utf-8">
    <link href="https://fonts.googleapis.com/css2?family=Quicksand:wght@500&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="css/bootstrap.css">
    <link rel="stylesheet" href="css/styleLibreria.css">
    <title>Libreria</title>
  </head>
  <body>
    <nav aria-label="breadcrumb">
      <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="Homepage.php">Home</a></li>
        <li class="breadcrumb-item"><a href="Libreria.php">Libreria</a></li>
        <li class="breadcrumb-item"><a href="#">Film</a></li>
        <li class="breadcrumb-item"><a href="#">Corsi Udemy</a></li>
        <li class="breadcrumb-item"><a href="#">Immagini Pinterest</a></li>
      </ol>
  </nav>
    <?php
    function calcPercentLibro($paginaAtt, $pagineTot)
    {
      $ris = ($paginaAtt/$pagineTot) * 100;
      return $ris;
    }
    ?>


    <div class="container">

      <h1>Libreria di Mike</h1>
      <!-- <a href="InserisciLibro.php" class="btn btn-secondary btn-lg active" role="button" aria-pressed="true">Inserisci nuovo libro</a> -->
      <a id="InserisciLibroBtn" href="InserisciLibro.php" class="btn btn-secondary btn-lg active" role="button" aria-pressed="true">Inserisci nuovo libro</a>
    </div>


    <table class="table table-hover">
      <thead class="thead-dark">
        <tr>
          <th scope="col">Id Libro</th>
          <th scope="col">Anno lettura</th>
          <th scope="col">Autore</th>
          <th scope="col">Titolo</th>
          <th scope="col">Pagine</th>
          <th scope="col">Categoria</th>
          <th scope="col">Iniziato il</th>
          <th scope="col">Da finire entro</th>
          <th scope="col">Pagina Attuale</th>
          <th scope="col">Da rileggere</th>
          <th scope="col">% Completamento</th>
          <th scope="col">Azioni</th>
        </tr>
      </thead>

  <tbody>

    <?php
    $conn;
    $DBQuery = "SELECT * FROM libreria";
    $sql = $conn->query($DBQuery);
    while ($Data = $sql->fetch()) {
      $table_ID =                 $Data["ID"];
      $table_ANNO_LETTURA =       $Data["ANNO_LETTURA"];
      $table_AUTORE =             $Data["AUTORE"];
      $table_TITOLO =             $Data["TITOLO"];
      $table_PAGINE =             $Data["PAGINE"];
      $table_CATEGORIA =          $Data["CATEGORIA"];
      $table_INIZIO =             $Data["INIZIATO_IL"];
      $table_FINE =               $Data["DA_FINIRE_IL"];
      $table_PAGINA_AT =          $Data["PAGINA_ATTUALE"];
      $table_DARILEGGERE =        $Data["DA_RILEGGERE"];
      $libro_completo = null;
      $percentualeCompl = calcPercentLibro($table_PAGINA_AT,$table_PAGINE);
      if($percentualeCompl == 100){
        $libro_completo = "bg-success";
      } else {
        $libro_completo = "";
      }


    ?>

    <tr style="background-color: #d5f5e3;">
      <th scope="row"><?php echo $table_ID; ?></th>
      <td><?php echo $table_ANNO_LETTURA; ?></td>
      <td><?php echo $table_AUTORE;?></td>
      <td><?php echo $table_TITOLO;?></td>
      <td><?php echo $table_PAGINE;?></td>
      <td><?php echo $table_CATEGORIA;?></td>
      <td><?php echo $table_INIZIO;?></td>
      <td><?php echo $table_FINE;?></td>
      <td><?php echo $table_PAGINA_AT;?></td>
      <td><?php echo $table_DARILEGGERE;?></td>
      <td><div class="progress"><div class="progress-bar <?php echo $libro_completo ?>" role="progressbar" style="width: <?php echo $percentualeCompl ?>%" aria-valuenow="25" aria-valuemin="0" aria-valuemax="100"><?php echo $percentualeCompl ?>%</div></div></td>
      <td><a href="AggiornaLibro.php?table_ID=<?php echo $table_ID  ?>">Aggiorna</a></td>
    </tr>

    <?php } ?>



  </tbody>
</table>




  <!-- <script type="text/javascript" src="js/jquery-3.5.1.js"></script>
  <script type="text/javascript" src="js/progressBar.js"></script> -->
  </body>
</html>
