{{--<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.0 Transitional//EN">--}}

{{--<HTML>--}}

{{--<HEAD>--}}

{{--    <TITLE> New Document </TITLE>--}}

{{--    <META NAME="Generator" CONTENT="EditPlus">--}}

{{--    <META NAME="Author" CONTENT="">--}}

{{--    <META NAME="Keywords" CONTENT="">--}}

{{--    <META NAME="Description" CONTENT="">--}}

{{--    <style>--}}
{{--        html,--}}
{{--        body {--}}

{{--            height: 100%;--}}

{{--            padding: 0;--}}

{{--            margin: 0;--}}

{{--            background: #000;--}}

{{--        }--}}

{{--        canvas {--}}

{{--            position: absolute;--}}

{{--            width: 100%;--}}

{{--            height: 100%;--}}

{{--        }--}}
{{--    </style>--}}

{{--</HEAD>--}}


{{--<BODY>--}}
{{--<h1><span style="color: #dfc2c4;"><i>Sắp sinh nhựt rùi, bé thích quà zì nè. hehehe</i></span></h1>--}}
{{--<canvas id="pinkboard"></canvas>--}}

{{--<script>--}}
{{--    /*--}}

{{--* Settings--}}

{{--*/--}}

{{--    var settings = {--}}

{{--        particles: {--}}

{{--            length:   500, // maximum amount of particles--}}

{{--            duration:   2, // particle duration in sec--}}

{{--            velocity: 100, // particle velocity in pixels/sec--}}

{{--            effect: -0.75, // play with this for a nice effect--}}

{{--            size:      30, // particle size in pixels--}}

{{--        },--}}

{{--    };--}}


{{--    /*--}}

{{--     * RequestAnimationFrame polyfill by Erik Möller--}}

{{--     */--}}

{{--    (function(){var b=0;var c=["ms","moz","webkit","o"];for(var a=0;a<c.length&&!window.requestAnimationFrame;++a){window.requestAnimationFrame=window[c[a]+"RequestAnimationFrame"];window.cancelAnimationFrame=window[c[a]+"CancelAnimationFrame"]||window[c[a]+"CancelRequestAnimationFrame"]}if(!window.requestAnimationFrame){window.requestAnimationFrame=function(h,e){var d=new Date().getTime();var f=Math.max(0,16-(d-b));var g=window.setTimeout(function(){h(d+f)},f);b=d+f;return g}}if(!window.cancelAnimationFrame){window.cancelAnimationFrame=function(d){clearTimeout(d)}}}());--}}


{{--    /*--}}

{{--     * Point class--}}

{{--     */--}}

{{--    var Point = (function() {--}}

{{--        function Point(x, y) {--}}

{{--            this.x = (typeof x !== 'undefined') ? x : 0;--}}

{{--            this.y = (typeof y !== 'undefined') ? y : 0;--}}

{{--        }--}}

{{--        Point.prototype.clone = function() {--}}

{{--            return new Point(this.x, this.y);--}}

{{--        };--}}

{{--        Point.prototype.length = function(length) {--}}

{{--            if (typeof length == 'undefined')--}}

{{--                return Math.sqrt(this.x * this.x + this.y * this.y);--}}

{{--            this.normalize();--}}

{{--            this.x *= length;--}}

{{--            this.y *= length;--}}

{{--            return this;--}}

{{--        };--}}

{{--        Point.prototype.normalize = function() {--}}

{{--            var length = this.length();--}}

{{--            this.x /= length;--}}

{{--            this.y /= length;--}}

{{--            return this;--}}

{{--        };--}}

{{--        return Point;--}}

{{--    })();--}}


{{--    /*--}}

{{--     * Particle class--}}

{{--     */--}}

{{--    var Particle = (function() {--}}

{{--        function Particle() {--}}

{{--            this.position = new Point();--}}

{{--            this.velocity = new Point();--}}

{{--            this.acceleration = new Point();--}}

{{--            this.age = 0;--}}

{{--        }--}}

{{--        Particle.prototype.initialize = function(x, y, dx, dy) {--}}

{{--            this.position.x = x;--}}

{{--            this.position.y = y;--}}

{{--            this.velocity.x = dx;--}}

{{--            this.velocity.y = dy;--}}

{{--            this.acceleration.x = dx * settings.particles.effect;--}}

{{--            this.acceleration.y = dy * settings.particles.effect;--}}

{{--            this.age = 0;--}}

{{--        };--}}

{{--        Particle.prototype.update = function(deltaTime) {--}}

{{--            this.position.x += this.velocity.x * deltaTime;--}}

{{--            this.position.y += this.velocity.y * deltaTime;--}}

{{--            this.velocity.x += this.acceleration.x * deltaTime;--}}

{{--            this.velocity.y += this.acceleration.y * deltaTime;--}}

{{--            this.age += deltaTime;--}}

{{--        };--}}

{{--        Particle.prototype.draw = function(context, image) {--}}

{{--            function ease(t) {--}}

{{--                return (--t) * t * t + 1;--}}

{{--            }--}}

{{--            var size = image.width * ease(this.age / settings.particles.duration);--}}

{{--            context.globalAlpha = 1 - this.age / settings.particles.duration;--}}

{{--            context.drawImage(image, this.position.x - size / 2, this.position.y - size / 2, size, size);--}}

{{--        };--}}

{{--        return Particle;--}}

{{--    })();--}}


{{--    /*--}}

{{--     * ParticlePool class--}}

{{--     */--}}

{{--    var ParticlePool = (function() {--}}

{{--        var particles,--}}

{{--            firstActive = 0,--}}

{{--            firstFree   = 0,--}}

{{--            duration    = settings.particles.duration;--}}



{{--        function ParticlePool(length) {--}}

{{--            // create and populate particle pool--}}

{{--            particles = new Array(length);--}}

{{--            for (var i = 0; i < particles.length; i++)--}}

{{--                particles[i] = new Particle();--}}

{{--        }--}}

{{--        ParticlePool.prototype.add = function(x, y, dx, dy) {--}}

{{--            particles[firstFree].initialize(x, y, dx, dy);--}}



{{--            // handle circular queue--}}

{{--            firstFree++;--}}

{{--            if (firstFree   == particles.length) firstFree   = 0;--}}

{{--            if (firstActive == firstFree       ) firstActive++;--}}

{{--            if (firstActive == particles.length) firstActive = 0;--}}

{{--        };--}}

{{--        ParticlePool.prototype.update = function(deltaTime) {--}}

{{--            var i;--}}



{{--            // update active particles--}}

{{--            if (firstActive < firstFree) {--}}

{{--                for (i = firstActive; i < firstFree; i++)--}}

{{--                    particles[i].update(deltaTime);--}}

{{--            }--}}

{{--            if (firstFree < firstActive) {--}}

{{--                for (i = firstActive; i < particles.length; i++)--}}

{{--                    particles[i].update(deltaTime);--}}

{{--                for (i = 0; i < firstFree; i++)--}}

{{--                    particles[i].update(deltaTime);--}}

{{--            }--}}



{{--            // remove inactive particles--}}

{{--            while (particles[firstActive].age >= duration && firstActive != firstFree) {--}}

{{--                firstActive++;--}}

{{--                if (firstActive == particles.length) firstActive = 0;--}}

{{--            }--}}





{{--        };--}}

{{--        ParticlePool.prototype.draw = function(context, image) {--}}

{{--            // draw active particles--}}

{{--            if (firstActive < firstFree) {--}}

{{--                for (i = firstActive; i < firstFree; i++)--}}

{{--                    particles[i].draw(context, image);--}}

{{--            }--}}

{{--            if (firstFree < firstActive) {--}}

{{--                for (i = firstActive; i < particles.length; i++)--}}

{{--                    particles[i].draw(context, image);--}}

{{--                for (i = 0; i < firstFree; i++)--}}

{{--                    particles[i].draw(context, image);--}}

{{--            }--}}

{{--        };--}}

{{--        return ParticlePool;--}}

{{--    })();--}}


{{--    /*--}}

{{--     * Putting it all together--}}

{{--     */--}}

{{--    (function(canvas) {--}}

{{--        var context = canvas.getContext('2d'),--}}

{{--            particles = new ParticlePool(settings.particles.length),--}}

{{--            particleRate = settings.particles.length / settings.particles.duration, // particles/sec--}}

{{--            time;--}}



{{--        // get point on heart with -PI <= t <= PI--}}

{{--        function pointOnHeart(t) {--}}

{{--            return new Point(--}}

{{--                160 * Math.pow(Math.sin(t), 3),--}}

{{--                130 * Math.cos(t) - 50 * Math.cos(2 * t) - 20 * Math.cos(3 * t) - 10 * Math.cos(4 * t) + 25--}}

{{--            );--}}

{{--        }--}}



{{--        // creating the particle image using a dummy canvas--}}

{{--        var image = (function() {--}}

{{--            var canvas  = document.createElement('canvas'),--}}

{{--                context = canvas.getContext('2d');--}}

{{--            canvas.width  = settings.particles.size;--}}

{{--            canvas.height = settings.particles.size;--}}

{{--            // helper function to create the path--}}

{{--            function to(t) {--}}

{{--                var point = pointOnHeart(t);--}}

{{--                point.x = settings.particles.size / 2 + point.x * settings.particles.size / 350;--}}

{{--                point.y = settings.particles.size / 2 - point.y * settings.particles.size / 350;--}}

{{--                return point;--}}

{{--            }--}}

{{--            // create the path--}}

{{--            context.beginPath();--}}

{{--            var t = -Math.PI;--}}

{{--            var point = to(t);--}}

{{--            context.moveTo(point.x, point.y);--}}

{{--            while (t < Math.PI) {--}}

{{--                t += 0.01; // baby steps!--}}

{{--                point = to(t);--}}

{{--                context.lineTo(point.x, point.y);--}}

{{--            }--}}

{{--            context.closePath();--}}

{{--            // create the fill--}}

{{--            context.fillStyle = '#ea80b0';--}}

{{--            context.fill();--}}

{{--            // create the image--}}

{{--            var image = new Image();--}}

{{--            image.src = canvas.toDataURL();--}}

{{--            return image;--}}

{{--        })();--}}



{{--        // render that thing!--}}

{{--        function render() {--}}

{{--            // next animation frame--}}

{{--            requestAnimationFrame(render);--}}



{{--            // update time--}}

{{--            var newTime   = new Date().getTime() / 1000,--}}

{{--                deltaTime = newTime - (time || newTime);--}}

{{--            time = newTime;--}}



{{--            // clear canvas--}}

{{--            context.clearRect(0, 0, canvas.width, canvas.height);--}}



{{--            // create new particles--}}

{{--            var amount = particleRate * deltaTime;--}}

{{--            for (var i = 0; i < amount; i++) {--}}

{{--                var pos = pointOnHeart(Math.PI - 2 * Math.PI * Math.random());--}}

{{--                var dir = pos.clone().length(settings.particles.velocity);--}}

{{--                particles.add(canvas.width / 2 + pos.x, canvas.height / 2 - pos.y, dir.x, -dir.y);--}}

{{--            }--}}



{{--            // update and draw particles--}}

{{--            particles.update(deltaTime);--}}

{{--            particles.draw(context, image);--}}

{{--        }--}}



{{--        // handle (re-)sizing of the canvas--}}

{{--        function onResize() {--}}

{{--            canvas.width  = canvas.clientWidth;--}}

{{--            canvas.height = canvas.clientHeight;--}}

{{--        }--}}

{{--        window.onresize = onResize;--}}



{{--        // delay rendering bootstrap--}}

{{--        setTimeout(function() {--}}

{{--            onResize();--}}

{{--            render();--}}

{{--        }, 10);--}}

{{--    })(document.getElementById('pinkboard'));--}}

{{--</script>--}}

{{--</BODY>--}}

{{--</HTML>--}}



    <!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>

    <meta http-equiv="Page-Enter" content="progid:DXImageTransform.Microsoft.Fade(duration=1)">
    <meta http-equiv="Page-Exit" content="progid:DXImageTransform.Microsoft.Fade(duration=1)">
    <meta http-equiv="X-UA-Compatible" content="chrome=1">
    <meta http-equiv="Content-Type" content="text/html; charset = UTF-8" />
    <link rel="shortcut icon" href="{{asset('meta/favicon.ico')}}" />
    <link rel="Stylesheet" href="{{asset('meta/style.css')}}" type="text/css" />
    <title>Anh thích nhất mùa xuân vì mùa đó có hoa đào</title>
    <script type="text/javascript" src="{{asset('meta/jquery.min.js')}}"></script>
    <script type="text/javascript" src="{{asset('meta/counterup.js')}}"></script>
    <script type="text/javascript" src="{{asset('meta/timroi.js')}}"></script>
    <script language="javascript">

        title_tmp1 = document.title

        if (title_tmp1.indexOf(">>") != -1) {

            title_tmp2 = title_tmp1.split(">>");

            title_last = "*~*" + title_tmp2[1];

            title_last = title_last + "*~*" + title_tmp2[2];

        } else {



            if (title_tmp1.indexOf("*~*") != -1) {

                title_tmp2 = title_tmp1.split("*~*");

                title_last = "*~*" + title_tmp2[1];

                if (title_last == "*~*") { title_last = "*~*" };

                if (title_last == "*~*") { title_last = "*~*" };

            }

            else { title_last = " Missing for you, So much... " }

        }

        title_new = "" + title_last + ""

        step = 0

        function flash_title() {

            step++

            if (step == 8) { step = 1 }

            if (step == 1) { document.title = '[~~~~*' + title_new + '*~~~~]' }

            if (step == 2) { document.title = '[~~~*~' + title_new + '-*~~~]' }

            if (step == 3) { document.title = '[~~*~~' + title_new + '~~*~~]' }

            if (step == 4) { document.title = '[~*~~~' + title_new + '~~~*~]' }

            if (step == 5) { document.title = '[~~*~~' + title_new + '~~*~~]' }

            if (step == 6) { document.title = '[~~~*~' + title_new + '~*~~~]' }

            if (step == 7) { document.title = '[~~~~*' + title_new + '*~~~~]' }

            setTimeout("flash_title()", 180);

        }

        flash_title();

        function scrollToBottom(elm_id) {
            var elm = document.getElementById(elm_id);
            try {
                elm.scrollTop = elm.scrollHeight;
            }
            catch (e) {
                var f = document.createElement("input");
                if (f.setAttribute) f.setAttribute("type", "text")
                if (elm.appendChild) elm.appendChild(f);
                f.style.width = "0px";
                f.style.height = "0px";
                if (f.focus) f.focus();
                if (elm.removeChild) elm.removeChild(f);
            }
        }

    </script>

</head>
<body onload="javascript:teclear();">
<div id="TextCounter">
    <strong>I</strong>
    <img src="{{asset('meta/heartr.png')}}" />
    <strong>U</strong> <span id="counter">
{{--            <script type="text/javascript">--}}
{{--                // January: tháng 1--}}
{{--                // February: tháng 2--}}
{{--                // March: tháng 3--}}
{{--                // April: tháng 4--}}
{{--                // May: tháng 5--}}
{{--                // June: tháng 6--}}
{{--                // July: tháng 7--}}
{{--                // August: tháng 8--}}
{{--                // September: tháng 9--}}
{{--                // October: tháng 10--}}
{{--                // November: tháng 11--}}
{{--                // December: tháng 12--}}
{{--                new CountUp('20 10 2022 00:00:00', 'counter', "...  ");--}}
{{--            </script>--}}
        </span>
</div>
<div id="BgContent">
    <div id="copyright">

    </div>
    <div id="TextContent">
    </div>
{{--    <div id="MusicPlayer">--}}
{{--        <iframe src="http://www.nhaccuatui.com/mh/auto/A3CPk9If5PKA" width="0" height="0" frameborder="0" allowfullscreen></iframe><br />--}}
{{--    </div>--}}
</div>
<div id="canvas">
</div>
<script type="text/javascript" src="{{asset('meta/protoclass.js')}}"></script>
<script type="text/javascript" src="{{asset('meta/box2d.js')}}"></script>
<script type="text/javascript" src="{{asset('meta/Main.js')}}"></script>
<script language="javascript" type="text/javascript">
    mensaje =
        '<font size="6" face="Courier New" color="#fff"><br>宝贝!!</font>' + ' <br>' +
        '<font color="#fff" size="4">不需要穿高跟鞋</font><br>' +
        '<font size="4" color="#fff">不需要花哨的口红</font><br>' +
        '<font size="4" color="#fff">你让我日日夜夜梦见你</font> <br> ' +
        '<font size="4" color="#fff">在你身边如此宁静</font>' + ' <br>' +
        '<font size="4" color="#fff">我只想醉一辈子</font>' + ' <br>' +
        '<font size="4" color="#fff">在柔软芬芳的头发中</font>' + ' <br> <br>' +
        '<p align="left" style="line-height: 30px"> <font face="Courier New" color="#fff" size="6">我的爱很简单 - 已经恋爱了. 爱到没有尽头</font></p>';
    line = 0;
    cursor = '_';
    function teclear() {
        if (line == mensaje.length) cursor = '';
        document.getElementById('TextContent').innerHTML = mensaje.substring(0, line) + cursor;
        var objDiv = document.getElementById("TextContent");
        objDiv.scrollTop = objDiv.scrollHeight;
        if (line++ < mensaje.length) setTimeout("teclear()", 60);
    }
</script>
</body>
</html>
