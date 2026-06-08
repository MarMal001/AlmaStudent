async function getSelectedCourseReviewsForm() {
    const url = "api-reviews.php";
    const formData = new FormData();
    const limit = document.querySelector("#reviewsNumber").value;
    const course = document.querySelector("#course").value;
    const page = document.querySelector("#url").value;
    const type = "course";
    formData.append("limit", limit);
    formData.append("course", course);
    formData.append("type", type);
    try {
        const response = await fetch(url, {
            method: "POST",
            body: formData
        });
        if (!response.ok) {
            throw new Error(`Response status: ${response.status}`);
        }
        const json = await response.json();
        console.log(json);
        const section = document.querySelector("#courseReviews");
        section.innerHTML = generateReviews(json["reviews"], json["user"], type, page);
    } catch (error) {
        console.log(error.message);
    }
}


async function getSelectedProfessorReviewsForm() {
    const url = "api-reviews.php";
    const formData = new FormData();
    const limit = document.querySelector("#reviewsNumber").value;
    const professor = document.querySelector("#professor").value;
    const page = document.querySelector("#url").value;
    const type = "professor";
    formData.append("limit", limit);
    formData.append("professor", professor);
    formData.append("type", type);
    try {
        const response = await fetch(url, {
            method: "POST",
            body: formData
        });
        if (!response.ok) {
            throw new Error(`Response status: ${response.status}`);
        }
        const json = await response.json();
        console.log(json);
        const section = document.querySelector("#profReviews");
        section.innerHTML = generateReviews(json["reviews"], json["user"], type, page);
    } catch (error) {
        console.log(error.message);
    }
}

function generateReviews(reviews, user, type, page) {
    let content = ``;
    console.log(reviews);
    if (reviews.length == 0) {
        content += `<p class="text-center text-secondary fw-normal fs-5">Non è presente ancora nessuna recensione</p>`;
    } else {
        for (review of reviews) {
            let place = "start";
            let bg = "bg-body-secondary";
            if (user == review["student"]) {
                place = "end";
                bg = "bg-primary-subtle";
            }
            content += `<div class="float-${place} ${bg} rounded-5 mb-4 p-3 w-80 w-lg-60">
                <div class="d-flex justify-content-between align-items-center">
                    <div class="d-md-inline-flex align-items-md-center p-1 mt-2 ms-2">

                        <p class="fw-bold fs-5 me-2 mt-1">${review["studentInfo"]["name"]} ${review["studentInfo"]["surname"]} ${review["date"]}</p>
                        ${createStars(getMeanRating(review["ratings"]), "#154388")}
                    </div>`;
            if (review["reported"]) {
                content += `<i class="fa-solid fa-flag me-3" style="color: rgb(213, 0, 0);" ></i>`;
            } else {
                content += `<button class="btn" data-bs-toggle="modal" data-bs-target="#flagModal" ><i class="fa-regular fa-flag" style="color: #154388;"></i></button>
                <div class="modal fade" id="flagModal" tabindex="-1">
                    <div class="modal-dialog">
                        <div class="modal-content">

                        <div class="modal-header">
                            <p class="modal-title fs-5">Sei sicuro?</p>
                        </div>

                        <div class="modal-body">
                            Confermando si segnalerà la recensione
                        </div>

                        <div class="modal-footer">
                            <button class="btn btn-secondary-subtle" data-bs-dismiss="modal">Annulla</button>
                            <a class="btn btn-darkred" href="handle_reports.php?type=add&page=${page}&id=${review["id"]}">Conferma</a>
                        </div>

                    </div>
                </div>
                </div>`;
            }
            content += `</div>`;
            if (type == "professor") {
                content += `<h6 class="fw-bold ms-3 mt-2">${review["courseName"]}</h6>`;
            }
            content += `<p class="ms-2 me-4 fs-5">${review["text"]}</p>
                </div>`;
        }
    }
    return content;
}

if (document.querySelector("#type").value == "course") {
    getSelectedCourseReviewsForm();
} else {
    getSelectedProfessorReviewsForm();
}
