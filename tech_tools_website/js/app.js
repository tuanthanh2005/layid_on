// Bootstrap Application MVC Flow
document.addEventListener('DOMContentLoaded', () => {
    // Inject logic via Global app controller
    window.app = new AppController();

    // Browser navigation back/forward handling
    window.addEventListener('hashchange', () => {
        app.route(window.location.hash.substring(1) || '/');
    });
});
