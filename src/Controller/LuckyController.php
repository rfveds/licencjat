<?php
// src/Controller/LuckyController.php
namespace App\Controller;

use MikeAlmond\Color\Color;
use MikeAlmond\Color\CssGenerator;
use MikeAlmond\Color\PaletteGenerator;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;



class LuckyController extends AbstractController
{
    /**
     * @Route(
     *  "/lucky"
     *  name="lucky")
     */
    public function test(Request $request)
    {

        $baseColor = Color::fromHex($request->query->get('color') ?? '0049B7');
        $generator = new PaletteGenerator($baseColor);
        $distance  = 30;

        $palette = $generator->triad($distance);
        array_push($palette, $baseColor->darken(20));



        return print sprintf(

            '  
            <link rel="preconnect" href="https://fonts.googleapis.com">
            <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
            <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@300;400&display=swap" rel="stylesheet">
            <link href="https://fonts.googleapis.com/css?family=Roboto&display=swap" rel="stylesheet">
        
            <script src="https://kit.fontawesome.com/ebdd806b2b.js" crossorigin="anonymous"></script>
            <style>
            body {
                margin: 0;
                font-family: Roboto, sans-serif
            }
            .wrapper {
                width: 100%%;
                height: 100vh;
                display: grid;
                grid-template-areas: "s m";
                grid-template-rows: 1fr;
                grid-template-columns: 150px 1fr
            }
            .settings {
                grid-area: s
            }
            .main__content {
                grid-area: m;
                width: 100%%;
                height: 100vh;
                display: grid;
                grid-template-areas:
                    "logo logo logo search"
                    "graphic graphic nav nav"
                    "graphic graphic text text"
                    "graphic graphic social social";
                grid-template-rows: 6rem 25%% 1fr 17%%;
                grid-template-columns: 40%% 1fr 1fr 20%%
            }
            .logo {
                font-size: 64px !important;
                grid-area: logo;
                width: 100%%;
                height: 100%%;
                display: flex;
                justify-content: flex-start;
                align-items: center;
                padding-left: 4rem !important; 
                padding-top: 1rem !important
            }
            .search {
                grid-area: search;
                width: 100%%;
                height: 100%%
            }
            .graphic {
                grid-area: graphic;
                width: 100%%;
                height: 100%%
            }
            .nav {
                grid-area: nav;
                width: 100%%;
                height: 100%%;
                display: flex;
                justify-content: flex-end
            }
            .nav__content {
                margin-right: 6rem;
                margin-top: 1.5rem
            }
            .text {
                grid-area: text;
                width: 100%%;
                height: 100%%;
                display: flex;
                justify-content: flex-start;
                flex-direction: column;
                align-items: center
            }
            .text__header {
                text-align: center;
                font-size: 64px;
                margin-top: 6rem
            }
            .text__header p {
                margin-bottom: 0;
                margin-top: 0
            }
            .text__content {
                text-align: center;
                width: 50%%
            }
            .social {
                grid-area: social;
                width: 100%%;
                height: 100%%;
                display: flex;
                justify-content: center;
                align-items: center;
                gap: 20px
            }
            .search {
                display: flex;
                justify-content: center;
                align-items: center
            }
            .search__bar {
                width: 230px;
                height: 30px;
                border-radius: 15%%
            }
            .search_wrapper {
                width: 100%%;
                max-width: 30rem;
                margin: 6rem auto;
                margin-top: 1rem
            }
            .square {
                height: 300px;
                width: 300px;
                position: absolute;
                top: 250px;
                left: 270px;
                z-index: 1;
            }
            .circle {
                border-radius: 50%%;
                height: 400px;
                width: 400px;
                position: absolute;
                top: 450px;
                left: 350px;
                z-index: 0;
            }
            .label {
                font-size: .625rem;
                font-weight: 400;
                text-transform: uppercase;
                letter-spacing: +1.3px;
                margin-bottom: 1rem
            }
            .searchBar {
                width: 100%%;
                display: flex;
                flex-direction: row;
                align-items: center
            }
            #searchQueryInput {
                width: 100%%;
                height: 2.8rem;
                outline: 0;
                border: none;
                border-radius: 1.625rem;
                padding: 0 3.5rem 0 1.5rem;
                font-size: 1rem
            }
            #searchQuerySubmit {
                width: 3.5rem;
                height: 2.8rem;
                margin-left: -3.5rem;
                background: 0 0;
                border: none;
                outline: 0
            }
            #searchQuerySubmit:hover {
                cursor: pointer
            }
            
            .settings {
                background-color: #ccc
            }
        
            /* background colors */
            #searchQueryInput,
            .graphic,
            .logo,
            .nav,
            .search,
            .social,
            .text {
                background-color: #%s
            }
            /* element 1 colors */
            p {
                color: #%s;
            }
            
            .square {
                background-color: #%s
            }
            
        
            /* element 2 colors */
            .circle
             {
                background-color: #%s
            }
        
            .fa-brands {
                color: #%s
            }
        
            </style>
        
        <div class="wrapper">
        
            <div class="settings">
            
            <form mtehod="GET" action="" >
                <input name="color" type="color"></input>
                <button type="submit">Submit</button>
            </form>
        
        
            </div>
            <div class="main__content">
                <div class="logo">
                    <p>LOGO</p>
                </div>
        
                <div class="search">
                    <div class="search__wrapper">
                        <div class="searchBar">
                            <input id="searchQueryInput" type="text" name="searchQueryInput" placeholder="Szukaj" value="" />
                            <button id="searchQuerySubmit" type="submit" name="searchQuerySubmit">
                                <svg style="width:24px;height:24px" viewBox="0 0 24 24">
                                    <path fill="#666666" d="M9.5,3A6.5,6.5 0 0,1 16,9.5C16,11.11 15.41,12.59 14.44,13.73L14.71,14H15.5L20.5,19L19,20.5L14,15.5V14.71L13.73,14.44C12.59,15.41 11.11,16 9.5,16A6.5,6.5 0 0,1 3,9.5A6.5,6.5 0 0,1 9.5,3M9.5,5C7,5 5,7 5,9.5C5,12 7,14 9.5,14C12,14 14,12 14,9.5C14,7 12,5 9.5,5Z" />
                                </svg>
                            </button>
                        </div>
                    </div>
        
                </div>
        
                <div class="nav">
                    <div class="nav__content">
                        <p>Dolor</p>
                        <p>Est</p>
                        <p>Cras</p>
                        <p>Nisl vel</p>
                    </div>
                </div>
        
                <div class="text">
                    <div class="text__header">
                        <p>Massa sed et</p>
                    </div>
                    <div class="text__content">
                        <p>Pharetra, arcu, pretium aenean donec velit llamcorper nulla rutrum ipsum egestas dictumst.</p>
                    </div>
                </div>
        
                <div class="graphic">
                    <div class="square">
                    </div>
                    <div class="circle">
                    </div>
                </div>
        
                <div class="social">
                    <div class="facebook">
                        <i class="fa-brands fa-facebook-square fa-4x"></i>
                    </div>
                    <div class="instagram">
                        <i class="fa-brands fa-instagram fa-4x"></i>
                    </div>
                    <div class="linkedin">
                        <i class="fa-brands fa-linkedin fa-4x"></i>
                    </div>
                    <div class="twitter">
                        <i class="fa-brands fa-twitter-square fa-4x"></i>
                    </div>
                </div>
            </div>
        </div>
        ',
            $palette[0]->getHex(),
            $palette[1]->getHex(),
            $palette[1]->getHex(),
            $palette[2]->getHex(),
            $palette[2]->getHex(),
        );
    }
}
