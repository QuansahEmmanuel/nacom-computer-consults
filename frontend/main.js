// Mobile menu toggle
const mobileMenuButton = document.getElementById("mobile-menu-button");
const mobileMenu = document.getElementById("mobile-menu");

mobileMenuButton.addEventListener("click", () => {
  mobileMenu.classList.toggle("hidden");
});
// End of Mobile menu toggle

// ...................Start Book Btn............
const button = document.getElementById("submitBtn");
const success = document.getElementById("successMessage");

button.addEventListener("click", () => {
  // Show the success message
  success.classList.remove("hidden");
  success.classList.add("flex");

  // Hide it again after 4 seconds
  setTimeout(() => {
    success.classList.remove("flex");
    success.classList.add("hidden");
  }, 4000);
});
// End Book Btn
