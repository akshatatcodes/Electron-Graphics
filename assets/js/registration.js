document.addEventListener("DOMContentLoaded", () => {
  const form = document.querySelector(".registration-form");

  // Array for fields (for dynamic rendering if needed later)
  const fields = [
    "full-name",
    "username",
    "age",
    "mobile-number",
    "email",
    "password",
    "confirm-password",
    
  ];

  // Basic client-side validation function
  form.addEventListener("submit", (event) => {
    const fullName = document.getElementById("full-name").value;
    const username = document.getElementById("username").value;
    const age = document.getElementById("age").value;
    const mobileNumber = document.getElementById("mobile-number").value;
    const email = document.getElementById("email").value;
    const password = document.getElementById("password").value;
    const confirmPassword = document.getElementById("confirm-password").value;
   

    // Basic validation
    if (password !== confirmPassword) {
      alert("Passwords do not match!");
      event.preventDefault();
      return;
    }

    if (fullName === "" || username === "" || email === "" || password === "" || age === "" || mobileNumber === "") {
      alert("Please fill out all fields!");
      event.preventDefault();
      return;
    }

    if (isNaN(age) || age <= 0) {
      alert("Please enter a valid age!");
      event.preventDefault();
      return;
    }
  });
});
