<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Test_API</title>
    <script src="https://code.jquery.com/jquery-3.6.0.js"
        integrity="sha256-H+K7U5CnXl1h5ywQfKtSj8PCmoN9aaq30gDh27Xc0jk=" crossorigin="anonymous"></script>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p"
        crossorigin="anonymous"></script>
</head>

<body>
    <div class="container">
        <div class="row g-3" style="margin-top: 20px;">
            <div class="col">
                <input type="text" id="latitude" class="form-control" placeholder="ละติจูด">
            </div>
            <div class="col">
                <input type="text" id="longitude" class="form-control" placeholder="ลองติจูด">
            </div>
            <button type="submit" class="btn btn-primary " id="btn_Submit">ค้นหา</button>
        </div>
        <div class="container">
            <div class="row">
                <div class="col-4">
                </div>
                <div class="col-4">
                    <div class="card" id="Bigcard" style="width: 20rem; margin-top: 20px;">
                        <img src="https://api.tourismthailand.org/upload/live/content_article/4-658.png"
                            class="card-img-top" alt="ชุมพร">
                        <div class="card-body card_show">
                        </div>
                    </div>
                </div>
                <div class="col-4">
                </div>
            </div>
        </div>
    </div>
    <script>
        var latitude = 9.953109
        var longitude = 99.157219
        display(latitude, longitude);

        function display(latitude, longitude) {
        var url = "https://api.openweathermap.org/data/2.5/weather?lat=" + latitude + "&lon=" + longitude + "&appid=44f67de03e8cffe8f31fcd91dd5a54d3"
        $.getJSON(url)
            .done((data) => {
                console.log(data);
                let temkel_data = data.main.temp;
                var temcel = temkel_data - 273;

                let presenttime = new Date();
                var atthemoment = presenttime.toLocaleString();

                let whensunshines = data.sys.sunrise;
                var sunshines = new Date(whensunshines * 1000);
                var sunshines_h = sunshines.getHours();
                var sunshines_m = "0" + sunshines.getMinutes();
                var sunshines_s = "0" + sunshines.getSeconds();
                var showsunshines = sunshines_h + ':' + sunshines_m.substr(-2) + ':' + sunshines_s.substr(-2);

                let whensundown = data.sys.sunset;
                var sundown = new Date(whensundown * 1000);
                var sundown_h = sundown.getHours();
                var sundown_m = "0" + sundown.getMinutes();
                var sundown_s = "0" + sundown.getSeconds();
                var showsundown = sundown_h + ':' + sundown_m.substr(-2) + ':' + sundown_s.substr(-2);

                var line = "<div class='card_show' id='showcontent'>"
                    line = "<ul class='list-group list-group-flush'>"
                line += "<h4 class='text-center'>" + data.name + "<h4>"
                line += "<li class='list-group-item'> อุณหภูมิ" +" "+ temcel.toFixed(2) + " เซนเซียส </li>"
                line += "<li class='list-group-item'>ความชื้นสัมพัทธ์ " +" "+ data.main.humidity + " % </li>"
                line += "<li class='list-group-item'>ดวงอาทิตย์ขึ้นเวลา" +" " +  showsunshines + " </li>"
                line += "<li class='list-group-item'>ดวงอาทิตย์ตกเวลา" +" " +  showsundown + " </li>"
                line += "<li class='list-group-item'>ณ วันที่" + " " + atthemoment + "เวลา" + presenttime + "</li>"
                line += "</ul>"
                line += "</div>"
                $("#Bigcard").append(line);

            })

            .fail((xhr, err, statu) => {
            })
    }
    $("#btn_Submit").click(()=>{
        $("#showcontent").remove();
        var latitude = parseFloat($("#latitude").val());
        var longitude = parseFloat($("#longitude").val());
        display(latitude,longitude);
    });
    </script>
</body>

</html>
