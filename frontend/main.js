// Mobile menu toggle
const mobileMenuButton = document.getElementById("mobile-menu-button");
const mobileMenu = document.getElementById("mobile-menu");

mobileMenuButton.addEventListener("click", () => {
  mobileMenu.classList.toggle("hidden");
});
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
    const errorMessageDiv = document.getElementById("booking_error_message");
    const successMessageDiv = document.getElementById(
      "booking_success_message"
    );

    // Validation
    if (!name || !email || !phone || !service_name || !date) {
      errorMessageText.innerHTML = "All fields are required.";
      errorMessageDiv.classList.remove("hidden");
      return;
    }

    if (!validateEmail(email)) {
      errorMessageText.innerHTML = "Please enter a valid email address.";
      errorMessageDiv.classList.remove("hidden");
      return;
    }

    if (!validatePhone(phone)) {
      errorMessageText.innerHTML = "Please enter a valid phone number.";
      errorMessageDiv.classList.remove("hidden");
      return;
    }

    try {
      const response = await fetch(
        "http://localhost/nacom-computer-consults/backend/bookOurService.php",
        {
          method: "POST",
          headers: {
            "Content-Type": "application/json",
          },
          body: JSON.stringify({ name, email, phone, service_name, date }),
        }
      );

      let result;
      try {
        result = await response.json();
      } catch (jsonError) {
        throw new Error("Server returned non-JSON response.");
      }

      if (!response.ok) {
        throw new Error(result.message || "Network response was not ok");
      }

      // Show success message
      successMessageText.innerText = result.message || "Booking successful!";
      successMessageDiv.classList.remove("hidden");
      errorMessageDiv.classList.add("hidden");

      // Reset form
      document.getElementById("book_our_service_form").reset();
    } catch (error) {
      console.error("Error:", error);

      // Hide success message and show error
      successMessageDiv.classList.add("hidden");
      errorMessageText.innerText =
        error.message || "An unexpected error occurred.";
      errorMessageDiv.classList.remove("hidden");
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
// End of Book Our Service

// Enquiries Form Submission
document
  .getElementById("enquiries_send_message_btn")
  .addEventListener("click", async function (e) {
    e.preventDefault();

    // Get form values
    const name = document.getElementById("enquiries_full_name").value.trim();
    const email = document.getElementById("enquiries_email").value.trim();
    const subject = document.getElementById("enquiries_subject").value.trim();
    const message = document.getElementById("enquiries_message").value.trim();

    let successMessageText = document.getElementById(
      "enquiry_success_message_text"
    );
    let errorMessageText = document.getElementById(
      "enquiry_error_message_text"
    );

    let errorMessage = "";
    let successMessage = "";

    // Validation
    if (!name || !email || !subject || !message) {
      errorMessage = "All fields are required.";
      errorMessageText.innerHTML = errorMessage;
      document
        .getElementById("enquiries_error_message")
        .classList.remove("hidden");
    } else if (!validateEmail(email)) {
      errorMessage = "Please enter a valid email address.";
      errorMessageText.innerHTML = errorMessage;
      document
        .getElementById("enquiries_error_message")
        .classList.remove("hidden");
    } else {
      try {
        const response = await fetch(
          "http://localhost/nacom-computer-consults/backend/generalEnquiries.php",
          {
            method: "POST",
            headers: {
              "Content-Type": "application/json",
            },
            body: JSON.stringify({ name, email, subject, message }),
          }
        );

        // Parse JSON response
        const data = await response.json();

        console.log(data.message);

        successMessage = data.message || "Enquiry sent successfully!";
        successMessageText.innerHTML = successMessage;
        document
          .getElementById("enquiries_success_message")
          .classList.remove("hidden");

        // Reset form
        document.getElementById("enquiries_form").reset();
      } catch (error) {
        console.error("Error:", error);
        errorMessage =
          error.message || "Something went wrong. Please try again later.";
        errorMessageText.innerHTML = errorMessage;
        document
          .getElementById("enquiries_error_message")
          .classList.remove("hidden");
      }
    }
  });
