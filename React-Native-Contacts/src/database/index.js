import { initializeApp } from 'firebase/app';
import { getFirestore, collection, doc, getDocs, addDoc, updateDoc, deleteDoc } from 'firebase/firestore';

// Your web app's Firebase configuration
const firebaseConfig = {
  
  // Include here the Firebase configuration for your project.
  apiKey: "AIzaSyCDkvMqLhC1L6YkNnD50rj5FH-ZPBGxfB4",
  authDomain: "bnnguyen-e6c30.firebaseapp.com",
  projectId: "bnnguyen-e6c30",
  storageBucket: "bnnguyen-e6c30.appspot.com",
  messagingSenderId: "909595081529",
  appId: "1:909595081529:web:f4dbd0e130b33fcbfb86e8",
  measurementId: "G-PSV660F2VK"
};

// Initialize Firebase
const app = initializeApp(firebaseConfig);

// Initialize Cloud Firestore and get a reference to the service
const db = getFirestore(app);

/**
 * Adds a data to the list of contacts.
 * 
 * @param {object} data 
 *   The data to be added.
 * @returns 
 *   If successful, returns the id of the added contacts. 
 *   If error, returns null.
 */
export async function save(data) {
  try {
    const dbCollection = collection(db, 'contacts');
    const docRef = await addDoc(dbCollection, data);
    return docRef.id;
  } catch (e) {
    return null;
  }
}

/**
 * Loads all documents from the contacts collection.
 * 
 * @returns 
 *   Array with the contacts.
 */
export async function load() {
  const data = [];

  const querySnapshot = await getDocs(collection(db, 'contacts'));
  querySnapshot.forEach((doc) => {
    data.push({
      ...doc.data(),
      id: doc.id
    });
  });

  return data;
}

/**
 * Update a contact in the database.
 * 
 * @param {string} id 
 *   The id of the contact to be updated.
 * @param {object} data 
 *   The updated data.
 * @returns 
 *   Whether the data was updated.
 */
export async function update(id, data) {
  try {
    const docRef = doc(db, 'contacts', id);
    await updateDoc(docRef, data);
    return true;
  }
  catch (e) {
    return false;
  }
}

/**
 * Deletes a contact from the string.
 * 
 * @param {string} id 
 *   The id of the contact to be removed.
 * @returns 
 *   Whether the contact was removed.
 */
export async function remove(id) {
  try {
    const docRef = doc(db, 'contacts', id);
    await deleteDoc(docRef);
    return true;
  }
  catch (e) {
    return false;
  }
}