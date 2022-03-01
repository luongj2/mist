import Navbar from "./components/Navbar"
import Store from "./components/Store"
import Forum from "./components/Forum"
import Login from "./components/Login"
import Signup from "./components/Signup"
import { Routes, Route } from "react-router-dom";

export default function App() {
    return (
        <div className='App'>
            <Navbar />
            <Routes>
                <Route path="/store" element={<Store />} />
                <Route path="/forum" element={<Forum />} />
                <Route path="/login" element={<Login />} />
                <Route path="/signup" element={<Signup />} />
                <Route path="/" element={<Store />} />
            </Routes>
        </div>

    )
}