const ADMIN_MODIFY_DEGREE = 5;
const ADMIN_DELETE_DEGREE = 8;

function generateUpdateDegreesForm(degree) {
    let content = `<ul>
        <li>
            <label for="name" class="text-left">
                <h5>Nome</h5>
            </label>
        </li>
        <li>
            <input type="text" id="name" name="name" value="${degree["name"]}" />
        </li>
        <div class="d-flex align-content-stretch">
            <li class="mt-2">
                <label for="years" class="text-left">
                    <h5>Anni</h5>
                </label>
            </li>
            <li class="mt-2">
                <select name="years" id="years" class="mt-3 ms-2">`;
    for (let i = 1; i <= 6; i++) {
        content += `<option value="${i}" ${degree["nYears"] == i ? "selected" : ""}>${i}</option>`;
    }
    content += `</select>
            </li>
        </div>
        <div class="d-flex align-content-stretch">
            <li class="mt-2">
                <label for="branch" class="text-left">
                    <h5>Sede</h5>
                </label>
            </li>
            <li class="mt-2">
                <select name="branch" id="branch" class="mt-3 ms-2">
                    <option value="Bologna" ${degree["campus"] == "Bologna" ? "selected" : ""}>Bologna</option>
                    <option value="Cesena" ${degree["campus"] == "Cesena" ? "selected" : ""}>Cesena</option>
                    <option value="Forli" ${degree["campus"] == "Forli" ? "selected" : ""}>Forli</option>
                </select>
            </li>
        </div>
        <div class="d-flex">
            <li>
                <button type="submit" class="btn btn-primary mt-3 me-2" name="action" value="${ADMIN_MODIFY_DEGREE}">Modifica</button>
            </li>
            <li>
                <button type="submit" class="btn btn-danger mt-3" name="action" value="${ADMIN_DELETE_DEGREE}">Elimina</button>
            </li>
        </div>
    </ul>
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
