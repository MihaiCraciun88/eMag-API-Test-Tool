<?php

namespace App\Http\Controllers;

use App\Models\UserIp;
use Illuminate\Http\Request;

class UserIpController extends Controller
{
    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $long = ip2long($request->ip);

        if ($long == -1 || $long === FALSE) {
            return redirect()->back()
                ->with('error', 'Invalid IP, please try again.');
        }

        UserIp::create([
            'user_id'   => $request->user_id,
            'ip'        => $long
        ]);

        return redirect()->back()
            ->with('success', 'Ip created successfully.');
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\UserIp  $userIp
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, UserIp $userIp)
    {
        return redirect()->back()
            ->with('success', 'Ip updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\UserIp  $userIp
     * @return \Illuminate\Http\Response
     */
    public function destroy(int $user, UserIp $ip)
    {
        $ip->delete();
        return redirect()->back()
            ->with('success', 'Ip deleted successfully.');
    }
}
