import { StyleSheet } from 'react-native';

const styles = StyleSheet.create({
  AddSave: {
    marginTop: 10,
  },
  textInput: {
    borderWidth: 1,
    borderColor: '#ccc',
    paddingHorizontal: 10,
    paddingVertical: 5,
    backgroundColor: '#fff',
    marginBottom: 10,
    marginTop: 10
},
textInputDescription: {
    height: 80,
    textAlignVertical: 'top'
},
  container: {
    alignSelf: 'stretch',
    padding: 20
  },
  label: {
    marginTop: 10,
    fontWeight: 'bold',
    color: '#000',
    marginLeft: 3,
    fontSize: 16
  },
  textbox: {
    backgroundColor: '#fff',
    borderWidth: 1,
    borderColor: '#bcbcbc',
    paddingVertical: 7,
    paddingHorizontal: 14,
    borderRadius: 8,
    fontSize: 16
  },
  switch: {
    container: {
      alignItems: 'center',
      flexDirection: 'row',
      marginTop: 5,
      marginBottom: 20
    },
    label: {
      color: '#000',
      fontSize: 16,
      fontWeight: 'bold',
      marginRight: 10
    }
  },
  successMessage: {
    container: {
      backgroundColor: '#fff',
      padding: 10,
      marginBottom: 0,
      borderColor: '#00e22d',
      borderWidth: 1,
      borderLeftWidth: 8
    },
    text: {
      color: '#01971f',
      fontSize: 16
    }
  },
  errorMessage: {
    container: {
      backgroundColor: '#fff',
      padding: 10,
      marginBottom: 0,
      borderColor: '#c00',
      borderWidth: 1,
      borderLeftWidth: 8
    },
    label: {
      color: '#c00',
      fontSize: 14,
      fontWeight: 'bold'
    },
    text: {
      color: '#c00',
      fontSize: 16
    }
  }
});

export default styles;