import styles from './Navbar.module.scss';
import { Link } from "react-router-dom";
import logo from "../media/logo.png"

export default function Navbar() {
    return (
        <nav className={styles.navbar}>
            <div className={styles.nav_container}>
                <Link to="/"><img className={styles.nav_brand} src={logo}/></Link>
                <div className={styles.navbar_nav}>
                    <Link to="/store"><a className={styles.nav_item}>STORE</a></Link>
                    <Link to="/forum"><a className={styles.nav_item}>FORUM</a></Link>
                    <Link to="/about"><a className={styles.nav_item}>ABOUT</a></Link>
                </div>
            </div>
            <div className={styles.account}>
                <Link to="/login"><button>Log In</button></Link>
                <Link to="/signup"><button className={styles.signup}>Sign Up</button></Link>
            </div>
        </nav>
    )
}