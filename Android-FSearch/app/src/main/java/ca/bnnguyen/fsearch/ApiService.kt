package ca.bnnguyen.fsearch

import ca.bnnguyen.fsearch.model.APIFormat
import retrofit2.Response
import retrofit2.http.GET
import retrofit2.http.Query

interface ApiService {
    @GET("v1/business/search")
    suspend fun searchBusiness(
        @Query("term") term: String,
        @Query("city") city: String,
        @Query("province") province: String,
        @Query("sort_by") sortBy: String,
        @Query("limit") limit: Int,
        @Query("offset") offset: Int
    ): Response<APIFormat>
}