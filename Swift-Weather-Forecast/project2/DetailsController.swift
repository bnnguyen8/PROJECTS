//
//  DetailsController.swift
//  project2
//
//  Created by ThaiAn on 3/26/23.
//

import UIKit



class DetailsController: UIViewController {
    
    @IBOutlet weak var locationName: UILabel!
    @IBOutlet weak var currentTemperature: UILabel!
    @IBOutlet weak var currentWeatherCondition: UILabel!
    @IBOutlet weak var highTemperature: UILabel!
    @IBOutlet weak var lowTemperature: UILabel!
    @IBOutlet weak var tableView: UITableView!
    
    private let weatherApiKey: String = "71d84ff75a7845babcf114741231704"
    
    var items: [ItemToDo] = []
    
    // these values will be transfer from MainController
    var currentLatitude: Double?
    var currentLongitude: Double?
    var currentLocationName: String?

    override func viewDidLoad() {
        super.viewDidLoad()
        
        tableView.dataSource = self
        tableView.delegate = self
 
        if let currentLocationName = currentLocationName {
            loadWeather(search: "\(currentLocationName)")
        }
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
            
                    self.locationName.text = forecastResponse.location.name
                    self.currentTemperature.text = "Current: \(forecastResponse.current.temperatureCelsius)°C"
                    self.currentWeatherCondition.text = "\(forecastResponse.current.condition.text)"
                    var order: Bool = true;
                    for forecastDay in forecastResponse.forecast.forecastday {
                        if order {
                            self.highTemperature.text = "High: \(forecastDay.day.maxTemperatureCelsius)°C"
                            self.lowTemperature.text = "Low: \(forecastDay.day.minTemperatureCelsius)°C"
                            order = false
                        } else {
                            // add new date to TableView
                            var weatherIconName = ""
                            if let mainController = self.presentingViewController as? MainController {
                                weatherIconName = mainController.getImageFromWeatherCode(code: forecastDay.day.condition.code)
                            }
                            self.items.append(ItemToDo(
                                title: "\(forecastDay.date) \(forecastDay.day.averageTemperatureCelsius)°C",
                                description: "",
                                icon: UIImage(systemName: weatherIconName),
                                latitude: 0.0,
                                longitude: 0.0,
                                locationName: forecastResponse.location.name
                            ))
                            self.tableView.reloadData()
                        }
                    }
                }
            }
        }
        dataTask.resume()
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
        guard let url = "\(baseUrl)\(currentEndpoint)?key=\(weatherApiKey)&days=8&q=\(query)".addingPercentEncoding(withAllowedCharacters: .urlQueryAllowed) else {
            return nil
        }
        return URL(string: url)
    }
}

extension DetailsController: UITableViewDataSource {
    func tableView(_ tableView: UITableView, numberOfRowsInSection section: Int) -> Int {
        return items.count
    }
    
    func tableView(_ tableView: UITableView, cellForRowAt indexPath: IndexPath) -> UITableViewCell {
        let cell = tableView.dequeueReusableCell(withIdentifier: "detailsCell", for: indexPath)
        let item = items[indexPath.row]
        
        var content = cell.defaultContentConfiguration()
        content.text = item.title
        content.secondaryText = item.description
        content.image = item.icon
        cell.contentConfiguration = content
        
        return cell
        
    }
}

extension DetailsController: UITableViewDelegate {
    func tableView(_ tableView: UITableView, didSelectRowAt indexPath: IndexPath) {
        tableView.deselectRow(at: indexPath, animated: true)
        self.tableView.reloadRows(at: [indexPath], with: .automatic)
    }
}
