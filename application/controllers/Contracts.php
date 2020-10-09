<?php

defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * Contracts Controller
 *
 *  @author       : Rodrigo Pereira da Luz
 *  e-mail        : rodrigopluz@gmail.com
 *  item          : Sistema Web - Symee
 *  specification : Class Contracts
 */
class Contracts extends CI_Controller
{
    /**
     * @param NotificationHistory
     */
    public function __construct()
    {
        parent::__construct();
        $this->load->helper('dump');
        
        $this->load->model('Company');
        $this->load->model('Contract');
        $this->load->model('Employee');
        $this->load->model('UserCompany');
        $this->load->model('FunctionRole');
        $this->load->model('FunctionCategory');
        $this->load->model('NotificationHistory');
        $this->load->model('CompanyFunctionCategory');
        
        $this->load->library('Pdf');
        $this->load->library('session');
        $this->load->library('PushNotification');
        
        /*cache control*/
		$this->output->set_header('Cache-Control: no-store, no-cache, must-revalidate, post-check=0, pre-check=0');
		$this->output->set_header('Pragma: no-cache');
    }

    /**
     * Index a listing of contract.
     *
     * @return void
     */
    public function index()
    {
        if ($this->session->userdata('admin_login') != 1)
            redirect(base_url() . 'login', 'refresh');
        
        $page_data['contracts'] = $this->Contract->get_all_contract();

        $page_data['count_contracts'] = $this->Contract->get_count_contract();

        $page_data['page_menu']  = 'contract';
        $page_data['page_name']  = 'contract/index';
        $page_data['page_title'] = get_phrase('entails');

        $this->load->view('backend/index', $page_data);
    }

    /**
     * Create the form for creating a new contract.
     *
     * @return void
     */
    public function create()
    {
        //* list function-category
        if ($this->session->userdata('profile_id') == 1) {
            $page_data['fcategory'] = $this->FunctionCategory->get_all_function_category();
        } else {
            $page_data['fcategory'] = $this->CompanyFunctionCategory->get_company_function_category($this->session->userdata('company_id'));            
        }
        
        $page_data['page_name']  = 'contract/create';
        $page_data['page_title'] = get_phrase('entails');

        $this->load->view('backend/index', $page_data);   
    }

    /**
     * Edit the form for editing the specified contract.
     * 
     * @param  int $id
     * @return void
     */
    public function edit($id)
    {
        if (!isset($id)) {
            show_404();
        }

        $page_data['contract'] = $this->Contract->get_contract($id);

        /*- company -*/
        $id_company = $page_data['contract']['id_company'];
        $page_data['company'] = $this->Company->get_company($id_company);

        /*- employee -*/
        $id_employee = $page_data['contract']['id_employee'];
        $page_data['employee'] = $this->Employee->get_employee($id_employee);

        /*- function_role -*/
        $id_function = $page_data['contract']['id_function_category'];
        $page_data['fcategory'] = $this->FunctionRole->get_all_function_role();
        $page_data['froles'] = $this->FunctionRole->get_category_function_role($id_function);

        if (isset($page_data['contract']['id'])) {
            if (isset($_POST) && count($_POST) > 0) {   
                $params = [
                    'id_function' => $this->input->post('role'),
                    'id_user_company' => $this->session->userdata('login_user_id'),
                    'time_hour' => $this->input->post('time_hour'),
                    'start_date' => format_date($this->input->post('start_date')),
                    'last_changed_date' => date('Y-m-d H:i:s'),
                ];

                $this->Contract->update_contract($id,$params);

                $type = 'NV';
                $delivered = '1';

                $this->push_notification_history(
                    $page_data['contract']['id_device'],
                    $id,
                    $page_data['contract']['cpf_cnpj'],
                    $page_data['contract']['business_name'],
                    $page_data['contract']['function_name'],
                    $page_data['contract']['start_date'],
                    $page_data['contract']['end_date'],
                    $delivered,
                    $type,
                    $page_data['contract']['token']
                );

                $this->session->set_flashdata('flash_message', get_phrase('contract_updated'));
                redirect(base_url() . 'admin/vinculos', 'refresh');
            } else {
                $page_data['page_name']  = 'contract/edit';
                $page_data['page_title'] = get_phrase('contract');
            }
        } else {
            show_error('The contract you are trying to edit does not exist.');
        }

        $this->load->view('backend/index', $page_data);
    }

    /**
     * Deletes the specified contract from storage.
     * 
     * @param  int $id
     * @return void
     */
    public function delete($id)
    {
        if (!isset($id)) {
            show_404();
        }

        $contract = $this->Contract->delete_contract($id);

        // check if the contract exists before trying to delete it
        if (isset($contract['id'])) {
            $this->Contract->delete_contract($id);
            redirect('contract/index');
        } else {
            show_error('The contract you are trying to delete does not exist.');
        }
    }

