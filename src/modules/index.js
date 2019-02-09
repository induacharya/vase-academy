/**
* @name APP exam
* @autor jaime.salazar@u-planner.com
*/
//declaration and definition main files project
import routing from './admin.route';

// declaration controllers and services file
import loginController from './admin/login/loginController';
import adminModuleServices from './admin/adminModuleServices';
import homeController from './admin/home/homeController';
import userController from './admin/user/userController';
import registerController from './admin/register/registerController';
import resetController from './admin/reset/resetController';
import subjectsController from './admin/subjects/subjectsController';
import classController from './admin/class/classController';
import teachersController from './admin/teachers/teachersController';

export default angular.module('app.admin', [adminModuleServices])
  .config(routing)
  .controller('loginController', loginController)
  .controller('homeController',homeController)
  .controller('userController',userController)
  .controller('registerController',registerController)
  .controller('resetController',resetController)
  .controller('subjectsController',subjectsController)
  .controller('classController',classController)
  .controller('teachersController',teachersController) 

