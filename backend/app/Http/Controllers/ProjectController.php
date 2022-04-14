<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;

class ProjectController extends Controller
{
    function putData(Request $request)
    {
        $request->aayojana_suru_miti = Carbon::createFromFormat('Y-m-d', $request->aayojana_suru_miti)->toDateString();
        $request->gathan_vayeko_miti = Carbon::createFromFormat('Y-m-d', $request->gathan_vayeko_miti)->toDateString();
        $request->aayojana_ante_miti = Carbon::createFromFormat('Y-m-d', $request->aayojana_ante_miti)->toDateString();
        if (!empty($request->pratham_miti)) {
            $request->pratham_miti = Carbon::createFromFormat('Y-m-d', $request->pratham_miti)->toDateString();
        }
        if (!empty($request->dorshro_miti)) {
            $request->dorshro_miti = Carbon::createFromFormat('Y-m-d', $request->dorshro_miti)->toDateString();
        }
        if (!empty($request->teshro_miti)) {
            $request->teshro_miti = Carbon::createFromFormat('Y-m-d', $request->teshro_miti)->toDateString();
        }
        if (!empty($request->jamma_miti)) {
            $request->jamma_miti = Carbon::createFromFormat('Y-m-d', $request->jamma_miti)->toDateString();
        }
        $validator = Validator::make($request->all(), [
            'update'=>'bail|required|boolean',
            'projectId'=>'bail|required_if:update,true|nullable|exists:projects,id',

            'upabhokta_samitiko_naam' => 'bail|required|string|max:255',
            'upabokta_samitiko_thegana' => 'bail|required|string|max:255',
            'aayojanako_naam' => 'bail|required|string|max:255',
            'aayojanako_sthal' => 'bail|required|string|max:255',
            'aayojanako_udeshya' => 'bail|required|string|max:255',
            'aayojana_suru_miti' => 'bail|required|date|date_format:Y-m-d',
            'lagat_anuman' => 'bail|required|integer',
            'lagat_behorne_karyalay' => 'bail|required|integer',
            'lagat_behorne_upobhokta_samiti' => 'bail|required|integer',
            'lagatBehorneSrotId' => 'bail|nullable|exists:lagatbehornesrots,id',
            'lagat_behorne_anne' => 'bail|nullable|integer',

            'bastugat_anudan_sangbata_samagriko_naam' => 'bail|required|string|max:255',
            'bastugat_anudan_sangbata_ekai' => 'bail|required|string|max:255',
            'bastugat_anudan_pradeshbata_samagriko_naam' => 'bail|required|string|max:255',
            'bastugat_anudan_pradeshbata_ekai' => 'bail|required|string|max:255',
            'bastugat_anudan_sthaniyebata_samagriko_naam' => 'bail|required|string|max:255',
            'bastugat_anudan_sthaniyebata_ekai' => 'bail|required|string|max:255',
            'bastugat_anudan_gairasarakaribata_samagriko_naam' => 'bail|required|string|max:255',
            'bastugat_anudan_gairasarakaribata_ekai' => 'bail|required|string|max:255',
            'bastugat_anudan_bideshbata_samagriko_naam' => 'bail|required|string|max:255',
            'bastugat_anudan_bideshbata_ekai' => 'bail|required|string|max:255',
            'bastugat_anudan_upobhoktasamitibata_samagriko_naam' => 'bail|required|string|max:255',
            'bastugat_anudan_upokhoktasamitibata_ekai' => 'bail|required|string|max:255',
            'bastugat_anudan_anne_samagriko_naam' => 'bail|required|string|max:255',
            'bastugat_anudan_anne_ekai' => 'bail|required|string|max:255',

            'aayojana_labhanbit_gharpariwar_sangkhya' => 'bail|required|string|max:255',
            'aayojana_labhanbit_janasankhya' => 'bail|required|string|max:255',
            'aayojana_labhanbit_sangathit_sangkhya' => 'bail|string|max:255',
            'aayojana_labhanbit_anne' => 'bail|string|max:255',
            'gathan_vayeko_miti' => 'bail|required|date|date_format:Y-m-d',

            'padadhikariharu' => "bail|required|array|min:1|max:15",
            'padadhikariharu.*.projectpadadhikariId' => "sometimes|required|exists:projectpadadhikaris,id",
            'padadhikariharu.*.padadhikariPadaId' => "bail|required|integer|exists:padadhikaripadas,id",
            'padadhikariharu.*.name' => "bail|required|string|max:255",
            'padadhikariharu.*.thegana' => "bail|required|string|max:255",
            'padadhikariharu.*.na_na' => "bail|required|string|max:255",
            'padadhikariharu.*.jilla' => "bail|required|string|max:255",

            'upobhokta_samiti_gathan_garda_upasthit_labhanbit_sangkhya' => 'bail|required|string|max:255',
            'anubhav_barsa' => 'bail|required|string|max:255',

            'pratham_miti' => 'bail|nullable|date|date_format:Y-m-d',
            'pratham_rakam' => 'bail|string|max:255',
            'pratham_samagriko_pariman' => 'bail|string|max:255',
            'pratham_kaifiyet' => 'bail|string|max:255',
            'dorshro_miti' => 'bail|nullable|date|date_format:Y-m-d',
            'dorshro_rakam' => 'bail|string|max:255',
            'dorshro_samagriko_pariman' => 'bail|string|max:255',
            'dorshro_kaifiyet' => 'bail|string|max:255',
            'teshro_miti' => 'bail|nullable|date|date_format:Y-m-d',
            'teshro_rakam' => 'bail|string|max:255',
            'teshro_samagriko_pariman' => 'bail|string|max:255',
            'teshro_kaifiyet' => 'bail|string|max:255',
            'jamma_miti' => 'bail|nullable|date|date_format:Y-m-d',
            'jamma_rakam' => 'bail|string|max:255',
            'jamma_samagriko_pariman' => 'bail|string|max:255',
            'jamma_kaifiyet' => 'bail|string|max:255',

            'yojana_marmat_jimma_line_samiti' => 'bail|string|max:255',
            'marmat_sambhabit_srot' => 'bail|string|max:255',
            'janasramdan' => 'bail|string|max:255',
            'sewa_sulka' => 'bail|string|max:255',
            'dastur_chandabata' => 'bail|string|max:255',
            'anne_kehi_vaye' => 'bail|string|max:255',

            'aayojana_ante_miti' => 'bail|required|date|date_format:Y-m-d',
            'wardId' => 'bail|required|integer||exists:wards,id',
            'ppaId' => 'bail|required|integer|exists:ppas,id',
            'kaifiyet' => 'bail|required|string|max:255',

        ]);
        if ($validator->fails()) {
            return response(array(0, $validator->errors()));
        }

        $projectId = DB::transaction(function ()  use($request) {
            $projectId = $request->projectId;
            $project = ['upabhokta_samitiko_naam' => $request->upabhokta_samitiko_naam,
                'upabokta_samitiko_thegana' => $request->upabokta_samitiko_thegana,
                'aayojanako_naam' => $request->aayojanako_naam,
                'aayojanako_sthal' => $request->aayojanako_sthal,
                'aayojanako_udeshya' => $request->aayojanako_udeshya,
                'aayojana_suru_miti' => $request->aayojana_suru_miti,
                'lagat_anuman' => $request->lagat_anuman,
                'lagat_behorne_karyalay' => $request->lagat_behorne_karyalay,
                'lagat_behorne_upobhokta_samiti' => $request->lagat_behorne_upobhokta_samiti,
                'lagatBehorneSrotId' => $request->lagatBehorneSrotId,
                'lagat_behorne_anne' => $request->lagat_behorne_anne,
                'aayojana_labhanbit_gharpariwar_sangkhya' => $request->aayojana_labhanbit_gharpariwar_sangkhya,
                'aayojana_labhanbit_janasankhya' => $request->aayojana_labhanbit_janasankhya,
                'aayojana_labhanbit_sangathit_sangkhya' => $request->aayojana_labhanbit_sangathit_sangkhya,
                'aayojana_labhanbit_anne' => $request->aayojana_labhanbit_anne,
                'gathan_vayeko_miti' => $request->gathan_vayeko_miti,
                'upobhokta_samiti_gathan_garda_upasthit_labhanbit_sangkhya' => $request->upobhokta_samiti_gathan_garda_upasthit_labhanbit_sangkhya,
                'anubhav_barsa' => $request->anubhav_barsa,
                'yojana_marmat_jimma_line_samiti' => $request->yojana_marmat_jimma_line_samiti,
                'marmat_sambhabit_srot' => $request->marmat_sambhabit_srot,
                'janasramdan' => $request->janasramdan,
                'sewa_sulka' => $request->sewa_sulka,
                'dastur_chandabata' => $request->dastur_chandabata,
                'anne_kehi_vaye' => $request->anne_kehi_vaye,
                'aayojana_ante_miti' => $request->aayojana_ante_miti,
                'wardId' => $request->wardId,
                'ppaId' => $request->ppaId,
                'adaxyako_number' => $request->adaxyako_number,
                'kaifiyet' => $request->kaifiyet
            ];
            $projectbastugatanudans = [
                'bastugat_anudan_sangbata_samagriko_naam' => $request->bastugat_anudan_sangbata_samagriko_naam,
                'bastugat_anudan_sangbata_ekai' => $request->bastugat_anudan_sangbata_ekai,
                'bastugat_anudan_pradeshbata_samagriko_naam' => $request->bastugat_anudan_pradeshbata_samagriko_naam,
                'bastugat_anudan_pradeshbata_ekai' => $request->bastugat_anudan_pradeshbata_ekai,
                'bastugat_anudan_sthaniyebata_samagriko_naam' => $request->bastugat_anudan_sthaniyebata_samagriko_naam,
                'bastugat_anudan_sthaniyebata_ekai' => $request->bastugat_anudan_sthaniyebata_ekai,
                'bastugat_anudan_gairasarakaribata_samagriko_naam' => $request->bastugat_anudan_gairasarakaribata_samagriko_naam,
                'bastugat_anudan_gairasarakaribata_ekai' => $request->bastugat_anudan_gairasarakaribata_ekai,
                'bastugat_anudan_bideshbata_samagriko_naam' => $request->bastugat_anudan_bideshbata_samagriko_naam,
                'bastugat_anudan_bideshbata_ekai' => $request->bastugat_anudan_bideshbata_ekai,
                'bastugat_anudan_upobhoktasamitibata_samagriko_naam' => $request->bastugat_anudan_upobhoktasamitibata_samagriko_naam,
                'bastugat_anudan_upokhoktasamitibata_ekai' => $request->bastugat_anudan_upokhoktasamitibata_ekai,
                'bastugat_anudan_anne_samagriko_naam' => $request->bastugat_anudan_anne_samagriko_naam,
                'bastugat_anudan_anne_ekai' => $request->bastugat_anudan_anne_ekai,
            ];
            $projectkistakobiwarans = [
                'pratham_miti' => $request->pratham_miti,
                'pratham_rakam' => $request->pratham_rakam,
                'pratham_samagriko_pariman' => $request->pratham_samagriko_pariman,
                'pratham_kaifiyet' => $request->pratham_kaifiyet,
                'dorshro_miti' => $request->dorshro_miti,
                'dorshro_rakam' => $request->dorshro_rakam,
                'dorshro_samagriko_pariman' => $request->dorshro_samagriko_pariman,
                'dorshro_kaifiyet' => $request->dorshro_kaifiyet,
                'teshro_miti' => $request->teshro_miti,
                'teshro_rakam' => $request->teshro_rakam,
                'teshro_samagriko_pariman' => $request->teshro_samagriko_pariman,
                'teshro_kaifiyet' => $request->teshro_kaifiyet,
                'jamma_miti' => $request->jamma_miti,
                'jamma_rakam' => $request->jamma_rakam,
                'jamma_samagriko_pariman' => $request->jamma_samagriko_pariman,
                'jamma_kaifiyet' => $request->jamma_kaifiyet,
            ];
            if ($request->update) {
                $updated = DB::table('projects')->where('id', $request->projectId)->update($project);
                if($updated){
                    $this->remoteUpdates('projects','update',$projectId);
                }

                $padadhikariIds = array();
                for ($i = 0; $i < count($request->padadhikariharu); $i++) {
                    $padadhikari = array(
                        'projectId' => $projectId,
                        'padadhikariPadaId' => $request->padadhikariharu[$i]['padadhikariPadaId'],
                        'name' => $request->padadhikariharu[$i]['name'],
                        'thegana' => $request->padadhikariharu[$i]['thegana'],
                        'na_na' => $request->padadhikariharu[$i]['na_na'],
                        'jilla' => $request->padadhikariharu[$i]['jilla'],
                    );
                    if (array_key_exists('projectpadadhikariId', $request->padadhikariharu[$i])) {
                        $updated = DB::table('projectpadadhikaris')->where('id', $request->padadhikariharu[$i]['projectpadadhikariId'])->update($padadhikari);
                        $padadhikariIds[] = $request->padadhikariharu[$i]['projectpadadhikariId'];
                        if($updated){
                            $this->remoteUpdates('projectpadadhikaris','update',$request->padadhikariharu[$i]['projectpadadhikariId']);
                        }
                    }else {
                        $padadhikariId = DB::table('projectpadadhikaris')->insertGetId($padadhikari);
                        $padadhikariIds[] = $padadhikariId;
                        $this->remoteUpdates('projectpadadhikaris','insert',$padadhikariId);
                    }
                    DB::table('projectpadadhikaris')->where('projectId', $request->projectId)->whereNotIn('id', $padadhikariIds)->delete();
                    $this->remoteUpdates('projectpadadhikaris','deleteExcept',$padadhikariIds);

                }
                if($selected = DB::table('projectbastugatanudans')->where('projectId', $projectId)->first()){
                    $updated = DB::table('projectbastugatanudans')->where('projectId', $projectId)->update($projectbastugatanudans);
                    if($updated){
                        $this->remoteUpdates('projectbastugatanudans','update',$selected->id);
                    }
                }

                if($selected= DB::table('projectkistakobiwarans')->where('projectId', $projectId)->first()){
                    $updated = DB::table('projectkistakobiwarans')->where('projectId', $projectId)->update($projectkistakobiwarans);
                    if($updated){
                        $this->remoteUpdates('projectkistakobiwarans','update',$selected->id);
                    }
                }

            } else {
                $projectId = DB::table('projects')->insertGetId($project);
                $this->remoteUpdates('projects','insert',$projectId);

                for ($i = 0; $i < count($request->padadhikariharu); $i++) {
                    $padadhikari = array(
                        'projectId' => $projectId,
                        'padadhikariPadaId' => $request->padadhikariharu[$i]['padadhikariPadaId'],
                        'name' => $request->padadhikariharu[$i]['name'],
                        'thegana' => $request->padadhikariharu[$i]['thegana'],
                        'na_na' => $request->padadhikariharu[$i]['na_na'],
                        'jilla' => $request->padadhikariharu[$i]['jilla'],
                    );
                    $padadhikariId = DB::table('projectpadadhikaris')->insertGetId($padadhikari);
                    $this->remoteUpdates('projectpadadhikaris', 'insert', $padadhikariId);
                }

                $projectbastugatanudans['projectId'] = $projectId;
                $projectbastugatanudanId = DB::table('projectbastugatanudans')->insertGetId($projectbastugatanudans);
                $this->remoteUpdates('projectbastugatanudans','insert',$projectbastugatanudanId);

                $projectkistakobiwarans['projectId'] = $projectId;
                $projectkistakobiwaranId = DB::table('projectkistakobiwarans')->insertGetId($projectkistakobiwarans);
                $this->remoteUpdates('projectkistakobiwarans','insert',$projectkistakobiwaranId);

            }
            return $projectId;
        });
        return response(array(1, $projectId));
    }
    function getProject(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'projectId'=>'required|integer',
        ]);
        if ($validator->fails()) {
            return response(array(0,$validator->errors()));
        }
        $query = DB::selectOne('SELECT projects.*, projects.id as projectId, projectpadadhikaris.*, projectkistakobiwarans.*, projectbastugatanudans.*, ppas.*, ppas.name as ppaName, ppas.phone as ppaPhone, wards.number as wardNumber, lagatbehornesrots.*, lagatbehornesrots.name as lagatbehornesrotsName FROM projects JOIN projectpadadhikaris JOIN projectkistakobiwarans JOIN projectbastugatanudans JOIN ppas JOIN wards JOIN lagatbehornesrots on (projects.id=projectpadadhikaris.projectId and projects.id=projectkistakobiwarans.projectId and projects.id=projectbastugatanudans.projectId and projects.ppaId=ppas.id and projects.wardId=wards.id and projects.lagatbehornesrotId=lagatbehornesrots.id) WHERE projects.id=?', [$request->projectId]);
        $query1 = DB::select('SELECT projectpadadhikaris.*, projectpadadhikaris.id as projectpadadhikariId, padadhikaripadas.* FROM projectpadadhikaris INNER JOIN padadhikaripadas on (projectpadadhikaris.padadhikaripadaId=padadhikaripadas.id) WHERE projectpadadhikaris.projectId=? ORDER BY padadhikaripadas.level', [$request->projectId]);
        return response(array(1,$query,$query1),201);
    }
    function getSifaris(Request $request)
    {
        $errors = false;
        $query = null;
        $query1 = null;
        $query2 = null;
        $validator = Validator::make($request->all(), [
            'id' => 'required|integer',
        ]);
        if ($validator->fails()) {
            $errors = true;
        } else {
            $query = DB::selectOne('SELECT * FROM projects WHERE id=?', [$request->id]);
            $query1 = DB::select('SELECT padadhikariharu.*, padadhikari_pada_options.* FROM padadhikariharu JOIN padadhikari_pada_options on (padadhikariharu.pada=padadhikari_pada_options.id ) WHERE record_id=?', [$query->id]);
            $query2 = DB::selectOne('SELECT COUNT(id) as jamma_padadhikariharu FROM padadhikariharu WHERE record_id=?', [$query->id]);
        }
        if ($errors === true) {
            return response(array(0, $validator->errors()));
        } else {
            return response(array(1, $query, $query1, $query2), 201);
        }
    }
    function getSearch(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'projectName' => 'required|string|max:25',
        ]);
        if ($validator->fails()) {
            return response(array(0, $validator->errors()));
        } else {
            $projects = DB::select('SELECT * FROM projects WHERE aayojanako_naam like ?', ['%' .$request->projectName. '%' ]);
            return response(array(1, $projects));
        }
    }

    function projects(Request $request)
    {
        $setting = DB::selectOne('SELECT * FROM setting Where title=? ', ["aaBa"]);
        $validator = Validator::make($request->all(), [
            'aa_ba' => 'required|string|max:10',
        ]);
        if ($validator->fails()) {
            return response(array(0, $validator->errors()));
        }
        $aaBa = $request->aa_ba==='aa_ba' ? substr($setting->option,0,4) : ( $request->aa_ba==='all' ? '' : null );
        $level = DB::selectOne('SELECT MIN(level) as level From padadhikaripadas');
        $projects = DB::select("SELECT projects.*, projects.id as projectId, projectpadadhikaris.*,projectpadadhikaris.name as projectpadadhikariName, padadhikaripadas.*, wards.*, wards.number as wardNumber FROM projects JOIN projectpadadhikaris JOIN padadhikaripadas JOIN wards on (projects.id=projectpadadhikaris.projectId and padadhikaripadas.id=projectpadadhikaris.padadhikariPadaId and projects.wardId=wards.id) WHERE padadhikaripadas.level=? and aayojana_suru_miti like ? ", [$level->level,'%' .$aaBa. '%' ]);
        return response(array(1,['projects'=>$projects, 'aaBa'=>$request->aa_ba==='aa_ba' ? $setting->option:'सबै']));
    }
    function deleteProject(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'projectId'=>'required|integer',
        ]);
        if ($validator->fails()) {
            return response(array(0, $validator->errors()));
        }
        DB::table('projects')->where('id', $request->projectId)->delete();
        $this->remoteUpdates('projects','delete',$request->projectId);
        return response(array(1,$request->projectId));
    }
    function getDashboard(Request $request)
    {
        $aa_ba = DB::selectOne('SELECT * FROM setting Where title=? ', ["aaBa"]);
        $year = substr($aa_ba->option,0,4);
        $nextYear = (int) $year + 1;

        $query1 = DB::select('SELECT sum(lagat_anuman) as lagat_anuman, count(id) as yojanaharu FROM projects WHERE aayojana_suru_miti>= ? and aayojana_suru_miti < ?', [$year . '/04/01', $year . '/05/01']);
        $query2 = DB::select('SELECT sum(lagat_anuman) as lagat_anuman, count(id) as yojanaharu FROM projects WHERE aayojana_suru_miti>= ? and aayojana_suru_miti < ?', [$year . '/05/01', $year . '/06/01']);
        $query3 = DB::select('SELECT sum(lagat_anuman) as lagat_anuman, count(id) as yojanaharu FROM projects WHERE aayojana_suru_miti>= ? and aayojana_suru_miti < ?', [$year . '/06/01', $year . '/07/01']);
        $query4 = DB::select('SELECT sum(lagat_anuman) as lagat_anuman, count(id) as yojanaharu FROM projects WHERE aayojana_suru_miti>= ? and aayojana_suru_miti < ?', [$year . '/07/01', $year . '/08/01']);
        $query5 = DB::select('SELECT sum(lagat_anuman) as lagat_anuman, count(id) as yojanaharu FROM projects WHERE aayojana_suru_miti>= ? and aayojana_suru_miti < ?', [$year . '/08/01', $year . '/09/01']);
        $query6 = DB::select('SELECT sum(lagat_anuman) as lagat_anuman, count(id) as yojanaharu FROM projects WHERE aayojana_suru_miti>= ? and aayojana_suru_miti < ?', [$year . '/09/01', $year . '/10/01']);
        $query7 = DB::select('SELECT sum(lagat_anuman) as lagat_anuman, count(id) as yojanaharu FROM projects WHERE aayojana_suru_miti>= ? and aayojana_suru_miti < ?', [$year . '/10/01', $year . '/11/01']);
        $query8 = DB::select('SELECT sum(lagat_anuman) as lagat_anuman, count(id) as yojanaharu FROM projects WHERE aayojana_suru_miti>= ? and aayojana_suru_miti < ?', [$year . '/11/01', $year . '/12/01']);
        $query9 = DB::select('SELECT sum(lagat_anuman) as lagat_anuman, count(id) as yojanaharu FROM projects WHERE aayojana_suru_miti>= ? and aayojana_suru_miti < ?', [$year . '/12/01', $nextYear . '/01/01']);
        $query10 = DB::select('SELECT sum(lagat_anuman) as lagat_anuman, count(id) as yojanaharu FROM projects WHERE aayojana_suru_miti>= ? and aayojana_suru_miti < ?', [$nextYear . '/01/01', $nextYear . '/02/01']);
        $query11 = DB::select('SELECT sum(lagat_anuman) as lagat_anuman, count(id) as yojanaharu FROM projects WHERE aayojana_suru_miti>= ? and aayojana_suru_miti < ?', [$nextYear . '/02/01', $nextYear . '/03/01']);
        $query12 = DB::select('SELECT sum(lagat_anuman) as lagat_anuman, count(id) as yojanaharu FROM projects WHERE aayojana_suru_miti>= ? and aayojana_suru_miti < ?', [$nextYear . '/03/01', $nextYear . '/04/01']);
        $selected1 = array($query1, $query2, $query3, $query4, $query5, $query6, $query7, $query8, $query9, $query10, $query11, $query12);

        $selected2 = DB::select('SELECT sum(lagat_anuman) as lagat_anuman, count(id) as yojanaharu, sum(lagat_behorne_karyalay) as lagat_behorne_karyalay, sum(lagat_behorne_upobhokta_samiti) as lagat_behorne_upobhokta_samiti, sum(lagat_behorne_anne) as lagat_behorne_anne FROM projects WHERE aayojana_suru_miti>= ? and aayojana_suru_miti < ?', [$year . '/04/01', $nextYear . '/04/01']);

        $selected3 =  DB::select('SELECT sum(lagat_anuman) as lagat_anuman, count(id) as yojanaharu, sum(lagat_behorne_karyalay) as lagat_behorne_karyalay, sum(lagat_behorne_upobhokta_samiti) as lagat_behorne_upobhokta_samiti, sum(lagat_behorne_anne) as lagat_behorne_anne, wardId FROM projects WHERE ( aayojana_suru_miti>= ? and aayojana_suru_miti < ? ) Group By wardId', [$year . '/04/01', $nextYear . '/04/01']);
        $index = 0;
        foreach ($selected3 as $value){
            $wards = DB::selectOne('SELECT * FROM wards WHERE id=?',[$value->wardId]);
            $selected3[$index]->wardNumber = $wards->number;
            $selected3[$index]->wardName = $wards->name;
            $index=$index+1;
        }

        $selected4 = DB::select('SELECT count(id) as totalCompletedWardProjects, wardId FROM projects WHERE aayojana_suru_miti>= ? and aayojana_suru_miti < ? group by wardId', [$year . '/04/01', $nextYear . '/04/01']);
        $index = 0;
        $gapa = array('totalGapaProjects'=>0,'totalCompletedGapaProjects'=>0);
        foreach ($selected4 as $item) {
            $wards = DB::selectOne('SELECT * FROM wards where id=?', [$item->wardId]);
            $totalwardprojects = DB::selectOne('SELECT * FROM totalwardprojects where wardId=? ', [$item->wardId]);
            $selected4[$index]->wardNumber = $wards->number;
            $selected4[$index]->wardName = $wards->name;
            $selected4[$index]->totalWardProjects = $totalwardprojects->total;
            $gapa['totalGapaProjects'] = $gapa['totalGapaProjects']+$totalwardprojects->total;
            $gapa['totalCompletedGapaProjects'] = $gapa['totalCompletedGapaProjects']+$item->totalCompletedWardProjects;
            $index=$index+1;
        }
        $selected4 = array($selected4,$gapa);
        return response()->json([1=>$selected1,2=>$selected2[0],3=>$selected3,4=>$selected4]);
    }

    function putDetail(Request $request)
    {
        $error=false;
        $validator = Validator::make($request->all(), [
            'bank.name' => 'nullable|string|max:25',
            'bank.addr' => 'nullable|string|max:25',
            'bank.branch' => 'nullable|string|max:25',
            'ppa.name' => 'nullable|string|max:25',
            'ppa.phone' => 'nullable|string|max:25',
            'lagatBehorneSrot.name' => 'nullable|string|max:50',
            'padadhikariPada.pada' => 'nullable|string|max:25',
            'padadhikariPada.level' => 'nullable|string|max:25',
            'padadhikariPada.vitalPost' => 'nullable|boolean',
            'ward.name' => 'nullable|string|max:25',
            'ward.number' => 'nullable|string|max:25',
            'totalWardProject.wardId' => 'nullable|integer',
            'totalWardProject.total' => 'nullable|integer',
        ]);
        if ($validator->fails()) {
            return response(array(0,$validator->errors()));
        }
        if ($request->selectedBiwaran === "bank") {
            $bankId = DB::table('banks')->insertGetId([
                    'name' => $request->bank['name'],
                    'addr' => $request->bank['addr'],
                    'branch' => $request->bank['branch'],
                ]
            );
        }
        if ($request->selectedBiwaran === "ppa") {
            $ppaId = DB::table('ppas')->insertGetId(
                [
                    'name' => $request->ppa['name'],
                    'phone' => $request->ppa['phone'],
                ]
            );
        }
        if ($request->selectedBiwaran === "lagatBehorneSrot") {
            $lagatbehornesrotId = DB::table('lagatbehornesrots')->insertGetId(
                [
                    'name' => $request->lagatBehorneSrot['name'],
                ]
            );
        }
        if ($request->selectedBiwaran === "padadhikariPada") {
            $padadhikaripadaId = DB::table('padadhikaripadas')->insertGetId(
                [
                    'pada' => $request->padadhikariPada['pada'],
                    'level' => $request->padadhikariPada['level'],
                    'vitalPost' => $request->padadhikariPada['vitalPost'],
                ]
            );
        }
        if ($request->selectedBiwaran === "ward") {
            $wardId = DB::table('wards')->insertGetId(
                [
                    'name' => $request->ward['name'],
                    'number' => $request->ward['number'],
                ]
            );
        }
        if ($request->selectedBiwaran === "totalWardProject") {
            $aa_ba = DB::selectOne('SELECT * FROM setting Where title=? ', ["aaBa"]);
            $selected = DB::table('totalwardprojects')->where('wardId',$request->totalWardProject['wardId'])->first();
            if($selected){
                DB::table('totalwardprojects')->where('wardId',$request->totalWardProject['wardId'])->update(
                    [
                        'total' => $request->totalWardProject['total'],
                        'aaBa' => $aa_ba->option
                    ],
                );
                $this->remoteUpdates('totalwardprojects','update',$selected->id);
            }else{
                $totalwardprojectId = DB::table('totalwardprojects')->insertGetId(
                    [
                        'wardId' => $request->totalWardProject['wardId'],
                        'total' => $request->totalWardProject['total'],
                        'aaBa' => $aa_ba->option
                    ]
                );
            }
        }
        if($error===true){
            return response(array(0));
        }else{
            return response(array(1));
        }
    }

    function getDetail(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'detail'=>'required|string|max:25',
        ]);
        if ($validator->fails()) {
            return response(array(0, $validator->errors()));
        }
        if($request->detail==='all'){
            $all = DB::transaction(function () {
                $banks = DB::select('SELECT * FROM banks', []);
                $ppas = DB::select('SELECT * FROM ppas', []);
                $lagatBehorneSrots = DB::select('SELECT * FROM lagatbehornesrots', []);
                $padadhikariPadas = DB::select('SELECT * FROM padadhikaripadas', []);
                $wards = DB::select('SELECT * FROM wards', []);
                $totalWardProjects = DB::select('SELECT totalwardprojects.*, wards.* FROM totalwardprojects JOIN wards on(totalwardprojects.wardId=wards.id)', []);
                return ['banks'=>$banks,'ppas'=>$ppas,'lagatBehorneSrots'=>$lagatBehorneSrots,'padadhikariPadas'=>$padadhikariPadas,'wards'=>$wards,'totalWardProjects'=>$totalWardProjects];
            });
            return response(array(1,$all));
        }
        if($request->detail==='ward'){
            $wards = DB::select('SELECT * FROM wards', []);
            return response($wards);
        }
        if($request->detail==='bank'){
            $banks = DB::select('SELECT * FROM banks', []);
            return response($banks);
        }
        if($request->options==='totalYojanaharu'){
            $yojana_sangkhya = DB::select('SELECT * FROM yojana_sangkhya where fy=?', [$request->fy]);
            return response(array('status'=>1,'yojana_sangkhya'=>$yojana_sangkhya),201);
        }
    }
    function deleteDetail(Request $request)
    {
        $error = false;
        $validator = Validator::make($request->all(), [
            'detail'=>'required|string|max:100',
            'id'=>'required|integer',
        ]);
        if ($validator->fails()) {
            return response(array(0, $validator->errors()));
        }
        if($request->detail==='bank'){
            DB::table('banks')->where('id', $request->id)->delete();
        }
        if($request->detail==='ppa'){
            DB::table('ppas')->where('id', $request->id)->delete();
        }
        if($request->detail==='padadhikariPada'){
            DB::table('padadhikariPadas')->where('id', $request->id)->delete();
        }
        if($request->detail==='lagatBehorneSrot'){
            if($request->id!==1){
                DB::table('lagatBehorneSrots')->where('id', $request->id)->delete();
            }else{
                $error = true;
                $validator->getMessageBag()->add('lagatBehorneSrot','The item can not be deleted !');
            }
        }
        if($request->detail==='ward'){
            DB::table('wards')->where('id', $request->id)->delete();
        }
        if($request->detail==='totalWardProject'){
            DB::table('totalWardProjects')->where('id', $request->id)->delete();
        }
        if($error===true){
            return response(array(0, $validator->errors()));
        }else{
            return response(array(1));
        }
    }

    function getSetting(Request $request){
        $validator = Validator::make($request->all(), [
            'setting'=>'required|string|max:10',
        ]);
        if ($validator->fails()) {
            return response(array(0,$validator->errors()));
        }
        if($request->setting==='aaBa'){
            $selected = DB::selectOne('SELECT * FROM setting Where title=?', [$request->setting]);
            return response(array(1,$selected));
        }
    }
    function updateSetting(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'selectedSetting'=>'required|string|max:25',
            'aaBa'=>'sometimes|string|max:10',
        ]);
        if ($validator->fails()) {
            return response(array(0,$validator->errors()));
        }else{
            if($request->selectedSetting==='aaBa'){
                $selected = DB::table('setting')->where('title','aaBa')->update(['option'=>$request->aaBa]);
                return response(array(1));
            }
        }
    }
    function remoteUpdates($table,$operation,$changedId){
        $bankId = DB::table('remoteUpdates')->insert([
                'table' => $table,
                'operation' => $operation,
                'changedId' => $changedId,
            ]
        );
    }
}
