function createStars(rating, color) {
    let content = "";
    let nColored = Math.floor(rating);
    let nWhite = 5 - nColored;

    for (let i = 0; i < nColored; i++) {
        content += `<i class='fa-solid fa-star' style='color: ${color}'></i>`;
    };

    if (rating - nColored != 0) {
        content += `<i class='fa-solid fa-star-half-stroke' style='color: ${color}'></i>`;
        nWhite--;
    };

    for (let i = 0; i < nWhite; i++) {
        content += `<i class='fa-regular fa-star' style='color: ${color}'></i>`;
    };
    return content;
}

function getMeanRating(ratingArray) {
    let sum = 0;
    let mean = 0;
    for (const rating of ratingArray) {
        sum += Number(rating);
    };
    mean = sum / ratingArray.length;
    return mean;
}

function subscriptionButton(courseCode, isSubscribed, page) {
    if (isSubscribed){
        return `<a href='subscription.php?action=remove&course=${courseCode}&page=${page}' class='btn btn-white border-primary ms-1 mt-2'>Discriviti</a>`;
    } else {
        return `<a href='subscription.php?action=add&course=${courseCode}&page=${page}' class='btn btn-primary ms-1 mt-2'>Iscriviti</a>`;
    }
}

function idWithoutDomain(id) {
    const idElements = id.split("@");
    return idElements[0];
}

function parseCourseYear(year) {
    switch (year) {
        case 1: return "Primo";
        case 2: return "Secondo";
        case 3: return "Terzo";
        case 4: return "Quarto";
        case 5: return "Quinto";
        case 6: return "Sesto";
        default: return "Invalid";
    }
}

function toggleStatistics() {
    const style = document.querySelector("#statistics").style;
    style["display"] = style["display"] == "block" ? "none" : "block";
}
