import { useState } from "react";
import {
	View,
	Text,
	TextInput,
	Switch,
	Button,
	Keyboard,
	Alert,
} from "react-native";
import { save as databaseSave } from "../../database";
import styles from "./styles";

export default function Form(props) {
	const [contactName, setContactName] = useState("");
	const [contactPhoneNumber, setContactPhoneNumber] = useState("");
	const [contactEmail, setContactEmail] = useState("");
	const [contactBirthday, setContactBirthday] = useState("");
	const [contactAddress, setContactAddress] = useState("");
	const [contactNote, setContactNote] = useState("");

	const [contactFavourite, setContactFavourite] = useState(false);
	const [successMessage, setSuccessMessage] = useState(null);
	const [errorMessage, setErrorMessage] = useState(null);

	const handleAddPress = () => {
		if (!contactName && !contactPhoneNumber) {
			setSuccessMessage(null);
			setErrorMessage("Name & Phone Number is required.");
		} else if (!contactName) {
			setSuccessMessage(null);
			setErrorMessage("Name is required.");
		} else if (!contactName || !contactPhoneNumber) {
			setSuccessMessage(null);
			setErrorMessage("Phone number is required.");
		} else {
			const data = {
				name: contactName,
				phoneNumber: contactPhoneNumber,
				email: contactEmail,
				birthday: contactBirthday,
				address: contactAddress,
				note: contactNote,
				favourite: contactFavourite,
			};

			databaseSave(data)
				.then((id) => {
					data.id = id;
					props.onAddContact(data);

					setErrorMessage(null);
					setContactName("");
					setContactPhoneNumber("");
					setContactEmail("");
					setContactBirthday("");
					setContactAddress("");
					setContactNote("");
					setContactFavourite(false);

					setSuccessMessage("New contact was saved successfully.");

					Keyboard.dismiss();
				})
				.catch(() => {
					Alert.alert(
						"Database Save",
						"There was an error saving to the database. Please, try again later."
					);
				});
		}
	};

	return (
		<View style={styles.container}>
			{errorMessage && (
				<View style={styles.errorMessage.container}>
					<Text style={styles.errorMessage.label}>Error:</Text>
					<Text style={styles.errorMessage.text}>{errorMessage}</Text>
				</View>
			)}

			{successMessage && (
				<View style={styles.successMessage.container}>
					<Text style={styles.successMessage.text}>
						{successMessage}
					</Text>
				</View>
			)}

			<Text style={styles.label}>Name:</Text>
			<TextInput
				maxLength={150}
				onChangeText={setContactName}
				defaultValue={contactName}
				style={styles.textbox}
			/>

			<Text style={styles.label}>Phone Number:</Text>
			<TextInput
				maxLength={150}
				onChangeText={setContactPhoneNumber}
				defaultValue={contactPhoneNumber}
				style={styles.textbox}
			/>

			<Text style={styles.label}>Email:</Text>
			<TextInput
				maxLength={150}
				onChangeText={setContactEmail}
				defaultValue={contactEmail}
				style={styles.textbox}
			/>

			<Text style={styles.label}>Birthday:</Text>
			<TextInput
				maxLength={150}
				onChangeText={setContactBirthday}
				defaultValue={contactBirthday}
				style={styles.textbox}
			/>

			<Text style={styles.label}>Address:</Text>
			<TextInput
				maxLength={150}
				onChangeText={setContactAddress}
				defaultValue={contactAddress}
				style={styles.textbox}
			/>

			<Text style={styles.label}>Note:</Text>
			<TextInput
				style={[styles.textInput, styles.textInputDescription]}
				maxLength={150}
				onChangeText={setContactNote}
				defaultValue={contactNote}
			/>

			<View style={styles.AddSave}>
				<Button
					color="#5f442c"
					title="Save Contact"
					onPress={handleAddPress}
				/>
			</View>
		</View>
	);
}
