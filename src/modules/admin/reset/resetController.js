import {
	$IsStateFilter
} from "angular-ui-router/lib/stateFilters";

export default class resetController {

	constructor($scope, adminModuleServices,$state) {
		var vm = this;
		this.adminModuleServices = adminModuleServices;
		$scope.demoVariable = 'Reset Page';
        this.$state = $state;

	}
    changePasswd(arg) {
		let param = {};
		param.username = arg.email;
        param.currentpassword = arg.currpassword;
        param.newpassword = arg.newpassword;
        

		this.adminModuleServices.reset(param).then((response) => {
			//  if(response.status){
				

  				alert("Password updated successfully!!");

				this.$state.go('darshboard.home');
			//  }
			 
		});
	}

}

resetController.$inject = ['$scope', 'adminModuleServices','$state'];
