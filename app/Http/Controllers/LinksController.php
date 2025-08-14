<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Links;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;
use LaravelQRCode\Facades\QRCode;

class LinksController extends Controller
{
    public function createLink(Request $request)
    {

        if (!$request->user()) {
            return response()->json(['error' => 'Usuário não autenticado'], 401);
        }

        $validated = $request->validate([
            'original_url' => 'required|url',
            'expires_at' => 'nullable|date|after:now'
        ], [
            'original_url.required' => 'A URL é obrigatória.',
            'original_url.url' => 'A URL fornecida é inválida.',
            'expires_at.date' => 'A data de expiração deve ser uma data válida.',
            'expires_at.after' => 'A data de expiração deve ser no futuro.'
        ]);

        $uuid = Str::uuid()->toString();
        $slug = str_replace('-', "", $uuid);


        $link = new Links;
        $link->user_id = $request->user()->id;
        $link->original_url = $request->original_url;
        $link->slug = $slug;
        $link->status = 'active'; //default = active
        $link->expires_at = $request->expires_at;
        $link->click_count = 0; //default = 0
        $link->save();


        return response()->json([
            'message' => 'Link criado com sucesso!',
            'slug' => $slug,

        ], 201);
    }

    public function fetchLinkUser(Request $request)
    {
        if (!$request->user()) {
            return response()->json(['error' => 'Usuário não autenticado'], 401);
        }

        $idUser = $request->user()->id;
        $links = Links::where('user_id', $idUser)->get();

        return response()->json($links, 200);
    }

    public function redirectOriginalUrl($slug)
    {
        $captureUrl = Links::where('slug', $slug)->first();

        if (!$captureUrl) {
            return response()->json(['error' => 'Link não encontrado'], 404);
        }

        $currentDateTime = now()->toDateTimeString();

        if ($captureUrl->status === 'expired') {
            return response()->json(['message' => 'link expirado'], 410);
        }

        if ($captureUrl->status === 'inactive') {
            return response()->json(['message' => 'link inativo'], 404);
        }

        if ($captureUrl->expires_at && $captureUrl->expires_at < $currentDateTime) {
            $captureUrl->status = 'expired';
            $captureUrl->save();
            return response()->json(['message' => 'link expirado']);
        }
        $clientIP = request()->ip();
        $link_id = $captureUrl->id;
        $agent = request()->server('HTTP_USER_AGENT');

        DB::table('visits')->insert([
            'link_id' => $link_id,
            'ip_hash' => $clientIP,
            'user_agent' => $agent,
            'created_at' => now()
        ]);
        $captureUrl->increment('click_count');
        return redirect($captureUrl->original_url, 302);
    }

    public function totalLinks(Request $request)
    {
        if (!$request->user()) {
            return response()->json([
                'message' => 'usuario não autenticado'
            ], 401);
        }
        $idUser = $request->user()->id;
        $totalLinks = Links::where('user_id', $idUser)->count();



        return response()->json([
            'total_links' => $totalLinks,
        ]);
    }
    public function totalClick(Request $request)
    {
        if (!$request->user()) {
            return response()->json([
                'message' => 'usuario não autenticado'
            ], 401);
        }

        $idUser = $request->user()->id;
        $totalClicks = Links::where('user_id', $idUser)->sum('click_count');

        return response()->json([

            'total_click' => $totalClicks,

        ]);
    }
    public function activeExpired(Request $request)
    {
        if (!$request->user()) {
            return response()->json([
                'message' => 'usuario não autenticado'
            ], 401);
        }
        $idUser = $request->user()->id;

        $linksActive = Links::where('user_id', $idUser)->where('status', 'active')->count();

        $linksExpired = Links::where('user_id', $idUser)->where('status', 'expired')->count();

        return response()->json([

            'links_active' => $linksActive,
            'links_expired' => $linksExpired,

        ]);
    }
    public function topClick(Request $request)
    {
        if (!$request->user()) {
            return response()->json([
                'message' => 'usuario não autenticado'
            ], 401);
        }

        $idUser = $request->user()->id;
        $topClick = Links::where('user_id', $idUser)->orderByDesc('click_count')->limit(10)->select('slug', 'original_url', 'click_count')->get();


        return response()->json([
            'top_click' => $topClick
        ]);
    }
}
