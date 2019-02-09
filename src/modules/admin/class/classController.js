import {
	$IsStateFilter
} from "angular-ui-router/lib/stateFilters";

export default class classController {

	constructor($scope, adminModuleServices,$state) {
		var vm = this;
		this.adminModuleServices = adminModuleServices;
		$scope.demoVariable = 'Class Page';
        this.$state = $state;

	}

	addclass(arg) {
		let param = {};
		param.cname = arg.cname;
		

		this.adminModuleServices.class(param).then((response) => {
		//	if(response.status==true){
				this.$state.go('darshboard.home');
			// }
			 
		});
	}

}

classController.$inject = ['$scope', 'adminModuleServices','$state'];
