import { View, Text, TouchableOpacity } from 'react-native';
import { AntDesign } from '@expo/vector-icons'; 
import styles from './styles';
import { useEffect, useState } from 'react';
import { auth } from '../../../firebaseConfig';

export default function Header() {

  const [userEmail, setUserEmail] = useState('');


  useEffect(() => {
    const currentUser = auth.currentUser;
    if (currentUser) {
      setUserEmail(currentUser.email);
    }

  }, []);

  const handleLogout = async () => {
    try {
      await auth.signOut();
    } catch (error) {
      console.log(error.message);
    }
  };

  return (
    <View style={styles.container}>
      <View style={styles.leftGroup}>
        <AntDesign name="contacts" size={24} color="#5e4932" />
        <Text style={styles.title}>Contacts</Text>
      </View>
      <TouchableOpacity onPress={() => handleLogout()}>
          <Text style={styles.author}>{userEmail} (LogOut)</Text>
        </TouchableOpacity>
    </View>
  );
}