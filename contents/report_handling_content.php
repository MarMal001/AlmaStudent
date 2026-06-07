<main class="m-5">
	<?php
	$id = $templateParams["id"];
	$infoReview = $dbh->getReviewInfo($id)[0]; 
	$course = null;
	$degree = null;
	?>
	<h2 class="mt-2">Recensione Segnalata</h2>
	<?php if ($infoReview["type"] == "DOCENTE"): 
		$course = $dbh->getCourseInfo($infoReview["dCourse"])[0];
		$degree = $dbh->getCourseDegree($infoReview["dCourse"]);
		$professor = $dbh->getPersonInfo($infoReview["professor"])[0];
	?>
		<p class="mb-sm-1">Stai valutando una recensione su <?php echo $professor["name"] . " " . $professor["surname"]; ?>, docente nel corso <?php echo $course["name"]; ?> di <?php echo $degree["degreeName"]; ?>.</p>
	<?php else: 
		$course = $dbh->getCourseInfo($infoReview["cCourse"])[0];
		$degree = $dbh->getCourseDegree($infoReview["cCourse"]);
	?>
		<p class="mb-sm-1">Stai valutando una recensione sul corso di <?php echo $course["name"]; ?> in <?php echo $degree["degreeName"]; ?> - <?php echo $degree["campus"]; ?>.</p>
	<?php endif; ?>
	
	<div class="bg-light-subtle border border-secondary-subtle rounded rounded-4 ms-2 mb-3 p-3">
			<div class="float-left bg-body-secondary rounded-5 mb-4 p-3 w-80 w-sm-75">
				<div class="d-flex justify-content-between align-items-center">
					<div class="d-md-inline-flex align-items-md-center p-1 mt-2 ms-2">
						<?php $student = $GLOBALS["dbh"]->getPersonInfo($infoReview["student"])[0]; ?>
						<h5 class="fw-bold me-2 mt-2"><?php echo $student["name"] . ' ' . $student["surname"] . " " . $infoReview["date"]; ?></h5>
						<?php $ratings = $dbh->getRatingsFromId($id)[0];
							createStars(getMeanRating($ratings), "#154388"); ?>
					</div>
				</div>
				<?php if ($infoReview["type"] == "DOCENTE"): ?>
					<h6 class="fw-bold ms-3 mt-2"><?php echo $course["name"]; ?></h6>
				<?php endif; ?>
				<p class="ms-2 me-4 fs-5"><?php echo $infoReview["text"]; ?></p>
			</div>
	</div>

	<div class="d-flex justify-content-end">


		<button class="btn btn-secondary mb-5" data-bs-toggle="modal" data-bs-target="#annulModal">
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
						<button class="btn btn-secondary" data-bs-dismiss="modal">Annulla</button>
						<a class="btn btn-danger" href="handle_reports.php?type=annul&id=<?php echo $id; ?>">Conferma</a>
					</div>

				</div>
			</div>
		</div>
		
		<button class="btn btn-danger mb-5 ms-2 " data-bs-toggle="modal" data-bs-target="#confirmModal">
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
						<button class="btn btn-secondary" data-bs-dismiss="modal">Annulla</button>
						<a class="btn btn-danger" href="handle_reports.php?type=remove&id=<?php echo $id; ?>&student=<?php echo $infoReview["student"]; ?>">Conferma</a>
					</div>

				</div>
			</div>
		</div>				
	</div>
</main>
