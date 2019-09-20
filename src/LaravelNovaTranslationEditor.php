<?php

namespace Eboye\LaravelNovaTranslationEditor;

use Illuminate\View\View;
use Laravel\Nova\Nova;
use Laravel\Nova\Tool;

class LaravelNovaTranslationEditor extends Tool
{
    /**
     * Perform any tasks that need to happen when the tool is booted.
     *
     * @return void
     */
    public function boot()
    {
        Nova::script('laravel-nova-translation-editor', __DIR__.'/../dist/js/tool.js');
        Nova::style('laravel-nova-translation-editor', __DIR__.'/../dist/css/tool.css');
    }

    /**
     * Build the view that renders the navigation links for the tool.
     *
     * @return View
     */
    public function renderNavigation()
    {
        return view('laravel-nova-translation-editor::navigation');
    }
}
