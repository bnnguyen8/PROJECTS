import { Platform, StyleSheet } from 'react-native';

const styles = StyleSheet.create({
  container: {
    alignSelf: 'stretch',
    backgroundColor: '#c2a180',
    color: "#ffffff",
    marginLeft: 10,
    marginRight: 10,
    marginTop: 8,
    marginBottom: 0,
    padding: 15,
    borderRadius: 7,
    borderWidth: 1,
    borderColor: '#bcbcbc'
  },
  name: {
    fontSize: 17,
    fontWeight: 'bold',
  },
  phoneNumber: {
    fontSize: 16,
    color: '#333',
  },
  email: {
    fontSize: 16,
    color: '#333',
  },
  text: {
    fontSize: 13,
    color: '#777',
  },
  modal: {
    container: {
      flex: 1,
      alignItems: 'center',
      justifyContent: 'center',
      backgroundColor: 'rgba(0, 0, 0, 0.25)'
    },
    name: {
      justifyContent: 'center',
      color: '#030db9',
      fontWeight: 'bold',
    },
    box: {
      backgroundColor: 'white',
      padding: 30,
      width: '70%',
      borderRadius: 15,
      elevation: 5,
      shadowOpacity: 0.25,
      shadowRadius: 4,
      shadowColor: "#000",
      shadowOffset: {
        width: 0,
        height: 4
      }
    },
    details: {
      fontSize: 16,
      marginBottom: 5,
    }
  },

  close: {
    container: {
      flexDirection: 'row',
      alignItems: 'center',
      position: 'absolute',
      top: -20,
      right: -15
    },
    text: {
      marginLeft: 5
    }
  },

  options: {
    flexDirection: 'row',
    alignItems: 'flex-end',
    justifyContent: 'space-between',
    paddingTop: Platform.OS === 'ios' ? 20 : 10
  },

  switch: {
    container: {
      alignItems: 'center'
    },
    label: {
      paddingTop: Platform.OS === 'ios' ? 10 : 0,
      fontSize: 12
    }
  },

  remove: {
    container: {
      flexDirection: 'row',
      position: 'absolute',
      bottom: -20,
      right: -15
    },
    icon: {
      color: '#c00',
      alignSelf: 'center'
    },
    label: {
      paddingTop: 5,
      fontSize: 12,
      color: '#c00'
    }
  }
});

export default styles;