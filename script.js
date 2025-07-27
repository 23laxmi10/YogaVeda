document.addEventListener('DOMContentLoaded', () => {
  const loginForm = document.getElementById('loginForm');
  const registerForm = document.getElementById('registerForm');
  const toggleButton = document.getElementById('toggleForm');
  const formTitle = document.getElementById('formTitle');
  const loginAlert = document.getElementById('loginAlert');
  const registerAlert = document.getElementById('registerAlert');
  const signInButton = document.getElementById("signInButton");

  let isLoginForm = true;

  // Toggle between login and register forms
  if (toggleButton) {
      toggleButton.addEventListener('click', () => {
          isLoginForm = !isLoginForm;
          loginForm.classList.toggle('hidden');
          registerForm.classList.toggle('hidden');
          formTitle.textContent = isLoginForm ? 'Welcome Back' : 'Create Account';
          toggleButton.textContent = isLoginForm ? "Don't have an account? Register" : 'Already have an account? Login';
          clearAlerts();
      });
  }

  // Login form submission
  if (loginForm) {
      loginForm.addEventListener('submit', (e) => {
          e.preventDefault();
          const email = loginForm.querySelector('input[type="email"]').value;
          const password = loginForm.querySelector('input[type="password"]').value;

          // Validation
          if (!email || !password) {
              showAlert(loginAlert, 'error', 'Please fill in all fields');
              return;
          }

          if (!isValidEmail(email)) {
              showAlert(loginAlert, 'error', 'Please enter a valid email address');
              return;
          }

          if (password.length < 6) {
              showAlert(loginAlert, 'error', 'Password must be at least 6 characters long');
              return;
          }

          // If validation passes
          showAlert(loginAlert, 'success', 'Login successful!');
          loginForm.reset();
      });
  }

  // Redirect to index.html on successful login
  if (signInButton) {
      signInButton.addEventListener("click", function() {
          // Assuming the login is successful (you can integrate an actual login check here)
          window.location.href = "index.html";
      });
  }

  // Helper functions
  function showAlert(alertElement, type, message) {
      alertElement.classList.remove('hidden');
      alertElement.textContent = message;
      alertElement.classList.add(type === 'error' ? 'alert-danger' : 'alert-success');
  }

  function clearAlerts() {
      if (loginAlert) loginAlert.classList.add('hidden');
      if (registerAlert) registerAlert.classList.add('hidden');
  }

  function isValidEmail(email) {
      const regex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
      return regex.test(email);
  }
});

    // Register form submission
    registerForm.addEventListener('submit', (e) => {
        e.preventDefault();
        const name = registerForm.querySelector('input[type="text"]').value;
        const email = registerForm.querySelector('input[type="email"]').value;
        const password = registerForm.querySelectorAll('input[type="password"]')[0].value;
        const confirmPassword = registerForm.querySelectorAll('input[type="password"]')[1].value;

        // Validation
        if (!name || !email || !password || !confirmPassword) {
            showAlert(registerAlert, 'error', 'Please fill in all fields');
            return;
        }

        if (!isValidEmail(email)) {
            showAlert(registerAlert, 'error', 'Please enter a valid email address');
            return;
        }

        if (password.length < 6) {
            showAlert(registerAlert, 'error', 'Password must be at least 6 characters long');
            return;
        }

        if (password !== confirmPassword) {
            showAlert(registerAlert, 'error', 'Passwords do not match');
            return;
        }

        // If validation passes
        showAlert(registerAlert, 'success', 'Registration successful!');
        registerForm.reset();
    });

    // Helper functions
    function isValidEmail(email) {
        return email.includes('@') && email.includes('.');
    }

    function showAlert(alertElement, type, message) {
        alertElement.className = `alert ${type}`;
        alertElement.innerHTML = `
            ${type === 'error' 
                ? '<svg xmlns="http://www.w3.org/2000/svg" class="icon" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><circle cx="12" cy="12" r="10"/><line x1="12" x2="12" y1="8" y2="12"/><line x1="12" x2="12.01" y1="16" y2="16"/></svg>'
                : '<svg xmlns="http://www.w3.org/2000/svg" class="icon" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M22 11.08V12a10 10 0 1 1-5.93-9.14"/><polyline points="22 4 12 14.01 9 11.01"/></svg>'
            }
            ${message}
        `;
    }

    function clearAlerts() {
        loginAlert.className = 'alert hidden';
        registerAlert.className = 'alert hidden';
    }



