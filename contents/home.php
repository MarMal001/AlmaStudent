<div class="row mx-0">
    <main class="col-12 col-lg-6 mx-0 py-2 px-4 w-md-100">
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
        <div class="px-4 py-3 block" id="statistics">
            <h3>Le statistiche</h3>
            <div class="d-flex flex-wrap gap-3">
                <div class="card text-center my-3">
                    <?php if (!isAdmin()): ?>
                        <div class="card-body bg-primary text-white rounded-top">
                            <h6 class="card-title">Corsi</h6>
                        </div>
                        <h1 class="fw-bolder px-5 py-2"><?php echo count(isStudent() ? $dbh->getStudentCourses($user) : $dbh->getProfessorCourses($user)); ?></h1>
                    <?php endif; ?>
                </div>
                <div class="card text-center my-3">
                    <?php if (!isAdmin()): ?>
                        <div class="card-body bg-primary text-white rounded-top">
                            <h5 class="card-title">Ricevimenti</h6>
                            <h5 class="card-title">prenotati</h6>
                        </div>
                        <h1 class="fw-bolder px-5 py-2"><?php echo count(isStudent() ? $dbh->getReservationsOfStudent($user) : $dbh->getReservationsOfProfessor($user)); ?></h1>
                    <?php endif; ?>
                </div>
                <div class="card text-center my-3">
                    <?php if (isStudent()): ?>
                        <div class="card-body bg-primary text-white rounded-top">
                            <h6 class="card-title">Numero</h6>
                            <h6 class="card-title">segnalazioni</h6>
                        </div>
                        <h1 class="fw-bolder px-5 py-2"><?php echo $dbh->getStudentNumberReports($user)[0]["numReports"]; ?></h1>
                    <?php endif; ?>
                    <?php if (isAdmin()): ?>
                        <!--TODO aggiungere report da risolvere-->
                    <?php endif; ?>
                </div>
            </div>
            <h3>Il calendario</h3>
            <div class="card">
                <div class="bg-primary text-white text-center py-3">
                    <   Marzo 2026   >
                </div>
                <div class="card-body">
                    <ul class="text-primary fw-bold text-center">
                        <li>Lun</li>
                        <li>Mar</li>
                        <li>Mer</li>
                        <li>Gio</li>
                        <li>Ven</li>
                        <li>Sab</li>
                        <li>Dom</li>
                    </ul>
                    <ul class="text-center">
                        <li>1</li>
                        <li>2</li>
                        <li>3</li>
                        <li>4</li>
                        <li>5</li>
                        <li>6</li>
                        <li>7</li>
                        <li>8</li>
                        <li>9</li>
                        <li>10</li>
                        <li>11</li>
                        <li>12</li>
                        <li>13</li>
                        <li>14</li>
                        <li>15</li>
                        <li>16</li>
                        <li>17</li>
                        <li class="bg-primary text-white rounded-3 border-grey">18</li>
                        <li>19</li>
                        <li>20</li>
                        <li>21</li>
                        <li>22</li>
                        <li>23</li>
                        <li>24</li>
                        <li>25</li>
                        <li>26</li>
                        <li>27</li>
                        <li>28</li>
                        <li>29</li>
                        <li>30</li>
                        <li>31</li>
                    </ul>
                </div>
            </div>
        </div>
    </aside>
</div>
