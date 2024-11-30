const menuButton = document.querySelector(".hamburger");
const primaryNav = document.querySelector(".primary-navigation");

menuButton.addEventListener("click", () => {
  menuButton.classList.toggle("is-active");
  primaryNav.classList.toggle("is-active");
});
