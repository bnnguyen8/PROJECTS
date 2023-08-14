//
//  AddLocationController.swift
//  project2
//
//  Created by ThaiAn on 3/26/23.
//

import UIKit
import Foundation

class AddLocationController: UIViewController, UITextFieldDelegate {
    
    @IBOutlet weak var searchTextField: UITextField!
    @IBOutlet weak var weatherConditionImage: UIImageView!
    @IBOutlet weak var temperatureLabel: UILabel!
    @IBOutlet weak var locationLabel: UILabel!
    @IBOutlet weak var weatherConditionLabel: UILabel!
    @IBOutlet weak var viewTempTypeLabel: UILabel!
    @IBOutlet weak var switchButton: UISwitch!
    @IBOutlet weak var saveButton: UIBarButtonItem!
    
    private let weatherApiKey: String = "71d84ff75a7845babcf114741231704"
    private var currentTempC: Float = 0
    private var feelslikeC: Float = 0
    private var locationName: String = ""
    private var currentWeatherCode: Int = 0
    private var latitude: Double = 0.0
    private var longitude: Double = 0.0
    private var conditionText: String = ""
    private var conditionCode: Int = 0
    private var maxtempC: Float = 0.0
    private var mintempC: Float = 0.0

    override func viewDidLoad() {
        super.viewDidLoad()
        displayImage()

        // Do any additional setup after loading the view.
        searchTextField.delegate = self
        
        // disable when there is no search
        switchButton.isEnabled = false;
        saveButton.isEnabled = false
    }
    
    @IBAction func onSwitchTapped(_ sender: UISwitch) {
        changeStatusToggle(toggle: sender.isOn, text: "")
    }
    
    private func changeStatusToggle(toggle: Bool, text: String) {
        if toggle {
            viewTempTypeLabel.text = "Celsius"
            temperatureLabel.text = "\(currentTempC)°C"
        } else {
            viewTempTypeLabel.text = "Fahrenheit"
            temperatureLabel.text = String(format: "%.1f", (currentTempC * 1.8) + 32) + "°F"
        }
    }
    
    @IBAction func onSearchTapped(_ sender: UIButton) {
        loadWeather(search: searchTextField.text)
    }
    
    // trigger when user tapped Enter button after typing location name
    func textFieldShouldReturn(_ textField: UITextField) -> Bool {
        textField.endEditing(true)
        loadWeather(search: textField.text)
        displayImage()
        return true
    }
    
    private func loadWeather(search: String?) {
        guard let search = search else {
            return
        }
        guard let url = getURLForecast(query: search) else {
            print("Could not get URL")
            return
        }
        let session = URLSession.shared
        let dataTask = session.dataTask(with: url) { data, response, error in
            guard error == nil else {
                print("Received error")
                return
            }
            guard let data = data else {
                print("No data found")
                return
            }
            
            if let forecastResponse = self.parseJsonForecast(data: data) {
                DispatchQueue.main.sync {
                    
                    self.currentTempC = forecastResponse.current.temperatureCelsius
                    self.currentWeatherCode = forecastResponse.current.condition.code
                    self.locationLabel.text = forecastResponse.location.name
                    self.locationName = forecastResponse.location.name
                    self.temperatureLabel.text = "\(self.currentTempC)°C"
                    self.displayImage()
                    self.changeStatusToggle(toggle: true, text: "Celsius")
                    self.weatherConditionLabel.text = forecastResponse.current.condition.text
                    self.conditionText = forecastResponse.current.condition.text
                    self.conditionCode = forecastResponse.current.condition.code
                    self.switchButton.isEnabled = true;
                    self.saveButton.isEnabled = true
                    self.switchButton.isOn = true;
                    
                    for forecastDay in forecastResponse.forecast.forecastday {
                        self.maxtempC = forecastDay.day.maxTemperatureCelsius
                        self.mintempC = forecastDay.day.minTemperatureCelsius
                    }
         
                    self.feelslikeC = forecastResponse.current.feelsLikeCelsius
                    self.latitude = forecastResponse.location.lat;
                    self.longitude = forecastResponse.location.lon;
                    self.conditionText = forecastResponse.current.condition.text
                }
            }
        }
        dataTask.resume()
    }
    
    @IBAction func onSaveTapped(_ sender: UIBarButtonItem) {
        print("Save is tapped")
        if let mainController = presentingViewController as? MainController {
            mainController.addLocationScreenSave(newLatitude: latitude, newLongitude: longitude, locationName: locationName, tempC: currentTempC, feelslikeC: feelslikeC, weatherText: conditionText, weatherCode: conditionCode, mintempC: mintempC, maxtempC: maxtempC)
            dismiss(animated: true)
        }
    }
    
    @IBAction func onCancelTapped(_ sender: UIBarButtonItem) {
        print("Cancel is tapped")
        dismiss(animated: true)
    }
    
    private func parseJsonForecast(data: Data) -> WeatherData? {
        let decoder = JSONDecoder()
        var weather: WeatherData?
        do {
            weather = try decoder.decode(WeatherData.self, from: data)
        } catch {
            print("Error decoding")
        }
        return weather
    }
    
    private func getURLForecast(query: String) -> URL? {
        let baseUrl = "https://api.weatherapi.com/v1/"
        let currentEndpoint = "forecast.json"
        guard let url = "\(baseUrl)\(currentEndpoint)?key=\(weatherApiKey)&days=1&q=\(query)".addingPercentEncoding(withAllowedCharacters: .urlQueryAllowed) else {
            return nil
        }
        return URL(string: url)
    }
    
    private func displayImage() {
        let config = UIImage.SymbolConfiguration(paletteColors: [.systemGreen, .systemRed, .systemBlue])
        weatherConditionImage.preferredSymbolConfiguration = config
        let code = currentWeatherCode
        
        if let mainController = presentingViewController as? MainController {
            let iconSystemName = mainController.getImageFromWeatherCode(code: code)
            weatherConditionImage.image = UIImage(systemName: iconSystemName)
        }
    }
}

// Define structs to match the JSON structure
struct WeatherData: Decodable {
    let location: Location
    let current: Weather
    let forecast: Forecast
}

struct Forecast: Decodable {
    let forecastday: [ForecastDay]
}

struct ForecastDay: Decodable {
    let date: String
    let day: Day
}

struct Day: Decodable {
    let maxTemperatureCelsius: Float
    let minTemperatureCelsius: Float
    let averageTemperatureCelsius: Float
    let condition: WeatherCondition
    
    // Applied CodingKey
    enum CodingKeys: String, CodingKey {
        case maxTemperatureCelsius = "maxtemp_c"
        case minTemperatureCelsius = "mintemp_c"
        case averageTemperatureCelsius = "avgtemp_c"
        case condition
    }
}
