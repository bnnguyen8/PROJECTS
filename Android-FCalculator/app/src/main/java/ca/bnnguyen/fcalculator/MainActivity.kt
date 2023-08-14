package ca.bnnguyen.fcalculator

import androidx.appcompat.app.AppCompatActivity
import android.os.Bundle
import ca.bnnguyen.fcalculator.databinding.ActivityMainBinding

class MainActivity : AppCompatActivity() {
    private val ADD_SIGN = "+"
    private val SUBTRACT_SIGN = "–"
    private val MULTIPLY_SIGN = "×"
    private val DIVISION_SIGN = "÷"
    private var currentNumber: Double = 0.0
    private var previousNumber: Double = 0.0
    private var currentOperator: String = ""
    private var isOperatorClicked: Boolean = false

    private lateinit var binding: ActivityMainBinding

    override fun onCreate(savedInstanceState: Bundle?) {
        super.onCreate(savedInstanceState)
        binding = ActivityMainBinding.inflate(layoutInflater)
        val view = binding.root
        setContentView(view)

        setUpView()
    }

    private fun setUpView() {
        binding.btnDivision.text = DIVISION_SIGN
        binding.btnMultiple.text = MULTIPLY_SIGN
        binding.btnAdd.text = ADD_SIGN
        binding.btnMinus.text = SUBTRACT_SIGN

        binding.btnDivision.setOnClickListener { onOperatorClicked(DIVISION_SIGN) }
        binding.btnMultiple.setOnClickListener { onOperatorClicked(MULTIPLY_SIGN) }
        binding.btnAdd.setOnClickListener { onOperatorClicked(ADD_SIGN) }
        binding.btnMinus.setOnClickListener { onOperatorClicked(SUBTRACT_SIGN) }
        // Add click listeners for other operator buttons

        binding.btnEquals.setOnClickListener { onEqualsClicked() }
        binding.btnClear.setOnClickListener { onClearClicked() }
        binding.btnBack.setOnClickListener { onBackSpaceClicked() }

        // Add click listeners for number buttons
        binding.btn0.setOnClickListener { onNumberClicked("0") }
        binding.btn1.setOnClickListener { onNumberClicked("1") }
        binding.btn2.setOnClickListener { onNumberClicked("2") }
        binding.btn3.setOnClickListener { onNumberClicked("3") }
        binding.btn4.setOnClickListener { onNumberClicked("4") }
        binding.btn5.setOnClickListener { onNumberClicked("5") }
        binding.btn6.setOnClickListener { onNumberClicked("6") }
        binding.btn7.setOnClickListener { onNumberClicked("7") }
        binding.btn8.setOnClickListener { onNumberClicked("8") }
        binding.btn9.setOnClickListener { onNumberClicked("9") }
    }

    private fun onNumberClicked(number: String) {
        if (isOperatorClicked) {
            binding.resultTextView.text = number
            isOperatorClicked = false
        } else {
            val currentText = binding.resultTextView.text.toString()
            if (currentText == "0") {
                binding.resultTextView.text = number
            } else {
                binding.resultTextView.text = currentText + number
            }
        }
    }

    private fun onOperatorClicked(operator: String) {
        currentOperator = operator
        previousNumber = binding.resultTextView.text.toString().toDouble()
        isOperatorClicked = true
    }

    private fun onEqualsClicked() {
        val currentText = binding.resultTextView.text.toString()
        if (!isOperatorClicked && currentText.isNotEmpty()) {
            val currentNumber = currentText.toDouble()
            val result = when (currentOperator) {
                DIVISION_SIGN -> previousNumber / currentNumber
                MULTIPLY_SIGN -> previousNumber * currentNumber
                ADD_SIGN -> previousNumber + currentNumber
                SUBTRACT_SIGN -> previousNumber - currentNumber
                else -> currentNumber
            }

            val resultText = if (result % 1 == 0.0) {
                result.toInt().toString()
            } else {
                result.toString()
            }

            binding.resultTextView.text = resultText
            isOperatorClicked = true
        }
    }

    private fun onClearClicked() {
        binding.resultTextView.text = "0"
        currentNumber = 0.0
        previousNumber = 0.0
        currentOperator = ""
        isOperatorClicked = false
    }

    private fun onBackSpaceClicked() {
        val currentText = binding.resultTextView.text.toString()
        if (currentText.isNotEmpty()) {
            binding.resultTextView.text = currentText.dropLast(1)
        }
    }
}