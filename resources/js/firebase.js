import { initializeApp } from "firebase/app";
import { getAnalytics } from "firebase/analytics";
// ...import other Firebase products as needed...

const firebaseConfig = {
  apiKey: "AIzaSyBHYRZIXUnjw9FZEhrlAVzDyDITqaW7nQ8",
  authDomain: "web-app-42e6b.firebaseapp.com",
  databaseURL: "https://web-app-42e6b-default-rtdb.firebaseio.com",
  projectId: "web-app-42e6b",
  storageBucket: "web-app-42e6b.firebasestorage.app",
  messagingSenderId: "450698563786",
  appId: "1:450698563786:web:0e16cba93087e3eb15a433",
  measurementId: "G-B52Z1C2VE9"
};

const app = initializeApp(firebaseConfig);
const analytics = getAnalytics(app);

export { app, analytics };
