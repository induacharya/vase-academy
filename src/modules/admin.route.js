
//file for include routes 
routes.$inject = ['$stateProvider', '$urlRouterProvider', '$locationProvider'];

export default function routes($stateProvider, $urlRouterProvider, $locationProvider) {
      $locationProvider.html5Mode(true);
    //   $urlRouterProvider.otherwise('login');
  $stateProvider
     .state('login', {
            abstract: false,
            url: '/login',
            template: require('./admin/login/login.html'),
            controller: 'loginController',
            controllerAs:'login'           
        })
        .state('register', {
            abstract: false,
            url: '/register',
            template: require('./admin/register/register.html'),
            controller: 'registerController',
            controllerAs:'register'           
        })
        .state('darshboard', {
            url: '/darshboard',
            template: require('./admin/dashboard/dashboard.html'),          
        })
        .state('darshboard.home', {
            url: '/home',
            template: require('./admin/home/home.html'),
            controller: 'homeController',
            controllerAs:'home'          
        })      
        .state('darshboard.user', {
            url: '/user',
            template: require('./admin/user/user.html'),
            controller: 'userController',
            controllerAs:'user'          
        })  

        .state('reset', {
            abstract: false,
            url: '/reset',
            template: require('./admin/reset/reset.html'),
            controller: 'resetController',
            controllerAs:'reset'           
        })

        .state('subjects', {
            abstract: false,
            url: '/subjects',
            template: require('./admin/subjects/subjects.html'),
            controller: 'subjectsController',
            controllerAs:'subjects'           
        })

        .state('class', {
            abstract: false,
            url: '/class',
            template: require('./admin/class/class.html'),
            controller: 'classController',
            controllerAs:'class'           
        })


        .state('teachers', {
            abstract: false,
            url: '/class',
            template: require('./admin/teachers/teachers.html'),
            controller: 'teachersController',
            controllerAs:'teachers'           
        })

        
}
