import SwiftUI

struct SettingsView: View {
    var body: some View {
        VStack {
            Spacer()
            Text("Bao Nam Nguyen")
                .font(.largeTitle)
                .fontWeight(.bold)
                .foregroundColor(.blue)
                .padding()
            
            Text("Student Number: 1131957")
                .padding(.bottom, 20)
                .font(.title)
                .foregroundColor(.gray)
                
            Spacer()
        }
        .background(Color.white)
        .navigationBarTitle("Settings")
    }
}

struct SettingsView_Previews: PreviewProvider {
    static var previews: some View {
        SettingsView()
    }
}
