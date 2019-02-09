import {
	$IsStateFilter
} from "angular-ui-router/lib/stateFilters";

export default class loginController {

	constructor($scope, adminModuleServices,$state) {
		var vm = this;
		this.adminModuleServices = adminModuleServices;
		$scope.demoVariable = 'Login Page';
        this.$state = $state;

	}

	loginfun(arg) {
		let param = {};
		param.userName = arg.email;
		param.password = arg.password;

		this.adminModuleServices.login(param).then((response) => {
			 if(response.status==true){
				this.$state.go('darshboard.home');
			 }
			 
		});
	}

}

loginController.$inject = ['$scope', 'adminModuleServices','$state'];
