package ca.bnnguyen.i6130p2group8

import android.animation.ObjectAnimator
import android.animation.ValueAnimator
import android.annotation.SuppressLint
import android.graphics.Color
import android.icu.text.DateFormat
import android.media.MediaPlayer
import android.os.Bundle
import android.os.Handler
import android.os.Looper
import androidx.fragment.app.Fragment
import android.view.LayoutInflater
import android.view.View
import android.view.ViewGroup
import android.view.animation.AnimationUtils
import androidx.vectordrawable.graphics.drawable.ArgbEvaluator
import ca.bnnguyen.i6130p2group8.databinding.Fragment1Binding
import java.util.Date

class Fragment1 : Fragment() {
    private lateinit var binding: Fragment1Binding
    private var started = false

    // Use for DateTime changes
    private val df = DateFormat.getDateTimeInstance()
    private val mainHandler = Handler(Looper.getMainLooper())
    private val dateTimeUpdateRunnable = object : Runnable {
        override fun run() {
            updateDateTime()
            mainHandler.postDelayed(this, 1000)
        }
    }

    // Use for changing Background color at the bottom
    private val handler = Handler()
    private val colors = listOf("#FF4500", "#8FBC8F", "#FFFF00", "#FFFFFF")
    private val images = listOf(
        R.drawable.spring,
        R.drawable.summer,
        R.drawable.autumn,
        R.drawable.winter
    )
    private val mp3List = listOf(
        R.raw.spring_song,
        R.raw.summer_song,
        R.raw.autumn_song,
        R.raw.winter_song
    )
    private var colorIndex = 0
    private val colorChangeRunnable: Runnable = object : Runnable {
        override fun run() {
            updateBackgroundColorAndMusic()
            handler.postDelayed(this, 15000) // 15 seconds
            colorIndex = (colorIndex + 1) % colors.size
        }
    }

    // Use for Media player
    private lateinit var mediaPlayer: MediaPlayer

    override fun onCreateView(
        inflater: LayoutInflater, container: ViewGroup?,
        savedInstanceState: Bundle?
    ): View? {
        binding = Fragment1Binding.inflate(inflater, container, false)
        mediaPlayer = MediaPlayer.create(requireContext(), R.raw.spring_song)

        binding.apply {
            startButton.isEnabled = !started
            stopButton.isEnabled = started

            startButton.setOnClickListener {
                runStartButton()
            }

            stopButton.setOnClickListener {
                stopActions()
            }
        }

        // Set up actions when the app starts
        runStartButton()

        return binding.root
    }

    private fun runStartButton() {
        if (!started) {
            started = true
            binding.apply {
                startButton.isEnabled = !started
                stopButton.isEnabled = started

                binding.stopButton.alpha = 0f
                val animFadeIn = AnimationUtils.loadAnimation(requireContext(), R.anim.fade_in)
                binding.stopButton.visibility = View.VISIBLE
                binding.stopButton.alpha = 1f
                binding.stopButton.startAnimation(animFadeIn)

                imgCloud.startAnimation(
                    AnimationUtils.loadAnimation(
                        requireContext(),
                        R.anim.moveforwardandback
                    )
                )
                imgSun.startAnimation(
                    AnimationUtils.loadAnimation(
                        requireContext(),
                        R.anim.moveforwardandbacksun
                    )
                )
                imgBird.startAnimation(
                    AnimationUtils.loadAnimation(
                        requireContext(),
                        R.anim.move_n_repeat
                    )
                )
                imgWheel.startAnimation(
                    AnimationUtils.loadAnimation(
                        requireContext(),
                        R.anim.rotate
                    )
                )

                // Run DateTime update
                mainHandler.post(dateTimeUpdateRunnable)

                // For top background
                runAnimatorBackgroundTop()

                // For bottom background and music change
                handler.post(colorChangeRunnable)

                // For Media player
                if (!mediaPlayer.isPlaying) {
                    mediaPlayer.start()
                }
            }
        }
    }

    private fun stopActions() {
        if (started) {
            started = false
            binding.apply {
                startButton.isEnabled = !started
                stopButton.isEnabled = started

                val animFadeOut = AnimationUtils.loadAnimation(requireContext(), R.anim.fade_out)
                stopButton.visibility = View.VISIBLE
                stopButton.startAnimation(animFadeOut)

                imgCloud.clearAnimation()
                imgSun.clearAnimation()
                imgBird.clearAnimation()
                imgWheel.clearAnimation()

                // Cancel top background animation
                colorAnim.cancel()

                // Stop DateTime update
                mainHandler.removeCallbacks(dateTimeUpdateRunnable)

                // Stop bottom background and music change
                handler.removeCallbacks(colorChangeRunnable)

                // Stop music
                pauseMusic()
            }
        }
    }

    private fun updateBackgroundColorAndMusic() {
        updateBackgroundColor()
        updateNextMp3()
    }

    private fun updateBackgroundColor() {
        binding.imgSeason.setImageResource(images[colorIndex])
        //Fade in
        binding.imgSeason.setImageResource(images[colorIndex])
        binding.imgSeason.alpha = 0f
        val animFadeIn = AnimationUtils.loadAnimation(requireContext(), R.anim.fade_in)
        binding.imgSeason.visibility = View.VISIBLE
        binding.imgSeason.alpha = 1f
        binding.imgSeason.startAnimation(animFadeIn)

        binding.linearBottom.setBackgroundColor(Color.parseColor(colors[colorIndex]))
    }

    private lateinit var colorAnim: ValueAnimator

    @SuppressLint("RestrictedApi")
    private fun runAnimatorBackgroundTop() {
        colorAnim = ObjectAnimator.ofInt(
            binding.fragment1, "backgroundColor",
            Color.parseColor("#5e5ed0"),
            Color.parseColor("#5ed0ba"),
            Color.parseColor("#6ed05e")
        )
        val ANIMATION_DURATION = 4000
        colorAnim.duration = ANIMATION_DURATION.toLong()
        colorAnim.repeatCount = ValueAnimator.INFINITE
        colorAnim.repeatMode = ValueAnimator.REVERSE
        colorAnim.setEvaluator(ArgbEvaluator())
        colorAnim.start()
    }

    private fun updateNextMp3() {
        // Stop the current playback if it's running
        mediaPlayer.stop()
        mediaPlayer.reset()

        // Load and play the "summer.mp3" file from the raw folder
        mediaPlayer = MediaPlayer.create(requireContext(), mp3List[colorIndex])
        mediaPlayer.start()
    }

    private fun updateDateTime() {
        binding.tvDateTime.text = df.format(Date())
    }

    private fun pauseMusic() {
        if (mediaPlayer.isPlaying) {
            mediaPlayer.pause()
        }
    }

    override fun onPause() {
        super.onPause()
        pauseMusic()
    }

    override fun onDestroy() {
        super.onDestroy()

        // Release the MediaPlayer resources when the fragment is destroyed
        mediaPlayer.release()
    }
}