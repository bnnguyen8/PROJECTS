package ca.bnnguyen.fcalculatetips

import androidx.lifecycle.LiveData
import androidx.lifecycle.MutableLiveData
import androidx.lifecycle.ViewModel

class MainViewModel : ViewModel() {
    private val _tipPercent = MutableLiveData<Int>()
    val tipPercent: LiveData<Int> get() = _tipPercent

    private val _tipDescription = MutableLiveData<String>()
    val tipDescription: LiveData<String> get() = _tipDescription

    private val _tipAmount = MutableLiveData<String>()
    val tipAmount: LiveData<String> get() = _tipAmount

    private val _totalAmount = MutableLiveData<String>()
    val totalAmount: LiveData<String> get() = _totalAmount

    init {
        _tipPercent.value = INITIAL_TIP_PERCENT
        updateTipDescription(INITIAL_TIP_PERCENT)
    }

    fun onTipPercentChanged(etBaseAmount: Double, progress: Int) {
        _tipPercent.value = progress
        updateTipDescription(progress)
        computeTipAndTotal(etBaseAmount)
    }

    fun onBaseAmountChanged(etBaseAmount: Double) {
        computeTipAndTotal(etBaseAmount)
    }

    private fun updateTipDescription(tipPercent: Int) {
        val tipDescription = when (tipPercent) {
            in 0..9 -> "Sad"
            in 10..14 -> "Thank you"
            in 15..19 -> "Happy"
            in 20..24 -> "Love"
            else -> "Appreciate"
        }
        _tipDescription.value = tipDescription

    }

    private fun computeTipAndTotal(baseAmount: Double) {
        val tipPercent = _tipPercent.value ?: return

        val tipAmount = baseAmount * tipPercent / 100
        val totalAmount = baseAmount + tipAmount

        _tipAmount.value = "%.2f".format(tipAmount)
        _totalAmount.value = "%.2f".format(totalAmount)
    }
}
