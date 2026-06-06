function generateProfessors(professors) {
    let content = "";
    for (const professor of professors) {
        content += `<div class="container-fluid w-auto w-lg-55 m-2 p-0">
            <div class="btn bg-primary-subtle border border-secondary-subtle text-black text-start w-100">
                <div class="d-flex justify-content-between align-items-center text-darkbluenavy fw-bold" type="button" data-bs-toggle="collapse" data-bs-target="#${professor["professor"]}">
                    <div class="d-md-inline-flex align-items-md-center p-0">
                        <p class="m-0 p-2 text-start">${professor["name"]} ${professor["surname"]}</p>
                        <div>
                            ${createStars(getMeanRating([professor["ratingD"], professor["ratingC"], professor["ratingD"]]), "#154388")}
                        </div>
                    </div>
                    <i class="fa-solid fa-angle-down" style="color: rgb(30, 48, 80);"></i>
                </div>
                <div id="${professor["professor"]}" class="collapse p-3 w-100">
                    <h6>Corsi:</h6>
                    <ul class="d-flex flex-column align-items-start">`;
        for (const course of professor["courses"]) {
            content += `<li><a href="course.php?course=${course["code"]}" class="link-deepskyblue">${course["name"]}</a></li>`;
        }
        content += `</ul>
                    <div class="d-flex justify-content-end m-2">
                        <a href="professor.php?professor=${idWithoutDomain(professor["professor"])}" class="btn btn-deepskyblue me-1">Vai alla pagina</a>
                    </div>
                </div>
            </div>
        </div>`;
    }
    return content;
}

async function getProfessorsData() {
    const url = "api-professors.php";
    const formData = new FormData();
    let degreeCode = document.querySelector("#degreeCode").value;
    formData.append("degreeCode", degreeCode);
    try {
        const response = await fetch(url, {
            method: "POST",
            body: formData
        });
        if (!response.ok) {
            throw new Error(`Response status: ${response.status} `);
        }
        const json = await response.json();
        console.log(json);
        const section = document.querySelector("#professors");
        section.innerHTML = generateProfessors(json["professors"]);
    } catch (error) {
        console.log(error.message);
    }
}

getProfessorsData();
