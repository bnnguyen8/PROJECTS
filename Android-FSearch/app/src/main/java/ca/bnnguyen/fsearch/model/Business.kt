package ca.bnnguyen.fsearch.model

data class Business(
    val name: String,
    val phone: String,
    val address: String,
    val rating: Double,
    val imageUrl: String,
    val longitude: Double,
    val latitude: Double,
)