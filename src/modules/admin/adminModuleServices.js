class adminModuleServices {

	constructor($http, ENV) {
		this.$http = $http;
		this.ENV = ENV;
	}
	get = () => {
		return this.$http.get(this.ENV.appUrl)
			.then((response) => {
				return response.data;
			});
	}

	login = (req) => {
		var url = this.ENV.appUrl + 'adminlogin';
		return this.$http.post(url, req)
			.then((response) => {
				return response.data;
			});
	}

	reset = (req) => {
		var url = this.ENV.appUrl + 'resetPassword';
		return this.$http.post(url, req)
			.then((response) => {
				return response.data;
				
			});
	}

	register = (req) => {
		var url = this.ENV.appUrl + 'addstudentprofile';
		return this.$http.post(url, req)
			.then((response) => {
				return response.data;
				
			});
	}


	subjects = (req) => {
		var url = this.ENV.appUrl + 'addSubject';
		return this.$http.post(url, req)
			.then((response) => {
				return response.data;
				
			});
	}

	getsubjects = () => {
		let url = this.ENV.appUrl + 'getSubjectList';
		return this.$http.get(url)
			.then((response) => {
				return response.data;
				
			});
	}

	class = (req) => {
		var url = this.ENV.appUrl + 'addClass';
		return this.$http.post(url, req)
			.then((response) => {
				return response.data;
				
			});
	}

	teachers = (req) => {
		var url = this.ENV.appUrl + 'addTeacherprofile';
		return this.$http.post(url, req)
			.then((response) => {
				return response.data;
				
			});
	}

	
}

adminModuleServices.$inject = ['$http', 'ENV']

export default angular.module('services.adminModuleServices', [])
	.service('adminModuleServices', adminModuleServices)
	.name;
