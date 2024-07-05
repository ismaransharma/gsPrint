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
    const reviewTextarea = document.getElementById("review");
    const ratingInput = document.getElementById("rating");

    stars.forEach((star) => {
        star.addEventListener("click", function () {
            const value = parseInt(star.getAttribute("data-value"));
            ratingInput.value = value;
            setRating(value);
        });
    });

    function setRating(value) {
        stars.forEach((star) => {
            const starValue = parseInt(star.getAttribute("data-value"));
            if (starValue <= value) {
                star.classList.add("active");
            } else {
                star.classList.remove("active");
            }
        });
    }

    document
        .getElementById("ratingForm")
        .addEventListener("submit", function (event) {
            if (!reviewTextarea.checkValidity()) {
                reviewTextarea.reportValidity();
                event.preventDefault();
            } else if (ratingInput.value === "") {
                event.preventDefault();
                showRatingValidationMessage();
            }
        });

    function showRatingValidationMessage() {
        const ratingErrorMessage =
            document.getElementById("ratingErrorMessage");
        if (ratingErrorMessage) {
            ratingErrorMessage.style.display = "block";
        } else {
            const errorMessage = document.createElement("div");
            errorMessage.id = "ratingErrorMessage";
            errorMessage.textContent = "Please select minimum 1 star rating";
            errorMessage.style.color = "red";
            errorMessage.style.marginTop = "5px";
            errorMessage.style.fontSize = "12px";
            errorMessage.style.display = "block";
            document.querySelector(".reviewStars").appendChild(errorMessage);
        }
    }
});

function submitForm() {
    const reviewTextarea = document.getElementById("review");
    const reviewValue = reviewTextarea.value.trim(); // Trim to remove leading and trailing whitespace

    if (reviewValue === "") {
        alert("Please enter a review before submitting.");
        return; // Prevent form submission if textarea is empty
    }

    document.getElementById("ratingForm").submit();
}

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
