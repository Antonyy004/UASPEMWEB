document.addEventListener("DOMContentLoaded", function () {
  const feedbackForm = document.getElementById("feedbackForm");
  if (feedbackForm) {
    feedbackForm.addEventListener("submit", function (e) {
      e.preventDefault();

      const formData = new FormData(this);

      fetch("submit_feedback.php", {
        method: "POST",
        body: formData,
      })
        .then((response) => response.text())
        .then((data) => {
          document.getElementById("formMessage").textContent = data;
          this.reset();
        })
        .catch((error) => {
          document.getElementById("formMessage").textContent =
            "Terjadi kesalahan.";
          console.error(error);
        });
    });
  }
});
