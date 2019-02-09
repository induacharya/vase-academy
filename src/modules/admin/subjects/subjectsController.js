import {
	$IsStateFilter
} from "angular-ui-router/lib/stateFilters";

export default class subjectsController {

	constructor($scope, adminModuleServices,$state) {
		var vm = this;
		this.adminModuleServices = adminModuleServices;
		$scope.demoVariable = 'Subjects Page';
		this.$state = $state;
		
		this.getSubList();

	}

	addsub(arg) {
		let param = {};
		param.sname = arg.subName;

		this.adminModuleServices.subjects(param).then((response) => {
			 if(response.status==true){
				this.$state.go('subjects');
			 }
			 
		});
	}

	getSubList() {
		
		
		//let value = "";
		this.adminModuleServices.getsubjects().then((response) => {
			 if(response.status==true){
				$scope.values = response.data;
			}
			 
		});
	}


}

subjectsController.$inject = ['$scope', 'adminModuleServices','$state'];
