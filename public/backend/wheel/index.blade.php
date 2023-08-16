<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <link rel="stylesheet" type="text/css" href="style.css" />
    <title>Lucky Spin App Example</title>
    <link href="https://www.jqueryscript.net/css/jquerysctipttop.css" rel="stylesheet" type="text/css">
</head>

<body>
<a href="" onclick="return Spin_Wheel()">

    <img src="{{asset('uploads/wheel/wwheel.png')}}" alt="">
</a>
    


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
            // Play the sound
            wheel.play();
            // Inisialisasi variabel
            const box = document.getElementById("box");
            const element = document.getElementById("mainbox");
            let SelectedItem = "";
            let MagicRoaster = shuffle([1890, 2250, 2610]);
            let Sepeda = shuffle([1850, 2210, 2570]); //Kemungkinan : 100%
            let RiceCooker = shuffle([1810, 2170, 2530]);
            let LunchBox = shuffle([1770, 2130, 2490]);
            let Sanken = shuffle([1750, 2110, 2470]);
            let Electrolux = shuffle([1630, 1990, 2350]);
            let JblSpeaker = shuffle([1570, 1930, 2290]);

            // Bentuk acak
            let Hasil = shuffle([
                MagicRoaster[0],
                Sepeda[0],
                RiceCooker[0],
                LunchBox[0],
                Sanken[0],
                Electrolux[0],
                JblSpeaker[0],
            ]);
            // console.log(Hasil[0]);

            // Ambil value item yang terpilih
            if (MagicRoaster.includes(Hasil[0])) SelectedItem = "Magic Roaster";
            if (Sepeda.includes(Hasil[0])) SelectedItem = "Sepeda Aviator";
            if (RiceCooker.includes(Hasil[0])) SelectedItem = "Rice Cooker Philips";
            if (LunchBox.includes(Hasil[0])) SelectedItem = "Lunch Box Lock&Lock";
            if (Sanken.includes(Hasil[0])) SelectedItem = "Air Cooler Sanken";
            if (Electrolux.includes(Hasil[0])) SelectedItem = "Electrolux Blender";
            if (JblSpeaker.includes(Hasil[0])) SelectedItem = "JBL Speaker";

            // Proses
            box.style.setProperty("transition", "all ease 5s");
            box.style.transform = "rotate(" + Hasil[0] + "deg)";
            element.classList.remove("animate");
            setTimeout(function () {
                element.classList.add("animate");
            }, 5000);

            // Munculkan Alert
            setTimeout(function () {
                applause.play();
                swal(
                "Congratulations",
                "You Won The " + SelectedItem + ".",
                "success"
                );
            }, 5500);

            // Delay and set to normal state
            setTimeout(function () {
                box.style.setProperty("transition", "initial");
                box.style.transform = "rotate(90deg)";
            }, 6000);
            }

    </script>
</body>

</html>