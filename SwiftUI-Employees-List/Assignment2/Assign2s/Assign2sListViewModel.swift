//
//  Assign2sListViewModel.swift
//  Assignment2
//
//  Created by ThaiAn on 8/12/23.
//

import SwiftUI

final class Assign2sListViewModel: ObservableObject {
    private let service: Assign2ServiceType
    @Published private(set) var employees: [Employee] = []
    @Published private(set) var isLoading: Bool = false
    @Published var searchResults: [Employee] = []
    @Published var searchTerm: String = ""
    
    var filterEmployees: [Employee] {
        return searchTerm.isEmpty ? employees : searchResults
    }
    
    init(service: Assign2ServiceType = Assign2Service()) {
        self.service = service
    }
    
    @MainActor
    func fetchEmployees() async {
        if employees.isEmpty {
            do {
                isLoading = true
                employees = try await service.fetchEmployees()
                isLoading = false
            } catch {
                print("Error: \(error)")
            }
        }
    }
    
    func refresh()  {
        self.searchTerm = ""
    }
    
    func filterSearchResults() {
        searchResults = employees.filter({$0.full_name.localizedCaseInsensitiveContains(searchTerm)})
    }
}

