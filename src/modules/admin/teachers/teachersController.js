import {
	$IsStateFilter
} from "angular-ui-router/lib/stateFilters";

export default class teachersController {

	constructor($scope, adminModuleServices,$state) {
		var vm = this;
		this.adminModuleServices = adminModuleServices;
		$scope.demoVariable = 'Teachers Page';
        this.$state = $state;

	}

	addTeacher(arg) {
		let param = {};
		param.Teachername = arg.name;
		param.emailid = arg.email;
        param.mobilenumber = arg.phoneno;
        param.password = arg.password;

        this.adminModuleServices.teachers(param).then((response) => {
			 if(response.status==true){
				this.$state.go('darshboard.home');
			 }
			 
		});
	}

}

teachersController.$inject = ['$scope', 'adminModuleServices','$state'];
