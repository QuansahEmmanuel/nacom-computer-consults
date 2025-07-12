// Mobile menu toggle
const mobileMenuButton = document.getElementById("mobile-menu-button");
const mobileMenu = document.getElementById("mobile-menu");

mobileMenuButton.addEventListener("click", () => {
  mobileMenu.classList.toggle("hidden");
});
// End of Mobile menu toggle

// Book Our Service
document
  .getElementById("book_our_service_btn")
  .addEventListener("click", (e) => {
    e.preventDefault();

    // Get form values
    const name = document.getElementById("bks_coustomer_name").value.trim();
    const email = document.getElementById("bks_coustomer_email").value.trim();
    const phone = document
      .getElementById("bks_coustomer_phone_number")
      .value.trim();
    const service_name = document
      .getElementById("bks_coustomer_service_name")
      .value.trim();
    const date = document.getElementById("bks_coustomer_date").value;

    // Log the data (for testing)
    console.log({ name, email, phone, service_name, date });
  });
