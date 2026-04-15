<div class="row mx-0">
    <main class="col-12 col-lg-6 mx-0 py-2 px-4 w-md-100">
        <section>
            <h1 class="fw-bold">Ciao Giulia!</h1>
            <div>Gestisci facilmente e velocemente i tuoi corsi.</div>
        </section>
        <section>
            <h1 class="fw-bold">I tuoi corsi</h1>
            <div class="container-fluid w-auto m-2 p-0">
        <button class="btn btn-primary d-flex justify-content-between align-items-center text-start w-100 fw-bold" type="button" data-bs-toggle="collapse" data-bs-target="#c0">
            <div class="d-md-inline-flex align-items-md-center p-0">
                <p class="m-0  p-2 text-start">Virtualizzazione e integrazione di sistemi</p>
                <div>
                    <i class="fa-solid fa-star" style="color: rgb(30, 48, 80);"></i>
                    <i class="fa-solid fa-star" style="color: rgb(30, 48, 80);"></i>
                    <i class="fa-solid fa-star" style="color: rgb(30, 48, 80);"></i>
                    <i class="fa-solid fa-star" style="color: rgb(30, 48, 80);"></i>
                    <i class="fa-solid fa-star" style="color: rgb(30, 48, 80);"></i>
                </div>
            </div>
            <i class="fa-solid fa-angle-down" style="color: rgb(255, 255, 255);"></i>
        </button>
        
        <div id="c0" class="collapse p-3 w-100 border border-primary border-2 rounded">
            <p>
            Lorem ipsum dolor sit amet consectetur adipisicing elit. Perspiciatis natus vitae, 
            deleniti quidem commodi voluptate doloremque quod officia pariatur excepturi id ducimus 
            laudantium culpa officiis obcaecati iure eos reiciendis quaerat.
            </p>
            <div class="d-flex justify-content-end m-2">
                <button class="btn btn-primary me-1" type="button">Apri corso</button>
                <button class="btn btn-white border-primary ms-1" type="submit">Discriviti</button>
            </div>
        </div>
        </div>    

        <div class="container-fluid w-auto m-2 p-0">
        <button class="btn btn-primary d-flex justify-content-between align-items-center text-start w-100 fw-bold" type="button" data-bs-toggle="collapse" data-bs-target="#c1">
            <div class="d-md-inline-flex align-items-center p-0">
                <p class="m-0 p-2">Sistemi Operativi</p>
                <div>
                    <i class="fa-solid fa-star" style="color: rgb(30, 48, 80);"></i>
                    <i class="fa-solid fa-star" style="color: rgb(30, 48, 80);"></i>
                    <i class="fa-solid fa-star" style="color: rgb(30, 48, 80);"></i>
                    <i class="fa-solid fa-star" style="color: rgb(30, 48, 80);"></i>
                    <i class="fa-solid fa-star" style="color: rgb(30, 48, 80);"></i>
                </div>
            </div>
            <i class="fa-solid fa-angle-down" style="color: rgb(255, 255, 255);"></i>
        </button>
        
        <div id="c1" class="collapse p-3 w-100 border border-primary border-2 rounded">
            <p>
            Lorem ipsum dolor sit amet consectetur adipisicing elit. Perspiciatis natus vitae, 
            deleniti quidem commodi voluptate doloremque quod officia pariatur excepturi id ducimus 
            laudantium culpa officiis obcaecati iure eos reiciendis quaerat.
            </p>
            <div class="d-flex justify-content-end m-2">
                <button class="btn btn-primary me-1" type="button">Apri corso</button>
                <button class="btn btn-white border-primary ms-1" type="submit">Discriviti</button>
            </div>
        </div>
        </div>
        </section>
        <section>
            <h1 class="fw-bold">I tuoi ricevimenti</h1>
            <ul>
                <?php foreach($dbh->getReservationsOfStudent("0000000001") as $reservation): ?>
                    <?php
                        $timeRange = date("H:i", strtotime($reservation["startTime"])) . "-" . date("H:i", strtotime($reservation["endTime"]));
                        $date = date("d-m-Y", strtotime($reservation["date"]));
                    ?>
                    <li><?php echo $date . " " . $timeRange . " " . $reservation["professorName"] . " " . $reservation["professorSurname"] . " " . $reservation["mode"]; ?></li>
                <?php endforeach; ?>
            </ul>
        </section>
    </main><aside class="col-0 col-lg-6 w-md-100 px-0 mx-0">
        <div>
            <i class="fa-solid fa-angle-up"></i>
            <i class="fa-solid fa-angle-left"></i>
        </div>
        <div class="px-4 py-3">
            <h3>Le statistiche</h3>
            <div class="d-flex flex-wrap gap-3">
                <div class="card text-center my-3">
                    <div class="card-body bg-primary text-white rounded-top">
                        <h6 class="card-title">Corsi</h6>
                    </div>
                    <h1 class="fw-bolder px-5 py-2">4</h1>
                </div>
                <div class="card text-center my-3">
                    <div class="card-body bg-primary text-white rounded-top">
                        <h6 class="card-title">Ricevimenti</h6>
                        <h6 class="card-title">prenotati</h6>
                    </div>
                    <h1 class="fw-bolder px-5 py-2">3</h1>
                </div>
                <div class="card text-center my-3">
                    <div class="card-body bg-primary text-white rounded-top">
                        <h6 class="card-title">Nuovi</h6>
                        <h6 class="card-title">messaggi</h6>
                    </div>
                    <h1 class="fw-bolder px-5 py-2">7</h1>
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