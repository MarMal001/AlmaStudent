const ADMIN_ADD_COURSE = 0;
const ADMIN_MODIFY_COURSE = 3;
const ADMIN_DELETE_COURSE = 6;

function generateAddCourse(degreeYears) {
    let content = `<li>
            <label for="addName" class="text-left">
                <h5>Nome</h5>
            </label>
        </li>
        <li>
            <input type="text" id="addName" name="name" required />
        </li>
        <div class="d-flex align-content-stretch">
            <li class="mt-2">
                <label for="addYear" class="text-left">
                    <h5>Anno</h5>
                </label>
            </li>
            <li class="mt-2" id="degreeYears">
                <select name="year" id="addYear" class="form-select mt-2 ms-2 me-3" required>`;
                    for (year = 1; year <= degreeYears; year++) {
                        content += `<option value="${year}">${year}</option>`;
                    }
    content += `</select>
            </li>
            <li class="mt-2 ms-4">
                <label for="addSemester" class="text-left">
                    <h5>Semestre</h5>
                </label>
            </li>
            <li class="mt-2">
                <select name="semester" id="addSemester" class="form-select mt-2 ms-2" required>
                    <option value="1">1</option>
                    <option value="2">2</option>
                </select>
            </li> 
        </div>
        <li>
            <label for="addCode" class="text-left">
                <h5>Codice corso</h5>
            </label>
        </li>
        <li>
            <input type="text" id="addCode" name="code" required />
        </li>
        <li>
            <button type="submit" class="btn btn-primary mt-3" name="action" value="${ADMIN_ADD_COURSE}">Crea corso</button>
        </li>`;
    return content;
}

function generateCourses(courses, degreeYears, isStudent) {
    let content = "";
    for (let year = 1; year <= degreeYears; year++) {
        content += `<h3>${parseCourseYear(year)} anno</h3>`;
        for (const course of courses[year]) {
            content += `<div class="container-fluid w-auto w-lg-55 m-2 p-0">
                <div class="btn bg-primary-subtle border border-secondary-subtle text-black text-start w-100 fw-bold">
                    <div class="d-flex justify-content-between align-items-center" type="button" data-bs-toggle="collapse" data-bs-target="#${course["code"]}">
                        <div class="d-md-inline-flex align-items-md-center p-0">
                            <p class="m-0 p-2 text-start">${course["name"]}</p>
                            <div>
                                ${createStars(getMeanRating([course["ratingL"], course["ratingM"], course["ratingE"], course["ratingD"]]), "rgb(30, 48, 80)")}
                            </div>`
            if (isStudent && course["isSubscribed"]) {
                content += `<i class="fa-solid fa-check mx-2 mt-2" style="color: rgb(30, 48, 80);"></i>`
            }
            content += `</div>
                        <i class="fa-solid fa-angle-down" style="color: rgb(30, 48, 80);"></i>
                    </div>
                    <div id="${course["code"]}" class="collapse p-3 w-100">
                        <ul class="d-flex flex-column align-items-start">`
            for (const professor of course["professors"]) {
                content += `<li><a href="professor.php?professor=${idWithoutDomain(professor["professor"])}" class="link-deepskyblue">${professor["name"]} ${professor["surname"]}</a></li>`;
            }
            content += `</ul>
                    <p>${course["shortDescription"]}</p>
                    <div class="d-flex justify-content-end">
                        <a href="course.php?course=${course["code"]}" class="btn btn-primary me-1 mt-2">Apri corso</a>`;
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
            <div class="btn bg-primary-subtle border border-secondary-subtle text-black text-start w-100 fw-bold">
                <div class="d-flex justify-content-between align-items-center" type="button" data-bs-toggle="collapse" data-bs-target="#${course["code"]}">
                    <div class="d-md-inline-flex align-items-md-center p-0">
                        <p class="m-0 p-2 text-start">${course["code"]} ${course["name"]}: ${course["degreeName"]} - ${course["campus"]}</p>
                        <div>
                            ${createStars(getMeanRating([course["ratingL"], course["ratingM"], course["ratingE"], course["ratingD"]]), "rgb(30, 48, 80)")}
                        </div>`;
        if (isStudent && course["isSubscribed"]) {
            content += `<i class="fa-solid fa-check mx-2 mt-2" style="color: rgb(30, 48, 80);"></i>`
        }
        content += `</div>
                    <i class="fa-solid fa-angle-down" style="color: rgb(30, 48, 80);"></i>
                </div>
                <div id="${course["code"]}" class="collapse p-3 w-100">
                    <ul class="d-flex flex-column align-items-start">`;
        for (const professor of course["professors"]) {
            content += `<li><a href="professor.php?professor=${idWithoutDomain(professor["professor"])}" class="link-deepskyblue">${professor["name"]} ${professor["surname"]}</a></li>`;
        }
        content += `</ul>
                <p>${course["shortDescription"]}</p>
                <div class="d-flex justify-content-end">
                    <a href="course.php?course=${course["code"]}" class="btn btn-primary me-1 mt-2">Apri corso</a>`;
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

function generateUpdateCoursesDropdown(courses, degreeYears) {
    let content = `<li>
            <label for="updateCourseCode">
                <h5>Corso</h5>
            </label>
        </li>
        <li>
            <select name="code" id="updateCourseCode" onchange="getUpdateCoursesForm()" class="form-select w-lg-25" required>
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
            <label for="updateName" class="text-left">
                <h5>Nome</h5>
            </label>
        </li>
        <li>
            <input type="text" id="updateName" name="name" value="${course["name"]}" required />
        </li>
        <div class="d-flex align-content-stretch">
            <li class="mt-2">
                <label for="updateYear" class="text-left">
                    <h5>Anno</h5>
                </label>
            </li>
            <li class="mt-2">
                <select name="year" id="updateYear" class="form-select mt-2 ms-2 me-3" required>`;
    for (let year = 1; year <= degreeYears; year++) {
        content += `<option value="${year}" ${course["year"] == year ? "selected" : ""}>${year}</option>`;
    }
    content += `</select>
            </li>
            <li class="mt-2 ms-4">
                <label for="updateSemester" class="text-left">
                    <h5>Semestre</h5>
                </label>
            </li>
            <li class="mt-2">
                <select name="semester" id="updateSemester" class="form-select mt-2 ms-2" required>
                    <option value="1" ${course["semester"] == "1" ? "selected" : ""}>1</option>
                    <option value="2" ${course["semester"] == "2" ? "selected" : ""}>2</option>
                </select>
            </li> 
        </div>
        <div>
            <li>
                <label for="addProfessor">
                    <h5>Aggiungi docente al corso</h5>
                </label>
            </li>
            <li>
                <select name="addProfessor" id="addProfessor" class="form-select w-lg-25">
                    <option value="" selected>Nessuno</option>`;
        const professorsToAdd = professors.filter(e => !course["professors"].find(t => t["professor"] == e["professor"]));
        for (const professor of professorsToAdd) {
            content += `<option value="${professor["professor"]}">${professor["name"]} ${professor["surname"]}</option>`;
        }
        content += `</select>
            </li>
        </div>
        <div>
            <li>
                <label for="removeProfessor">
                    <h5>Rimuovi docente dal corso</h5>
                </label>
            </li>
            <li>
                <select name="removeProfessor" id="removeProfessor" class="form-select w-lg-25">
                    <option value="" selected>Nessuno</option>`;
        for (const professor of course["professors"]) {
            content += `<option value="${professor["professor"]}">${professor["name"]} ${professor["surname"]}</option>`;
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

const coursesSection = document.querySelector("#courses");
if (coursesSection != null) {
    getCoursesData();
}
