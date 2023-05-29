<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>Prueba Backen - Laravel</title>
        <!-- Styles -->
        <style>
            @font-face {
                font-family: "Gridlite";
                src: url("https://assets.codepen.io/35984/GridlitePEVFWeb-All.woff2")  format('woff2');
            }

            body {
            background-color: #14213D;
            overflow: hidden;
            text-align:center;
            display: flex;
            align-items: center;
            justify-content: center;
            }
            :root {
                --wght: 100;
                --BACK: 1;
                --ESHP: 4;
            }
            body,
            html {
            height: 100%;
            width: 100%;
            }


            #msg{
                font-family:'Gridlite';
                color: #FCA311;
                font-size: 20vh;
            }
            #msg div {
                font-variation-settings:  'wght' var(--wght), "BACK"  var(--BACK), "ESHP" var(--ESHP);
            }
        </style>
        <script type="text/javascript">
            let myST = new SplitText('#msg', {type: 'words,chars'})

            let tl = gsap.timeline({
            repeat: -1
            });
            let duration = 0.65;
            let stagger = 0.15;
            tl.to(myST.chars, {
                duration: duration,
                '--wght': 900,
                stagger: {
                    each: stagger,
                    repeat: -1,
                repeatDelay: 2.6,
                    yoyo: true
                },
                ease: 'sine.inOut'
            })
            .to(myST.chars, {
                duration: duration,
                '--ESHP': 3,
            color: '#F2F7F2',
                stagger: {
                    each: stagger,
                    repeat: -1,
                repeatDelay: 2.6,
                    yoyo: true
                },
                ease: 'sine.inOut'
            }, 0)
            .to(myST.chars, {
                duration: duration,
                '--wght': 20,
                stagger: {
                    each: stagger,
                repeatDelay: 2.6,
                    repeat: -1,
                    yoyo: true
                },
                ease: 'sine.inOut'
            }, 1.3)
            .to(myST.chars, {
                duration: duration,
                '--ESHP': 2,
                stagger: {
                    each: stagger,
                repeatDelay: 2.6,
                    repeat: -1,
                    yoyo: true
                },
                ease: 'sine.inOut'
            }, 1.3)
        </script>
    </head>
    <body class="antialiased">
        <div id="msg">PRUEBA BACKEND </div>
    </body>
</html>
