// App.js
import React, { useEffect, useState } from 'react';
import { View, ActivityIndicator } from 'react-native';
import { NavigationContainer } from '@react-navigation/native';
import { createStackNavigator } from '@react-navigation/stack';
import { auth } from './firebaseConfig';
import Login from './Login';
import Register from './Register';
import Home from './Home';
import { store } from "./src/redux/store";
import { Provider } from "react-redux";

const Stack = createStackNavigator();

export default function App() {
  const [initializing, setInitializing] = useState(true);
  const [user, setUser] = useState(null);

  useEffect(() => {
    const unsubscribe = auth.onAuthStateChanged((user) => {
      setUser(user);
      if (initializing) setInitializing(false);
    });

    return unsubscribe;
  }, [initializing]);

  if (initializing) {
    return (
      <View style={{ flex: 1, justifyContent: 'center', alignItems: 'center' }}>
        <ActivityIndicator size="large" />
      </View>
    );
  }

  return (
    <Provider store={store}>
      <NavigationContainer>
        <Stack.Navigator>
          {user ? (
            <Stack.Screen name="Home" options={{
              headerShown: false
            }} component={Home} />
          ) : (
            <>
              <Stack.Screen name="Login" options={{
              headerShown: false
            }} component={Login} />
              <Stack.Screen name="Register" options={{
              headerShown: false
            }} component={Register} />
            </>
          )}
        </Stack.Navigator>
      </NavigationContainer>
    </Provider>
  );
}
