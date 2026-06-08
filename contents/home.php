<div class="row mx-0">
    <main class="col-12 col-lg-7 mx-0 py-2 px-4 w-md-100">
        <?php
            if (isAdmin()) {
                include("contents/home_admin.php");
            } else if (isProfessor() || isStudent()) {
                include("contents/home_students_and_professors.php");
            } else {
                header("location: login.php");
            }
        ?>
    </main><aside class="col-0 col-lg-5 w-md-100 px-0 mx-0 d-flex flex-column flex-lg-row justify-content-start justify-content-lg-end">
        <div class="me-auto me-lg-0">
            <i class="fa-solid fa-angle-up" onclick=toggleStatistics()></i>
            <i class="fa-solid fa-angle-left" onclick=toggleStatistics()></i>
        </div>
        <div class="px-5 py-5">
            <h3>Le statistiche</h3>
            <div class="d-flex flex-wrap gap-3 justify-content-center mt-3 mb-4">
                <?php if (!isAdmin()): ?>
                    <div class="card text-center my-1 mx-1">
                        <div class="card-body bg-deepskyblue text-white rounded-top">
                            <p class="card-title fs-5 text-center p-0 m-0">Corsi</p>
                        </div>
                        <h2 class="fw-bolder px-5 py-2"><?php echo count(isStudent() ? $dbh->getStudentCourses($user) : $dbh->getCoursesByProfessor($user)); ?></h2>
                    </div>
                    <div class="card text-center my-1 mx-1">
                        <div class="card-body bg-deepskyblue text-white rounded-top">
                            <p class="card-title fs-5 text-center p-0 m-0">Ricevimenti</p>
                            <p class="card-title fs-5 text-center p-0 m-0">prenotati</p>
                        </div>
                        <h2 class="fw-bolder px-5 py-2"><?php echo count(isStudent() ? $dbh->getReservationsOfStudent($user) : $dbh->getReservedReservationsOfProfessor($user)); ?></h2>   
                    </div>
                <?php endif; ?>
                <?php if (isProfessor()): ?>
                    <?php
                        $ratingsByCourse = array();
                        foreach ($dbh->getCoursesByProfessor($user) as $course) {
                            array_push($ratingsByCourse, getMeanRating($dbh->getGeneralRatingsByCourse($course["code"])[0]));
                        }
                    ?>
                    <div class="card text-center my-1 mx-1">
                        <div class="card-body bg-deepskyblue text-white rounded-top">
                            <p class="card-title fs-5 text-center p-0 m-0">Numero iscritti</p>
                            <p class="card-title fs-5 text-center p-0 m-0">ai propri corsi</p>
                        </div>
                        <h2 class="fw-bolder px-5 py-2"><?php echo $dbh->getNumberOfSubscribedStudentToCoursesOfProfessor($user); ?></h2>
                    </div>
                    <div class="card text-center my-1 mx-1">
                        <div class="card-body bg-deepskyblue text-white rounded-top">
                            <p class="card-title fs-5 text-center p-0 m-0">Rating medio</p>
                            <p class="card-title fs-5 text-center p-0 m-0">corsi</p>
                        </div>
                        <h2 class="fw-bolder px-5 py-2"><?php echo round(getMeanRating($ratingsByCourse) * 10) / 10; ?> / 5</h2>
                    </div>
                    <div class="card text-center my-1 mx-1">
                        <div class="card-body bg-deepskyblue text-white rounded-top">
                            <p class=" fs-5 text-center p-0 m-0">Rating</p>
                            <p class=" fs-5 text-center p-0 m-0">docente</p>
                        </div>
                        <h2 class="fw-bolder px-5 py-2"><?php echo round(getMeanRating($dbh->getProfessorRatings($user)[0]) * 10) / 10; ?> / 5</h2>
                    </div>
                <?php endif; ?>
                <?php if (isStudent()): ?>
                    <div class="card text-center my-1 mx-1">
                        <div class="card-body bg-deepskyblue text-white rounded-top">
                            <p class="card-title fs-5 text-center p-0 m-0">Numero</p>
                            <p class="card-title fs-5 text-center p-0 m-0">segnalazioni</p>
                        </div>
                        <h2 class="fw-bolder px-5 py-2"><?php echo $dbh->getStudentNumberReports($user)[0]["numReports"]; ?></h2>
                    </div>
                    <div class="card text-center my-1 mx-1">
                        <div class="card-body bg-deepskyblue text-white rounded-top">
                            <p class="card-title fs-5 text-center p-0 m-0">Numero di</p>
                            <p class="card-title fs-5 text-center p-0 m-0">professori valutati</p>
                        </div>
                        <h2 class="fw-bolder px-5 py-2"><?php echo $dbh->getNumberOfProfessorReviewsOfStudent($user); ?></h2>
                    </div>
                    <div class="card text-center my-1 mx-1">
                        <div class="card-body bg-deepskyblue text-white rounded-top">
                            <p class="card-title fs-5 text-center p-0 m-0">Numero di</p>
                            <p class="card-title fs-5 text-center p-0 m-0">corsi valutati</p>
                        </div>
                        <h2 class="fw-bolder px-5 py-2"><?php echo $dbh->getNumberOfCourseReviewsOfStudent($user); ?></h2>
                    </div>
                <?php endif; ?>
                <?php if (isAdmin()): ?>
                    <?php 
                        $nReportedReviewsProf = count($dbh->getReportedReviewsOfProfessors());
                        $nReportedReviewsCourses = count($dbh->getReportedReviewsOfCourses()); 
                        $nReports = $nReportedReviewsCourses + $nReportedReviewsProf;
                    ?>
                    <div class="card text-center my-1 mx-1">
                        <div class="card-body bg-deepskyblue text-white rounded-top">
                            <p class="card-title fs-5 text-center p-0 m-0">Segnalazioni</p>
                            <p class="card-title fs-5 text-center p-0 m-0">da gestire</p>
                        </div>
                        <h2 class="fw-bolder px-5 py-2"><?php echo $nReports; ?></h2>
                    </div>
                    <div class="card text-center my-1 mx-1">
                        <div class="card-body bg-deepskyblue text-white rounded-top">
                            <p class="card-title fs-5 text-center p-0 m-0">Numero di</p>
                            <p class="card-title fs-5 text-center p-0 m-0">persone bloccate</p>
                        </div>
                        <h2 class="fw-bolder px-5 py-2"><?php echo $dbh->getNumberOfBannedStudents(); ?></h2>
                    </div>
                    <div class="card text-center my-1 mx-1">
                        <div class="card-body bg-deepskyblue text-white rounded-top">
                            <p class="card-title fs-5 text-center p-0 m-0">Numero</p>
                            <p class="card-title fs-5 text-center p-0 m-0">di corsi</p>
                        </div>
                        <h2 class="fw-bolder px-5 py-2"><?php echo count($dbh->getCourses()); ?></h2>
                    </div>
                    <div class="card text-center my-1 mx-1">
                        <div class="card-body bg-deepskyblue text-white rounded-top">
                            <p class="card-title fs-5 text-center p-0 m-0">Numero di</p>
                            <p class="card-title fs-5 text-center p-0 m-0">professori</p>
                        </div>
                        <h2 class="fw-bolder px-5 py-2"><?php echo count($dbh->getProfessors()); ?></h2>
                    </div>
                    <div class="card text-center my-1 mx-1">
                        <div class="card-body bg-deepskyblue text-white rounded-top">
                            <p class="card-title fs-5 text-center p-0 m-0">Numero di</p>
                            <p class="card-title fs-5 text-center p-0 m-0">studenti</p>
                        </div>
                        <h2 class="fw-bolder px-5 py-2"><?php echo count($dbh->getStudents()); ?></h2>
                    </div>
                <?php endif; ?>
            </div>
            <h3 class="mt-4 mb-3">Il calendario</h3>
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
