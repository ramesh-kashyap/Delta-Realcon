<?php

namespace App\Http\Controllers\UserPanel;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Income;
use App\Models\Reward;
use App\Models\Boost_direct;
use App\Models\User_trade;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class Bonus extends Controller
{
  public function index(Request $request)
  {
    $user = Auth::user();

    $limit = $request->limit ? $request->limit : paginationLimit();
    $status = $request->status ? $request->status : null;
    $search = $request->search ? $request->search : null;
    $notes = Income::where('user_id', $user->id)->where('remarks', 'Level Bonus')->orderBy('id', 'DESC');
    if ($search <> null && $request->reset != "Reset") {
      $notes = $notes->where(function ($q) use ($search) {
        $q->Where('rname', 'LIKE', '%' . $search . '%')
          ->orWhere('ttime', 'LIKE', '%' . $search . '%')
          ->orWhere('level', 'LIKE', '%' . $search . '%')
          ->orWhere('amt', 'LIKE', '%' . $search . '%')
          ->orWhere('comm', 'LIKE', '%' . $search . '%');
      });
    }
    $notes = $notes->paginate($limit)
      ->appends([
        'limit' => $limit
      ]);
    $this->data['level_income'] = $notes;
    $this->data['search'] = $search;
    $this->data['page'] = 'user.bonus.level-income';
    return $this->dashboard_layout();
  }
  public function direct_bonus(Request $request)
  {
    $user = Auth::user();

    $limit = $request->limit ? $request->limit : paginationLimit();
    $status = $request->status ? $request->status : null;
    $search = $request->search ? $request->search : null;
    $notes = Income::where('user_id', $user->id)->where('remarks', 'Direct Bonus')->orderBy('id', 'DESC');
    if ($search <> null && $request->reset != "Reset") {
      $notes = $notes->where(function ($q) use ($search) {
        $q->Where('rname', 'LIKE', '%' . $search . '%')
          ->orWhere('ttime', 'LIKE', '%' . $search . '%')
          ->orWhere('level', 'LIKE', '%' . $search . '%')
          ->orWhere('amt', 'LIKE', '%' . $search . '%')
          ->orWhere('comm', 'LIKE', '%' . $search . '%');
      });
    }
    $notes = $notes->paginate($limit)
      ->appends([
        'limit' => $limit
      ]);
    $this->data['level_income'] = $notes;
    $this->data['search'] = $search;
    $this->data['page'] = 'user.bonus.direct-bonus';
    return $this->dashboard_layout();
  }

  public function cashback_income(Request $request)
  {
    $user = Auth::user();

    $limit = $request->limit ? $request->limit : paginationLimit();
    $status = $request->status ? $request->status : null;
    $search = $request->search ? $request->search : null;
    $notes = Income::where('user_id', $user->id)->where('remarks', 'Matching Bonus')->orderBy('id', 'DESC');
    if ($search <> null && $request->reset != "Reset") {
      $notes = $notes->where(function ($q) use ($search) {
        $q->Where('rname', 'LIKE', '%' . $search . '%')
          ->orWhere('ttime', 'LIKE', '%' . $search . '%')
          ->orWhere('level', 'LIKE', '%' . $search . '%')
          ->orWhere('amt', 'LIKE', '%' . $search . '%')
          ->orWhere('comm', 'LIKE', '%' . $search . '%');
      });
    }
    $notes = $notes->paginate($limit)
      ->appends([
        'limit' => $limit
      ]);
    $this->data['level_income'] = $notes;
    $this->data['search'] = $search;
    $this->data['page'] = 'user.bonus.cashback-income';
    return $this->dashboard_layout();
  }

  public function activitiesBonus(Request $request)
  {
    $user = Auth::user();

    $limit = $request->limit ? $request->limit : paginationLimit();
    $status = $request->status ? $request->status : null;
    $search = $request->search ? $request->search : null;
    $notes = Income::where('user_id', $user->id)->where('remarks', 'Activities Bonus')->orderBy('id', 'DESC');
    if ($search <> null && $request->reset != "Reset") {
      $notes = $notes->where(function ($q) use ($search) {
        $q->Where('rname', 'LIKE', '%' . $search . '%')
          ->orWhere('ttime', 'LIKE', '%' . $search . '%')
          ->orWhere('level', 'LIKE', '%' . $search . '%')
          ->orWhere('amt', 'LIKE', '%' . $search . '%')
          ->orWhere('comm', 'LIKE', '%' . $search . '%');
      });
    }
    $notes = $notes->paginate($limit)
      ->appends([
        'limit' => $limit
      ]);
    $this->data['level_income'] = $notes;
    $this->data['search'] = $search;
    $this->data['page'] = 'user.bonus.activitiesBonus';
    return $this->dashboard_layout();
  }


  public function gap_margin_bonus(Request $request)
  {
    $user = Auth::user();

    $limit = $request->limit ? $request->limit : paginationLimit();
    $status = $request->status ? $request->status : null;
    $search = $request->search ? $request->search : null;
    $notes = Income::where('user_id', $user->id)->where('remarks', 'Gap Margin Bonus')->orderBy('id', 'DESC');
    if ($search <> null && $request->reset != "Reset") {
      $notes = $notes->where(function ($q) use ($search) {
        $q->Where('rname', 'LIKE', '%' . $search . '%')
          ->orWhere('ttime', 'LIKE', '%' . $search . '%')
          ->orWhere('level', 'LIKE', '%' . $search . '%')
          ->orWhere('amt', 'LIKE', '%' . $search . '%')
          ->orWhere('comm', 'LIKE', '%' . $search . '%');
      });
    }
    $notes = $notes->paginate($limit)
      ->appends([
        'limit' => $limit
      ]);
    $this->data['level_income'] = $notes;
    $this->data['search'] = $search;
    $this->data['page'] = 'user.bonus.gap-margin-bonus';
    return $this->dashboard_layout();
  }



  public function dailyIncentive(Request $request)
  {
    $user = Auth::user();

    $limit = $request->limit ? $request->limit : paginationLimit();
    $status = $request->status ? $request->status : null;
    $search = $request->search ? $request->search : null;
    $notes = Income::where('user_id', $user->id)->where('remarks', 'Roi Bonus')->orderBy('id', 'DESC');
    if ($search <> null && $request->reset != "Reset") {
      $notes = $notes->where(function ($q) use ($search) {
        $q->Where('rname', 'LIKE', '%' . $search . '%')
          ->orWhere('ttime', 'LIKE', '%' . $search . '%')
          ->orWhere('level', 'LIKE', '%' . $search . '%')
          ->orWhere('amt', 'LIKE', '%' . $search . '%')
          ->orWhere('comm', 'LIKE', '%' . $search . '%');
      });
    }
    $notes = $notes->paginate($limit)
      ->appends([
        'limit' => $limit
      ]);
    $this->data['level_income'] = $notes;
    $this->data['search'] = $search;
    $this->data['page'] = 'user.bonus.daily-incentive';
    return $this->dashboard_layout();
  }



  public function reward_income(Request $request)
  {
    $user = Auth::user();


    $limit = $request->limit ? $request->limit : paginationLimit();
    $status = $request->status ? $request->status : null;
    $search = $request->search ? $request->search : null;
    $notes = Income::where('user_id', $user->id)->where('remarks', 'Royalty Bonus')->orderBy('id', 'DESC');

    if ($search <> null && $request->reset != "Reset") {
      $notes = $notes->where(function ($q) use ($search) {
        $q->Where('ttime', 'LIKE', '%' . $search . '%')
          ->orWhere('amt', 'LIKE', '%' . $search . '%')
          ->orWhere('rname', 'LIKE', '%' . $search . '%')
          ->orWhere('comm', 'LIKE', '%' . $search . '%');
      });
    }

    $notes = $notes->paginate($limit)
      ->appends([
        'limit' => $limit
      ]);

    $this->data['level_income'] = $notes;
    $this->data['search'] = $search;
    $this->data['page'] = 'user.bonus.reward-bonus';
    return $this->dashboard_layout();
  }



  public function roi_income(Request $request)
  {
    $user = Auth::user();


    $limit = $request->limit ? $request->limit :  paginationLimit();
    $status = $request->status ? $request->status : null;
    $search = $request->search ? $request->search : null;
    $notes = Income::where('user_id', $user->id)->where('remarks', 'Roi Bonus')->orderBy('id', 'DESC');
    if ($search <> null && $request->reset != "Reset") {
      $notes = $notes->where(function ($q) use ($search) {
        $q->Where('ttime', 'LIKE', '%' . $search . '%')
          ->orWhere('amt', 'LIKE', '%' . $search . '%')
          ->orWhere('rname', 'LIKE', '%' . $search . '%')
          ->orWhere('comm', 'LIKE', '%' . $search . '%');
      });
    }

    $notes = $notes->paginate($limit)
      ->appends([
        'limit' => $limit
      ]);
      $notes->getCollection()->transform(function ($item, $key) use ($notes) {
        $item->index = $key + 1 + (($notes->currentPage() - 1) * $notes->perPage());
        return $item;
    });
    $note = Income::where('user_id', $user->id)->where('remarks', 'Roi Bonus')->orderBy('id', 'DESC');

    $this->data['level_income'] = $notes;
    $this->data['directbonus'] = $note;
    $this->data['search'] = $search;
    $this->data['page'] = 'user.bonus.roi-bonus';
    return $this->dashboard_layout();
  }
}
