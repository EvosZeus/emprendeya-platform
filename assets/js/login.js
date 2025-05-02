document.addEventListener('DOMContentLoaded', function() {

    // Función para alternar visibilidad de contraseña
    function addPasswordToggleListener(buttonId, inputId) {
        const toggleButton = document.getElementById(buttonId);
        const passwordInput = document.getElementById(inputId);

        // Verificar que ambos elementos existen antes de añadir el listener
        if (toggleButton && passwordInput) {
            toggleButton.addEventListener('click', function () {
                const type = passwordInput.getAttribute('type') === 'password' ? 'text' : 'password';
                passwordInput.setAttribute('type', type);

                const icon = this.querySelector('i');
                if (type === 'password') {
                    // Cambia a ojo visible
                    icon.classList.remove('bi-eye-slash-fill');
                    icon.classList.add('bi-eye-fill');
                } else {
                    // Cambia a ojo tachado
                    icon.classList.remove('bi-eye-fill');
                    icon.classList.add('bi-eye-slash-fill');
                }
            });
        } else {
            // Opcional: Mostrar un aviso si no se encuentran los elementos
            // console.warn(`Elementos no encontrados para toggle: ${buttonId}, ${inputId}`);
        }
    }

    // Aplicar a los campos de contraseña del formulario de registro
    addPasswordToggleListener('togglePassword', 'password');
    addPasswordToggleListener('toggleConfirmPassword', 'confirmPassword');

    // Puedes añadir aquí otros scripts globales para tus páginas de autenticación

});