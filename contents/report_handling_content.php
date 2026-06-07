<main>
<h2 class="mt-2">Recensione Segnalata</h2>
<div class="card mb-4" style="height: clamp(100px, 60vh, 200px);">
    <div class="card-body overflow-auto bg-light <?php echo $style; ?>">
        <?php
        $id = $templateParams["id"];
        $infoReview = $dbh->getReviewInfo($id)[0]; 
        ?>
        <div class="float-left border border-2 border-primary rounded-3 p-2 w-75 w-lg-55">
            <div class="d-flex justify-content-between align-items-center">
                <div class="d-md-inline-flex align-items-md-center p-0">
        <?php $student = $GLOBALS["dbh"]->getPersonInfo($infoReview["student"])[0]; ?>
        <h5 class="me-2"><?php echo $student["name"] . ' ' . $student["surname"] . " " . $infoReview["date"]; ?></h5>
        <?php $ratings = $dbh->getRatingsFromId($id)[0];
        createStars(getMeanRating($ratings), "rgb(30, 48, 80)"); ?>
                </div>
            </div>
            <p><?php echo $infoReview["text"]; ?></p>
        </div>
    </div>
</div>
<div>

<button class="btn btn-darkred mb-5" data-bs-toggle="modal" data-bs-target="#confirmModal">
    Elimina
</button>

<div class="modal fade" id="confirmModal" tabindex="-1">
  <div class="modal-dialog">
    <div class="modal-content">

      <div class="modal-header">
        <h5 class="modal-title">Sei sicuro?</h5>
      </div>

      <div class="modal-body">
        Eliminando questa recensione confermerai la segnalazione all'utente
      </div>

      <div class="modal-footer">
        <button class="btn btn-secondary-subtle" data-bs-dismiss="modal">Annulla</button>
        <a class="btn btn-darkred" href="handle_reports.php?type=remove&id=<?php echo $id; ?>&student=<?php echo $infoReview["student"]; ?>">Conferma</a>
      </div>

    </div>
  </div>
</div>

<button class="btn btn-secondary-subtle mb-5" data-bs-toggle="modal" data-bs-target="#annulModal">
    Ignora segnalazione
</button>

<div class="modal fade" id="annulModal" tabindex="-1">
  <div class="modal-dialog">
    <div class="modal-content">

      <div class="modal-header">
        <h5 class="modal-title">Sei sicuro?</h5>
      </div>

      <div class="modal-body">
        Ignorando questa segnalazione l'utente non verrà segnalato per la recensione
      </div>

      <div class="modal-footer">
        <button class="btn btn-secondary-subtle" data-bs-dismiss="modal">Annulla</button>
        <a class="btn btn-darkred" href="handle_reports.php?type=annul&id=<?php echo $id; ?>">Conferma</a>
      </div>

    </div>
  </div>
</div>
    

</div>
</main>
