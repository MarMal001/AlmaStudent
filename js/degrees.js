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

async function getCoursesData() {
    const url = "api-degrees.php";
    const formData = new FormData();
    let degreeCode = document.querySelector("#degreeCode").value;
    if (degreeCode == "") {
        return;
    }
    formData.append("degreeCode", degreeCode);
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
