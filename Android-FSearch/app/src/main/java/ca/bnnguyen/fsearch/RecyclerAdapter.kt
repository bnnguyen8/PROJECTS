package ca.bnnguyen.fsearch

import android.content.Context
import android.content.Intent
import android.net.Uri
import android.view.LayoutInflater
import android.view.ViewGroup
import androidx.core.content.ContextCompat.startActivity
import androidx.recyclerview.widget.RecyclerView
import ca.bnnguyen.fsearch.databinding.ItemBinding
import ca.bnnguyen.fsearch.model.Business
import com.squareup.picasso.Picasso


class RecyclerAdapter : RecyclerView.Adapter<RecyclerAdapter.ViewHolder>() {

    private var itemsList: List<Business> = emptyList()

    inner class ViewHolder(private val binding: ItemBinding, private val context: Context) : RecyclerView.ViewHolder(binding.root) {
        fun bind(business: Business, position: Int) {
            binding.textViewName.text = "${position + 1}. ${business.name}"
            binding.textViewPhone.text = "Phone: ${business.phone}"
            binding.textViewAddress.text = "Address: ${business.address}"
            binding.textViewRating.text = "Rating: ${business.rating}"
            if (business.imageUrl.isNotEmpty()) {
                Picasso.get().load(business.imageUrl).into(binding.imageView)
            }

            binding.googleMapLink.setOnClickListener {
                val intent = Intent(context, MapsActivity::class.java)
                intent.putExtra("longitude", business.longitude)
                intent.putExtra("latitude", business.latitude)
                intent.putExtra("address", business.address)
                intent.putExtra("name", business.name)
                context.startActivity(intent)
            }
        }
    }

    override fun onCreateViewHolder(viewGroup: ViewGroup, viewType: Int): ViewHolder {
        val inflater = LayoutInflater.from(viewGroup.context)
        val binding = ItemBinding.inflate(inflater, viewGroup, false)
        return ViewHolder(binding, viewGroup.context)
    }

    override fun onBindViewHolder(holder: ViewHolder, position: Int) {
        holder.bind(itemsList[position], position)
    }

    override fun getItemCount():Int {
        return itemsList.size
    }

    fun setBusinesses(businesses: List<Business>) {
        itemsList = businesses
        notifyDataSetChanged()
    }
}