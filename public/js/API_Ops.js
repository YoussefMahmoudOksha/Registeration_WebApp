function showActors(date) {
    const actorsContainer = document.querySelector(".Api_recall");
    actorsContainer.innerHTML = ""; // Clear the container

    if (date.length === 0) {
        // Handle empty date case
        actorsContainer.innerHTML = "No date provided.";
        return;
    }

    // Construct the URL with the dynamic date value
    const url = "apiActor/" + encodeURIComponent(date);

    $.ajax({
        url: url,
        type: "GET",
        success: function (response) {
            const actors = response.actors;

            actorsContainer.innerHTML = "";

            if (actors.length === 0) {
                actorsContainer.innerHTML = "No actors found.";
            } else {
                actorsContainer.innerHTML =
                    "<p>Actors born on the same day:</p>";

                actors.forEach((actor) => {
                    const actorDiv = document.createElement("div");
                    actorDiv.classList.add("actor");

                    const actorImage = document.createElement("img");
                    actorImage.src = actor.image;
                    actorImage.alt = "Actor image";

                    const actorName = document.createElement("p");
                    actorName.textContent = actor.name;

                    actorDiv.appendChild(actorImage);
                    actorDiv.appendChild(actorName);

                    actorsContainer.appendChild(actorDiv);
                    actorsContainer.appendChild(document.createElement("br"));
                });
            }
        },
        error: function (xhr, status, error) {
            actorsContainer.innerHTML = "Error fetching data: " + error;
        },
    });
}
