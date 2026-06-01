<div class="card my-5 ms-5" style="width: 30rem;">
  <div class="card-header bg-primary text-white fw-bold">
    Recensisci: <?php echo $GLOBALS["dbh"]->getCourseInfo($templateParams["course"])[0]["name"]; ?>
  </div>
  <ul class="list-group list-group-flush">
    <li class="list-group-item">An item</li>
    <li class="list-group-item">A second item</li>
    <li class="list-group-item">A third item</li>
  </ul>
</div>