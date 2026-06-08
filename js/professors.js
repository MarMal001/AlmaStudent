function generateProfessors(professors) {
    let content = "";
    for (const professor of professors) {
        content += `<div class="container-fluid w-auto w-lg-55 m-2 p-0">
            <div class="btn bg-primary-subtle border border-secondary-subtle text-black text-start w-lg-75 p-0">
                <button class="bg-primary-subtle w-100 border-0 d-flex justify-content-between align-items-center fw-bold p-4" data-bs-toggle="collapse" data-bs-target="#${professor["professor"]}">
                    <span class="d-md-inline-flex align-items-md-center ps-2">
                        ${professor["name"]} ${professor["surname"]}
                        <span class="ms-md-2">
                            ${createStars(getMeanRating([professor["ratingD"], professor["ratingC"], professor["ratingD"]]), "#154388")}
                        </span>
                    </span>
                    <i class="fa-solid fa-angle-down" style="color: rgb(30, 48, 80);"></i>
                </button>
                <div id="${professor["professor"]}" class="collapse p-3 ms-3 w-100">
                    Corsi:
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
