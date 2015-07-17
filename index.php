<!DOCTYPE html>
<html lang="en-us">
	<head>
		<meta charset="utf-8" />
		<title>Caesar Cipher in PHP</title>
		<meta name="description" content="Create your own Caesar Cipher!" />
		<link href="styles/stylesheet.css" type="text/css" rel="stylesheet" />
		<script src="javascript/modernizr.js" type="text/javascript"></script>
	</head>
	<body>
		<div id="wrapper">
			<h1>Caesar Cipher</h1>
			<p>This site creates a Caesar Cipher from any input. For those unfamiliar with Caesar Ciphers, it's a substition cipher where each letter in the original text is substituted with another letter in the alphabet. The substituted letter is a fixed number of positions away in the alphabet from the original letter.</p>
			<p>For example, let's say you wanted to create a Caesar Cipher with a right shift of 3. We'll use "Hello World" as our demo text.</p>
			<p>First we start with the "H." Three letters to the right from "h" in the alphabet is "k." Then we move onto the next letter, "e." Three letter to the right of "e" is "h." And so on, until each letter is substituted.</p>
			<p>So with a right shift of 3, "Hello World!" becomes "Khoor Zruog!" Try it yourself below, with a customized shift value.</p>
			<form method="post" action="index.php">
				<div class="form-div">
					<label for="user_text">Original Text:</label>
					<textarea name="user_text" id="user_text" maxlength="350"></textarea>
				</div>
				<div class="form-div">
					<label for="shift">Shift:</label>
					<select name="shift" id="shift">
					<?php
						for($i = 1; $i < 26; $i++){
							echo "<option value=\"$i\">$i</option>";
						}
					?>
				</select>
				</div>
				<button>Submit</button>
			</form>
			<div id="result-div">
				<?php
					function caesar_cipher($alphabet, $text, $shift, $i){		// Find substitute character for cipher using a right shift
						$originalLetterIndex = strpos($alphabet, $text[$i]);	// Find index of original character in alphabet string
						$substituteIndex = $originalLetterIndex + $shift;		// Find index of the substitute character
						if ($substituteIndex > 25){				// If the shift results in an index greater than the length of the alphabet
							$substituteIndex -= 26;												// Find new index to wrap from z to a
						} 
						return $alphabet[$substituteIndex];										// Return substitute letter
					}

					if($_SERVER['REQUEST_METHOD'] === "POST"){									// Has user submitted form?
						if($_POST['user_text'] === ''){											// If user input isn't blank
							echo "<p>Please fill out the text input.</p>";						// Show error message
						} else {
							$alphabet = 'abcdefghijklmnopqrstuvwxyz';				// Alphabet variable used to find substitute letter later
							$shift = $_POST['shift'];											// Shift value for the cipher
							$text = trim(strip_tags($_POST['user_text'])); 						// Remove white space and strip html tags
							for($i = 0; $i < strlen($text); $i++){								// Check each character in user input
								if (preg_match('/[A-Z]/',$text[$i])){							// If character is a capital letter
									$text[$i] = caesar_cipher(strtoupper($alphabet), $text, $shift, $i);	// Complete substitution
								} else if (preg_match('/[a-z]/', $text[$i])){					// If character is undercase
									$text[$i] = caesar_cipher($alphabet, $text, $shift, $i);	// Complete substitution
								}
							}
							echo "<p>Your Caesar Cipher is:<br />$text</p>";					// Print result for user
						}
					}
				?>
			</div><!-- End of results div -->
			<footer>&copy; 2015 Tom Tillistrand</footer>
		</div><!-- End of wrapper div -->
		<script src="javascript/jquery-1.11.2.js" type="text/javascript"></script>
		<script src="javascript/main-script.js" type="text/javascript"></script>
	</body>
</html>