function showActors(date) {
  const actorsContainer = document.querySelector(".Api_recall");
  actorsContainer.innerHTML = "";

  if (date.length === 0) {
      actorsContainer.innerHTML = "";
      return;
  }

  const xmlhttp = new XMLHttpRequest();
  var url = "apiActor";
  xmlhttp.open("GET", url + "?birthday=" + date, true);
  xmlhttp.send();
}

