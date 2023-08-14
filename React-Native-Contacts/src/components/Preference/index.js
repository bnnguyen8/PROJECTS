import {
	Text,
	View,
	Switch,
    Pressable,
} from "react-native";
import { useSelector, useDispatch } from "react-redux";
import { toggleAllowDelete } from "../../redux/preferenceSlice"
import styles from './styles'


export default function Preference() {

    const allowDelete = useSelector((state) => state.preference.allowDelete)
    const dispatch = useDispatch()

    const handleAllowDeleteChange = () => {
        console.log("Allow delete changed")
        dispatch(toggleAllowDelete())
    }

    return (
        <View style={styles.container}> 
            <Text style={styles.title}>Preference</Text>
            <View style={styles.optionContainer}> 
                <Switch
                    value={allowDelete}
                    onValueChange={handleAllowDeleteChange}
                    />
                <Pressable onPress={handleAllowDeleteChange}>
                    <Text style={styles.optionText}>Allow delete contacts</Text>
                </Pressable>
            </View>
        </View>
    )
}