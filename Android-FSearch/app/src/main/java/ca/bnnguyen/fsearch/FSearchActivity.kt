package ca.bnnguyen.fsearch

import android.content.Context
import android.content.Intent
import android.net.Uri
import android.os.Bundle
import android.view.KeyEvent
import android.view.View
import android.view.inputmethod.InputMethodManager
import android.widget.AdapterView
import android.widget.ArrayAdapter
import android.widget.Spinner
import android.widget.Toast
import androidx.appcompat.app.AppCompatActivity
import androidx.lifecycle.ViewModelProvider
import androidx.recyclerview.widget.LinearLayoutManager
import androidx.recyclerview.widget.RecyclerView
import ca.bnnguyen.fsearch.databinding.ActivityFsearchBinding
import ca.bnnguyen.fsearch.model.SearchData
import ca.bnnguyen.fsearch.viewModel.FSearchViewModel
import com.google.gson.Gson
import com.google.gson.reflect.TypeToken
import java.io.File
import java.io.IOException

class FSearchActivity : AppCompatActivity() {

    private lateinit var binding: ActivityFsearchBinding
    private lateinit var viewModel: FSearchViewModel
    private lateinit var recyclerAdapter: RecyclerAdapter

    override fun onCreate(savedInstanceState: Bundle?) {
        super.onCreate(savedInstanceState)
        binding = ActivityFsearchBinding.inflate(layoutInflater)
        setContentView(binding.root)

        viewModel = ViewModelProvider(this)[FSearchViewModel::class.java]
        recyclerAdapter = RecyclerAdapter()
        binding.recyclerView.apply {
            layoutManager = LinearLayoutManager(applicationContext)
            setHasFixedSize(true)
            adapter = recyclerAdapter
        }

        binding.btnSearch.setOnClickListener {
            val term = binding.editSearchTerm.text.toString().trim()
            val city = binding.citySpinner.selectedItem as String
            val province = binding.provinceSpinner.selectedItem as String

            // Save the values to JSON file
            saveDataToJson(term, city, province)

            viewModel.offset = 0
            isLoadingData = false
            viewModel.searchBusiness(term, city, province)

            // hide keyboard
            val inputMethodManager =
                getSystemService(Context.INPUT_METHOD_SERVICE) as InputMethodManager
            inputMethodManager.hideSoftInputFromWindow(binding.btnSearch.windowToken, 0)
        }

        // do search when user tap Enter key
        binding.editSearchTerm.setOnKeyListener { _, keyCode, event ->
            if (keyCode == KeyEvent.KEYCODE_ENTER && event.action == KeyEvent.ACTION_UP) {
                binding.btnSearch.performClick()
                true
            }
            false
        }

        viewModel.places.observe(this) { businesses ->
            //Log.d("test", "$businesses")
            recyclerAdapter.setBusinesses(businesses)
            isLoadingData = false // Reset the loading flag
        }

        viewModel.error.observe(this) { error ->
            Toast.makeText(this, error, Toast.LENGTH_LONG).show()
        }

        binding.textViewBottom.setText(R.string.bottomQuote)

        setRecyclerView()
        setDefaultSpinners()
    }


    private var isLoadingData = false // Flag to prevent multiple simultaneous requests
    private fun setRecyclerView() {
        binding.recyclerView.addOnScrollListener(object : RecyclerView.OnScrollListener() {
            override fun onScrolled(recyclerView: RecyclerView, dx: Int, dy: Int) {
                super.onScrolled(recyclerView, dx, dy)
                val layoutManager = recyclerView.layoutManager as LinearLayoutManager
                val visibleItemCount = layoutManager.childCount
                val totalItemCount = layoutManager.itemCount - 2 // - 2 -> loading before user reaches the bottom
                val firstVisibleItemPosition = layoutManager.findFirstVisibleItemPosition()

                if (!isLoadingData && visibleItemCount + firstVisibleItemPosition >= totalItemCount && firstVisibleItemPosition >= 0) {
                    // Reached the end of the list, load more data
                    val term = binding.editSearchTerm.text.toString().trim()
                    val city = binding.citySpinner.selectedItem as String
                    val province = binding.provinceSpinner.selectedItem as String
                    viewModel.searchBusiness(term, city, province)

                    isLoadingData = true
                }
            }
        })
    }

