const btn = document.getElementById("toggle-button");
const body = document.getElementsByTagName("body")[0];
const btnImg = btn.getElementsByTagName("img");
const menu = document.getElementById("menu");
const sliderItems = document.getElementById("slider-items");
const slider = document.getElementById("slider");
const sliderButtons = slider.getElementsByTagName("button");
const sliderItem = document.getElementsByClassName("slider-item");
const links = menu.getElementsByTagName("a");
var ind = 0;

for (let i = 0; i < links.length; i++) {
  links[i].addEventListener("click", (event) => {
    menu.classList.add("hidden-height");
    btn.removeAttribute("opened", "");
    btnImg[0].classList.remove("hidden-op");
    btnImg[1].classList.add("hidden-op");
    body.classList.remove("no-scroll");
    event.preventDefault()
    document.querySelector(links[i].getAttribute('href')).scrollIntoView({
      behavior: 'smooth'
    })
  });
}

btn.addEventListener("click", () => {
  if (btn.hasAttribute("opened")) {
    menu.classList.add("hidden-height");
    btn.removeAttribute("opened", "");
    btnImg[0].classList.remove("hidden-op");
    btnImg[1].classList.add("hidden-op");
    body.classList.remove("no-scroll");
  } else {
    menu.classList.remove("hidden-height");
    btn.setAttribute("opened", "");
    btnImg[1].classList.remove("hidden-op");
    btnImg[0].classList.add("hidden-op");
    body.classList.add("no-scroll");
  }
});

async function get10RandomTvShows() {
  const shows = [];
  for (let i = 0; i < 10; i++)
    shows.push(await getShow(Math.floor(Math.random() * 5000 + 1)));
  return shows;
}

async function getShow(id) {
  const response = await fetch("https://api.tvmaze.com/shows/" + id);
  const show = await response.json();
  return show;
}

async function fillSlider() {
  const shows = await get10RandomTvShows();
  let i = 0;
  shows.forEach((show) => {
    if (show.name != "Not Found" && show.image?.original != undefined) {
      const li = document.createElement("li");
      li.classList.add("slider-item");
      if (i == 0) {
        li.setAttribute("item-active", "");
        i++;
      }
      const img = document.createElement("img");
      img.src = show.image.original;
      li.appendChild(img);

      const div = document.createElement("div");
      div.classList.add("show-info");

      const h6 = document.createElement("h6");
      h6.classList.add("show-name");

      const name = document.createTextNode(show.name);
      h6.appendChild(name);
      div.appendChild(h6);

      const genres = document.createElement("div");
      genres.classList.add("show-genres");
      genres.appendChild(document.createTextNode(show.genres.join(", ")));

      const rating = document.createElement("div");
      rating.classList.add("show-rating");
      rating.appendChild(
        document.createTextNode(
          (show.rating.average == null ? "?" : show.rating.average) + "/10"
        )
      );

      div.appendChild(h6);
      div.appendChild(genres);
      div.appendChild(rating);

      li.appendChild(div);

      sliderItems.appendChild(li);
    }
  });
}

fillSlider();

let interval = setInterval(() => sliderButtons[0].click(), 8000);

for (i = 0; i < sliderButtons.length; i++) {
  sliderButtons[i].addEventListener(
    "click",
    function (i) {
      clearInterval(interval);
      interval = setInterval(() => sliderButtons[0].click(), 8000);
      for (j = 0; j < sliderButtons.length; j++) {
        sliderButtons[j].setAttribute("disabled", "");
      }
      setTimeout(() => {
        for (j = 0; j < sliderButtons.length; j++) {
          sliderButtons[j].removeAttribute("disabled");
        }
      }, 800);

      sliderItem[ind].removeAttribute("item-active");
      if (i == 0) {
        let prev = ind;
        sliderItem[ind].classList.add("translate-100", "slide-in", "reverse");
        ind -= 1;
        if (ind < 0) ind = sliderItem.length - 1;
        if (ind > sliderItem.length - 1) ind = 0;
        sliderItem[ind].classList.add("translate100", "slide-in");
        sliderItem[ind].setAttribute("item-active", "");
        setTimeout(() => {
          sliderItem[prev].classList.remove(
            "translate-100",
            "slide-in",
            "reverse"
          );
          sliderItem[ind].classList.remove("translate100", "slide-in");
        }, 750);
      } else {
        let nxt = ind;
        sliderItem[ind].classList.add("translate100", "slide-in", "reverse");
        ind += 1;
        if (ind < 0) ind = sliderItem.length - 1;
        if (ind > sliderItem.length - 1) ind = 0;
        sliderItem[ind].classList.add("translate-100", "slide-in");
        sliderItem[ind].setAttribute("item-active", "");
        setTimeout(() => {
          sliderItem[nxt].classList.remove(
            "translate100",
            "slide-in",
            "reverse"
          );
          sliderItem[ind].classList.remove("translate-100", "slide-in");
        }, 750);
      }
    }.bind(null, i)
  );
}
