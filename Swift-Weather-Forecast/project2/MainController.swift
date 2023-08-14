//
//  ViewController.swift
//  project2
//
//  Created by ThaiAn on 3/26/23.
//

import UIKit
import MapKit
import CoreLocation

class MainController: UIViewController {
    
    @IBOutlet weak var mapView: MKMapView!
    @IBOutlet weak var tableView: UITableView!
    
    private var latitude: Double = 0.0
    private var longitude: Double = 0.0
    private var currentLocationName: String = ""
    private let sequeToDetails = "goToDetails"
    private let sequeToAddLocation = "goToAddLocation"
    private let locationManager = CLLocationManager()
    private var items: [ItemToDo] = []
    private var currentTagIdentifier: Int = 1;
    private let weatherApiKey: String = "71d84ff75a7845babcf114741231704"
    
    override func viewDidLoad() {
        super.viewDidLoad()
        // Do any additional setup after loading the view.
        
        locationManager.delegate = self
        locationManager.requestWhenInUseAuthorization()
        locationManager.requestLocation()
        
        setupMap()
        
        // TableView
        tableView.dataSource = self
        tableView.delegate = self
    }
    
    private func setupMap() {
        // set delegate
        mapView.delegate = self
        mapView.showsUserLocation = true
        
    }
    
    private func zoomToLocation() {
        let location = CLLocation(latitude: latitude, longitude: longitude)
        let radiusInMeters: CLLocationDistance = 1000000
        let region = MKCoordinateRegion(center: location.coordinate, latitudinalMeters: radiusInMeters, longitudinalMeters: radiusInMeters)
        mapView.setRegion(region, animated: true)
        
        // camera bounderies
        let cameraBoundary = MKMapView.CameraBoundary(coordinateRegion: region)
        mapView.setCameraBoundary(cameraBoundary, animated: true)
        
        // control zooming
        let zoomRange = MKMapView.CameraZoomRange(maxCenterCoordinateDistance: 10000000)
        mapView.setCameraZoomRange(zoomRange, animated: true)
    }
    
    @IBAction func onAddLocationTapped(_ sender: UIBarButtonItem) {
        performSegue(withIdentifier: sequeToAddLocation, sender: self)
    }
    
    func addLocationScreenSave(newLatitude: Double, newLongitude: Double, locationName: String, tempC: Float, feelslikeC: Float, weatherText: String, weatherCode: Int, mintempC: Float, maxtempC: Float) {

        latitude = newLatitude
        longitude = newLongitude

        // custom marker for current location
        let customMarker = MyAnnotation(
            coordinate: CLLocation(latitude: latitude, longitude: longitude).coordinate,
            locationName: locationName,
            title: "\(weatherText)",
            subtitle: "\(tempC)°C and \(feelslikeC)°C",
            glyphText: "\(tempC)°C",
            tag: currentTagIdentifier,
            image: getImageFromWeatherCode(code: weatherCode),
            markerTintColor: getColorForTemperature(tempC),
            tintColor: getColorForTemperature(tempC)
        )
        mapView.addAnnotation(customMarker)
        currentTagIdentifier += 1
        currentLocationName = locationName
//        zoomToLocation()
        mapView.setCenter(CLLocation(latitude: latitude, longitude: longitude).coordinate, animated: true)
        
        // add new item to TableView
        items.append(ItemToDo(
            title: locationName,
            description: "\(tempC)°C (H:\(maxtempC)°C L:\(mintempC)°C)",
            icon: UIImage(systemName: getImageFromWeatherCode(code: weatherCode)),
            latitude: latitude,
            longitude: longitude,
            locationName: locationName
        ))
        tableView.reloadData()

    }
    
    override func prepare(for segue: UIStoryboardSegue, sender: Any?) {

        // transfer data into Details to show current location
        if segue.identifier == sequeToDetails {
            let detailsController = segue.destination as! DetailsController
            detailsController.currentLatitude = latitude
            detailsController.currentLongitude = longitude
            detailsController.currentLocationName = currentLocationName
        }
    }
    
