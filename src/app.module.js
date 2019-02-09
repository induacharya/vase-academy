// for loading styles we need to load main scss file
import styles from './styles/styles.scss';

// loading shared module
import './services/core.module';
import './modules/index'
// loading all module components
import './app.components';

const appModule = angular
	.module('schoolApp', [
		// shared module
		'app.core',
		'app.admin',
		// 3rd party modules
		'ui.router',
		// application specific modules
		'app.root',
		'app.footer'
	])
	.constant('ENV',{name:"development",appUrl:"http://localhost/vase-academy/api/"});

export default appModule;
