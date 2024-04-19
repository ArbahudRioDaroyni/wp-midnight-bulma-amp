let waitingSeconds = 2;
function startToDownload() {
  document.getElementById("download-button").addEventListener("click", startForDownload);

  function startForDownload() {
  document.getElementById("check-area").classList.remove("is-hidden");
  setTimeout(
      function() {
          document.getElementById("check-area").classList.add("is-hidden");
          document.getElementById("checked-area").classList.remove("is-hidden");
          clearTimeout(myInterval);
      }, 15000);

  const myInterval = setInterval(loadingForDownload, 1000);
  }

  function loadingForDownload() {
    document.getElementById("waitingSeconds").innerHTML = `${waitingSeconds}%.`;
    // document.getElementById("waitingProgress").style.setProperty('value', `${waitingSeconds}`);
    waitingSeconds = waitingSeconds + Math.floor(Math.random() * (8 - 6 + 1)) + 6;
  }
}
startToDownload();

// // post file
// function toggleText() {

//   // Get all the elements from the page
//   var points =
//       document.getElementById("points");

//   var showMoreText =
//       document.getElementById("moreText");

//   var buttonText =
//       document.getElementById("textButton");

//   if (points.style.display === "none") {
//       showMoreText.style.display = "none";
//       points.style.display = "inline";
//       buttonText.innerHTML = "Tampilkan Lebih Banyak";
//   } else {
//       showMoreText.style.display = "inline";
//       points.style.display = "none";
//       buttonText.innerHTML = "Tampilkan Lebih Sedikit";
//   }
// }

// function startToDownload() {
//   document.getElementById("download-button").addEventListener("click", startForDownload);

//   function startForDownload() {
//   waitingSeconds = 2;
//   document.getElementById("check-area").classList.remove("d-none");
//   setTimeout(
//       function() {
//           document.getElementById("check-area").classList.add("d-none");
//           document.getElementById("checked-area").classList.remove("d-none");
//           clearTimeout(myInterval);
//       }, 15000);

//   const myInterval = setInterval(loadingForDownload, 1000);
//   }

//   function loadingForDownload() {
//   document.getElementById("waitingSeconds").innerHTML = waitingSeconds;
//   document.getElementById("waitingProgress").style.setProperty('width', `${waitingSeconds}%`);
//   waitingSeconds = waitingSeconds + Math.floor(Math.random() * (8 - 6 + 1)) + 6;
//   }
// }
// startToDownload();