    private func loadWeather(search: String?) {
        guard let search = search else {
            return
        }
        guard let url = getURL(query: search) else {
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
            if let weatherResponse = self.parseJson(data: data) {
                DispatchQueue.main.sync {
          
                    // add marker for current location
                    let customMarker = MyAnnotation(
                        coordinate: CLLocation(latitude: self.latitude, longitude: self.longitude).coordinate,
                        locationName: "\(weatherResponse.location.name)",
                        title: "\(weatherResponse.current.condition.text)",
                        subtitle: "\(weatherResponse.current.temperatureCelsius)°C and \(weatherResponse.current.feelsLikeCelsius)°C",
                        glyphText: "\(weatherResponse.current.temperatureCelsius)°C",
                        tag: self.currentTagIdentifier,
                        image: "\(self.getImageFromWeatherCode(code: weatherResponse.current.condition.code))",
                        markerTintColor: self.getColorForTemperature(weatherResponse.current.temperatureCelsius),
                        tintColor: self.getColorForTemperature(weatherResponse.current.temperatureCelsius)
                        
                    )
                    self.mapView.addAnnotation(customMarker)
                    self.currentTagIdentifier += 1
                    self.currentLocationName = weatherResponse.location.name
                    
                    self.mapView.setCenter(CLLocation(latitude: self.latitude, longitude: self.longitude).coordinate, animated: true)
//                    self.zoomToLocation()
                }
            }
        }
        dataTask.resume()
    }
    
    private func getColorForTemperature(_ temperature: Float) -> UIColor {
        if temperature > 35 {
            return UIColor(red: 0.8, green: 0, blue: 0, alpha: 1) // dark red
        } else if temperature >= 31 && temperature <= 35 {
            return UIColor.red
        } else if temperature >= 25 && temperature <= 30 {
            return UIColor.orange
        } else if temperature >= 17 && temperature <= 24 {
            return UIColor.yellow
        } else if temperature >= 12 && temperature <= 16 {
            return UIColor.cyan
        } else if temperature >= 0 && temperature <= 11 {
            return UIColor.blue
        } else {
            return UIColor.purple
        }
    }

    func getImageFromWeatherCode(code: Int) -> String {
        var imgeName = ""
        switch code {
            case 1000:
                imgeName = "sun.and.horizon.fill"
            case 1003, 1006:
                imgeName = "cloud.sun"
            case 1009, 1030:
                imgeName = "smoke"
            case 1063, 1150...1153, 1180...1192, 1201, 1240...1246:
                imgeName = "cloud.rain"
            case 1069, 1204, 1207, 1249, 1252:
                imgeName = "cloud.sleet.fill"
            case 1072, 1168, 1171, 1198, 1237:
                imgeName = "thermometer.snowflake"
            case 1087, 1273...1282:
                imgeName = "tornado.circle"
            case 1114...1117, 1210...1225, 1255...1264:
                imgeName = "snowflake.circle"
            case 1135, 1147:
                imgeName = "cloud.fog"
            default:
                imgeName = "sun.min" // default when opening app
        }
        return imgeName
    }
    
    func parseJson(data: Data) -> WeatherResponse? {
        let decoder = JSONDecoder()
        var weather: WeatherResponse?
        do {
            weather = try decoder.decode(WeatherResponse.self, from: data)
        } catch {
            print("Error decoding")
        }
        return weather
    }
    
    private func getURL(query: String) -> URL? {
        let baseUrl = "https://api.weatherapi.com/v1/"
        let currentEndpoint = "current.json"
        guard let url = "\(baseUrl)\(currentEndpoint)?key=\(weatherApiKey)&q=\(query)".addingPercentEncoding(withAllowedCharacters: .urlQueryAllowed) else {
            return nil
        }
        return URL(string: url)
    }
}

