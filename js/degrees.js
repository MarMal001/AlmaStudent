const ADMIN_MODIFY_DEGREE = 5;
const ADMIN_DELETE_DEGREE = 8;

function generateUpdateDegreesForm(degree) {
    let content = `<li>
            <label for="updateName" class="text-left form-label">
                Nome
            </label>
        </li>
        <li>
            <input type="text" id="updateName" name="name" value="${degree["name"]}" class="form-control rounded-pill" required />
        </li>
        <li class="mt-2 d-flex">
            <label for="updateYears" class="text-left form-label">
                Anni
            </label>
            <select name="years" id="updateYears" class="form-select rounded-pill mt-2 ms-2 w-lg-25">`;
    for (let i = 1; i <= 6; i++) {
        content += `<option value="${i}" ${degree["nYears"] == i ? "selected" : ""}>${i}</option>`;
    }
    content += `</select>
        </li>
        <li class="mt-2 d-flex">
            <label for="updateDepartment" class="text-left form-label">
                Dipartimento
            </label>
            <select name="department" id="updateDepartment" class="form-select rounded-pill mt-2 ms-2 w-lg-25">
                <option value="DISI" ${degree["department"] == "DISI" ? "selected" : ""}>DISI</option>
                <option value="DEI" ${degree["department"] == "DEI" ? "selected" : ""}>DEI</option>
                <option value="DIMEC" ${degree["department"] == "DIMEC" ? "selected" : ""}>DIMEC</option>
            </select>
        </li>
        <li class="mt-2 d-flex">
            <label for="updateBranch" class="text-left form-label">
                Sede
            </label>
            <select name="branch" id="updateBranch" class="form-select rounded-pill mt-2 ms-2 w-lg-25">
                <option value="Bologna" ${degree["campus"] == "Bologna" ? "selected" : ""}>Bologna</option>
                <option value="Cesena" ${degree["campus"] == "Cesena" ? "selected" : ""}>Cesena</option>
                <option value="Forli" ${degree["campus"] == "Forli" ? "selected" : ""}>Forli</option>
            </select>
        </li>
        <li class="d-flex justify-content-end">
            <button type="submit" class="btn btn-deepskyblue mt-3 me-2" name="action" value="${ADMIN_MODIFY_DEGREE}">Modifica</button>
            <button type="submit" class="btn btn-darkred mt-3" name="action" value="${ADMIN_DELETE_DEGREE}">Elimina</button>
        </li>
        <input type="hidden" name="degreeCode" value="${degree["code"]} />`;
    return content;
}

async function getUpdateDegreesForm() {
    const url = "api-degrees.php";
    const formData = new FormData();
    let degreeCode = document.querySelector("#degreeCode").value;
    if (degreeCode == "") {
        return;
    }
    formData.append("degreeCode", degreeCode);
    formData.append("type", "updateDegree");
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
        const section = document.querySelector("#formUpdate");
        section.innerHTML = generateUpdateDegreesForm(json["degree"]);
    } catch (error) {
        console.log(error.message);
    }
}
