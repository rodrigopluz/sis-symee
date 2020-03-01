<?php

defined('BASEPATH') or exit('No direct script access allowed');

/**
 * -------------------------------------------------------------------------
 * URI ROUTING
 * -------------------------------------------------------------------------
 * This file lets you re-map URI requests to specific controller functions.
 *
 * Typically there is a one-to-one relationship between a URL string
 * and its corresponding controller class/method. The segments in a
 * URL normally follow this pattern:
 *
 *	example.com/class/method/id/
 *
 * In some instances, however, you may want to remap this relationship
 * so that a different class/function is called than the one
 * corresponding to the URL.
 *
 * Please see the user guide for complete details:
 *
 *	http://codeigniter.com/user_guide/general/routing.html
 *
 * -------------------------------------------------------------------------
 * RESERVED ROUTES
 * -------------------------------------------------------------------------
 *
 * There are three reserved routes:
 *
 *	$route['default_controller'] = 'welcome';
 *
 * This route indicates which controller class should be loaded if the
 * URI contains no data. In the above example, the "welcome" class
 * would be loaded.
 *
 *	$route['404_override'] = 'errors/page_missing';
 *
 * This route will tell the Router which controller/method to use if those
 * provided in the URL cannot be matched to a valid route.
 *
 *	$route['translate_uri_dashes'] = FALSE;
 *
 * This is not exactly a route, but allows you to automatically route
 * controller and method names that contain dashes. '-' isn't a valid
 * class or method name character, so it requires translation.
 * When you set this option to TRUE, it will replace ALL dashes in the
 * controller and method URI segments.
 *
 * Examples: my-controller/index	 -> my_controller/index
 *		     my-controller/my-method -> my_controller/my_method
 */
$route['404_override'] = '';
$route['translate_uri_dashes'] = FALSE;
$route['default_controller']   = 'Login/index';

$route['login/leitor-qrcode']  = 'Login/hit_point';
$route['login/ajax-login']     = 'Login/ajax_login';
$route['login/esqueci-senha']  = 'Login/forgot_password';

/**
 * -------------------------------------------------------------------------
 * ROUTES SYSTEM WEB AFTER ACCESS
 * -------------------------------------------------------------------------
 */
$route['admin/dashboard']                            = 'Dashboard/dashboard';
$route['admin/conta']                                = 'ManageProfile/manage_profile';
$route['admin/gerenciar-lingua']                     = 'ManageLanguage/manage_language';
$route['admin/configuracoes-gerais']                 = 'SystemSettings/system_settings';
$route['admin/gerenciar-lingua/edita-idioma/(:any)'] = 'ManageLanguage/manage_language/edit_phrase/$1';

//* user-company
$route['admin/usuario-empresa']                      = 'UserCompanys/index';
$route['admin/usuario-empresa/novo']                 = 'UserCompanys/create';
$route['admin/usuario-empresa/edita/(:any)']         = 'UserCompanys/edit/$1';
$route['admin/usuario-empresa/delete/(:any)']        = 'UserCompanys/delete/$1';

//* user-employee
$route['admin/usuario-empregado']                    = 'Employees/index';
$route['admin/usuario-empregado/novo']               = 'Employees/create';
$route['admin/usuario-empregado/edita/(:any)']       = 'Employees/edit/$1';
$route['admin/usuario-empregado/delete/(:any)']      = 'Employees/delete/$1';

//* profile
$route['admin/perfis']                               = 'Profiles/index';
$route['admin/perfis/edita/(:any)']                  = 'Profiles/edit/$1';

//* company
$route['admin/empresas']                             = 'Companys/index';
$route['admin/empresas/novo']                        = 'Companys/create';
$route['admin/empresas/edita/(:any)']                = 'Companys/edit/$1';
$route['admin/empresas/delete/(:any)']               = 'Companys/delete/$1';

//* entail
$route['admin/vinculos']                             = 'Contracts/index';
$route['admin/vinculos/novo']                        = 'Contracts/create';
$route['admin/vinculos/edita/(:any)']                = 'Contracts/edit/$1';
$route['admin/vinculos/delete/(:any)']               = 'Contracts/delete/$1';
$route['admin/vinculos/contrato-pdf/(:any)']         = 'Contracts/contract_pdf/$1';

//* city
$route['admin/cidades']                              = 'Citys/index';
$route['admin/cidades/novo']                         = 'Citys/create';
$route['admin/cidades/edita/(:any)']                 = 'Citys/edit/$1';
$route['admin/cidades/delete/(:any)']                = 'Citys/delete/$1';

