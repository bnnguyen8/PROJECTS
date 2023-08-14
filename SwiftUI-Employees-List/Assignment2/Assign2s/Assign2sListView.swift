//
//  Assign2sListView.swift
//  Assignment2
//
//  Created by ThaiAn on 8/12/23.
//

import SwiftUI

struct Assign2sListView: View {
    @AppStorage("onboardingRequired3") var onboardingRequired: Bool = true
 
    var body: some View {
        TabView {
            HomeView()
                .tabItem {
                    Label("Home", systemImage: "person.3")
                }
            SettingsView()
                .tabItem {
                    Label("Settings", systemImage: "gear")
                }
        }
        // add OnBoarding
        .fullScreenCover(isPresented: $onboardingRequired) {
            onboardingRequired = false
        } content: {
            OnboardingView(onboardingRequired: $onboardingRequired)
        }
    }
    
}

struct ContentView_Previews: PreviewProvider {
    static var previews: some View {
        Assign2sListView()
    }
}

struct OnboardingView: View {
    @Binding var onboardingRequired: Bool
    
    var body: some View {
        ZStack {
            LinearGradient(gradient: Gradient(colors: [.orange, .purple]), startPoint: .topLeading, endPoint: .bottomTrailing)
                .ignoresSafeArea()
            VStack {
                
                Text("Employee List")
                    .font(.system(size: 40, weight: .bold))
                Spacer()
                Image(systemName: "sun.max")
                    .font(.system(size: 100))
                    .fontWeight(.semibold)
                Spacer()
                Text("This application shows the list of employees who are fetched from the network. You can search employees by name and view their details by pressing them.")
                    .font(.system(size: 20))
                Spacer()
                Button {
                    onboardingRequired = false
                } label: {
                    Text("Continue")
                        .frame(maxWidth: .infinity)
                }
                .buttonStyle(.borderedProminent)
                .controlSize(.large)
                .padding([.horizontal], 40)
                
            }
        }
    }
}
