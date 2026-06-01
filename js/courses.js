const ADMIN_MODIFY_COURSE = 3;
const ADMIN_DELETE_COURSE = 6;

function generateCourses(user, courses, degreeYears, isStudent) {
    let content = "";
    for (let year = 1; year <= degreeYears; year++) {
        content += `<h3>${parseCourseYear(year)} anno</h3>`;
        for (const course of courses[year]) {
            content += `<div class="container-fluid w-auto w-lg-55 m-2 p-0">
                <button class="btn btn-primary d-flex justify-content-between align-items-center text-start w-100 fw-bold" type="button" data-bs-toggle="collapse" data-bs-target="#${course["code"]}">
                    <div class="d-md-inline-flex align-items-md-center p-0">
                        <p class="m-0 p-2 text-start">${course["name"]}</p>
                        <div>
                            ${createStars(getMeanRating([course["ratingL"], course["ratingM"], course["ratingE"], course["ratingD"]]), "rgb(30, 48, 80)")}
                        </div>`
            if (isStudent && course["isSubscribed"]) {
                content += `<i class="fa-solid fa-check mx-2" style="color: rgb(38, 246, 30);"></i>`
            }
            content += `</div>
                    <i class="fa-solid fa-angle-down" style="color: rgb(255, 255, 255);"></i>
                </button>
                <div id="${course["code"]}" class="collapse p-3 w-100 border border-primary border-2 rounded">
                        <ul class="d-flex flex-column align-items-start">`
            for (const professor of course["professors"]) {
                content += `<li><a href="professor.php?professor=${idWithoutDomain(professor["professor"])}" class="text-primary">${professor["name"]} ${professor["surname"]}</a></li>`;
            }
            content += `</ul>
                    <p>${course["shortDescription"]}</p>
                    <div class="d-flex justify-content-end m-2">
                        <a href="course.php?course=${course["code"]}" class="btn btn-primary me-1">Apri corso</a>`;

            if (isStudent) {
                subscriptionButton(user, course["code"]);
            }
            content += `</div>
                </div>
            </div>`;
        }
    }
    return content;
}

function generateUpdateCoursesDropdown(courses, degreeYears) {
    let content = `<li>
            <label for="code">
                <h5>Corso</h5>
            </label>
        </li>
        <li>
            <select name="code" id="updateCourseCode" onchange="getUpdateCoursesForm()">
                <option value="" disabled selected hidden>-- Seleziona --</option>`;
    for (let year = 1; year <= degreeYears; year++) {
        for (const course of courses[year]) {
            content += `<option value="${course["code"]}">${course["code"]} - ${course["name"]}</option>`;
        }
    }
    content += `</select>
        </li>
        <div id="updateCoursesForm"></div>`;
    return content;
}

function generateUpdateCoursesForm(course, degreeYears, professors) {
    let content = `<li>
            <label for="name" class="text-left">
                <h5>Nome</h5>
            </label>
        </li>
        <li>
            <input type="text" id="name" name="name" value="${course["name"]}" />
        </li>
        <div class="d-flex align-content-stretch">
            <li class="mt-2">
                <label for="year" class="text-left">
                    <h5>Anno</h5>
                </label>
            </li>
            <li class="mt-2">
                <select name="year" id="year" class="mt-3 ms-2 me-3">`;
    for (let year = 1; year <= degreeYears; year++) {
        content += `<option value="${year}" ${course["year"] == year ? "selected" : ""}>${year}</option>`;
    }
    content += `</select>
            </li>
            <li class="mt-2">
                <label for="semester" class="text-left">
                    <h5>Semestre</h5>
                </label>
            </li>
            <li class="mt-2">
                <select name="semester" id="semester" class="mt-3 ms-2">
                    <option value="1" ${course["semester"] == "1" ? "selected" : ""}>1</option>
                    <option value="2" ${course["semester"] == "2" ? "selected" : ""}>2</option>
                </select>
            </li> 
        </div>
        <div>
            <li>
                <label for="addProfessors">
                    <h5>Aggiungi docente al corso</h5>
                </label>
            </li>
            <li>
                <select name="addProfesors" id="addProfessors">
                    <option value="" selected>Nessuno</option>`;
        for (const professor of professors) {
            content += `<option value="${professor["code"]}">${professor["name"]} ${professor["surname"]}</option>`;
        }
        content += `</select>
            </li>
        </div>
        <div>
            <li>
                <label for="removeProfessors">
                    <h5>Rimuovi docente dal corso</h5>
                </label>
            </li>
            <li>
                <select name="removeProfesors" id="removeProfessors">
                    <option value="" selected>Nessuno</option>`;
        for (const professor of course["professors"]) {
            content += `<option value="${professor["code"]}">${professor["name"]} ${professor["surname"]}</option>`;
        }
        content += `</select>
            </li>
        </div>
        <li>
            <button type="submit" class="btn btn-primary mt-3" name="action" value="${ADMIN_MODIFY_COURSE}">Modifica corso</button>
        </li>
        <li>
            <button type="submit" class="btn btn-danger mt-3" name="action" value="${ADMIN_DELETE_COURSE}">Elimina corso</button>
        </li>`;
    return content;
}

async function getCoursesData() {
    const url = "api-degrees.php";
    const formData = new FormData();
    let degreeCode = document.querySelector("#degreeCode").value;
    if (degreeCode == "") {
        return;
    }
    formData.append("degreeCode", degreeCode);
    formData.append("type", "courses");
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
        const section = document.querySelector("#courses");
        section.innerHTML = generateCourses(json["user"], json["courses"], json["degreeYears"], json["isStudent"]);
    } catch (error) {
        console.log(error.message);
    }
}

async function getUpdateCoursesDropdown() {
    const url = "api-degrees.php";
    const formData = new FormData();
    let degreeCode = document.querySelector("#updateDegreeCode").value;
    if (degreeCode == "") {
        return;
    }
    formData.append("degreeCode", degreeCode);
    formData.append("type", "courses");
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
        const section = document.querySelector("#coursesDropdown");
        section.innerHTML = generateUpdateCoursesDropdown(json["courses"], json["degreeYears"]);
    } catch (error) {
        console.log(error.message);
    }
}

async function getUpdateCoursesForm() {
    const url = "api-degrees.php";
    const formData = new FormData();
    let degreeCode = document.querySelector("#updateDegreeCode").value;
    let courseCode = document.querySelector("#updateCourseCode").value;
    if (degreeCode == "" || courseCode == "") {
        return;
    }
    formData.append("degreeCode", degreeCode);
    formData.append("type", "courses");
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
        const section = document.querySelector("#updateCoursesForm");
        course = Object.values(json["courses"]).flat().find(item => item["code"] == courseCode);
        section.innerHTML = generateUpdateCoursesForm(course, json["degreeYears"], json["professors"]);
    } catch (error) {
        console.log(error.message);
    }
}
