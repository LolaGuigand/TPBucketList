// declaration du compteur
const counterDisplay = document.querySelector("h3");
let counter = 0;
const vitesse = 300;
let StartingMinutes = 2;
let time = StartingMinutes*60;
const countdownEl = document.getElementById("countdown");

// fonction des bulles
const bubbleMaker = () =>{

    // creation de la bulle
    const bubble = document.createElement("span");
    bubble.classList.add("bubble");
    document.body.appendChild(bubble);

    // dimension de base
    const size = (Math.random() * 200 +100) + "px";
    bubble.style.height = size;
    bubble.style.width = size;

    // position de base
    bubble.style.top = Math.random() * 100 + 50 +"%";
    bubble.style.left = Math.random() * 100 + "%";

    // donner la direction à prendre
    const plusMinus = Math.random() > 0.5 ? 1 : -1; // fonction qui determine si la bulle part sur la droite -1, ou sur la gauche +1
    bubble.style.setProperty("--left", plusMinus*Math.random()*100 +"%");

    // evenement du clic
    bubble.addEventListener("click", ()=>{
        counter++;
        counterDisplay.textContent = counter;
        bubble.remove();
    })

    // durée de vie d'une bulle
    setTimeout(() =>{
        bubble.remove();
    }, 8000);
};

// Compte à rebours
function updateCountdown() {
    const minutes = Math.floor(time / 60);
    let seconds = time % 60;

    seconds = seconds < 10 ? "0" + seconds : seconds;
    countdownEl.innerHTML = `${minutes} : ${seconds}`;
    if (time > 0){
        time--;
    } else {
        countdownEl.innerHtml = `C'EST FINI !!`;
    }
}

// intervalle de temps entre 2 bulles
setInterval(bubbleMaker, vitesse);
setInterval(updateCountdown, 1000);