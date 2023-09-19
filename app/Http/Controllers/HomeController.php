<?php

namespace App\Http\Controllers;

use App\Models\Jadwal;
use App\Models\JadwalKesehatan;
use App\Models\PenilaianKesehatan;
use App\Models\Player;
use App\Models\SlideShow;
use App\Models\SystemUserGroup;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {


        $berita = SlideShow::where('data_state', 0)->whereDate('start_date', '<=', now())->whereDate('end_date', '>=', now())->get();
        $systemusergroup = SystemUserGroup::where('data_state', '=', 0)->get()->pluck('user_group_name', 'user_group_id');

        $systemuser = User::select('system_user.*', 'system_user_group.user_group_level')
            ->join('system_user_group', 'system_user.user_group_id', 'system_user_group.user_group_id')
            ->where('system_user.data_state', 0);

        if (!Session::get('user_group_id')) {
            $user_group_id = null;
            $systemuser = $systemuser->get();
        } else {
            $user_group_id = Session::get('user_group_id');
            $systemuser = $systemuser->where('system_user.user_group_id', $user_group_id)->get();
        }

        $currentDayOfWeek = now()->format('N');

        $currentDateTime = Carbon::now('Asia/Jakarta')->format('Y-m-d\TH:i');

        $jadwal = Jadwal::where('data_state', '=', 0)
            ->where('training_day', $currentDayOfWeek)
            ->whereTime('end_time', '>=', $currentDateTime)
            ->get();

        $jadwal_penilaian_kesehatan = JadwalKesehatan::where('data_state', 0)->get();

        $penilaian_kesehatan = PenilaianKesehatan::select(
            'health_assessment.*',
            'player.player_name',
            'health_assessment_categories.name_assessment'
        )
            ->join('player', 'health_assessment.id_player', '=', 'player.id_player')
            ->join('health_assessment_categories', 'health_assessment.health_assessment_categories_id', '=', 'health_assessment_categories.health_assessment_categories_id')
            ->where('health_assessment.data_state', 0)
            ->get();

        $value = PenilaianKesehatan::select('health_assessment.health_assessment_id', DB::raw('SUM(mark_health) as mark_health'))
            ->groupBy('health_assessment_id')
            ->pluck('mark_health');

        $menus =  User::select('system_menu_mapping.*', 'system_menu.*')
            ->join('system_user_group', 'system_user_group.user_group_id', '=', 'system_user.user_group_id')
            ->join('system_menu_mapping', 'system_menu_mapping.user_group_level', '=', 'system_user_group.user_group_level')
            ->join('system_menu', 'system_menu.id_menu', '=', 'system_menu_mapping.id_menu')
            ->where('system_user.user_id', '=', Auth::id())
            ->orderBy('system_menu_mapping.id_menu', 'ASC')
            ->get();

        return view('home', compact('menus', 'jadwal', 'systemuser', 'berita', 'penilaian_kesehatan', 'jadwal_penilaian_kesehatan', 'value'));
    }
}