    /**
     * push-notification-history
     *
     * @return void
     */
    public function push_notification_history($device, $id_contract, $document, $company, $frole_name, $data_start, $data_end, $delivered, $type, $token)
    {
        $date = date('Y-m-d H:i:s');
        
        //* save notification-history
        $not_history = [
            'id_device' => $device,
            'id_contract' => $id_contract,
            'date_time_notification' => $date,
            'delivered' => $delivered,
            'response' => 'documento: '. $document .', empresa: '. $company .', funcao: '. $frole_name
        ];

        $id_notification = $this->NotificationHistory->add_notification_history($not_history);

        //* send push-notification
        $push = [
            'person_name' => $company,
            'function_name' => $frole_name,
            'data_start' => $data_start,
            'data_end' => $data_end,
            'id_contract' => $id_contract,
            'id_notification' => $id_notification
        ];
        
        PushNotification::android($not = $type, $push, $token);
    }

    /**
     * contract-pdf
     */
    public function contract_pdf($id)
    {
        if ($id) {
            $contract = $this->Contract->get_contract($id);
            $company  = $this->Company->get_company($contract['id_company']);
            $employee = $this->Employee->get_employee($contract['id_employee']);

            $html_content = '
                <p class="western" align="center" style="margin-bottom: 0cm; line-height: 100%">
                    <a name="_GoBack"></a>
                    <font size="3" style="font-size: 12pt"><u><b>CONTRATO DE TRABALHO INTERMITENTE</b></u></font>
                </p>
                <br/>
                <p class="western" align="justify" style="margin-bottom: 0cm; line-height: 100%">
                    <font size="3" style="font-size: 12pt">
                        <b>CONTRATANTE: RAZÃO SOCIAL</b>, Pessoa Jurídica de Direito privado, inscrita no CNPJ: '. addformat_cnpj($company['cnpj']) .', 
                        estabelecida '. $company['place_name'] .', nº '. $company['number'] .', Bairro '. $company['neighborhood_name'] .',
                        '. $company['city'] .'/'. $company['sigla'] .', CEP: '. addformat_zipcode($company['zipcode']) .', neste ato representada pelo Sócio administrador Sr(a). '. $contract['pu_name'] .'.
                        <br/><br/>
                        <b>CONTRATADO</b>: '. $contract['pe_name'] .', inscrito no CPF: '. addformat_cpf($contract['cpf_cnpj']) .', qualificação '. $contract['function_name'] .',
                        endereço '. $employee['place_name'] .' - '. $employee['city_name'] .'/'. $employee['sigla'] .', telefone '. addformat_phone($employee['phone']) .'
                    </font>
                </p>
                <p class="western" align="justify" style="margin-bottom: 0cm; line-height: 100%">
                    <font size="3" style="font-size: 12pt">
                        O presente contrato de trabalho intermitente é celebrado com fundamento no Art. 443 e Art. 452-A da CLT, podendo ser executado de forma descontínua, com
                        alternância de períodos de prestação de serviços e de inatividade determinados em horas, dias ou meses sob as seguintes condições especiais, além das regras previstas na CLT:
                    </font>
                </p>
                <ol type="a">
                    <li>
                        <p align="justify" style="margin-bottom: 0cm; line-height: 100%">
                            <font size="3" style="font-size: 12pt">
                                <u>Local de trabalho</u> – No momento da convocação para prestação de serviço, o contratante poderá direcionar o contratado para prestar serviços em locais determinados, 
                                submetendo-se aos padrões exigidos, normas, locais e horários padronizados ou especiais.
                            </font>
                        </p>
                    </li>
                </ol>
                <ol type="a" start="2">
                    <li>
                        <p align="justify" style="margin-bottom: 0cm; line-height: 100%">
                            <font size="3" style="font-size: 12pt">
                                <u>Horários</u> – A jornada mínima será de 2 (duas) horas diárias, em quaisquer dias da semana, respeitado os limites de 8 horas diárias, 44 semanais, 
                                com repouso remunerado pago a cada período trabalhado na fração de 1/6 ou 16,67% da remuneração percebida, independentemente de completar a semana, 
                                sempre garantidos os intervalos Interjornadas, intrajornadas e o intervalo intersemanal de 35 horas.
                            </font>
                        </p>
                    </li>
                </ol>
                <ol type="a" start="3">
                    <li>
                        <p align="justify" style="margin-bottom: 0cm; line-height: 100%">
                            <font size="3" style="font-size: 12pt">
                                <u>Função</u> – A função será de <u>'. $contract['function_name'] .'</u>, cujas tarefas e responsabilidades serão designadas e coordenadas pelos superiores
                                hierárquicos. Independentemente de anotação específica, nos termos do parágrafo único do art. 456 da CLT, o empregado se
                                obriga as tarefas previstas na CBO e a todo e qualquer serviço de acordo com a necessidade da empresa, que sejam compatíveis com sua
                                condição pessoal, seus conhecimentos e habilidades, assim como poderá realizar tarefas mais complexas em processo de aprendizagem.
                            </font>
                        </p>
                    </li>
                </ol>
                <ol type="a" start="4">
                    <li>
                        <p align="justify" style="margin-bottom: 0cm; line-height: 100%">
                            <font size="3" style="font-size: 12pt">
                                <u>Remuneração</u> – A remuneração será de R$ '. $contract['time_hour'] .' por hora trabalhada. O pagamento será realizado ao final de cada
                                período de chamada e compreenderá as horas efetivamente trabalhadas, o repouso semanal remunerado no percentual de 16,67%,
                                as férias no percentual de 8,33%, o terço das férias no percentual de 2,78%, o décimo terceiro salário no percentual de
                                8,33%. Do valor bruto será retida a quota do empregado do INSS e outros débitos ou pagamentos legais ou autorizados.
                                O pagamento das verbas acima é devido independentemente de não completar 15 dias de trabalho em cada mês.
                            </font>
                        </p>
                    </li>
                </ol>
                <ol type="a" start="5">
                    <li>
                        <p align="justify" style="margin-bottom: 0cm; line-height: 100%">
                            <font size="3" style="font-size: 12pt">
                                <u>Das chamadas</u> – As chamadas serão realizadas pela empresa, conforme a necessidade de trabalho, podendo o trabalhador aceitar ou não,
                                presumindo-se o silêncio após 24 horas como NÃO ACEITAÇÃO. As partes elegem como instrumentos eficazes para a realização de
                                chamadas o sistema “<i><b>SYMEE</b></i>”, que será considerado válido e eficaz pela continuidade do uso. Os
                                prazos e penalidades respeitarão o disposto na lei. Os pagamentos periódicos serão realizados após o período de cada chamada, e os
                                valores serão apresentados meio de recibo simples com discriminação das verbas pagas. A folha de pagamento para fins de recolhimentos
                                previdenciários e fiscais será gerada ao final de cada mês.
                            </font>
                        </p>
                    </li>
                </ol>
                <ol type="a" start="6">
                    <li>
                        <p align="justify" style="margin-bottom: 0cm; line-height: 100%">
                            <font size="3" style="font-size: 12pt">
                                De acordo o parágrafo 8º da Art. 452-A da CLT o contratante efetuará o recolhimento da contribuição previdenciária e o depósito do Fundo de Garantia do
                                Tempo de Serviço proporcional aos valores pagos que tenham incidência e fornecerá ao empregado, via aplicativo “<i><b>SYMEE</b></i>”,
                                ou com cópia entregue mediante recibo, o comprovante do cumprimento dessas obrigações no prazo de 10 (dez) dias após o recolhimento.
                            </font>
                        </p>
                    </li>
                </ol>
                <ol type="a" start="7">
                    <li>
                        <p align="justify" style="margin-bottom: 0cm; line-height: 100%">
                            <font size="3" style="font-size: 12pt">
                                O presente Contrato, terá a vigência de ........ dias, sendo celebrado para as partes verificarem reciprocamente, a conveniência
                                ou não de se vincularem em caráter definitivo a um Contrato de Trabalho. Fica ressalvada a possibilidade de prorrogação deste
                                contrato de experiência, por uma vez, respeitado o prazo de 90 dias, nos termos do Art. 445 parágrafo único e art. 451, ambos da
                                CLT. Findando o prazo estabelecido nesta cláusula, o presente terá vigência por prazo indeterminado, permanecendo vigentes as
                                cláusulas acima.
                            </font>
                        </p>
                    </li>
                </ol>
                <br/><br/>
                <p class="western" align="center" style="margin-bottom: 0cm; line-height: 100%">
                    <font size="3" style="font-size: 12pt">'. $company['city'] .'/'. $company['sigla'] .', '. date('d') .' de '. date_mes_ptbr() .' de '. date('Y') .'</font>
                </p>
                <br/>
                <p class="western" align="center" style="margin-bottom: 0cm; line-height: 100%">
                    <font size="3" style="font-size: 12pt">Assinam.</font>
                </p>
                <br/><br/>
                <p class="western" align="center" style="margin-bottom: 0cm; line-height: 100%">
                    <font size="3" style="font-size: 12pt"><b>Contratante.</b></font>
                </p>
                <br/><br/><br/><br/>
                <p class="western" align="center" style="margin-bottom: 0cm; line-height: 100%">
                    <font size="3" style="font-size: 12pt"><b>Contratado.</b></font>
                </p>
            ';
            
            $this->pdf->loadHtml($html_content);
			$this->pdf->render();
			$this->pdf->stream("". $contract .".pdf", ["Attachment" => 0]);
		}
    }
}