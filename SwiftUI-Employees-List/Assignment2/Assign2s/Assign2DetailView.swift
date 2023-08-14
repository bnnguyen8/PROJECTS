//
//  Assign2DetailView.swift
//  Assignment2
//
//  Created by ThaiAn on 8/12/23.
//

import SwiftUI

struct Assign2DetailView: View {
    let employee: Employee
        
    var formattedEmployeeType: String {
        switch employee.employee_type {
            case "FULL_TIME":
                return "Full time"
            case "PART_TIME":
                return "Part time"
            case "CONTRACTOR":
                return "Contractor"
            default:
                return "Unknown"
        }
    }

    var body: some View {
        ScrollView {
            VStack(spacing: 20) {
      
                AsyncImage(url: URL(string: employee.photo_url_large)) { image in
                    image
                        .resizable()
                        .aspectRatio(contentMode: .fill)
                        .frame(width: 250, height: 250)
                        .clipShape(Circle())
                } placeholder: {
                    Color.gray
                        .frame(width: 50, height: 50)
                        .clipShape(Circle())
                }
                
                Text(employee.full_name)
                    .font(.largeTitle)
                    .fontWeight(.bold)
                
                Text(employee.biography)
                    .font(.body)
                    .multilineTextAlignment(.center)
                    .padding(.horizontal, 20)
                
                Divider()
                
                InfoLabel(imageName: "phone.fill", text: employee.phone_number)
                InfoLabel(imageName: "envelope.fill", text: employee.email_address)
                InfoLabel(imageName: "person.and.background.dotted", text: employee.team)
                InfoLabel(imageName: "person.fill", text: formattedEmployeeType)
                
                Spacer()
            }
            .padding()
        }
    }
}

struct InfoLabel: View {
    let imageName: String
    let text: String
    
    var body: some View {
        HStack {
            Image(systemName: imageName)
                .foregroundColor(.secondary)
                .font(.headline)
                .frame(width: 24, height: 24)
            
            Text(text)
                .foregroundColor(.secondary)
                .font(.subheadline)
        }
    }
}
