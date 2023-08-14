import SwiftUI

struct HomeView: View {
    
    @AppStorage("onboardingRequired3") var onboardingRequired: Bool = true
    @ObservedObject var viewModel: Assign2sListViewModel
    
    init (viewModel: Assign2sListViewModel = Assign2sListViewModel()) {
        self.viewModel = viewModel
    }
    
    var body: some View {
        NavigationStack {
            if viewModel.isLoading {
                ProgressView("Fetching employees...")
                    .progressViewStyle(CircularProgressViewStyle())
            } else {
                listContentView
            }
        }
        .onAppear() {
            Task {
                await viewModel.fetchEmployees()
            }
        }
        
    }
    
    @ViewBuilder
    var listContentView: some View {
        List(viewModel.filterEmployees) { employee in
            NavigationLink {
                Assign2DetailView(employee: employee)
            } label: {
                

                AsyncImage(url: URL(string: employee.photo_url_small)) { image in
                    image
                        .resizable()
                        .aspectRatio(contentMode: .fill)
                        .frame(width: 50, height: 50)
                        .clipShape(Circle())
                } placeholder: {
                    Color.gray
                        .frame(width: 50, height: 50)
                        .clipShape(Circle())
                }
                    

                VStack(alignment: .leading) {
                    Text(employee.full_name)
                        .font(.headline)
                    Text(employee.team)
                        .foregroundColor(.secondary)
                }
            }
        }
        
        .refreshable {
            viewModel.refresh()
        }

        .searchable(text: $viewModel.searchTerm, placement: .navigationBarDrawer(displayMode: .always), prompt: "Search for employee")
        .onChange(of: viewModel.searchTerm, perform: { newValue in
            viewModel.filterSearchResults()
        })
        
        .navigationTitle("Employees")
        .listStyle(.plain)
        HStack {
            Spacer()
            Text("\(viewModel.employees.count) employees")
                .foregroundColor(.secondary)
            Spacer()
        }
    }
    
}

struct HomeView_Previews: PreviewProvider {
    static var previews: some View {
        HomeView()
    }
}
