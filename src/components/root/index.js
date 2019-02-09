import rootComponent from './root.component';

const rootModule = angular.module('app.root', []);

// loading components, services, directives, specific to this module.
rootModule.component('appRoot', rootComponent);

// export this module
export default rootModule;
