import { StatusBar } from "expo-status-bar";
import { Alert, View } from "react-native";
import Header from "./src/components/Header/Header";
import Contacts from "./src/components/Contacts/Contacts";
import Form from "./src/components/Form/Form";
import styles from "./src/styles/main";
import { useEffect, useState } from "react";
import { createBottomTabNavigator } from "@react-navigation/bottom-tabs";
import { AntDesign } from "@expo/vector-icons";
import { load as databaseLoad } from "./src/database";
import SettingsScreen from "./src/components/Screens/SettingsScreen";
import { MaterialIcons } from "@expo/vector-icons";

const Tab = createBottomTabNavigator();

// export default function App() {
export default function Home({ navigation }) {
	const [contacts, setContacts] = useState([]);

	useEffect(() => {
		databaseLoad()
			.then((data) => {
				setContacts(data);
			})
			.catch(() => {
				Alert.alert(
					"Database Load",
					"There was an error loading the database. Please, try again later."
				);
			})
			.finally(() => {
				// SplashScreen.hideAsync();
			});
	}, []);

	const handleAddContact = (data) => {
		const updatedContacts = [...contacts];
		updatedContacts.push(data);
		setContacts(updatedContacts);
	};

	// Toggles the status of a contact.
	const handleFavouriteChange = (id) => {
		const updatedContacts = contacts.map((contact) => {
			if (contact.id === id) {
				contact.favourite = !contact.favourite;
			}
			return contact;
		});
		setContacts(updatedContacts);
	};

	// Remove a contact.
	const handleContactRemoval = (id) => {
		const updatedContacts = contacts.filter((contact) => contact.id !== id);
		setContacts(updatedContacts);
	};

	return (
		<View style={styles.container}>
			<StatusBar style="auto" />
			<Header />

			<Tab.Navigator
				screenOptions={{
					tabBarItemStyle: {
						backgroundColor: "#5f442c",
						color: "#ffffff",
					},
					tabBarStyle: [
						{
							display: "flex",
						},
						null,
					],
				}}
			>
				<Tab.Screen
					name="List"
					options={{
						headerShown: false,
						headerTintColor: "#ffffff",
						headerStyle: {
							backgroundColor: "#5f442c",
						},
						title: "My Contacts",
						tabBarActiveTintColor: "#ffffff",
						tabBarIcon: ({ color, size }) => (
							<AntDesign
								name="contacts"
								size={size}
								color={color}
							/>
						),
					}}
				>
					{(props) => (
						<Contacts
							{...props}
							contacts={contacts}
							onFavouriteChange={handleFavouriteChange}
							onContactRemoval={handleContactRemoval}
						/>
					)}
				</Tab.Screen>
				<Tab.Screen
					name="Add"
					options={{
						title: "Add Contact",
						headerShown: false,
						headerTintColor: "#ffffff",
						headerStyle: {
							backgroundColor: "#5f442c",
						},
						tabBarActiveTintColor: "#ffffff",
						tabBarIcon: ({ color, size }) => (
							<AntDesign
								name="adduser"
								size={size}
								color={color}
							/>
						),
					}}
				>
					{(props) => (
						<Form {...props} onAddContact={handleAddContact} />
					)}
				</Tab.Screen>

				<Tab.Screen
					name="SettingsScreen"
					component={SettingsScreen}
					options={{
						headerTintColor: "#fff",
						headerStyle: {
							backgroundColor: "#2196F3",
						},
						title: "Settings",
						tabBarIcon: ({ color, size }) => {
							return (
								<MaterialIcons
									name="admin-panel-settings"
									size={size}
									color={color}
								/>
							);
						},
					}}
				/>
			</Tab.Navigator>
		</View>
	);
}
