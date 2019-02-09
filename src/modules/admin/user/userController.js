export default class userController {

	constructor($scope, adminModuleServices) {
		var vm = this;
		this.adminModuleServices = adminModuleServices;
		this.today = new Date();
		this.adminModuleServices.get().then((users) => {
			this.users = users;
		});
	}
}

userController.$inject = ['$scope', 'adminModuleServices'];
