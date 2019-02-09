import footerComponent from './footer.component';

const footerModule = angular.module('app.footer', []);

// loading components, services, directives, specific to this module.
footerModule.component('appFooter', footerComponent);

// export this module
export default footerModule;
