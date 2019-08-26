<?php

namespace App\Http\Controllers;

use Auth;
use Session;
use Helper;
use Excel;

use App\Case_;
use App\Users;
use App\Tasks;
use App\Task_Types;
use App\Installment;
use App\Courts;
use App\Cases_Types;
use App\Geo_Cities;
use App\Geo_Governorates;
use App\Geo_Countries;
use App\Package_Types;
use App\User_Details;
use App\Exports\ReportsExport;
use App\Exports\InstallmentsExport;
use App\Exports\UrgentsExport;
use App\Exports\TasksExport;
use App\Exports\ReportsCasetypeExport;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use App\Rules;
use App\Specializations;
use App\SyndicateLevels;

class ReportsStatisticsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        // if(Auth::user()->country_id == null)
        // {
        //     return redirect()->route('choose.country');
        // }
        $data = $this->getData();
        return view('reports_statistics', $data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }

    public function getData($filters = NULL) 
    {
        /** Filter data */
        $data['governorates']  = Geo_Governorates::all();
        $data['cities'] = Geo_Cities::all();
        $data['nationalities'] = Geo_Countries::all();
        $data['lawyers_'] = Helper::getUsersBasedOnRules([5])->where('is_active', 1);
        $data['companies_'] = Users::users(9)->get();
        $data['packages_']  = Package_Types::all();
        $data['installments_'] = Installment::select('subscription_id')->distinct()->get();
        $data['courts_']    = Courts::all();
        $data['tasks_']     = Task_Types::all();
        $data['caseTypes']  = Cases_Types::all();
        $data['lawyer_types'] = Rules::where('parent_id',5)->get();
        $data['work_sectors'] = Specializations::all();
        $data['syndicate_levels'] = SyndicateLevels::all();
        /** Countable and percentage data */
        // list data
        $data['count_clients'] = Helper::getUsersBasedOnRules([7, 8, 9, 10])->count();  // count all clients

        // mobile clients number and percentage
        $data['count_mobile'] = Users::users(7)->where('country_id',Auth::user()->country_id)->count();
        $data['percentage_mobile'] = Helper::percent($data['count_mobile'], $data['count_clients']);

        // individuals number and percentage
        $data['count_individuals'] = Users::users(8)->where('country_id',Auth::user()->country_id)->count();
        $data['percentage_individuals'] = Helper::percent($data['count_individuals'], $data['count_clients']);

        // companies number and percentage
        $data['count_companies'] = Users::users(9)->where('country_id',Auth::user()->country_id)->count();
        $data['percentage_companies'] = Helper::percent($data['count_companies'], $data['count_clients']);
        
        // individuals-companies number and percentage
        $data['count_indcom'] = Users::users(10)->where('country_id',Auth::user()->country_id)->count();
        $data['percentage_indcom'] = Helper::percent($data['count_indcom'], $data['count_clients']);
        
        $data['count_case'] = Case_::where('country_id',Auth::user()->country_id)->count();

        // paid services
        $data['count_paid_services'] = Tasks::where('country_id',Auth::user()->country_id)->where('task_type_id', 3)->where('task_payment_status_id', 2)->count();
        // free services
        $data['count_free_services'] = Tasks::where('country_id',Auth::user()->country_id)->where('task_type_id', 3)->where('task_payment_status_id', 1)->count();
        // call services
        $data['call_services'] =0;
        $calls= User_Details::whereHas('user',function($q){
            $q->where('country_id',Auth::user()->country_id)->whereHas('rules',function($q){
                $q->where('rule_id',5);
            });
        })->get();
        // dd($calls);
        foreach($calls as $call)
        {
            $data['call_services'] +=$call['number_of_calls'];
        }
        // dd($data['call_services']);
        /** List data */
        // cases number & percentage
        if(isset ( $filters['gov'] ) || isset ( $filters['city'] ) ) { 
            if(isset($filters['gov'])) { 
                $data['cases'] = Case_::where('country_id',Auth::user()->country_id)->whereIn('geo_governorate_id', $filters['gov'])->select('geo_governorate_id', 'geo_city_id', \DB::raw('count(*) as total'))->groupBy('geo_governorate_id')->groupBy('geo_city_id'); 
            }
            if(isset($filters['city'])) { 
                $data['cases'] = Case_::where('country_id',Auth::user()->country_id)->whereIn('geo_city_id', $filters['city'])->select('geo_governorate_id', 'geo_city_id', \DB::raw('count(*) as total'))->groupBy('geo_governorate_id')->groupBy('geo_city_id'); 
            }

            $data['cases'] = $data['cases']->get();
        } else {
            $data['cases'] = Case_::select('geo_governorate_id', 'geo_city_id', \DB::raw('count(*) as total'))->where('country_id',Auth::user()->country_id)->groupBy('geo_governorate_id')->groupBy('geo_city_id')->get();
        }

         //for export excel after filter 

          foreach ($data['cases'] as $case) {
             $filter_cases_ids[] = $case->geo_city_id;
             }
           if (!empty($filter_cases_ids)) {
             Session::flash('filter_cases_ids', $filter_cases_ids);
             } else {
             $filter_cases_ids[] = 0;
             Session::flash('filter_cases_ids', $filter_cases_ids);
             }

          //for export excel after filter 

        // Lawyers
        if ( isset ( $filters['sector'] ) || isset ( $filters['level'] ) || isset ( $filters['nationality'] ) || isset ( $filters['title'] ) || isset ( $filters['type'] )  ) {
            
            $data['lawyers'] = Users::where('country_id',Auth::user()->country_id)->whereHas('rules', function($query) {
                $query->whereIn('rule_id', [11, 12]);
            });

            $sector = $filters['sector'];
            $level  = $filters['level'];
            $nat    = $filters['nationality'];
            $title  = $filters['title'];
            $type   = $filters['type'];

            if ( isset($filters['sector']) ) { $data['lawyers'] = $data['lawyers']->whereHas('specializations', function($q) use($sector) { 
                $q->where('specialization_id', $sector); }); 
            }
            if ( isset($filters['level']) ) { $data['lawyers'] = $data['lawyers']->whereHas('user_detail', function($q) use($level) { 
                $q->where('syndicate_level_id',$level); }); 
            }
            if ( isset($filters['nationality']) ) { $data['lawyers'] = $data['lawyers']->whereHas('user_detail', function($q) use($nat) { 
                $q->where('nationality_id', $nat); }); 
            }
            if ( isset($filters['title']) ) { $data['lawyers'] = $data['lawyers']->whereHas('user_detail', function($q) use($title) { 
                $q->where('job_title', $title); }); 
            }
            if ( isset($filters['type']) ) { $data['lawyers'] = $data['lawyers']->whereHas('user_detail', function($q) use($type) { 
                $q->where('work_sector_type', $type); }); 
            }

            $data['lawyers'] = $data['lawyers']->get();
        } else {
            $data['lawyers'] = Helper::getUsersBasedOnRules([11, 12]);
        }
        //for export excel after filter 
          $this->set_filterIDs_session( $data['lawyers'] , 'lawyers' );
   
        // Companies
        if ( isset( $filters['company'] ) ||isset( $filters['packages'] ) ||isset( $filters['activate'] ) ) { 
            $packages = $filters['packages'];
            $data['companies'] = Users::users(9)->where('country_id',Auth::user()->country_id);

            if ( isset( $filters['company'] ) ) {
                $data['companies'] = $data['companies']->where('users.id', $filters['company']);
            }
            if ( isset( $filters['packages'] ) ) {
                $data['companies'] = $data['companies']->whereHas('subscription', function($q) use($packages) {
                    $q->whereIn('package_type_id', $packages);
                });
            }
            if ( isset( $filters['activate'] ) ) {
                if($filters['activate'] == 1) {
                    $data['companies'] = $data['companies']->get();
                } else if($filters['activate'] == 2) {
                    $data['companies'] = $data['companies']->where('is_active', 1)->get();
                } else if($filters['activate'] == 3) {
                    $data['companies'] = $data['companies']->where('is_active', 0)->get();
                }
            }
        } else {
            $data['companies'] = Users::users(9)->where('country_id',Auth::user()->country_id)->get();
        }

        //for export excel after filter 
          $this->set_filterIDs_session( $data['companies'] , 'companies' );

        // Installments
        if ( isset( $filters['code'] ) || isset( $filters['startDate'] ) || isset( $filters['activate1'] ) ) {
            // dd([$filters['code']  , $filters['startDate'] , $filters['activate1']]);
            $data['installments'] = new Installment;

            if ( isset($filters['code']) ) {
                $data['installments'] = $data['installments']->whereHas('subscription', function($query) {
            })->where('subscription_id', $filters['code']);
            }

            if ( isset($filters['startDate']) ) {
                $startDate = date('Y-m-d', strtotime($filters['startDate']));
                $data['installments'] = $data['installments']->whereHas('subscription', function($q) use($startDate) {
                    $q->where('start_date', '>=', $startDate);
                });
            }

            if ( isset($filters['activate1']) ) {
                if($filters['activate1'] == 1) { 
                    $data['installments'] = $data['installments']->whereHas('subscription', function($query) {
            })->get();
                }
                if($filters['activate1'] == 2) {
                    $data['installments'] = $data['installments']->whereHas('subscription', function($query) {
            })->where('is_paid', 1)->get();
                }
                if($filters['activate1'] == 3) {
                    $data['installments'] = $data['installments']->whereHas('subscription', function($query) {
            })->where('is_paid', 0)->get();
                }
            }

        } else {
            $data['installments'] = //Installment::all();
            Installment::whereHas('subscription', function($query) {
            })->get();
        }

        //for export excel after filter 
          $this->set_filterIDs_session( $data['installments'] , 'installments' );
        
        // Urgents
        if ( isset( $filters['userType'] ) ) {
            $data['urgents'] = Helper::getUrgents($filters['userType']);
        } else {
            $data['urgents'] = Helper::getUrgents([7, 8, 9, 10]);
        }
        //for export excel after filter 
          $this->set_filterIDs_session( $data['urgents'] , 'urgents' );

        // Courts
        if ( isset( $filters['cities'] ) || isset( $filters['govs'] ) || isset( $filters['courts'] ) ) {

            $data['courts'] = new Courts;

            if( isset($filters['cities']) ) {
                $data['courts'] = $data['courts']->whereIn('city_id', $filters['cities']);
            }

            if( isset($filters['govs']) ) {
                $govs = $filters['govs'];
                $data['courts'] = $data['courts']->whereHas('city', function($q) use($govs) {
                    $q->whereHas('governorate', function($m) use($govs) {
                       $m->whereIn('id', $govs); 
                    });
                });
            }

            if( isset($filters['courts']) ) {
                $data['courts'] = $data['courts']->whereIn('id', $filters['courts']);
            }

            $data['courts'] = $data['courts']->where('country_id',Auth::user()->country_id)->get();
        } else {
            $data['courts'] = Courts::select('city_id', 'name', \DB::raw('count(*) as total') )->groupBy('city_id')->groupBy('name')->where('country_id',Auth::user()->country_id)->get();
        }

        //for export excel after filter 
          $filter_courts_ids[] ='';
          foreach ($data['courts'] as $court) {
             $filter_courts_ids[] = $court->name;
             }
           if (!empty($filter_courts_ids)) {
             Session::flash('filter_courts_ids', $filter_courts_ids);
             } else {
             $filter_court_ids[] = 0;
             Session::flash('filter_courts_ids', $filter_courts_ids);
             }


        // Tasks
        if ( isset( $filters['taskType'] ) || isset( $filters['dateFrom'] ) || isset( $filters['dateTo'] ) ) {
            
            $data['tasks'] = new Task_Types;
            
            if ( isset( $filters['taskType'] ) ) {
                $data['tasks'] = $data['tasks']->whereIn('id', $filters['taskType']);
            }

            if ( isset( $filters['dateFrom'] ) ) {
                $dateFrom = $filters['dateFrom'];
                $data['tasks'] = $data['tasks']->whereHas('tasks', function($q) use($dateFrom) {
                    $q->where('start_datetime', '>=', $dateFrom);
                });
            }

            if ( isset( $filters['dateTo'] ) ) {
                $dateTo = $filters['dateTo'];
                $data['tasks'] = $data['tasks']->whereHas('tasks', function($q) use($dateTo) {
                    $q->where('end_datetime', '<=', $dateTo);
                });
            }

            $data['tasks'] = $data['tasks']->whereHas('tasks', function($q){
                })->get();
        } else {
            $data['tasks'] = //Task_Types::all();
            Task_Types::whereHas('tasks', function($q){
                })->get();
        }
         //for export excel after filter 
          $this->set_filterIDs_session( $data['tasks'] , 'tasks' );

        // Case type

        if ( isset( $filters['cities1'] ) ||isset( $filters['govs1'] ) || isset( $filters['caseType'] ) ) {

            // dd([$filters['cities1'], $filters['govs1'], $filters['caseType']]);
            $data['cases1'] = new Case_;

            if ( isset( $filters['cities1'] ) ) {
                $data['cases1'] = $data['cases1']->whereIn('geo_city_id', $filters['cities1'])->select(['case_type_id', 'geo_city_id', 'geo_governorate_id'])->groupBy('case_type_id')->groupBy('geo_city_id')->groupBy('geo_governorate_id');
            }
            if ( isset( $filters['govs1'] ) ) {
                $data['cases1'] = $data['cases1']->whereIn('geo_governorate_id', $filters['govs1'])->select(['case_type_id', 'geo_city_id', 'geo_governorate_id'])->groupBy('case_type_id')->groupBy('geo_city_id')->groupBy('geo_governorate_id');
            }
            if ( isset( $filters['caseType'] ) ) {
                $data['cases1'] = $data['cases1']->whereIn('case_type_id', $filters['caseType'])->select(['case_type_id', 'geo_city_id', 'geo_governorate_id'])->groupBy('case_type_id')->groupBy('geo_city_id')->groupBy('geo_governorate_id');
            }

            $data['cases1'] = $data['cases1']->whereHas('created_by', function($query) {
        $query->where('country_id' ,Auth::user()->country_id);
    })->get();
        } else {
            $data['cases1'] = Case_::select(['case_type_id', 'geo_city_id', 'geo_governorate_id'])->groupBy('case_type_id')->groupBy('geo_city_id')->groupBy('geo_governorate_id')->whereHas('created_by', function($query) {
        $query->where('country_id' ,Auth::user()->country_id);
    })->get();
        }
         //for export excel after filter 
         // $this->set_filterIDs_session( $data['cases1'] , 'cases1' );

        //for export excel after filter 

          foreach ($data['cases1'] as $case) {
             $filter_cases1_ids[] = $case->geo_governorate_id;
             }
           if (!empty($filter_cases1_ids)) {
             Session::flash('filter_cases1_ids', $filter_cases1_ids);
             } else {
             $filter_cases1_ids[] = 0;
             Session::flash('filter_cases1_ids', $filter_cases1_ids);
             }

        return $data;
    }

    public function filter(Request $request) {
        if(count($request->all()) > 1) { 
            // cases tab
            if( $request->gov || $request->city ) { $data = $this->getData(['gov' => $request->gov, 'city' => $request->city]); $tab = 1; }

            // lawyers tab
            if( $request->workSector || $request->level || $request->nationality || $request->workTitle || $request->workSectorType ) {
                $data = $this->getData(['sector'=>$request->workSector, 'level'=>$request->level, 'nationality'=>$request->nationality, 'title'=>$request->workTitle, 'type'=>$request->workSectorType]);
                $tab = 2;
            }

            // company tab
            if ( $request->company || $request->packages || $request->activate ) {
                $data = $this->getData(['company'=>$request->company, 'packages'=>$request->packages, 'activate'=>$request->activate]);
                $tab = 3;
            }

            // installments
            if ( $request->code || $request->startDate || $request->activate1 ) {
                $data = $this->getData(['code'=> $request->code, 'startDate'=> $request->startDate, 'activate1'=>$request->activate1]);
                $tab = 4;
            }
            
            // Urgents
            if ( $request->userType ) {
                $data = $this->getData(['userType'=>$request->userType]);
                $tab = 5;
            }

            // Courts
            if ( $request->cities || $request->govs || $request->courts ) {
                $data = $this->getData(['cities'=>$request->cities, 'govs'=>$request->govs, 'courts'=>$request->courts]);
              $tab = 6;
            }

            // Tasks
            if ( $request->taskType || $request->dateFrom || $request->dateTo ) {
                $data = $this->getData(['taskType'=>$request->taskType, 'dateFrom'=>$request->dateFrom, 'dateTo'=>$request->dateTo]);
                $tab = 7;
            }

            // Cases Types
            if ( $request->cities1 || $request->govs1 || $request->caseType ) {
                $data = $this->getData(['cities1'=>$request->cities1, 'govs1'=>$request->govs1, 'caseType'=>$request->caseType]);
              $tab = 8;
            }

        } else {
            $data = $this->getData();
           
        }
        $data['tab'] = $tab;
        // dd($tab);
        return view('reports_statistics', $data);
    }

    public function cases_exportXLS( Request $request ) {
        $filepath ='public/excel/';
        $PathForJson='storage/excel/';
        $filename = 'Cases'.time().'.xlsx';

        if( isset( $request->ids ) && $request->ids != NULL ){
           // $ids = explode(",", $request->ids);
          $ids =  $request->ids;
            Excel::store(new ReportsExport($ids),$filepath.$filename);
            return response()->json($PathForJson.$filename);
      } elseif ($_GET['filters'] != '') {
      $filters = json_decode($_GET['filters']);
       Excel::store(new ReportsExport($filters),$filepath.$filename);
            return response()->json($PathForJson.$filename);
        } else{
            Excel::store((new ReportsExport()),$filepath.$filename);
            return response()->json($PathForJson.$filename); 
        }

        return response()->json($response);
    }


        public function installments_exportXLS( Request $request ) {
        $filepath ='public/excel/';
        $PathForJson='storage/excel/';
        $filename = 'Installments'.time().'.xlsx';

        if( isset( $request->ids ) && $request->ids != NULL ){
           // $ids = explode(",", $request->ids);
          $ids =  $request->ids;
            Excel::store(new InstallmentsExport($ids),$filepath.$filename);
            return response()->json($PathForJson.$filename);
      } elseif ($_GET['filters'] != '') {
      $filters = json_decode($_GET['filters']);
       Excel::store(new InstallmentsExport($filters),$filepath.$filename);
            return response()->json($PathForJson.$filename);
        } else{
            Excel::store((new InstallmentsExport()),$filepath.$filename);
            return response()->json($PathForJson.$filename); 
        }

        return response()->json($response);
    }


     public function urgents_exportXLS( Request $request ) {
        $filepath ='public/excel/';
        $PathForJson='storage/excel/';
        $filename = 'Urgents'.time().'.xlsx';

        if( isset( $request->ids ) && $request->ids != NULL ){
           // $ids = explode(",", $request->ids);
          $ids =  $request->ids;
            Excel::store(new UrgentsExport($ids),$filepath.$filename);
            return response()->json($PathForJson.$filename);
      } elseif ($_GET['filters'] != '') {
      $filters = json_decode($_GET['filters']);
       Excel::store(new UrgentsExport($filters),$filepath.$filename);
            return response()->json($PathForJson.$filename);
        } else{
            Excel::store((new UrgentsExport()),$filepath.$filename);
            return response()->json($PathForJson.$filename); 
        }

        return response()->json($response);
    }

     public function tasks_exportXLS( Request $request ) {
        $filepath ='public/excel/';
        $PathForJson='storage/excel/';
        $filename = 'Tasks'.time().'.xlsx';

        if( isset( $request->ids ) && $request->ids != NULL ){
           // $ids = explode(",", $request->ids);
          $ids =  $request->ids;
            Excel::store(new TasksExport($ids),$filepath.$filename);
            return response()->json($PathForJson.$filename);
      } elseif ($_GET['filters'] != '') {
      $filters = json_decode($_GET['filters']);
       Excel::store(new TasksExport($filters),$filepath.$filename);
            return response()->json($PathForJson.$filename);
        } else{
            Excel::store((new TasksExport()),$filepath.$filename);
            return response()->json($PathForJson.$filename); 
        }

        return response()->json($response);
    }

     public function casetype_exportXLS( Request $request ) {
        $filepath ='public/excel/';
        $PathForJson='storage/excel/';
        $filename = 'casetype'.time().'.xlsx';

        if( isset( $request->ids ) && $request->ids != NULL ){
           // $ids = explode(",", $request->ids);
          $ids =  $request->ids;
            Excel::store(new ReportsCasetypeExport($ids),$filepath.$filename);
            return response()->json($PathForJson.$filename);
      } elseif ($_GET['filters'] != '') {
      $filters = json_decode($_GET['filters']);
       Excel::store(new ReportsCasetypeExport($filters),$filepath.$filename);
            return response()->json($PathForJson.$filename);
        } else{
            Excel::store((new ReportsCasetypeExport()),$filepath.$filename);
            return response()->json($PathForJson.$filename); 
        }

        return response()->json($response);
    }



public function set_filterIDs_session( $section_data , $section_name ) {
    foreach ($section_data as $data) {
             $filter_ids[] = $data->id;
             }
           if (!empty($filter_ids)) {
             Session::flash('filter_'.$section_name.'_ids', $filter_ids);
             } else {
             $filter_ids[] = 0;
             Session::flash('filter_'.$section_name.'_ids', $filter_ids);
             }
         }
}
