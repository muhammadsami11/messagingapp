<!DOCTYPE html>
<html lang="en">
<head>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Weather App</title>
   <style>
    * { 
    margin: 0;
    padding: 0;
    font-family: 'Times New Roman', Times, serif;
    box-sizing: border-box;
}

body {
    background:rgb(156, 152, 152); /* Dark background with a softer tone */
    color: #fff; 
    display: flex;
    justify-content: center;
    align-items: center;
    height: 100vh;
    padding: 20px;
}

.card {
    width: 100%;
    max-width: 600px; /* Increased width */
    background: linear-gradient(135deg, #00ffcc, #6a5acd); /* Brighter turquoise and purple shades */
    color: #fff;
    border-radius: 25px;
    padding: 50px 40px;
    text-align: center;
    box-shadow: 0 10px 20px rgba(0, 0, 0, 0.4); /* Stronger shadow for depth */
    transition: transform 0.3s ease, box-shadow 0.3s ease;
}

.card:hover {
    transform: translateY(-5px);
    box-shadow: 0 15px 30px rgba(0, 0, 0, 0.5);
}

.search {
    width: 100%;
    display: flex;
    align-items: center;
    justify-content: space-between;
}

.search input {
    border: 0;
    outline: 0;
    background: #d6fffa; /* Brighter input field */
    color: #222; /* Darker text for readability */
    padding: 12px 25px;
    height: 60px;
    border-radius: 30px;
    flex: 1;
    margin-right: 16px;
    font-size: 18px;
    box-shadow: inset 2px 2px 5px rgba(0, 0, 0, 0.2);
}

.search button {
    border: 0;
    outline: 0;
    background: #d6fffa; /* Matching input field */
    border-radius: 50%;
    width: 60px;
    height: 60px;
    cursor: pointer;
    transition: background 0.3s ease, transform 0.2s ease;
}

.search button:hover {
    background: #b3fff0; /* Brighter hover effect */
    transform: scale(1.1);
}

.search button img {
    width: 20px;
}

.weather-icon {
    width: 180px;
    margin-top: 30px;
    animation: fadeIn 1.5s ease-in-out;
}

.weather h1 {
    font-size: 85px;
    font-weight: 600;
    text-shadow: 3px 3px 5px rgba(0, 0, 0, 0.4);
}

.weather h2 {
    font-size: 48px;
    font-weight: 400;
    margin-top: -10px;
}

.details {
    display: flex;
    align-items: center;
    justify-content: space-between;
    padding: 0 25px;
    margin-top: 50px;
}

.col {
    display: flex;
    align-items: center;
    text-align: left;
}

.col img {
    width: 55px;
    margin-right: 12px;
}

.humidity, .wind {
    font-size: 30px;
    margin-top: -6px;
    font-weight: bold;
}

/* Fade-in animation */
@keyframes fadeIn {
    from {
        opacity: 0;
        transform: scale(0.9);
    }
    to {
        opacity: 1;
        transform: scale(1);
    }
}
</style>
</head>
<body>
    <div class="card">
        <div class="search">
            <input type="text" placeholder="Enter city, country code (e.g., Lahore, PK)" spellcheck="false">
            <button><img src="search.png" alt="Search"></button>
        </div>
        <div class="weather">
            <img src="default.png" class="weather-icon" alt="Weather Icon">
            <h1 class="temp">--°C</h1>
            <h2 class="city">---</h2>
            <div class="details">
                <div class="col">
                    <img src="humidity.png" alt="Humidity Icon">
                    <div>
                        <p class="humidity">--%</p>
                        <p>Humidity</p>
                    </div>
                </div>
                <div class="col">
                    <img src="wind.png" alt="Wind Icon">
                    <div>
                        <p class="wind">-- km/h</p>
                        <p>Wind Speed</p>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script>
        const apikey = "71de6b45b28c20feca4c1777b81134dd"; 
        const apiUrl = "https://api.openweathermap.org/data/2.5/weather?units=metric&q=";
        const searchBox = document.querySelector(".search input");
        const searchBtn = document.querySelector(".search button");
        const weatherIcon = document.querySelector(".weather-icon");

        // Weather condition to image mapping
        const weatherImages = {
            "Clear": "sunny.png",
            "Clouds": "cloudy.png",
            "Rain": "rainy.png",
            "Drizzle": "drizzle.png",
            "Thunderstorm": "stormy.png",
            "Snow": "snow.png",
            "Mist": "mist.png",
            "Smoke": "smog.png",
            "Haze": "smog.png"
        };

        async function checkWeather(city) {
            try {
                const response = await fetch(`${apiUrl}${city}&appid=${apikey}`);
                if (!response.ok) {
                    throw new Error("City not found");
                }
                const data = await response.json();
                console.log("API Response:", data);

                document.querySelector(".city").innerHTML = `${data.name}, ${data.sys?.country ?? ''}`;
                document.querySelector(".temp").innerHTML = Math.round(data.main.temp) + "°C";
                document.querySelector(".humidity").innerHTML = data.main.humidity + "%";
                document.querySelector(".wind").innerHTML = data.wind.speed + " km/h";

                // Get the weather condition from API
                const weatherCondition = data.weather[0]?.main || "Default";
                console.log("Weather Condition:", weatherCondition);

                // Set weather image based on condition
                weatherIcon.src = weatherImages[weatherCondition] ? `images/${weatherImages[weatherCondition]}` : "images/default.png";
            } catch (error) {
                alert(error.message);
            }
        }

        // Search button event listener
        searchBtn.addEventListener("click", () => {
            const cityInput = searchBox.value.trim();
            if (cityInput) {
                checkWeather(cityInput);
            } else {
                alert("Please enter a city and country code (e.g., Lahore, PK)");
            }
        });

        // Pressing Enter in input field triggers search
        searchBox.addEventListener("keydown", (event) => {
            if (event.key === "Enter") {
                searchBtn.click();
            }
        });

    </script>
</body>
</html>
