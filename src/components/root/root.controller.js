export default class rootController {
	constructor($log) {
		'ngInject';
		this.$log = $log;
	}

	$onInit = () => {
		this.menuTitle = "School App";
		$(document).on("click", "#menu-toggle", function (e) {
			e.preventDefault();
			$("#wrapper").toggleClass("toggled");
		});
	};
}
