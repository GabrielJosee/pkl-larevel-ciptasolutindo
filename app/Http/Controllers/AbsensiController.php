<?php

namespace App\Http\Controllers;

use App\Models\SystemUserGroup;
use App\Models\User;
use Illuminate\Http\Request;
use App\Models\Absensi;
use App\Models\Jadwal;
use App\Models\Player;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Controller;
use App\Models\TimBasket;
use App\Models\timbasketplay;
use Illuminate\Support\Facades\Session;


class AbsensiController extends Controller
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

    public function index()
    {
        $systemusergroup = SystemUserGroup::where('data_state', 0)->get()->pluck('user_group_name', 'user_group_id');

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

        $player = Player::where('data_state', '=', 0)->get();

        $currentDayOfWeek = now()->format('N');

        $currentDateTime = Carbon::now('Asia/Jakarta')->format('Y-m-d\TH:i');
        
        $jadwal = Jadwal::where('data_state', '=', 0)
            ->where('training_day', $currentDayOfWeek)
            ->whereTime('start_time', '<=', $currentDateTime)
            ->whereTime('end_time', '>=', $currentDateTime)
            ->get();

        $userIsPlayer = $systemuser->contains(function ($user) use ($user_group_id) {
            return $user->id_player == $user_group_id;
        });

        if (!$userIsPlayer) {
            return redirect()->route('absensi')->with('error', 'Anda tidak dapat melakukan absen pada jadwal ini.');
        }

        return view('content.Absen.Absensi', compact('player', 'jadwal', 'systemuser', 'systemusergroup', 'currentDateTime'));
    }

    public function Absen(Request $request)
    {
        $currentDateTime = Carbon::now('Asia/Jakarta')->format('Y-m-d\TH:i');

        $request->validate([
            'timetable_id' => 'required',
            'attendance_datetime' => 'required',
        ]);

        $user = Auth::user();

        $playerId = $user->id_player;

        if (!$playerId) {
            return redirect()->route('absensi')->with('error', 'Anda tidak memiliki id_player yang valid.');
        }

        $playerInTeam = TimBasketplay::where('id_player', $playerId)->first();

        if (!$playerInTeam) {
            return redirect()->route('absensi')->with('error', 'Anda tidak tergabung dalam tim.');
        }

        $jadwal = Jadwal::where('start_time', '<=', $currentDateTime)
            ->whereTime('end_time', '>=', $currentDateTime)
            ->whereTime('id_team', $playerInTeam->id_team)
            ->first();

        if ($jadwal != null) {
            $absen = [
                'timetable_id' => $request->timetable_id,
                'id_player' => $playerId,
                'attendance_datetime' => $request->attendance_datetime,
            ];

            Absensi::create($absen);

            $msg = 'Absensi Berhasil';
            return redirect()->to('/home')->with('msg', $msg);
        } else {
            return redirect()->route('absensi')->with('error', 'Absen gagal, Ini bukan jadwal latihan mu.');
        }
    }
}
