//Impotando arquivo bootstrap
import './bootstrap';

//Apresentar e ocultar a senha e substituir o ícone
window.togglePassword = function(fieldId, toggleIcon){
    const field = document.getElementById(fieldId);
    const icon = toggleIcon.querySelector('i');

    if (field.type === "password") {
        field.type = "text";
        icon.classList.remove('bi-eye');
        icon.classList.add('bi-eye-slash');
    } else {
        field.type = "password";
        icon.classList.remove('bi-eye-slash');
        icon.classList.add('bi-eye');
    }
}
