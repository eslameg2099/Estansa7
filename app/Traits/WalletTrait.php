<?php

namespace App\Traits;

use App\Http\Resources\WalletResource;
use App\Models\User;
use App\Models\Wallet;
use App\Models\Withdrawal;
use Illuminate\Support\Arr;
use phpDocumentor\Reflection\Types\Boolean;

trait WalletTrait
{
    /**
     * Check if user can withdrew.
     *
     * @param object $this
     *
     * @return bool
     */
    public function can_withdrew($value)
    {
        if (auth()->user()->type == User::ADMIN_TYPE) return true;
        return ($this->wallet()->sum('transaction') + ($value*-1) >= 0);
    }

    /**
     * Check if user can withdrew.
     *
     * @param object $record
     *
     * @return object
     */
    public function withdrewRequest($record){
        $withdrew_request = Withdrawal::create($record);
        return $withdrew_request;
    }
    public function withdrew($user,$record)
    {
        $record['title'] = 'withdrew';
        $wallet = $user->wallet()->create($record);
        return $wallet;
    }

    public function deposite($user,$record)
    {
        $record['title'] = 'deposit';
        $wallet = $user->wallet()->create($record);
        return $wallet;
    }
    public function fastWithdrew($value){
        $transaction = $this->withdrew(auth()->user(),
            [
            'transaction' => $value * (-1),
            'status' => Wallet::TRANSFER_STATUS
        ]);
        return $transaction;
    }
    public function fastDeposit($user,$value){
        $transaction = $this->deposite($user,
            [
                'transaction' => $value * (1),
                'status' => Wallet::REQUEST_STATUS,
            ]);
        return $transaction;
    }
    public function transferMoney($sender, $receiver, $value , $note = null)
    {
         $this->withdrew($sender,
            [
            'transaction' => $value * (-1),
            'status' => Wallet::TRANSFER_STATUS,
            'note' => $note
            ]);
        $this->deposite($receiver,
            [
                'transaction' => $value * (1),
                'status' => Wallet::TRANSFER_STATUS,
                'note' => $note
            ]);
        return true;
    }
    public function getBalance() {
        return $this->wallet()->sum('transaction');
    }
}
