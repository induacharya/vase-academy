import {
	$IsStateFilter
} from "angular-ui-router/lib/stateFilters";

export default class registerController {

	constructor($scope, adminModuleServices,$state) {
		var vm = this;
		this.adminModuleServices = adminModuleServices;
		$scope.demoVariable = 'Register Page';
        this.$state = $state;

	}

	submitForm(arg) {
		let param = {};
		param.name = arg.name;
        param.uname = arg.username;
        param.upassword = arg.password;
        param.father_name = arg.fathername;
        param.emailid = arg.email;
        param.mobilenumber = arg.contactno;
        param.dob = arg.dob;
        param.gender = arg.gander;
        param.address = arg.Address;
        param.className = arg.classname;
        param.subjectName = arg.Subjectname;

		this.adminModuleServices.register(param).then((response) => {
			// if(response.status==true){
				this.$state.go('login');
			// }
			 
		});
	}

}

registerController.$inject = ['$scope', 'adminModuleServices','$state'];
