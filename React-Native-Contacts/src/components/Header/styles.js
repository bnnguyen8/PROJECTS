import { StyleSheet } from 'react-native';

const styles = StyleSheet.create({
  container: {
    alignSelf: 'stretch',
    alignItems: 'center',
    justifyContent: 'space-between',
    flexDirection: 'row',
    borderBottomColor: '#5e4932',
    borderBottomWidth: 3,
    paddingBottom: 5,
    paddingTop: 30,
    marginTop: 20,
    paddingHorizontal: 10
  },
  leftGroup: {
    flexDirection: 'row',
    alignItems: 'center'
  },
  title: {
    fontSize: 22,
    color: '#5e4932',
    fontWeight: 'bold',
    alignSelf: 'flex-end',
    marginLeft: 10
  },
  author: {
    fontSize: 12,
    color: "#3b71ca"
  }
});

export default styles;