import styles from './Navbar.module.scss';

export default function Navbar() {
    return (
        <nav className={styles.navbar}>
            <div className={styles.nav_container}>
                <a className={styles.nav_brand}><i>Mist</i></a>
                <div className={styles.navbar_nav}>
                    <a className={styles.nav_item}>Store</a>
                    <a className={styles.nav_item}>Forum</a>
                </div>
            </div>
            <div className={styles.account}>
                <button>Log In</button>
                <button>Sign Up</button>
            </div>
        </nav>
    )
}