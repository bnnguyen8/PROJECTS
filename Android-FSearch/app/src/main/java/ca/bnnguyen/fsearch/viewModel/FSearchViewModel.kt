package ca.bnnguyen.fsearch.viewModel

import android.util.Log
import androidx.lifecycle.LiveData
import androidx.lifecycle.MutableLiveData
import androidx.lifecycle.ViewModel
import androidx.lifecycle.viewModelScope
import ca.bnnguyen.fsearch.ApiClient
import ca.bnnguyen.fsearch.model.Business
import kotlinx.coroutines.Dispatchers
import kotlinx.coroutines.launch
import kotlinx.coroutines.withContext
import java.net.URLEncoder

class FSearchViewModel : ViewModel() {
    private val _places = MutableLiveData<List<Business>>()
    val places: LiveData<List<Business>> get() = _places

    private val _error = MutableLiveData<String>()
    val error: LiveData<String> get() = _error

    var offset = 0 // Track the offset for pagination
    fun searchBusiness(term: String, city: String, province: String) {
        viewModelScope.launch {
            try {
                val encodedTerm = if (term.isNotEmpty()) URLEncoder.encode(term, "UTF-8") else ""
                val response = ApiClient.apiService.searchBusiness(
                    encodedTerm,
                    "$city",
                    "$province",
                    "best_match",
                    20,
                    offset
                )

                if (response.isSuccessful) {
                    val request = response.body()
                    if (request != null) {
                        withContext(Dispatchers.Main) {
                            if (request.businesses.isNotEmpty()) {
                                _places.value = if (offset > 1) {
                                    _places.value.orEmpty() + request.businesses
                                } else {
                                    request.businesses
                                }
                                offset += request.businesses.size // Increment the offset
                            }
                        }
                    }
                } else {
                    withContext(Dispatchers.Main) {
                        _error.value = "Failed Connection"
                    }
                }
            } catch (e: Exception) {
                e.printStackTrace()
                withContext(Dispatchers.Main) {
                    _error.value = "Failed Connection"
                }
            }
        }
    }
}

