<?php

class Production extends Controller {
    public function __construct(){
		if( isset($_SESSION['usr']) ){
		}else{
			header('location:'. BASEURL);
		}
    }

    public function index(){
        $check = $this->model('Home_model')->checkUsermenu('production','Create');
        if ($check){
            $data['title'] = 'Input Production Planning';
            $data['menu']  = 'Input Production Planning';  

            $data['lines'] = $this->model('Line_model')->getListProductionLines();   

            $this->view('templates/header_a', $data);
            $this->view('production/index', $data);
            $this->view('templates/footer_a');
        }else{
            $this->view('templates/401');
        }        
    }

    public function inputactualqty(){
        $check = $this->model('Home_model')->checkUsermenu('production/inputactualqty','Create');
        if ($check){
            $data['title'] = 'Input Actual Production Quantity';
            $data['menu']  = 'Input Actual Production Quantity';

            $data['lines'] = $this->model('Line_model')->getListProductionLines();   
            $data['hrtimes'] = $this->model('Production_model')->getHourlyTimes();

            $this->view('templates/header_a', $data);
            $this->view('production/inputActual', $data);
            $this->view('templates/footer_a');
        }else{
            $this->view('templates/401');
        }         
    }
    
    public function save(){
        // echo json_encode($_POST);
        // $this->model('Production_model')->savePlanning($_POST);
		if( $this->model('Production_model')->savePlanning($_POST) > 0 ) {
			Flasher::setMessage('Planning Created','','success');
			header('location: '. BASEURL . '/production');
			exit;			
		}else{
			Flasher::setMessage('Failed,','','danger');
			header('location: '. BASEURL . '/production');
			exit;	
	    }
    }

    public function getplanning(){
        $data = $this->model('Production_model')->getPlanningData($_POST);
        echo json_encode($data);
    }

    public function getactualdata(){
        $data = $this->model('Production_model')->getActualData($_POST);
        echo json_encode($data);
    }

    public function hourlymonitoringview($params){
        $url  = parse_url($_SERVER['REQUEST_URI']);
        $data = parse_str($url['query'], $params);
        // $plandate = $params['plandate'];
        // $prodline = $params['prodline'];
        // $shift    = $params['shift'];
        $plandate = date('Y-m-d');

        $data['title'] = 'Hourly Production Monitoring';
        $data['menu']  = 'Hourly Production Monitoring';
        // echo json_encode($prodline, $prodline, $shift);
        // $data['title'] = 'Hourly Production Monitoring';
        // $data['menu']  = 'Hourly Production Monitoring';
        // // $data['rdata'] = $this->model('')->getHourlyMonitoring($_GET);

        $data['chour'] = $this->model('Production_model')->getServerHour();

        if($data['chour']['serverhour'] >= 6 && $data['chour']['serverhour'] <= 18){
            $shift = 1;
        }else{
            $shift = 2;
        }

        // $data['lines']    = $this->model('Line_model')->getListProductionLines();
        $data['lines']    = $this->model('Production_model')->getListProductionLines($plandate, $shift);
        $data['rdata']    = $this->model('Production_model')->getHourlyMonitoringViewV2($plandate, $shift);
        $data['plandate'] = $plandate;
        // $data['prodline'] = $prodline;
        $data['shift']    = $shift;

        $this->view('templates/header_a', $data);
        $this->view('production/hourlymonitoringview', $data);
        $this->view('templates/footer_a');
    }

    public function hourlymonitoring(){

        // echo json_encode($_GET);
        $data['title'] = 'Hourly Production Monitoring';
        $data['menu']  = 'Hourly Production Monitoring';
        // $data['rdata'] = $this->model('')->getHourlyMonitoring($_GET);

        $data['lines'] = $this->model('Line_model')->getListProductionLines();

        $this->view('templates/header_a', $data);
        $this->view('production/hourlymonitoring', $data);
        $this->view('templates/footer_a');
    }

    public function gethourlyoutput(){
        $data = $this->model('Production_model')->getHourlyMonitoring($_POST);
        echo json_encode($data);
    }

    public function productionview(){
        // 
        // echo json_encode($data);
            $data['title'] = 'Production View';
            $data['menu']  = 'Production View';

            $data['rdata'] = $this->model('Production_model')->planningMonitoring();
            $data['rday1'] = $this->model('Production_model')->planningMonitoringDay1();
            $data['rday2'] = $this->model('Production_model')->planningMonitoringDay2();
            // echo json_encode($data['rday2']);
            $data['rday3'] = $this->model('Production_model')->planningMonitoringDay3();
            $data['hdata'] = $this->model('Production_model')->planningMonitoringDate();

            $data['ctime'] = $this->model('Production_model')->getServerTime();
            $data['chour'] = $this->model('Production_model')->getServerHour();
            // echo json_encode($data);
            $this->view('templates/header_a', $data);
            $this->view('production/productionviewV3', $data);
            $this->view('templates/footer_a');
    }

    public function saveactualdata(){
        if( $this->model('Production_model')->saveactualdata($_POST) > 0 ) {
			$return = array(
                "msgtype" => "1",
                "message" => "Actual Quantity Inserted"
            );
            echo json_encode($return);
			exit;			
		}else{
			$return = array(
                "msgtype" => "2",
                "message" => "Insert Actual Quantity Failed"
            );
            echo json_encode($return);
			exit;	
	    }
    }

    public function searchMaterial(){
        $url    = parse_url($_SERVER['REQUEST_URI']);
        $search = $url['query'];
        $search = str_replace("searchName=","",$search);

        $result['data'] = $this->model('Production_model')->searchMaterial($search);
        echo json_encode($result);
    }
}