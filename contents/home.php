<div class="row mx-0">
    <main class="col-12 col-lg-6 mx-0 py-2 px-4 w-md-100">
        <?php showMessage(); ?>
        <?php
            if (isAdmin()) {
                include("contents/home_admin.php");
            } else if (isProfessor() || isStudent()) {
                include("contents/home_students_and_professors.php");
            } else {
                header("location: login.php");
            }
        ?>
    </main><aside class="col-0 col-lg-6 w-md-100 px-0 mx-0 d-flex flex-column flex-lg-row justify-content-start justify-content-lg-end">
        <div class="me-auto me-lg-0">
            <i class="fa-solid fa-angle-up" onclick=toggleStatistics()></i>
            <i class="fa-solid fa-angle-left" onclick=toggleStatistics()></i>
        </div>
        <div class="px-4 py-3" style="display: block" id="statistics">   
        <h3>Le statistiche</h3>
            <div class="d-flex flex-wrap gap-3">
                <?php if (!isAdmin()): ?>
                    <div class="card text-center my-3">
                        <div class="card-body bg-deepskyblue text-white rounded-top">
                            <h5 class="card-title">Corsi</h5>
                        </div>
                        <h1 class="fw-bolder px-5 py-2"><?php echo count(isStudent() ? $dbh->getStudentCourses($user) : $dbh->getCoursesByProfessor($user)); ?></h1>
                    </div>
                    <div class="card text-center my-3">
                    
                        <div class="card-body bg-deepskyblue text-white rounded-top">
                            <h5 class="card-title">Ricevimenti</h6>
                            <h5 class="card-title">prenotati</h6>
                        </div>
                        <h1 class="fw-bolder px-5 py-2"><?php echo count(isStudent() ? $dbh->getReservationsOfStudent($user) : $dbh->getReservedReservationsOfProfessor($user)); ?></h1>   
                    </div>
                <?php endif; ?>
                <?php if (isProfessor()): ?>
                    <?php
                        $ratingsByCourse = array();
                        foreach ($dbh->getCoursesByProfessor($user) as $course) {
                            array_push($ratingsByCourse, getMeanRating($dbh->getGeneralRatingsByCourse($course["code"])[0]));
                        }
                    ?>
                    <div class="card text-center my-3">
                        <div class="card-body bg-primary text-white rounded-top">
                            <h5 class="card-title">Numero iscritti</h5>
                            <h5 class="card-title">ai propri corsi</h5>
                        </div>
                        <h1 class="fw-bolder px-5 py-2"><?php echo $dbh->getNumberOfSubscribedStudentToCoursesOfProfessor($user); ?></h1>
                    </div>
                    <div class="card text-center my-3">
                        <div class="card-body bg-primary text-white rounded-top">
                            <h5 class="card-title">Rating medio</h5>
                            <h5 class="card-title">corsi</h5>
                        </div>
                        <h1 class="fw-bolder px-5 py-2"><?php echo round(getMeanRating($ratingsByCourse) * 10) / 10; ?> / 5</h1>
                    </div>
                    <div class="card text-center my-3">
                        <div class="card-body bg-primary text-white rounded-top">
                            <h5 class="card-title">Rating</h5>
                            <h5 class="card-title">docente</h5>
                        </div>
                        <h1 class="fw-bolder px-5 py-2"><?php echo round(getMeanRating($dbh->getProfessorRatings($user)[0]) * 10) / 10; ?> / 5</h1>
                    </div>
                <?php endif; ?>
                <?php if (isStudent()): ?>
                    <div class="card text-center my-3">
                        <div class="card-body bg-deepskyblue text-white rounded-top">
                            <h5 class="card-title">Numero</h5>
                            <h5 class="card-title">segnalazioni</h5>
                        </div>
                        <h1 class="fw-bolder px-5 py-2"><?php echo $dbh->getStudentNumberReports($user)[0]["numReports"]; ?></h1>
                    </div>
                    <div class="card text-center my-3">
                        <div class="card-body bg-deepskyblue text-white rounded-top">
                            <h5 class="card-title">Numero di</h5>
                            <h5 class="card-title">recensioni scritte</h5>
                        </div>
                        <h1 class="fw-bolder px-5 py-2"><?php echo $dbh->getNumberOfReviewsOfStudent($user); ?></h1>
                    </div>
                <?php endif; ?>
                <?php if (isAdmin()): ?>
                    <?php 
                        $nReportedReviewsProf = count($dbh->getReportedReviewsOfProfessors());
                        $nReportedReviewsCourses = count($dbh->getReportedReviewsOfCourses()); 
                        $nReports = $nReportedReviewsCourses + $nReportedReviewsProf;
                    ?>
                    <div class="card text-center my-3">
                        <div class="card-body bg-deepskyblue text-white rounded-top">
                            <h5 class="card-title">Segnalazioni</h6>
                            <h5 class="card-title">da gestire</h6>
                        </div>
                        <h1 class="fw-bolder px-5 py-2"><?php echo $nReports; ?></h1>
                    </div>
                    <div class="card text-center my-3">
                        <div class="card-body bg-deepskyblue text-white rounded-top">
                            <h5 class="card-title">Numero di</h5>
                            <h5 class="card-title">persone bloccate</h5>
                        </div>
                        <h1 class="fw-bolder px-5 py-2"><?php echo $dbh->getNumberOfBannedStudents(); ?></h1>
                    </div>
                    <div class="card text-center my-3">
                        <div class="card-body bg-deepskyblue text-white rounded-top">
                            <h5 class="card-title">Numero di</h5>
                            <h5 class="card-title">corsi</h5>
                        </div>
                        <h1 class="fw-bolder px-5 py-2"><?php echo count($dbh->getCourses()); ?></h1>
                    </div>
                    <div class="card text-center my-3">
                        <div class="card-body bg-deepskyblue text-white rounded-top">
                            <h5 class="card-title">Numero di</h5>
                            <h5 class="card-title">professori</h5>
                        </div>
                        <h1 class="fw-bolder px-5 py-2"><?php echo count($dbh->getProfessors()); ?></h1>
                    </div>
                    <div class="card text-center my-3">
                        <div class="card-body bg-deepskyblue text-white rounded-top">
                            <h5 class="card-title">Numero di</h5>
                            <h5 class="card-title">studenti</h5>
                        </div>
                        <h1 class="fw-bolder px-5 py-2"><?php echo count($dbh->getStudents()); ?></h1>
                    </div>
                <?php endif; ?>
            </div>
            <h3>Il calendario</h3>
            <div class="card" id="calendar-container">
                <div class="bg-deepskyblue text-white text-center py-3 rounded-top" id="calendar-header">
                    <div class="d-flex inline-flex justify-content-center align-items-center" id="calendar-navigation">
                        <i id="calendar-prev" class="fa-solid fa-angle-left"></i>
                        <div id="calendar-current-date" class="mx-2"></div>
                        <i id="calendar-next" class="fa-solid fa-angle-right"></i>
                    </div>
                </div>
                <div class="card-body" id="calendar-body">
                    <ul class="text-deepskyblue fw-bold text-center" id="calendar-weekdays">
                        <li>Lun</li>
                        <li>Mar</li>
                        <li>Mer</li>
                        <li>Gio</li>
                        <li>Ven</li>
                        <li>Sab</li>
                        <li>Dom</li>
                    </ul>
                    <ul class="text-center" id="calendar-dates"></ul>
                </div>
            </div>
        </div>
    </aside>
</div>
