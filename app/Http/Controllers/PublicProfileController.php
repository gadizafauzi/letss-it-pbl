<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\CmsHeroSection;
use App\Models\CmsWelcomeMessage;
use App\Models\CmsVisi;
use App\Models\CmsMisiItem;
use App\Models\CmsSejarahItem;

class PublicProfileController extends Controller
{
    public function index()
    {
        $hero = CmsHeroSection::where('page', 'profil')->where('is_active', true)->first();
        
        $welcomeMessage = CmsWelcomeMessage::where('is_active', true)->first();
        
        $visi = CmsVisi::where('is_active', true)->first();
        
        $misiItems = CmsMisiItem::where('is_active', true)->orderBy('order')->get();
        
        $sejarahItems = CmsSejarahItem::where('is_active', true)->orderBy('order')->get();

        return view('public.profil.index', compact(
            'hero',
            'welcomeMessage',
            'visi',
            'misiItems',
            'sejarahItems'
        ));
    }
}
