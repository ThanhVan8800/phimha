<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <link rel="stylesheet" type="text/css" href="style.css" />
    <title>Lucky Spin App Example</title>
    <link href="https://www.jqueryscript.net/css/jquerysctipttop.css" rel="stylesheet" type="text/css">
    <style>
        .wheel_style{
            position: relative;
            height: 1000px;
            margin-left: 50px;
            margin-top: 350px;
        }

        img.market_style{
            position: absolute;
            top: 81%;
            left: 20%;
            opacity: 0.6;
            width: 18%;
            height: 24%;
            border: 9px solid red;
            border-radius: 52px;
        }
        img.market_style:hover{
            opacity: 1;
            transition: 1s all ease;
        }
    </style>
</head>

<body>
    <div class="wheel_box">
        <img src="{{asset('uploads/wheel/wwheel.png')}}" alt="" class="wheel_style">
        <a style="cursor:pointer;" onclick="return Spin_Wheel()" id="market_click" >
            <img   src="{{asset('uploads/wheel/TBT.jpg')}}" alt="" class="market_style" id="market_style">
        </a>
    </div>



    <script>
    function shuffle(array) {
        var currentIndex = array.length,
            randomIndex;

        // While there remain elements to shuffle...
        while (0 !== currentIndex) {
            // Pick a remaining element...
            randomIndex = Math.floor(Math.random() * currentIndex);
            currentIndex--;

            // And swap it with the current element.
            [array[currentIndex], array[randomIndex]] = [
                array[randomIndex],
                array[currentIndex],
            ];
        }

        return array;
    }

    function Spin_Wheel() {
        document.getElementById("market_click").setAttribute('onclick','return false;');
        document.getElementById("market_style").style.opacity = "0.8";
        var path_wheel = "{{URL::asset('/backend/wheel/wheel.mp3')}}";
        var path_applause = "{{URL::asset('/backend/wheel/applause.mp3')}}";
        var wheel_music = new Audio(path_wheel);
        var applause_music = new Audio(path_applause);

        wheel_music.play();

        const wheel = document.querySelector('.wheel_style');
        // const market = document.getElementById('mainbox');

        let SelectedItem = '';

        // Play the sound
        // wheel.play();
        // Inisialisasi variabel
        let huvang999k = shuffle([2205,2565,2925]);
        let MagicRoaster = shuffle([2160,2520,2880]);
        let Sepeda = shuffle([2115,2475,2835]); //Kemungkinan : 100%
        let RiceCooker = shuffle([2070,2430,2790]);
        let LunchBox = shuffle([2025,2385,2745]);
        let Sanken = shuffle([1980,2250,2610]);
        let Electrolux = shuffle([1845,2205,2565]);
        let JblSpeaker = shuffle([1800,2160,2520]);

        // Bentuk acak
        let Random = shuffle([
            huvang999k[0],
            MagicRoaster[0],
            Sepeda[0],
            RiceCooker[0],
            LunchBox[0],
            Sanken[0],
            Electrolux[0],
            JblSpeaker[0],
        ]);
        // console.log(Random[0]);

        // Ambil value item yang terpilih
        if (huvang999k.includes(Random[0])) SelectedItem = "huvang999k";
        if (MagicRoaster.includes(Random[0])) SelectedItem = "Magic Roaster";
        if (Sepeda.includes(Random[0])) SelectedItem = "Sepeda Aviator";
        if (RiceCooker.includes(Random[0])) SelectedItem = "Rice Cooker Philips";
        if (LunchBox.includes(Random[0])) SelectedItem = "Lunch Box Lock&Lock";
        if (Sanken.includes(Random[0])) SelectedItem = "Air Cooler Sanken";
        if (Electrolux.includes(Random[0])) SelectedItem = "Electrolux Blender";
        if (JblSpeaker.includes(Random[0])) SelectedItem = "JBL Speaker";

        // Proses
        wheel.style.transition = "all 10s ease";
        wheel.style.transform = "rotate(445deg)";


        // Munculkan Alert
        setTimeout(function() {
            applause_music.play();
            swal(
                "Congratulations",
                "You Won The " + SelectedItem + ".",
                "success"
            );
        }, 5500);

        // Delay and set to normal state
        setTimeout(function() {
            wheel_music.pause();
            wheel.style.setProperty("transition", "initial");
            wheel.style.transform = "rotate(360deg)";
            document.getElementById("market_click").setAttribute('onclick','return Spin_Wheel();');
        }, 6000);
    }
    </script>
</body>

</html>