//* function_role
$route['admin/funcoes']                              = 'FunctionRoles/index';
$route['admin/funcoes/novo']                         = 'FunctionRoles/create';
$route['admin/funcoes/edita/(:any)']                 = 'FunctionRoles/edit/$1';
$route['admin/funcoes/delete/(:any)']                = 'FunctionRoles/delete/$1';

//* category_function
$route['admin/categoria-funcoes']                    = 'FunctionCategorys/index';
$route['admin/categoria-funcoes/novo']               = 'FunctionCategorys/create';
$route['admin/categoria-funcoes/edita/(:any)']       = 'FunctionCategorys/edit/$1';
$route['admin/categoria-funcoes/delete/(:any)']      = 'FunctionCategorys/delete/$1';

//* modal
$route['admin/modal/upload-file/(:any)']             = 'Modal/upload_file';
$route['admin/modal/delete/(:any)']                  = 'Modal/delete/$1';

//* routes - scripts for ajax
$route['admin/vinculos/ajax-listener']               = 'Ajax/ajax_listener';
$route['admin/empresas/ajax-search']                 = 'Ajax/ajax_search';
$route['admin/empresas/ajax-active']                 = 'Ajax/ajax_active';
$route['admin/empresas/ajax-add-activity']           = 'Ajax/ajax_add_activity';
$route['admin/vinculos/ajax-vinculo']                = 'Ajax/ajax_entail';
$route['admin/vinculos/ajax-cancela']                = 'Ajax/ajax_cancel';
$route['admin/vinculos/ajax-close']                  = 'Ajax/ajax_close';
$route['admin/vinculos/ajax-refresh']                = 'Ajax/ajax_refresh';
$route['admin/vinculos/ajax-search-function']        = 'Ajax/ajax_search_function';
$route['admin/vinculos/ajax-call-notification']      = 'Ajax/ajax_call_notification';
$route['admin/mac-address/ajax-mac-address']         = 'Ajax/ajax_mac_address';
$route['admin/usuario-empresa/ajax-email']           = 'Ajax/ajax_email';
$route['admin/usuario-empresa/ajax-login']           = 'Ajax/ajax_login_cpf';
$route['admin/locais-trabalho/ajax-empresa']         = 'Ajax/ajax_company';
$route['admin/jornada-trabalho/ajax-jornada']        = 'Ajax/ajax_work_day';

//* plans
$route['admin/planos']                               = 'Plans/index';
$route['admin/planos/novo']                          = 'Plans/create';
$route['admin/planos/edita/(:any)']                  = 'Plans/edit/$1';
$route['admin/planos/delete/(:any)']                 = 'Plans/delete/$1';

//* work-places
$route['admin/locais-trabalho']                      = 'WorkPlaces/index';
$route['admin/locais-trabalho/novo']                 = 'WorkPlaces/create';
$route['admin/locais-trabalho/edita/(:any)']         = 'WorkPlaces/edit/$1';
$route['admin/locais-trabalho/delete/(:any)']        = 'WorkPlaces/delete/$1';

//* work-days
$route['admin/jornada-trabalho']                     = 'WorkDays/index';
$route['admin/jornada-trabalho/novo']                = 'WorkDays/create';
$route['admin/jornada-trabalho/edita/(:any)']        = 'WorkDays/edit/$1';
$route['admin/jornada-trabalho/delete/(:any)']       = 'WorkDays/delete/$1';

/**
 * -------------------------------------------------------------------------
 * ROUTES API RESTFUL
 * -------------------------------------------------------------------------
 */
$route['api/login']                                  = 'api/Auth/login';
$route['api/empresas']                               = 'api/Companys';
$route['api/usuario-empresa']                        = 'api/UserCompanys';
$route['api/usuario-empresa/(:num)']                 = 'api/UserCompanys/$1';
$route['api/empregado']                              = 'api/EmployeeCtrl';
$route['api/empregado/(:num)']                       = 'api/EmployeeCtrl/$1';
$route['api/estados']                                = 'api/State';
$route['api/estados/(:any)']                         = 'api/State/search/$1';
$route['api/cidades']                                = 'api/Citys';
$route['api/cidades/(:any)']                         = 'api/Citys/byuf/$1';
$route['api/bairros/(:any)']                         = 'api/Neighborhoods/bycity/$1';
$route['api/logradouros/(:any)']                     = 'api/Place/byneigborhoods/$1';
$route['api/device']                                 = 'api/DeviceCtrl';
$route['api/device/(:any)']                          = 'api/DeviceCtrl/$1';
$route['api/empregado/reset_password']               = 'api/EmployeeCtrl/reset_password';
$route['api/vinculo/(:any)']                         = 'api/ContractCtrl/$1';
$route['api/vinculo/byEmployeeId/(:any)']            = 'api/ContractCtrl/byEmployeeId/$1';