    private fun setDefaultSpinners() {

         val provinces = arrayOf(
            "Alberta",
            "British Columbia",
            "Manitoba",
            "New Brunswick",
            "Newfoundland and Labrador",
            "Nova Scotia",
            "Ontario",
            "Prince Edward Island",
            "Quebec",
            "Saskatchewan"
        )

        val citiesByProvince = mapOf(
            "Alberta" to arrayOf("Calgary", "Edmonton", "Fort McMurray", "Grande Prairie", "Lethbridge", "Medicine Hat", "Red Deer", "Sherwood Park"),
            "British Columbia" to arrayOf("Abbotsford", "Burnaby", "Coquitlam", "Kelowna", "Langley", "Richmond", "Surrey", "Vancouver"),
            "Manitoba" to arrayOf("Brandon", "Dauphin", "Morden", "Portage la Prairie", "Selkirk", "Steinbach", "Thompson", "Winnipeg"),
            "New Brunswick" to arrayOf("Bathurst", "Dieppe", "Edmundston", "Fredericton", "Miramichi", "Moncton", "Saint John", "Shediac"),
            "Newfoundland and Labrador" to arrayOf("Corner Brook", "Gander", "Grand Falls-Windsor", "Labrador City", "Mount Pearl", "St. John's", "Stephenville", "Torbay"),
            "Nova Scotia" to arrayOf("Amherst", "Antigonish", "Bridgewater", "Cape Breton", "Halifax", "Kentville", "New Glasgow", "Truro"),
            "Ontario" to arrayOf("Brampton", "Hamilton", "Kingston", "Kitchener", "London", "Mississauga", "Ottawa", "Toronto"),
            "Prince Edward Island" to arrayOf("Charlottetown", "Cornwall", "Kensington", "Montague", "Souris", "Stratford", "Summerside", "York"),
            "Quebec" to arrayOf("Laval", "Longueuil", "Montreal", "Quebec City", "Saguenay", "Sherbrooke", "Terrebonne", "Trois-Rivieres"),
            "Saskatchewan" to arrayOf("Estevan", "Moose Jaw", "North Battleford", "Prince Albert", "Regina", "Saskatoon", "Swift Current", "Yorkton")
        )

        // ---------- set default from saved data ---------
        val defaultData = loadDefaultData()
        var termDefault = defaultData.term
        var cityDefault = defaultData.city
        var provinceDefault = defaultData.province

        viewModel.searchBusiness(
            termDefault,
            cityDefault,
            provinceDefault
        )
        binding.editSearchTerm.setText(termDefault)

        // Create an ArrayAdapter for provinces
        val provinceAdapter = ArrayAdapter(this, android.R.layout.simple_spinner_item, provinces)
        provinceAdapter.setDropDownViewResource(android.R.layout.simple_spinner_dropdown_item)
        binding.provinceSpinner.adapter = provinceAdapter

        // Set the default province to Ontario
        val defaultProvince = provinceDefault
        val defaultProvinceIndex = provinceAdapter.getPosition(defaultProvince)
        binding.provinceSpinner.setSelection(defaultProvinceIndex)

        // Create an ArrayAdapter for cities
        val cityAdapter = ArrayAdapter(this, android.R.layout.simple_spinner_item, citiesByProvince[defaultProvince]!!)
        cityAdapter.setDropDownViewResource(android.R.layout.simple_spinner_dropdown_item)
        binding.citySpinner.adapter = cityAdapter

        // Set the default city to London
        val defaultCity = cityDefault
        val defaultCityIndex = cityAdapter.getPosition(defaultCity)
        binding.citySpinner.setSelection(defaultCityIndex)

        // Define a listener for provinceSpinner
        val provinceSpinnerListener = object : AdapterView.OnItemSelectedListener {
            override fun onItemSelected(parent: AdapterView<*>, view: View?, position: Int, id: Long) {
                val selectedProvince = parent.getItemAtPosition(position) as String
                val cities = citiesByProvince[selectedProvince]
                if (cities != null) {
                    // Update citySpinner with new cities
                    val cityAdapter = ArrayAdapter(this@FSearchActivity, android.R.layout.simple_spinner_item, cities)
                    cityAdapter.setDropDownViewResource(android.R.layout.simple_spinner_dropdown_item)
                    binding.citySpinner.adapter = cityAdapter

                    var defaultCityIndexSelected = 0
                    if (defaultProvince == selectedProvince) {
                        defaultCityIndexSelected = defaultCityIndex
                    }
                    binding.citySpinner.setSelection(defaultCityIndexSelected)
                }
            }

            override fun onNothingSelected(parent: AdapterView<*>) {
                // Do nothing
            }
        }
        binding.provinceSpinner.onItemSelectedListener = provinceSpinnerListener
    }

    private fun saveDataToJson(term: String, city: String, province: String) {
        val searchData = SearchData(term, city, province)
        val gson = Gson()
        val jsonData = gson.toJson(searchData)

        try {
            val file = File(filesDir, "search_data.json")
            file.writeText(jsonData)
        } catch (e: IOException) {
            e.printStackTrace()
        }
    }

    private fun loadDefaultData(): SearchData {
        try {
            val file = File(filesDir, "search_data.json")
            if (file.exists()) {
                val jsonData = file.readText()
                val gson = Gson()
                val searchDataType = object : TypeToken<SearchData>() {}.type
                return gson.fromJson(jsonData, searchDataType)
            }
        } catch (e: IOException) {
            e.printStackTrace()
        }
        // If the file does not exist or there's an error, return default values
        return SearchData("", "London", "Ontario")
    }

    private fun getIndex(spinner: Spinner, value: String): Int {
        for (i in 0 until spinner.adapter.count) {
            if (spinner.getItemAtPosition(i).toString() == value) {
                return i
            }
        }
        return 0
    }
}