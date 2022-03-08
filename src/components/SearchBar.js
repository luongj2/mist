import styles from "./SearchBar.module.scss";

export default function SeachBar() {
    return (
        <div className={styles.search_bar}>
            <div className={styles.search_button}>
                <input />            
                <button>Search</button>
            </div>
            <div className={styles.button_container}>
                <button>Sort By Date</button>
                <button style={{"display": "block"}}>Filter By Category</button>
            </div>
        </div>
    )
}