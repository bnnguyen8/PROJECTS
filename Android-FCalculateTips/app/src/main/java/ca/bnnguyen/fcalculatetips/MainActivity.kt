package ca.bnnguyen.fcalculatetips

import android.animation.ArgbEvaluator
import android.graphics.Color
import android.graphics.drawable.GradientDrawable
import androidx.appcompat.app.AppCompatActivity
import android.os.Bundle
import android.text.Editable
import android.text.TextWatcher
import android.widget.SeekBar
import androidx.core.content.ContextCompat
import androidx.lifecycle.ViewModelProvider
import ca.bnnguyen.fcalculatetips.databinding.ActivityMainBinding

const val INITIAL_TIP_PERCENT = 15
class MainActivity : AppCompatActivity() {
    private lateinit var binding: ActivityMainBinding
    private lateinit var viewModel: MainViewModel

    override fun onCreate(savedInstanceState: Bundle?) {
        super.onCreate(savedInstanceState)
        binding = ActivityMainBinding.inflate(layoutInflater)
        setContentView(binding.root)

        viewModel = ViewModelProvider(this).get(MainViewModel::class.java)

        binding.progressBarTip.progress = viewModel.tipPercent.value ?: INITIAL_TIP_PERCENT
        binding.tipPercentLabel.text = "${binding.progressBarTip.progress}%"
        binding.progressBarTip.setOnSeekBarChangeListener(object : SeekBar.OnSeekBarChangeListener {
            override fun onProgressChanged(seekBar: SeekBar?, progress: Int, fromUser: Boolean) {
                binding.tipPercentLabel.text = "$progress%"
                var temp = 0.0
                if (binding.editAmount.text.toString().isNotEmpty()) {
                    temp = binding.editAmount.text.toString().toDouble()
                }
                viewModel.onTipPercentChanged(temp, progress)
            }

            override fun onStartTrackingTouch(seekBar: SeekBar?) {}

            override fun onStopTrackingTouch(seekBar: SeekBar?) {}
        })

        binding.editAmount.addTextChangedListener(object : TextWatcher {
            override fun beforeTextChanged(s: CharSequence?, start: Int, count: Int, after: Int) {}

            override fun onTextChanged(s: CharSequence?, start: Int, before: Int, count: Int) {}

            override fun afterTextChanged(s: Editable?) {
                var temp = 0.0
                if (s.toString().isNotEmpty()) {
                    temp = s.toString().toDouble()
                }
                viewModel.onBaseAmountChanged(temp)
            }
        })
        val border = GradientDrawable()
        border.setStroke(2, Color.parseColor("#05236C")) // Set border color to brown (#8B4513)
        border.cornerRadius = 8f // Set corner radius
        binding.editAmount.background = border

        viewModel.tipDescription.observe(this) { tipDescription ->
            binding.tipDescription.text = tipDescription

            val color = ArgbEvaluator().evaluate(
                binding.progressBarTip.progress.toFloat() / binding.progressBarTip.max,
                ContextCompat.getColor(this, R.color.color_worst_tip),
                ContextCompat.getColor(this, R.color.color_best_tip)
            ) as Int
            binding.tipDescription.setTextColor(color)
        }

        viewModel.tipAmount.observe(this) { tipAmount ->
            binding.tipAmount.text = "\$$tipAmount"
        }

        viewModel.totalAmount.observe(this) { totalAmount ->
            binding.totalAmount.text = "\$$totalAmount"
        }
    }
}