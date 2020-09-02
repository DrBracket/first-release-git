<?php
$DSN = 'mysql:host=localhost;dbname=mytrack';
$conn = new PDO($DSN,'root','');

$updateSucc = null;
if (isset($_POST["Submit"])) {
  if (
  (!empty($_POST["titolo"])) &&
  (!empty($_POST["autore"])) &&
  (!empty($_POST["annoLettura"])) &&
  (!empty($_POST["pagine"])) &&
  (!empty($_POST["paginaAtt"]))
  // (!empty($_POST["categoria"]))




) {

    $titolo = $_POST["titolo"];
    $autore = $_POST["autore"];
    $annoLettura = $_POST["annoLettura"];
    $pagine = $_POST["pagine"];
    $paginaAtt = $_POST["paginaAtt"];
    // $categoria = $_POST["categoria"];



    $conn;
    $sql = "INSERT INTO libreria(TITOLO,AUTORE,ANNO_LETTURA,PAGINE,PAGINA_ATTUALE)
    VALUES(:TITOLO,:AUTORE,:ANNO_LETTURA,:PAGINE,:PAGINA_ATTUALE)";
    $sqlInj = $conn->prepare($sql);

    $sqlInj->bindValue(":TITOLO",$titolo);
    $sqlInj->bindValue(":AUTORE",$autore);
    $sqlInj->bindValue(":ANNO_LETTURA",$annoLettura);
    $sqlInj->bindValue(":PAGINE",$pagine);
    $sqlInj->bindValue(":PAGINA_ATTUALE",$paginaAtt);
    // $sqlInj->bindValue(":CATEGORIA",$categoria);

    $result = $sqlInj->execute();
    if ($result) {
      $updateSucc = "Libro Aggiunto al Database!";
    } else {
      $updateSucc = "Errore in fase di inserimento del libro..";
    }
  } else {
    $updateSucc = "Errore in fase di inserimento del libro..";
  }
}

?>
<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <meta charset="utf-8">
    <link rel="stylesheet" href="css/bootstrap.css">
    <link rel="stylesheet" href="css/InserisciLibro.css">
    <title>Inserisci Nuovo Libro</title>
  </head>
  <body>
      <div class="wrapper">
        <form class="form-signin" action="InserisciLibro.php" method="POST">
          <h4>Inserisci un nuovo libro</h4>
          <div class="form-separator">
            <label for="username">Titolo: </label>
            <input type="text" class="form-control" placeholder="Titolo" aria-label="Titolo" aria-describedby="basic-addon1" name="titolo">
            <label for="name">Autore: </label>
            <input type="text" class="form-control" id="inlineFormInputGroup" placeholder="Autore" name="autore">
            <br>
            <div class="input-group mb-3">
              <div class="input-group-prepend">
                <label class="input-group-text" for="inputGroupSelect01">Anno Lettura</label>
              </div>
              <select class="custom-select" id="inputGroupSelect01" name="annoLettura">
                <option selected value="<?php echo date("Y"); ?>">Corrente</option>
                <option value="2021">2021</option>
                <option value="2022">2022</option>
                <option value="2023">2023</option>
              </select>
            </div>

            <div class="input-group mb-3">
              <div class="input-group-prepend">
                <label class="input-group-text" for="inputGroupSelect01">Categoria</label>
              </div>
              <select class="custom-select" id="inputGroupSelect01" name="categoria">
                <option selected value="Romanzo">Romanzo</option>
                <option value="Biografia/Autobiografia/Memorialistica">Biografia/Autobiografia/Memorialistica</option>
                <option value="Business">Business</option>
                <option value="Socio/Culturale">Socio/Culturale</option>
              </select>
            </div>

            <label for="name">Pagine: </label>
            <input type="text" class="form-control" id="inlineFormInputGroup" placeholder="Pagine del libro" name="pagine">
            <br>
            </div>
            <label for="name">Pagina attuale: </label>
            <input type="text" class="form-control" placeholder="Pagina attuale" name="paginaAtt">
            <br>

            <input type="Submit" class="btn btn-dark" name="Submit" value="Aggiungi">
            <br>
            <?php echo $updateSucc ?>
            <br>
            <a href="Libreria.php">Back to</a>

          </div>
        </form>
        <div class="bg"></div>
      </div>



  </body>
</html>
