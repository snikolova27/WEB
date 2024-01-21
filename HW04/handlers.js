async function handleRegisterOnClick(event) {
  event.preventDefault();

  clearMessages();

  const username = document.getElementById("username").value;
  const name = document.getElementById("name").value;
  const familyName = document.getElementById("family-name").value;
  const email = document.getElementById("email").value;
  const password = document.getElementById("password").value;
  const street = document.getElementById("street").value;
  const city = document.getElementById("city").value;
  const postalCode = document.getElementById("postal-code").value;

  if (
    !validateFields(
      username,
      name,
      familyName,
      email,
      password,
      street,
      city,
      postalCode
    )
  ) {
    return;
  }

  const response = await fetch("https://jsonplaceholder.typicode.com/users");
  const users = await response.json();

  const existingUser = users.find((user) => user.username === username);

  if (existingUser) {
    displayError("Потребителското име вече е заето.");
  } else {
    const successDiv = document.getElementById("success");
    successDiv.className = "success";
    successDiv.textContent = "Регистрацията е успешна!";
  }
}
function clearMessages() {
  const errorDivs = document.querySelectorAll(".error");
  if (errorDivs) {
    errorDivs.forEach((errorDiv) => errorDiv.remove());
  }

  const successDiv = document.getElementById("success");
  successDiv.textContent = "";
}
function validateFields(
  username,
  name,
  familyName,
  email,
  password,
) {
  if (!username && !name && !familyName && !email && !password) {
    displayError("Моля попълнете всички задължителни полета");
    return false;
  }
  if (username.length < 3 || username.length > 10) {
    displayError("Потребителското име трябва да е между 3 и 10 символа.");
    return false;
  }

  return true;
}
function displayError(message) {
  const errorDiv = document.createElement("div");
  errorDiv.className = "error";
  errorDiv.textContent = message;

  document.getElementById("registrationForm").appendChild(errorDiv);
}
