//
//  ViewController.swift
//  hangsomeone
//
//  Created by ThaiAn on 2/13/23.
//

import UIKit

class ViewController: UIViewController {

    @IBOutlet weak var letter0: UILabel!
    @IBOutlet weak var letter1: UILabel!
    @IBOutlet weak var letter2: UILabel!
    @IBOutlet weak var letter3: UILabel!
    @IBOutlet weak var letter4: UILabel!
    @IBOutlet weak var letter5: UILabel!
    @IBOutlet weak var letter6: UILabel!
    
    @IBOutlet weak var winScore : UILabel!
    @IBOutlet weak var loseScore: UILabel!
    @IBOutlet weak var imgHangman: UIImageView!
    
    private var currentWord = ""
    private var listWords = Set<String>()
    
    private var guessFailed = 0
    private var guessSucceeded = 0
    private let totalChar = 7
    private let totalBody = 6
    private var totalWinScore = 0
    private var totalLoseScore = 0
    
    override func viewDidLoad() {
        super.viewDidLoad()
        
        initNewGame()
    }
    
    @IBAction func keyTapped(_ sender: UIButton) {
        // if use click NO after they win/lose, we will do nothing then
        if(guessFailed >= totalBody || guessSucceeded >= totalChar) {
            print("Do nothing because user clicked NO before")
            return
        }
        
        sender.isEnabled = false
        let clickChar = sender.currentTitle ?? ""
        let convertedChar = clickChar.lowercased()
        let charToFind = Character(convertedChar.lowercased())
        
        var charPositions: [Int] = []

        for (index, char) in currentWord.enumerated() {
            if char == charToFind {
                charPositions.append(index)
            }
        }

        if charPositions.isEmpty {
            guessFailed += 1
            imgHangman.image = UIImage(named: "Hangman\(guessFailed)")
            sender.backgroundColor = UIColor.red
            
            if(guessFailed == totalBody) {
                let alert = UIAlertController(title: "Game Over", message: "Correct word was \(currentWord). Would you like to play again?", preferredStyle: .alert)
                let okButton = UIAlertAction(title: "Yes", style: .default) { _ in
                    // print("OK button was pressed")
                    self.resetGame()
                }
                alert.addAction(okButton)
                
                let destructiveButton = UIAlertAction(title: "No", style: .destructive) { _ in
                    print("User clicked NO, do nothing here")
                }
                alert.addAction(destructiveButton)

                self.show(alert, sender: nil)
                
                totalLoseScore += 1
                loseScore.text = "LOSE: \(totalLoseScore)"
            }
            
        } else {
            sender.backgroundColor = UIColor.green
            
            for position in charPositions {
                guessSucceeded += 1
                switch position {
                case 0:
                    letter0.text = clickChar
                case 1:
                    letter1.text = clickChar
                case 2:
                    letter2.text = clickChar
                case 3:
                    letter3.text = clickChar
                case 4:
                    letter4.text = clickChar
                case 5:
                    letter5.text = clickChar
                default:
                    letter6.text = clickChar
                }
            }
            
            if(guessSucceeded == totalChar) {
                let alert = UIAlertController(title: "Phew!", message: "You saved me! Would you like to play again?", preferredStyle: .alert)
                let okButton = UIAlertAction(title: "Yes", style: .default) { _ in
                    // print("OK button was pressed")
                    self.resetGame()
                }
                alert.addAction(okButton)
                
                let destructiveButton = UIAlertAction(title: "No", style: .destructive) { _ in
                    print("User clicked NO, do nothing here")
                }
                alert.addAction(destructiveButton)

                self.show(alert, sender: nil)
                
                totalWinScore += 1
                winScore.text = "WIN: \(totalWinScore)"
                
            }
        }
        
        print(sender.currentTitle ?? "")
        
    }
    
    private func initNewGame() {
        listWords = ["writing", "alcohol", "ability", "fishing", "charity", "hearing", "context", "analyst", "funeral", "library", "surgery", "highway", "payment", "emotion", "quality", "society", "control", "problem", "variety", "meaning", "economy", "bedroom", "endorse", "forward", "complex", "failure", "pottery", "hostile", "extinct", "respect", "squeeze", "reverse", "concern", "science", "reality", "glacier", "popular", "protect", "mixture", "kitchen"]
        
        // get first random word
        let randomWord = listWords.randomElement()

        if let randomWord = randomWord {
            currentWord = randomWord
            print("Random string: \(randomWord)")
        } else {
            print("Set is empty.")
        }
        
        imgHangman.image = UIImage(named: "Hangman0")
        
        getAllButtonsFromView(view)
        
    }
    
    private func getAllButtonsFromView(_ view: UIView) {
        for subview in view.subviews {
            if let button = subview as? UIButton {
                button.layer.borderWidth = 1.0
                button.layer.borderColor = UIColor.black.cgColor
                button.backgroundColor = UIColor.white
                button.isEnabled = true
            } else if subview.subviews.count > 0 {
                getAllButtonsFromView(subview)
            }
        }
    }
    
    private func resetGame() {
        initNewGame()
        
        guessFailed = 0
        guessSucceeded = 0
        letter0.text = ""
        letter1.text = ""
        letter2.text = ""
        letter3.text = ""
        letter4.text = ""
        letter5.text = ""
        letter6.text = ""
    }
}

