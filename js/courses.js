const ADMIN_ADD_COURSE = 0;
const ADMIN_MODIFY_COURSE = 3;
const ADMIN_DELETE_COURSE = 6;

function generateAddCourse(degreeYears) {
    let content = `<li>
            <label for="addName" class="text-left form-label">
                Nome
            </label>
        </li>
        <li>
            <input type="text" id="addName" name="name" class="form-control rounded-pill" maxlength="100" required />
        </li>
        <li class="mt-2 d-flex">
            <label for="addYear" class="text-left form-label">
                Anno
            </label>
            <select name="year" id="addYear" class="form-select rounded-pill mt-2 ms-2 me-3 w-lg-25" required>
                <option value="" disabled selected hidden>-- Seleziona --</option>`;
    for (year = 1; year <= degreeYears; year++) {
        content += `<option value="${year}">${year}</option>`;
    }
    content += `</select>
            <label for="addSemester" class="text-left form-label">
                Semestre
            </label>
            <select name="semester" id="addSemester" class="form-select rounded-pill mt-2 ms-2 w-lg-25" required>
                <option value="" disabled selected hidden>-- Seleziona --</option>
                <option value="1">1</option>
                <option value="2">2</option>
            </select>
        </li> 
        <li>
            <label for="addCode" class="text-left form-label">
                Codice corso
            </label>
        </li>
        <li>
            <input type="text" id="addCode" name="code" class="form-control rounded-pill" maxlength="5" required />
        </li>
        <li class="d-flex justify-content-end">
            <button type="submit" class="btn btn-deepskyblue mt-3" name="action" value="${ADMIN_ADD_COURSE}">Crea corso</button>
        </li>`;
    return content;
}

function generateCourses(courses, degreeYears, isStudent) {
    let content = "";
    for (let year = 1; year <= degreeYears; year++) {
        content += `<p class="fs-3 p-0">${parseCourseYear(year)} anno</p>`;
        for (const course of courses[year]) {
            content += `<div class="container-fluid w-auto w-lg-55 m-2 p-0">
                <div class="bg-primary-subtle border border-secondary-subtle rounded text-black text-start w-lg-75 p-0">
                    <button class="bg-primary-subtle w-100 border-0 d-flex justify-content-between text-darkbluenavy align-items-center fw-bold p-4" data-bs-toggle="collapse" data-bs-target="#${course["code"]}">
                        <span class="d-lg-inline-flex align-items-lg-center ps-2">
                            ${course["name"]}
                            <span class="ms-lg-2">
                                ${createStars(getMeanRating([course["ratingL"], course["ratingM"], course["ratingE"], course["ratingD"]]), "#154388")}
                            </span>`
            if (isStudent && course["isSubscribed"]) {
                content += `<i class="fa-solid fa-check mx-2 mt-2" style="color: rgb(30, 48, 80);"></i>`
            }
            content += `</span>
                        <i class="fa-solid fa-angle-down" style="color: rgb(30, 48, 80);"></i>
                    </button>
                    <div id="${course["code"]}" class="collapse p-3 w-100">
                        <ul class="d-flex flex-column align-items-start mb-0">`
            for (const professor of course["professors"]) {
                content += `<li><a href="professor.php?professor=${idWithoutDomain(professor["professor"])}" class="link-deepskyblue">${professor["name"]} ${professor["surname"]}</a></li>`;
            }
            content += `</ul>
                    <p>${course["shortDescription"]}</p>
                    <div class="d-flex justify-content-end">
                        <a href="course.php?course=${course["code"]}" class="btn btn-deepskyblue me-1 mt-2">Apri corso</a>`;
            if (isStudent) {
                content += subscriptionButton(course["code"], course["isSubscribed"], "courses.php");
            }
            content += `</div>
                    </div>
                </div>
            </div>`;
        }
    }
    return content;
}

function generateAllCourses(courses, isStudent) {
    let content = "";
    for (const course of courses) {
        content += `<div class="container-fluid w-auto w-lg-55 m-2 p-0">
            <div class="bg-primary-subtle border border-secondary-subtle rounded text-black text-start w-lg-75 p-0">
                <button class="bg-primary-subtle w-100 border-0 d-flex justify-content-between text-darkbluenavy align-items-center fw-bold p-4" data-bs-toggle="collapse" data-bs-target="#${course["code"]}">
                    <span class="d-lg-flex align-items-lg-center ps-2">
                        ${course["code"]} ${course["name"]}: ${course["degreeName"]} - ${course["campus"]}
                        <span class="ms-lg-2">
                            ${createStars(getMeanRating([course["ratingL"], course["ratingM"], course["ratingE"], course["ratingD"]]), "#154388")}
                        </span>`;
        if (isStudent && course["isSubscribed"]) {
            content += `<i class="fa-solid fa-check mx-2 mt-2" style="color: rgb(30, 48, 80);"></i>`
        }
        content += `</span>
                    <i class="fa-solid fa-angle-down" style="color: rgb(30, 48, 80);"></i>
                </button>
                <div id="${course["code"]}" class="collapse p-3 w-100">
                    <ul class="d-flex flex-column align-items-start">`;
        for (const professor of course["professors"]) {
            content += `<li><a href="professor.php?professor=${idWithoutDomain(professor["professor"])}" class="link-deepskyblue">${professor["name"]} ${professor["surname"]}</a></li>`;
        }
        content += `</ul>
                <p>${course["shortDescription"]}</p>
                <div class="d-flex justify-content-end">
                    <a href="course.php?course=${course["code"]}" class="btn btn-deepskyblue me-1 mt-2">Apri corso</a>`;
        if (isStudent) {
            content += subscriptionButton(course["code"], course["isSubscribed"], "courses.php");
        }
        content += `</div>
                </div>
            </div>
        </div>`;
    }
    return content;
}

