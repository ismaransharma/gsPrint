function addAReview() {
    const addReview = document.getElementById("addAReview");
    const viewReview = document.getElementById("viewReview");

    addReview.style.display = "block";
    viewReview.style.display = "none";
}

function viewReview() {
    const addReview = document.getElementById("addAReview");
    const viewReview = document.getElementById("viewReview");

    addReview.style.display = "none";
    viewReview.style.display = "block";
}

// Hover Star

document.addEventListener("DOMContentLoaded", function () {
    const stars = document.querySelectorAll(".star");

    stars.forEach((star) => {
        star.addEventListener("mouseenter", function () {
            const value = parseInt(star.getAttribute("data-value"));
            highlightStars(value);
        });

        star.addEventListener("click", function () {
            const value = parseInt(star.getAttribute("data-value"));
            setRating(value);
        });
    });

    function highlightStars(value) {
        stars.forEach((star, index) => {
            const starValue = parseInt(star.getAttribute("data-value"));
            if (starValue <= value) {
                star.classList.add("active");
            } else {
                star.classList.remove("active");
            }
        });
    }

    function setRating(value) {
        stars.forEach((star) => {
            const starValue = parseInt(star.getAttribute("data-value"));
            if (starValue <= value) {
                star.classList.add("active");
            } else {
                star.classList.remove("active");
            }
        });

        // Set color to #ed8a19 for all stars up to the clicked value
        stars.forEach((star) => {
            const starValue = parseInt(star.getAttribute("data-value"));
            if (starValue <= value) {
                star.querySelector("path").style.fill = "#ed8a19";
            } else {
                star.querySelector("path").style.fill = "none";
            }
        });
    }
});

// Log Rating
function logRating() {
    const stars = document.querySelectorAll(".star");
    let rating = 0;

    stars.forEach((star) => {
        if (star.classList.contains("active")) {
            rating = parseInt(star.getAttribute("data-value"));
        }
    });

    console.log("Rating:", rating);
}
