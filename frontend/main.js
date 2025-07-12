// ...................Start Book Btn............
const button = document.getElementById('submitBtn');
  const success = document.getElementById('successMessage');

  button.addEventListener('click', () => {
    // Show the success message
    success.classList.remove('hidden');
    success.classList.add('flex');

    // Hide it again after 4 seconds
    setTimeout(() => {
      success.classList.remove('flex');
      success.classList.add('hidden');
    }, 4000);
  });
  // End Book Btn

  // Start Enquiry
  <script>
  const button = document.getElementById('submitBtn');
  const success = document.getElementById('successMessage');

  button.addEventListener('click', () => {
    success.classList.remove('hidden');
    success.classList.add('flex');

    setTimeout(() => {
      success.classList.remove('flex');
      success.classList.add('hidden');
    }, 4000);
  });
</script>
// End Enquiry