function generateUpdateCoursesDropdown(degrees, degreeCode, courses, degreeYears) {
let content = `<ul class="mb-0 py-0">
            <li>
                <label for="updateDegreeCode" class="form-label">
                    Corso di laurea
                </label>
            </li>
            <li>
                <select name="degree" id="updateDegreeCode" onchange="getUpdateCoursesDropdown()" class="form-select rounded-pill w-lg-50">`;
    for (const degree of degrees) {
        content += `<option value="${degree["code"]}" ${degreeCode == degree["code"] ? "selected" : ""}>${degree["code"]} - ${degree["name"]} - ${degree["campus"]}</option>`;
    }
    content += `</select>
            </li>
        </ul>
        <ul class="my-0 py-0">
            <li>
                <label for="updateCourseCode" class="form-label">
                    Corso
                </label>
            </li>
            <li>
                <select name="code" id="updateCourseCode" onchange="getUpdateCoursesForm()" class="form-select rounded-pill w-lg-25" required>
                    <option value="" disabled selected hidden>-- Seleziona --</option>`;
    for (let year = 1; year <= degreeYears; year++) {
        for (const course of courses[year]) {
            content += `<option value="${course["code"]}">${course["code"]} - ${course["name"]}</option>`;
        }
    }
    content += `</select>
            </li>
        </ul>
        <ul class="mb-0 pt-0" id="updateCoursesForm"></ul>`;
    return content;
}

function generateUpdateCoursesForm(course, degreeYears, professors) {
    let content = `<li>
            <label for="updateName" class="text-left form-label">
                Nome
            </label>
        </li>
        <li>
            <input type="text" id="updateName" name="name" value="${course["name"]}" class="form-control rounded-pill" maxlength="100" required />
        </li>
        <li class="mt-2 d-flex">
            <label for="updateYear" class="text-left form-label">
                Anno
            </label>
            <select name="year" id="updateYear" class="form-select rounded-pill mt-2 ms-2 me-3 w-lg-25">`;
    for (let year = 1; year <= degreeYears; year++) {
        content += `<option value="${year}" ${course["year"] == year ? "selected" : ""}>${year}</option>`;
    }
    content += `</select>
            <label for="updateSemester" class="text-left form-label">
                Semestre
            </label>
            <select name="semester" id="updateSemester" class="form-select rounded-pill mt-2 ms-2 w-lg-25">
                <option value="1" ${course["semester"] == "1" ? "selected" : ""}>1</option>
                <option value="2" ${course["semester"] == "2" ? "selected" : ""}>2</option>
            </select>
        </li>
        <li>
            <label for="addProfessor" class="form-label d-flex">
                Aggiungi docente al corso
            </label>
            <select name="addProfessor" id="addProfessor" class="form-select rounded-pill w-lg-25">
                <option value="" selected>Nessuno</option>`;
    const professorsToAdd = professors.filter(e => !course["professors"].find(t => t["professor"] == e["professor"]));
    for (const professor of professorsToAdd) {
        content += `<option value="${professor["professor"]}">${professor["name"]} ${professor["surname"]}</option>`;
    }
    content += `</select>
        </li>
        <li>
            <label for="removeProfessor" class="form-label">
                Rimuovi docente dal corso
            </label>
        </li>
        <li>
            <select name="removeProfessor" id="removeProfessor" class="form-select rounded-pill w-lg-25">
                <option value="" selected>Nessuno</option>`;
    for (const professor of course["professors"]) {
        content += `<option value="${professor["professor"]}">${professor["name"]} ${professor["surname"]}</option>`;
    }
    content += `</select>
        </li>
        <li class="d-flex justify-content-end">
            <button type="submit" class="btn btn-deepskyblue mt-3 me-2" name="action" value="${ADMIN_MODIFY_COURSE}">Modifica corso</button>
            <button type="submit" class="btn btn-darkred mt-3" name="action" value="${ADMIN_DELETE_COURSE}">Elimina corso</button>
        </li>`;
    return content;
}

async function getAddCourse() {
    const url = "api-degrees.php";
    const formData = new FormData();
    let degreeCode = document.querySelector("#addDegreeCode").value;
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
        const section = document.querySelector("#addCourse");
        section.innerHTML = generateAddCourse(json["degreeYears"]);
    } catch (error) {
        console.log(error.message);
    }
}

async function getCoursesData() {
    const url = "api-degrees.php";
    const formData = new FormData();
    let degreeCode = document.querySelector("#degreeCode").value;
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
        section.innerHTML = degreeCode == "" ? generateAllCourses(json["courses"], json["isStudent"]) : generateCourses(json["courses"], json["degreeYears"], json["isStudent"]);
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
        const section = document.querySelector("#c2");
        section.innerHTML = generateUpdateCoursesDropdown(json["degrees"], degreeCode, json["courses"], json["degreeYears"]);
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

const coursesSection = document.querySelector("#courses");
if (coursesSection != null) {
    getCoursesData();
}
