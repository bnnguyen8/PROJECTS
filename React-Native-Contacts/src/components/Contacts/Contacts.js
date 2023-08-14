import { View, ScrollView, Text } from 'react-native';
import Contact from './Contact/Contact';
import styles from './styles';

export default function Contacts(props) {
  if (props.contacts.length === 0) {
    return (
      <View style={styles.fullCenter}>
        <Text>There are no contacts in the list.</Text>
      </View>
    );
  }
  return (
    <View style={styles.container}>
      <ScrollView>
        {props.contacts.map(
          (contact, index) => (
            <Contact key={index} contact={contact} onFavouriteChange={props.onFavouriteChange} onContactRemoval={props.onContactRemoval} />
          )
        )}
      </ScrollView>
    </View>
  );
}