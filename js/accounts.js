const ADMIN_MODIFY_ACCOUNT = 4;
const ADMIN_DELETE_ACCOUNT = 7;

function generateUpdateProfessorForm(professor) {
    let content = `<li>
            <label for="updateName" class="text-left">
                <h5>Nome</h5>
            </label>
        </li>
        <li>
            <input type="text" id="updateName" name="name" value="${professor["name"]}" required />
        </li>
        <li>
            <label for="updateSurname" class="text-left">
                <h5>Cognome</h5>
            </label>
        </li>
        <li>
            <input type="text" id="updateSurname" name="surname" value="${professor["surname"]}" required />
        </li>
        <li>
            <label for="updateDepartment" class="text-left">
                <h5>Dipartimento</h5>
            </label>
        </li>
        <li>
            <input type="text" id="updateDepartment" name="department" value="${professor["department"]}" required />
        </li>
        <li>
            <label for="updateSeat" class="text-left">
                <h5>Sede</h5>
            </label>
        </li>
        <li>
            <input type="text" id="updateSeat" name="seat" value="${professor["campus"]}" required />
        </li>
        <li>
            <label for="updateInfoReception" class="text-left">
                <h5>Info ricevimento</h5>
            </label>
        </li>
        <li>
            <input type="text" id="updateInfoReception" name="infoReception" value="${professor["infoReception"]}" required />
        </li>
        <div class="d-flex">
            <li class="mt-3 me-2">
                <input type="checkbox" id="updateRemoveProfilePicture" name="removeProfilePicture" />
            </li>
            <li>
                <label for="updateRemoveProfilePicture">Rimuovi immagine profilo</label>
            </li>
        </div>        
        <li>
            <button type="submit" class="btn btn-primary mt-3" name="action" value="${ADMIN_MODIFY_ACCOUNT}">Modifica account</button>
        </li>
        <li>
            <button type="submit" class="btn btn-danger mt-3" name="action" value="${ADMIN_DELETE_ACCOUNT}">Elimina account</button>
        </li>`;
    return content;
}

function generateUpdateAdminForm(admin) {
    let content = `<li>
            <label for="updateName" class="text-left">
                <h5>Nome</h5>
            </label>
        </li>
        <li>
            <input type="text" id="updateName" name="name" value="${admin["name"]}" required />
        </li>
        <li>
            <label for="updateSurname" class="text-left">
                <h5>Cognome</h5>
            </label>
        </li>
        <li>
            <input type="text" id="updateSurname" name="surname" value="${admin["surname"]}" required />
        </li>
        <li>
            <button type="submit" class="btn btn-primary mt-3" name="action" value="${ADMIN_MODIFY_ACCOUNT}">Modifica account</button>
        </li>
        <li>
            <button type="submit" class="btn btn-danger mt-3" name="action" value="${ADMIN_DELETE_ACCOUNT}">Elimina account</button>
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
        section.innerHTML = generateUpdateProfessorForm(json["professor"]);
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
