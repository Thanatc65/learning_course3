// Authentication Pages JavaScript
document.addEventListener('DOMContentLoaded', function() {
    // Password Toggle Functionality
    const passwordToggleBtns = document.querySelectorAll('.password-toggle');

    passwordToggleBtns.forEach(btn => {
        btn.addEventListener('click', function() {
            const passwordInput = this.previousElementSibling;
            const icon = this.querySelector('i');

            // Toggle password visibility
            if (passwordInput.type === 'password') {
                passwordInput.type = 'text';
                icon.classList.remove('fa-eye');
                icon.classList.add('fa-eye-slash');
            } else {
                passwordInput.type = 'password';
                icon.classList.remove('fa-eye-slash');
                icon.classList.add('fa-eye');
            }
        });
    });

    // Password Validation (for register page)
    const passwordInput = document.querySelector('input[type="password"]');
    const passwordRequirements = document.querySelector('.password-requirements');

    if (passwordInput && passwordRequirements) {
        passwordInput.addEventListener('input', function() {
            // Check password length
            if (this.value.length < 8) {
                passwordRequirements.innerHTML = '<p style="color: #D32F2F;">Password must be at least 8 characters</p>';
            } else {
                passwordRequirements.innerHTML = '<p style="color: #388E3C;">Password meets minimum requirements</p>';
            }
        });
    }

    // Confirm Password Validation (for register page)
    const confirmPasswordInput = document.querySelectorAll('input[type="password"]')[1];

    if (passwordInput && confirmPasswordInput) {
        confirmPasswordInput.addEventListener('input', function() {
            if (this.value && this.value !== passwordInput.value) {
                this.style.borderColor = '#D32F2F';

                // Add error message if it doesn't exist
                let errorMsg = this.parentElement.nextElementSibling;
                if (!errorMsg || !errorMsg.classList.contains('password-mismatch')) {
                    errorMsg = document.createElement('div');
                    errorMsg.className = 'password-mismatch';
                    errorMsg.innerHTML = '<p style="color: #D32F2F; font-size: 12px; margin-top: 5px;">Passwords do not match</p>';
                    this.parentElement.after(errorMsg);
                }
            } else if (this.value && this.value === passwordInput.value) {
                this.style.borderColor = '#388E3C';

                // Remove error message if it exists
                const errorMsg = this.parentElement.nextElementSibling;
                if (errorMsg && errorMsg.classList.contains('password-mismatch')) {
                    errorMsg.remove();
                }

                // Add success message
                let successMsg = this.parentElement.nextElementSibling;
                if (!successMsg || !successMsg.classList.contains('password-match')) {
                    successMsg = document.createElement('div');
                    successMsg.className = 'password-match';
                    successMsg.innerHTML = '<p style="color: #388E3C; font-size: 12px; margin-top: 5px;">Passwords match</p>';
                    this.parentElement.after(successMsg);
                }
            } else {
                this.style.borderColor = '';

                // Remove any validation messages
                const errorMsg = this.parentElement.nextElementSibling;
                if (errorMsg && (errorMsg.classList.contains('password-mismatch') || errorMsg.classList.contains('password-match'))) {
                    errorMsg.remove();
                }
            }
        });
    }

    // Form Submission
    const authForm = document.querySelector('.auth-form');

    if (authForm) {
        authForm.addEventListener('submit', function(e) {
            e.preventDefault();

            // Get form inputs
            const inputs = this.querySelectorAll('input');
            let isValid = true;

            // Basic validation
            inputs.forEach(input => {
                if (input.required && !input.value.trim()) {
                    isValid = false;
                    input.style.borderColor = '#D32F2F';
                } else {
                    input.style.borderColor = '';
                }
            });

            // Check if the form is on the registration page (has confirm password)
            if (confirmPasswordInput && passwordInput.value !== confirmPasswordInput.value) {
                isValid = false;
                confirmPasswordInput.style.borderColor = '#D32F2F';
            }

            // If form is valid, simulate submission
            if (isValid) {
                // Show loading state
                const submitBtn = this.querySelector('[type="submit"]');
                const originalText = submitBtn.textContent;
                submitBtn.disabled = true;
                submitBtn.textContent = 'Processing...';

                // Simulate API call
                setTimeout(() => {
                    // Determine if this is login or register form
                    const isLoginForm = !confirmPasswordInput;

                    // Create success message
                    const successMsg = document.createElement('div');
                    successMsg.className = 'auth-message success';

                    if (isLoginForm) {
                        successMsg.textContent = 'Login successful! Redirecting to dashboard...';
                    } else {
                        successMsg.textContent = 'Account created successfully! Redirecting to login...';
                    }

                    // Insert message before form
                    this.before(successMsg);

                    // Reset button
                    submitBtn.textContent = originalText;

                    // Simulate redirect
                    setTimeout(() => {
                        if (isLoginForm) {
                            window.location.href = 'index.html'; // Redirect to home page (dashboard in real app)
                        } else {
                            window.location.href = 'login.html'; // Redirect to login after registration
                        }
                    }, 2000);

                }, 1500);
            } else {
                // Show general error message if it doesn't exist
                let errorMsg = document.querySelector('.auth-message.error');
                if (!errorMsg) {
                    errorMsg = document.createElement('div');
                    errorMsg.className = 'auth-message error';
                    errorMsg.textContent = 'Please fill in all required fields correctly.';
                    this.before(errorMsg);
                }
            }
        });
    }

    // Social Login Buttons
    const socialBtns = document.querySelectorAll('.social-btn');

    socialBtns.forEach(btn => {
        btn.addEventListener('click', function() {
            // Show loading state
            const originalText = this.innerHTML;
            this.innerHTML = '<i class="fas fa-spinner fa-spin"></i> Connecting...';
            this.disabled = true;

            // Simulate social login process
            setTimeout(() => {
                // Create success message
                const successMsg = document.createElement('div');
                successMsg.className = 'auth-message success';
                successMsg.textContent = 'Social login successful! Redirecting to dashboard...';

                // Insert message at the top of the auth card
                const authCard = document.querySelector('.auth-card');
                authCard.insertBefore(successMsg, authCard.firstChild);

                // Reset button
                this.innerHTML = originalText;
                this.disabled = false;

                // Simulate redirect
                setTimeout(() => {
                    window.location.href = 'index.html'; // Redirect to home page (dashboard in real app)
                }, 2000);
            }, 2000);
        });
    });
});
