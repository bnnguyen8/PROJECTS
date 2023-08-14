//
//  Assign2Service.swift
//  Assignment2
//
//  Created by ThaiAn on 8/12/23.
//

import Foundation

protocol Assign2ServiceType {
    func fetch<T: Decodable>(type: T.Type, from urlString: String) async -> T?
    func fetchEmployees() async throws -> [Employee]
}

final class Assign2Service: Assign2ServiceType {
    
    struct Paths {
        static let employeesUrl = "https://s3.amazonaws.com/sq-mobile-interview/employees.json"
//        static let employeesUrl = "https://s3.amazonaws.com/sq-mobile-interview/employees_empty.json"
//        static let employeesUrl = "https://s3.amazonaws.com/sq-mobile-interview/employees_malformed.json"
    }
    
    func fetch<T>(type: T.Type, from urlString: String)  async -> T? where T : Decodable {
        guard let url = URL(string: urlString) else {
            return nil
        }
        do {
            let (data, _) = try await URLSession
                .shared
                .data(from: url)
            let decoder = JSONDecoder()
            return try decoder.decode(type, from: data)
        } catch {
            print("Malformed employee data. Error: \(error)")
            return nil
        }
    }
    
    func fetchEmployees() async throws -> [Employee] {
        let employeeList = await fetch(type: EmployeeList.self, from: Paths.employeesUrl)
        return employeeList?.employees ?? []
    }
    
}
