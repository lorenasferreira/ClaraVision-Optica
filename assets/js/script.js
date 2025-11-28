let index = 0;
let slidesContainer;
let totalSlides;

document.addEventListener("DOMContentLoaded", () => {
  slidesContainer = document.querySelector(".slides");
  totalSlides = document.querySelectorAll(".slide").length;

  document.querySelector(".hero-next").onclick = () => showSlide(index + 1);
  document.querySelector(".hero-prev").onclick = () => showSlide(index - 1);

  setInterval(() => showSlide(index + 1), 5000);
});

function showSlide(i) {
  index = (i + totalSlides) % totalSlides;
  slidesContainer.style.transform = `translateX(${-index * 100}%)`;
}

function confirmDelete() {
    return confirm("Are you sure you want to delete this?");
}

