
async function getReceptionTable() {
    const url = "api-reception.php";
    const formData = new FormData();
    let date = null;
    let professor = null;
    if (document.querySelector("#professor") == null) {
        return;
    }
    professor = document.querySelector("#professor").value;
    if (document.querySelector("#date") != null) {
        date = document.querySelector("#date").value;
    } else {
        const dateObj = new Date();
        date = dateObj.toISOString().split("T")[0];
    }
    formData.append("date", date);
    formData.append("professor", professor);
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
        const section = document.querySelector("#receptionTable");
        const canStudentReserve = json["reservationsOfStudent"].filter(e => e["date"] == date && e["professor"] == professor).length < 4;
        section.innerHTML = generateReceptionTable(date, json["user"], professor, json["reservations"], json["isStudent"], canStudentReserve);
    } catch (error) {
        console.log(error.message);
    }

}

function getPreviousDay(currDay) {
    let date = new Date(currDay);
    date.setDate(date.getDate() - 1);
    const newDate = date.toISOString().split("T")[0];
    document.querySelector("#date").value = newDate; 
    getReceptionTable();
}

function getNextDay(currDay) {
    let date = new Date(currDay);
    date.setDate(date.getDate() + 1);
    const newDate = date.toISOString().split("T")[0];
    document.querySelector("#date").value = newDate; 
    getReceptionTable();
}

function generateReceptionTable(date, user, professor, reservations, isStudent, canStudentReserve) {
    let content = `<thead class="table-primary text-center">
        <tr>
            <th id="day" scope="colgroup" colspan="3" class="fs-5"><div class="d-flex inline-flex justify-content-center align-items-center">`;
    const dateObj = new Date();
    const toDayDate = dateObj.toISOString().split("T")[0];
    if (toDayDate != date) {
        content += `<i class="fa-solid fa-angle-left" style="color: black;" onClick='getPreviousDay("${date}")'></i>`;
    }
    content += `<div id="date" class="mb-1 mx-2">${date}</div><i class="fa-solid fa-angle-right" style="color: black;" onClick='getNextDay("${date}")'></i></div></th>
    </tr>`;
    content += `<tr class="fs-6">
    <th id="time" scope="col">Ore</th>
    <th id="type" scope="col">Disponibilità</th>`;    
    if (user == professor) {
        content += `<th id="reservations" scope="col">Prenotazioni</th>`;
    }
    content += `</tr>
    </thead>
    <tbody>`;
            for (const reservation of reservations.filter(e => e["date"] == date)) {
                let timeRange = reservation["timeRange"];
                content += `<tr>
                    <th id="${timeRange}" scope="row" headers="time" class="text-center">${timeRange}</th>
                    <td id="type_${timeRange}" headers="type ${timeRange}">Modalità ${reservation["studentCode"] == user ? ("scelta: " + reservation["reservedMode"].toLowerCase()) : (" disponibili: " + reservation["mode"].toLowerCase())}`;
                        if (isStudent) {
                            if (reservation["studentCode"] == user) {
                                content += `<a href="reserve.php?type=unreserve&date=${reservation["date"]}&start=${reservation["startTime"]}&professor=${idWithoutDomain(professor)}" class="btn btn-white text-primary border-primary ms-3">Cancella ricevimento</a>`;
                            } else {
                                const isButtonBlocked = reservation["studentCode"] != null || !canStudentReserve ? "disabled" : "";
                                const buttonPresence = `<a href="reserve.php?type=reserve&mode=Presenza&date=${reservation["date"]}&start=${reservation["startTime"]}&professor=${idWithoutDomain(professor)}" class="btn btn-primary ${isButtonBlocked} ms-3 me-2" ${isButtonBlocked}>Prenota ricevimento in presenza</a>`;
                                const buttonOnline = `<a href="reserve.php?type=reserve&mode=Online&date=${reservation["date"]}&start=${reservation["startTime"]}&professor=${idWithoutDomain(professor)}" class="btn btn-primary ${isButtonBlocked}" ${isButtonBlocked}>Prenota ricevimento online</a>`;
                                if (reservation["mode"].toLowerCase() == "online e in presenza"){
                                    content += buttonPresence;
                                    content += buttonOnline;
                                } else if (reservation["mode"].toLowerCase() == "presenza") {
                                    content += buttonPresence;
                                } else {
                                    content += buttonOnline;
                                }
                            }
                        }
                    content += `</td>`;
                    if (user == professor) {
                        content += `<td id="reservation_${timeRange}" headers="reservations ${timeRange}">`;
                            if (reservation["name"] != null) {
                                content += `<div>Prenotato con studente: ${reservation["name"]} ${reservation["surname"]}</div>
                                <div>Modalità: ${reservation["reservedMode"].toLowerCase()}</div>`;
                            } else {
                                content += `<div>Nessuna prenotazione</div>`;
                            }
                        content += `</td>`;
                    }
                content += `</tr>`;
            }
        if(reservations.filter(e => e["date"] == date).length == 0) {
            content += `<td id="noTime" headers="time" class="text-center">Non sono presenti ricevimenti in questa data</td>
            <td id="noAvailability" headers="type" class="text-center">Nessuna</td>`;
        }
        content += `</tbody>`;
        
    return content;
}

getReceptionTable();
