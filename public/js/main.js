const BASE_URL = "http://localhost/nacom-computer-consults/api";

// Mobile menu toggle
const mobileMenuButton = document.getElementById("mobile-menu-button");
const mobileMenu = document.getElementById("mobile-menu");

if (mobileMenuButton && mobileMenu) {
  mobileMenuButton.addEventListener("click", () => {
    mobileMenu.classList.toggle("hidden");
  });
}
// End of Mobile menu toggle

// Book Our Service Form Submission
document
  .getElementById("book_our_service_btn")
  .addEventListener("click", async function (e) {
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

    // Message elements
    const successMessageText = document.getElementById(
      "booking_success_message_text"
    );
    const errorMessageText = document.getElementById(
      "booking_error_message_text"
    );
    const errorMessageDiv = document.getElementById(
      "booking_error_message_div"
    );
    const successMessageDiv = document.getElementById(
      "booking_success_message_div"
    );

    // Hide all message boxes first
    successMessageDiv.classList.add("hidden");
    errorMessageDiv.classList.add("hidden");

    // Validation
    if (!name || !email || !phone || !service_name || !date) {
      errorMessageText.innerHTML = "All fields are required.";
      errorMessageDiv.classList.remove("hidden");
      setTimeout(() => errorMessageDiv.classList.add("hidden"), 3000);
      return;
    }

    if (!validateEmail(email)) {
      errorMessageText.innerHTML = "Please enter a valid email address.";
      errorMessageDiv.classList.remove("hidden");
      setTimeout(() => errorMessageDiv.classList.add("hidden"), 3000);
      return;
    }

    if (!validatePhone(phone)) {
      errorMessageText.innerHTML = "Please enter a valid phone number.";
      errorMessageDiv.classList.remove("hidden");
      setTimeout(() => errorMessageDiv.classList.add("hidden"), 3000);
      return;
    }

    try {
      const response = await axios.post(`${BASE_URL}/user/booking.php`, {
        name,
        email,
        phone,
        service_name,
        date,
        status: "pending",
      });

      const data = response.data;

      if (data && data.status === "success") {
        // Show success message
        successMessageText.innerText = data.message || "Booking successful!";
        successMessageDiv.classList.remove("hidden");
        errorMessageDiv.classList.add("hidden");

        // Reset form
        document.getElementById("book_our_service_form").reset();

        // Hide success after 3 seconds
        setTimeout(() => successMessageDiv.classList.add("hidden"), 3000);
      } else {
        // Show error message
        errorMessageText.innerText = data.message || "Something went wrong.";
        errorMessageDiv.classList.remove("hidden");
        successMessageDiv.classList.add("hidden");
        setTimeout(() => errorMessageDiv.classList.add("hidden"), 3000);
      }
    } catch (error) {
      console.error("Error:", error);

      // Hide success message and show error
      successMessageDiv.classList.add("hidden");
      errorMessageText.innerText =
        error.response?.data?.message ||
        error.message ||
        "An unexpected error occurred.";
      errorMessageDiv.classList.remove("hidden");
      setTimeout(() => errorMessageDiv.classList.add("hidden"), 3000);
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
document
  .getElementById("enquiries_send_message_btn")
  .addEventListener("click", async function (e) {
    e.preventDefault();

    const name = document.getElementById("enquiries_full_name").value.trim();
    const email = document.getElementById("enquiries_email").value.trim();
    const subject = document.getElementById("enquiries_subject").value.trim();
    const message = document.getElementById("enquiries_message").value.trim();

    const successText = document.getElementById("enquiry_success_message_text");
    const errorText = document.getElementById("enquiry_error_message_text");

    const successDiv = document.getElementById("enquiries_success_message_div");
    const errorDiv = document.getElementById("enquiries_error_message_div");

    // Hide all message boxes first
    successDiv.classList.add("hidden");
    errorDiv.classList.add("hidden");

    if (!name || !email || !subject || !message) {
      errorText.innerHTML = "All fields are required.";
      errorDiv.classList.remove("hidden");
      return;
    }

    if (!validateEmail(email)) {
      errorText.innerHTML = "Please enter a valid email address.";
      errorDiv.classList.remove("hidden");
      return;
    }

    try {
      const response = await axios.post(`${BASE_URL}/user/enquiries.php`, {
        name,
        email,
        subject,
        message,
      });

      const data = response.data;

      if (data && data.status === "success") {
        successText.innerHTML = data.message || "Enquiry sent successfully!";
        successDiv.classList.remove("hidden");
        document.getElementById("enquiries_form").reset();
      } else {
        errorText.innerHTML = data.message || "Something went wrong.";
        errorDiv.classList.remove("hidden");
      }
    } catch (error) {
      console.error("Error:", error);
      errorText.innerHTML =
        error.message || "Something went wrong. Please try again.";
      errorDiv.classList.remove("hidden");
    }
  });
