import { useState } from "react";
import { View, Text, Pressable, Modal, Switch, Alert } from "react-native";
import styles from "./styles";
import { AntDesign } from "@expo/vector-icons";
import { MaterialIcons } from "@expo/vector-icons";
import { Feather } from "@expo/vector-icons";
import { Fontisto } from "@expo/vector-icons";
import * as database from "../../../database";
import { useDispatch, useSelector } from "react-redux";
import { Entypo } from "@expo/vector-icons";

export default function Contact(props) {
	const allowDelete = useSelector((state) => state.preference.allowDelete);
	const [showModal, setShowModal] = useState(false);

	const handleModalToggle = () => {
		setShowModal(!showModal);
	};

	const handleFavouriteChangePress = () => {
		database
			.update(props.contact.id, { favourite: !props.contact.favourite })
			.then((updated) => {
				if (updated) {
					props.onFavouriteChange(props.contact.id);
				} else {
					Alert.alert(
						"Database Update",
						"There was an error updating the database. Please, try again later."
					);
				}
			});
	};

	const handleRemovePress = () => {
		Alert.alert(
			"Remove Contact",
			"This action will permanently delete this contact. This action cannot be undone!",
			[
				{
					text: "Confirm",
					onPress: () => {
						database.remove(props.contact.id).then((removed) => {
							if (removed) {
								props.onContactRemoval(props.contact.id);
								setShowModal(false);
							} else {
								Alert.alert(
									"Database Update",
									"There was an error removing data from the database. Please, try again later."
								);
							}
						});
					},
				},
				{
					text: "Cancel",
				},
			]
		);
	};

	return (
		<>
			<Pressable onPress={handleModalToggle}>
				<View style={styles.container}>
					<Text style={styles.name}>
						<MaterialIcons
							name="contact-page"
							size={17}
							color="black"
						/>{" "}
						{props.contact.name}
					</Text>
					<Text style={styles.phoneNumber}>
						<Feather name="phone" size={16} color="black" />{" "}
						{props.contact.phoneNumber}
					</Text>
					{props.contact.email && (
						<Text style={styles.email}>
							<Fontisto name="email" size={16} color="black" />{" "}
							{props.contact.email}
						</Text>
					)}
				</View>
			</Pressable>

			<Modal visible={showModal} transparent={true}>
				<View style={styles.modal.container}>
					<View style={styles.modal.box}>
						<Pressable onPress={handleModalToggle}>
							<View style={styles.close.container}>
								<AntDesign
									name="closecircle"
									size={25}
									color="#c00"
								/>
							</View>
						</Pressable>
						<Text style={[styles.modal.details, styles.modal.name]}>
							<MaterialIcons
								name="contact-page"
								size={17}
								color="black"
							/>{" "}
							{props.contact.name}
						</Text>
						<Text style={[styles.modal.details]}>
							<Feather name="phone" size={16} color="black" />{" "}
							Phone: {props.contact.phoneNumber}
						</Text>
						{props.contact.email && (
							<Text style={[styles.modal.details]}>
								<Fontisto
									name="email"
									size={16}
									color="black"
								/>{" "}
								Email: {props.contact.email}
							</Text>
						)}
						{props.contact.birthday && (
							<Text style={[styles.modal.details]}>
								<Fontisto name="date" size={16} color="black" />{" "}
								Birthday: {props.contact.birthday}
							</Text>
						)}
						{props.contact.address && (
							<Text style={[styles.modal.details]}>
								<MaterialIcons
									name="location-on"
									size={16}
									color="black"
								/>{" "}
								Address: {props.contact.address}
							</Text>
						)}
						{props.contact.note && (
							<Text style={[styles.modal.details]}>
								<Entypo name="text" size={16} color="black" />{" "}
								Note: {props.contact.note}
							</Text>
						)}
						{allowDelete && (
							<Pressable onPress={handleRemovePress}>
								<View style={styles.remove.container}>
									<AntDesign
										name="delete"
										size={16}
										color="red"
									/>
									<Text style={styles.remove.label}>
										{" "}
										Remove
									</Text>
								</View>
							</Pressable>
						)}
					</View>
				</View>
			</Modal>
		</>
	);
}
