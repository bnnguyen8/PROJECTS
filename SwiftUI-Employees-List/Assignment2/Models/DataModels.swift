//
//  DataModels.swift
//  Assignment2
//
//  Created by ThaiAn on 8/12/23.
//

import Foundation

struct Employee: Decodable, Identifiable {
    var id: String { uuid }
    let uuid: String
    let full_name: String
    let phone_number: String
    let email_address: String
    let biography: String
    let photo_url_small: String
    let photo_url_large: String
    let team: String
    let employee_type: String
}

struct EmployeeList: Decodable {
    let employees: [Employee]
}
