import styles from './Navbar.module.scss';
import { Link } from "react-router-dom";

export default function Navbar() {
    return (
        <nav className={styles.navbar}>
            <div className={styles.nav_container}>
                <Link to="/"><a className={styles.nav_brand}><i>Mist</i></a></Link>
                <div className={styles.navbar_nav}>
                    <Link to="/store"><a className={styles.nav_item}>Store</a></Link>
                    <Link to="forum"><a className={styles.nav_item}>Forum</a></Link>
                </div>
            </div>
            <div className={styles.account}>
                <Link to="/login"><button>Log In</button></Link>
                <Link to="/signup"><button>Sign Up</button></Link>
            </div>
        </nav>
    )
}