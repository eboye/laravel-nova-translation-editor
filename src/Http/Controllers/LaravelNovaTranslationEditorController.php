<?php

namespace Eboye\LaravelNovaTranslationEditor\Http\Controllers;

use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Routing\Controller;
use Illuminate\Routing\ResponseFactory;
use Illuminate\Support\Facades\Lang;
use Spatie\TranslationLoader\LanguageLine;

class LaravelNovaTranslationEditorController extends Controller {
    use ValidatesRequests;

    /**
     * @param Request $request
     *
     * @return array
     */
    public function index( Request $request ) {
        $translatables = config( 'trans_editor' );
        $response      = [];
        foreach ( $translatables as $translatable ) {
            $response[ $translatable ] = Lang::get( $translatable );
        }

        return $response;
    }

    /**
     * @param Request $request
     *
     * @return ResponseFactory|Response
     */
    public function save( Request $request ) {
        if ( $request->has( [ 'group', 'key', 'text', 'locale' ] ) ) {
            return LanguageLine::updateOrCreate(
                [
                    'group' => $request->get( 'group' ),
                    'key'   => $request->get( 'key' )
                ],
                [
                    'group' => $request->get( 'group' ),
                    'key'   => $request->get( 'key' ),
                    'text'  => [
                        $request->get( 'locale' ) => $request->get( 'text' )
                    ],
                ]
            );
        } else {
            return response( null, 400 );
        }
    }
}
