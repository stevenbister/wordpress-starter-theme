import Alpine from 'alpinejs';

window.Alpine = Alpine;

/**
 * If you imported Alpine into a bundle, you have to make sure you are registering any extension code IN BETWEEN when you import the Alpine global object, and when you initialize Alpine by calling Alpine.start().
 * Essentially define any Alpine related code here.
 * e.g. Alpine.data("dropdown", dropdown);
 */


Alpine.start();
