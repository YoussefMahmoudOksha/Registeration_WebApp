function showActors(date) {
  const actorsContainer = document.querySelector(".Api_recall");
  actorsContainer.innerHTML = "";

  if (date.length == 0) {
    document.getElementById("Api_recall").innerHTML = "";
    return;
  } else {
    const xmlhttp = new XMLHttpRequest();
    var url = "controller/API_Ops.php";
    var params = "birthday=" + date;
    xmlhttp.open("POST", url, true);
    xmlhttp.onload = function () {
      const response = JSON.parse(xmlhttp.responseText);
      const actors = response.actors;
      actorsContainer.innerHTML = "<p>Actors born on the same day:</p>";
      for (let i = 0; i < actors.length; i++) {
        // Create the actor div
        const actor = document.createElement("div");
        actor.classList.add("actor");

        // Create the actor image
        const actorImage = document.createElement("img");
        actorImage.src = actors[i].image;
        actorImage.alt = "Actor image";

        // Create the actor name
        const actorName = document.createElement("p");
        actorName.textContent = actors[i].name;

        // Append the actor image and name to the actor div
        actor.appendChild(actorImage);
        actor.appendChild(actorName);

        // Append the actor div to the actors container
        actorsContainer.appendChild(actor);
        actorsContainer.appendChild(document.createElement("br"));
      }
      
    };

    xmlhttp.setRequestHeader(
      "Content-type",
      "application/x-www-form-urlencoded"
    );
    xmlhttp.send(params);
  }
}
