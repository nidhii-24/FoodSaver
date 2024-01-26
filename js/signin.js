const signInForm = document.getElementById("sign-in-form");
const signUpForm = document.getElementById("sign-up-form");
const toggleFormsButton = document.getElementById("toggle-forms");

toggleFormsButton.addEventListener("click", () => {
    signInForm.classList.toggle("hidden");
    signUpForm.classList.toggle("hidden");
    toggleFormsButton.textContent = signInForm.classList.contains("hidden") ? "Sign Up" : "Sign In";
});
