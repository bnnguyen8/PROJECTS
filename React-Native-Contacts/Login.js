import React, { useState } from "react";
import {
	View,
	TextInput,
	StyleSheet,
	SafeAreaView,
	Image,
	TouchableOpacity,
	Text,
} from "react-native";
import { signInWithEmailAndPassword } from "firebase/auth";
import { auth } from "./firebaseConfig";
import Logo from "./assets/Logo.png";

const Login = ({ navigation }) => {
	const [isLoading, setIsLoading] = useState(false);
	const [email, setEmail] = useState("");
	const [password, setPassword] = useState("");
	const [errorMessage, setErrorMessage] = useState(null);

	const handleLogin = async () => {
		try {
			if (email === "" || password === "") {
				setErrorMessage("Please enter both email and password.");
			} else {
				signInWithEmailAndPassword(auth, email, password)
					.then(async (userCredential) => {
						// Handle successful login
					})
					.catch(() => setErrorMessage("Wrong email or password!"));
			}
		} catch (error) {
			console.log(error.message);
			setErrorMessage("Error: " + error.message);
		}
	};

	return (
		<SafeAreaView style={styles.container}>
			<View style={styles.logoContainer}>
				<Image source={Logo} style={styles.logo} />
			</View>

			<View style={styles.formContainer}>
				{errorMessage && (
					<View style={styles.errorMessage.container}>
						<Text style={styles.errorMessage.label}>Error:</Text>
						<Text style={styles.errorMessage.text}>
							{errorMessage}
						</Text>
					</View>
				)}
				<TextInput
					style={styles.input}
					placeholder="Email"
					value={email}
					onChangeText={(text) => setEmail(text)}
				/>
				<TextInput
					style={styles.input}
					placeholder="Password"
					secureTextEntry
					value={password}
					onChangeText={(text) => setPassword(text)}
				/>
				<TouchableOpacity
					style={styles.loginButton}
					onPress={handleLogin}
				>
					<Text style={styles.buttonText}>Login</Text>
				</TouchableOpacity>

				<View style={styles.registerLink}>
					<Text
						style={{
							color: "#342E29",
							fontSize: 20,
							paddingRight: 10,
						}}
					>
						Don't have an account?
					</Text>
					<TouchableOpacity
						onPress={() => navigation.navigate("Register")}
					>
						<Text
							style={{
								color: "#3b71ca",
								fontSize: 20,
								letterSpacing: 1,
							}}
						>
							Register
						</Text>
					</TouchableOpacity>
				</View>
			</View>
		</SafeAreaView>
	);
};

const styles = StyleSheet.create({
	container: {
		flex: 1,
		backgroundColor: "#FFEDCB",
		justifyContent: "center",
	},
	logoContainer: {
		alignItems: "center",
		marginBottom: 30,
	},
	logo: {
		width: 150,
		height: 150,
		resizeMode: "contain",
	},
	formContainer: {
		paddingHorizontal: 30,
	},
	input: {
		height: 50,
		backgroundColor: "#FFF",
		borderRadius: 10,
		paddingHorizontal: 15,
		marginBottom: 20,
		fontSize: 16,
	},
	loginButton: {
		height: 50,
		backgroundColor: "#3b71ca",
		justifyContent: "center",
		alignItems: "center",
		borderRadius: 10,
		marginBottom: 10,
	},
	buttonText: {
		color: "#FFF",
		fontSize: 18,
		fontWeight: "bold",
	},
	registerLink: {
		flexDirection: "row", // Add this property to keep Text and TouchableOpacity in one line
		alignItems: "center", // To vertically center align the elements
		justifyContent: "center", // To horizontally center align the elements
	},

	errorMessage: {
		container: {
			backgroundColor: "#fff",
			padding: 10,
			marginBottom: 0,
			borderColor: "#c00",
			borderWidth: 1,
			borderLeftWidth: 8,
			marginBottom: 20,
		},
		label: {
			color: "#c00",
			fontSize: 14,
			fontWeight: "bold",
		},
		text: {
			color: "#c00",
			fontSize: 16,
		},
	},
});

export default Login;
