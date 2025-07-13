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
  .addEventListener("click", function (e) {
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

    let errorMessage = "";

    // Validation
    if (!name || !email || !phone || !service_name || !date) {
      errorMessage = "All fields are required.";
    } else if (!validateEmail(email)) {
      errorMessage = "Please enter a valid email address.";
    } else if (!validatePhone(phone)) {
      errorMessage = "Please enter a valid phone number.";
    }

    // Display error message or success
    const errorDiv = document.getElementById("error_message_display");
    errorDiv.innerHTML = ""; // Clear previous messages

    if (errorMessage) {
      errorDiv.innerHTML = `
            <div class="alert alert-error shadow-lg mb-4 flex justify-center items-center">
                <div class="flex justify-center items-center text-center gap-4">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 shrink-0 stroke-current" fill="none" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 14l2-2m0 0l2-2m-2 2l-2-2m2 2l2 2m7-2a9 9 0 11-18 0 9 9 0 0118 0z" />
                    </svg>
                    <span class="text-m font-bold text-white">${errorMessage}</span> 
                </div>
            </div>
        `;
    } else {
      // Success: Show success message
      errorMessage = "";
      // Send POST request
      fetch("bookOurService.php", {
        method: "POST",
        headers: {
          "Content-Type": "application/json",
        },
        body: JSON.stringify({ name, email, phone, service_name, date }),
      })
        .then((response) => response.text())
        .then((data) => {
          console.log("Success:", data);
          document.getElementById("successMessage").classList.remove("hidden");
          document.querySelector("form").reset();
        })
        .catch((error) => {
          console.error("Error:", error);
          document.getElementById("error_message_display").innerHTML = `
           <div class="alert alert-error shadow-lg mb-4 flex justify-center items-center">
                <div class="flex justify-center items-center text-center gap-4">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 shrink-0 stroke-current" fill="none" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 14l2-2m0 0l2-2m-2 2l-2-2m2 2l2 2m7-2a9 9 0 11-18 0 9 9 0 0118 0z" />
                    </svg>
                    <span class="text-m font-bold text-white">Something went wrong. Please try again later.</span>
                </div>
            </div>`;
        });
    }
  });

// Email validation regex
function validateEmail(email) {
  const re = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
  return re.test(email);
}

// Phone validation (basic example)
function validatePhone(phone) {
  const re = /^\+?[0-9\s\-()]{7,}$/;
  return re.test(phone);
}
