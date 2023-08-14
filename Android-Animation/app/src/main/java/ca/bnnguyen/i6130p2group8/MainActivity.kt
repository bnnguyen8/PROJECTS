package ca.bnnguyen.i6130p2group8

import androidx.appcompat.app.AppCompatActivity
import android.os.Bundle
import ca.bnnguyen.i6130p2group8.databinding.ActivityMainBinding

class MainActivity : AppCompatActivity() {

    private lateinit var binding: ActivityMainBinding
    override fun onCreate(savedInstanceState: Bundle?) {
        super.onCreate(savedInstanceState)
        binding = ActivityMainBinding.inflate(layoutInflater)
        val view = binding.root
        setContentView(view)


    }
}