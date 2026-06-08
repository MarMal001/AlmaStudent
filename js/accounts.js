const ADMIN_MODIFY_ACCOUNT = 4;
const ADMIN_DELETE_ACCOUNT = 7;

function generateUpdateProfessorForm(professor, photo) {
    let content = `<li>
            <label for="updateName" class="text-left form-label">
                Nome
            </label>
        </li>
        <li>
            <input type="text" id="updateName" name="name" value="${professor["name"]}" class="form-control rounded-pill" required />
        </li>
        <li>
            <label for="updateSurname" class="text-left form-label">
                Cognome
            </label>
        </li>
        <li>
            <input type="text" id="updateSurname" name="surname" value="${professor["surname"]}" class="form-control rounded-pill" required />
        </li>
        <li>
            <label for="updateDepartment" class="text-left form-label">
                Dipartimento
            </label>
        </li>
        <li>
            <input type="text" id="updateDepartment" name="department" value='${professor["department"]}' class="form-control rounded-pill" required />
        </li>
        <li>
            <label for="updateSeat" class="text-left form-label">
                Sede
            </label>
        </li>
        <li>
            <input type="text" id="updateSeat" name="seat" value="${professor["campus"]}" class="form-control rounded-pill" required />
        </li>
        <li>
            <label for="updateInfoReception" class="text-left form-label">
                Info ricevimento
            </label>
        </li>
        <li>
            <textarea id="updateInfoReception" name="infoReception" class="form-control" maxlength="500">${professor["infoReception"]}</textarea>
        </li>
        <li class="w-25">
            <img src="${photo}" alt="" class="img-fluid object-fit-fill rounded mt-3" /> 
        </li>
        <li class="d-flex">
            <input type="checkbox" id="updateRemoveProfilePicture" name="removeProfilePicture" class="form-check-input mt-3 me-2" />
            <label for="updateRemoveProfilePicture" class="form-check-label mt-2">Rimuovi immagine profilo</label>
        </li>
        <li class="d-flex justify-content-end">
            <button type="submit" class="btn btn-deepskyblue mt-3 me-2" name="action" value="${ADMIN_MODIFY_ACCOUNT}">Modifica account</button>
            <button type="submit" class="btn btn-darkred mt-3" name="action" value="${ADMIN_DELETE_ACCOUNT}">Elimina account</button>
        </li>`;
    return content;
}

function generateUpdateAdminForm(admin) {
    let content = `<li>
            <label for="updateName" class="text-left form-label">
                Nome
            </label>
        </li>
        <li>
            <input type="text" id="updateName" name="name" value="${admin["name"]}" class="form-control rounded-pill" required />
        </li>
        <li>
            <label for="updateSurname" class="text-left form-label">
                Cognome
            </label>
        </li>
        <li>
            <input type="text" id="updateSurname" name="surname" value="${admin["surname"]}" class="form-control rounded-pill" required />
        </li>
        <li class="d-flex justify-content-end">
            <button type="submit" class="btn btn-deepskyblue mt-3 me-2" name="action" value="${ADMIN_MODIFY_ACCOUNT}">Modifica account</button>
            <button type="submit" class="btn btn-darkred mt-3" name="action" value="${ADMIN_DELETE_ACCOUNT}">Elimina account</button>
        </li>`;
    return content;
}

async function getUpdateProfessorForm() {
    const url = "api-accounts.php";
    const formData = new FormData();
    let professorCode = document.querySelector("#updateProfessorCode").value;
    if (professorCode == "") {
        return;
    }
    formData.append("code", professorCode);
    formData.append("type", "professor");
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
        const section = document.querySelector("#updateProfessorForm");
        section.innerHTML = generateUpdateProfessorForm(json["professor"], json["photo"]);
    } catch (error) {
        console.log(error.message);
    }
}

async function getUpdateAdminForm() {
    const url = "api-accounts.php";
    const formData = new FormData();
    let adminCode = document.querySelector("#updateAdminCode").value;
    if (adminCode == "") {
        return;
    }
    formData.append("code", adminCode);
    formData.append("type", "admin");
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
        const section = document.querySelector("#updateAdminForm");
        section.innerHTML = generateUpdateAdminForm(json["admin"]);
    } catch (error) {
        console.log(error.message);
    }
}