extension MainController: MKMapViewDelegate {
    func mapView(_ mapView: MKMapView, viewFor annotation: MKAnnotation) -> MKAnnotationView? {
        let identifier = "myIdentifier"
        var view: MKMarkerAnnotationView
        // check to see if we have a view, we can reuse
        if let dequedView = mapView.dequeueReusableAnnotationView(withIdentifier: identifier) as? MKMarkerAnnotationView {
            dequedView.annotation = annotation
            view = dequedView
        } else {
            view = MKMarkerAnnotationView(annotation: annotation, reuseIdentifier: identifier)
            view.canShowCallout = true
            view.calloutOffset = CGPoint(x: 0, y: 10)
            let button = UIButton(type: .detailDisclosure)
            if let myAnnotation = annotation as? MyAnnotation {
                view.markerTintColor = myAnnotation.markerTintColor
                button.tag = myAnnotation.tag
                view.rightCalloutAccessoryView = button
                view.leftCalloutAccessoryView = UIImageView(image: UIImage(systemName: myAnnotation.image))
                view.tintColor = myAnnotation.tintColor
                view.glyphText = myAnnotation.glyphText
            }
        }
        return view
    }
    
    func mapView(_ mapView: MKMapView, annotationView view: MKAnnotationView, calloutAccessoryControlTapped control: UIControl) {
        performSegue(withIdentifier: sequeToDetails, sender: self)
    }
}

class MyAnnotation: NSObject, MKAnnotation {
    var coordinate: CLLocationCoordinate2D
    var locationName: String
    var title: String?
    var subtitle: String?
    var glyphText: String?
    var tag: Int
    var image: String
    var markerTintColor: UIColor?
    var tintColor: UIColor?

    init(coordinate: CLLocationCoordinate2D, locationName: String, title: String, subtitle: String, glyphText: String? = nil, tag: Int, image: String, markerTintColor: UIColor, tintColor: UIColor) {
        self.coordinate = coordinate
        self.locationName = locationName
        self.title = title
        self.subtitle = subtitle
        self.glyphText = glyphText
        self.tag = tag
        self.image = image
        self.markerTintColor = markerTintColor
        self.tintColor = tintColor
        super.init()
    }
}

extension MainController: CLLocationManagerDelegate {
    
    func locationManager(_ manager: CLLocationManager,   didUpdateLocations locations: [CLLocation]) {
        if let location = locations.last {
            latitude = location.coordinate.latitude
            longitude = location.coordinate.longitude
            loadWeather(search: "\(latitude),\(longitude)")
        }
    }
    
    func locationManager(_ manager: CLLocationManager, didFailWithError error: Error) {
        print("locationManager")
        print(error)
    }
}

struct WeatherResponse: Decodable {
    let location: Location
    let current: Weather
}

struct Location: Decodable {
    let name: String
    let lat: Double
    let lon: Double
}

struct Weather: Decodable {
    let temperatureCelsius: Float
    let feelsLikeCelsius: Float
    let condition: WeatherCondition
    
    // Applied CodingKey
    enum CodingKeys: String, CodingKey {
        case temperatureCelsius = "temp_c"
        case feelsLikeCelsius = "feelslike_c"
        case condition
    }
}

struct WeatherCondition: Decodable {
    let text: String
    let code: Int
}

// --------- TableView to view all locations ------------
extension MainController: UITableViewDataSource {
    func tableView(_ tableView: UITableView, numberOfRowsInSection section: Int) -> Int {
        return items.count
    }
    
    func tableView(_ tableView: UITableView, cellForRowAt indexPath: IndexPath) -> UITableViewCell {
        let cell = tableView.dequeueReusableCell(withIdentifier: "toDoCell", for: indexPath)
        let item = items[indexPath.row]
        
        var content = cell.defaultContentConfiguration()
        content.text = item.title
        content.secondaryText = item.description
        content.image = item.icon
        cell.contentConfiguration = content
        
        return cell
    }
}

extension MainController: UITableViewDelegate {
    func tableView(_ tableView: UITableView, didSelectRowAt indexPath: IndexPath) {
        tableView.deselectRow(at: indexPath, animated: true)
        
        print("Table view click me \(indexPath.row)")
        
        // Tapping on the list item should pan the user to that location (pin) on the map
        let item = items[indexPath.row]
        latitude = Double(item.latitude)
        longitude = Double(item.longitude)
        currentLocationName = item.locationName
//        zoomToLocation()
        mapView.setCenter(CLLocation(latitude: latitude, longitude: longitude).coordinate, animated: true)
        
        self.tableView.reloadRows(at: [indexPath], with: .automatic)
    }
    
}

struct ItemToDo {
    let title: String
    let description: String
    let icon: UIImage?
    let latitude: Double
    let longitude: Double
    let locationName: String
}

