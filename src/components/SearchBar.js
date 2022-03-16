import styles from "./SearchBar.module.scss";

function CategoryChecklist(props) {
    const categories = props.categories;
	const listCategories = categories.map((category) => 
        <div>
            <input type="checkbox" id={category} name={category} onChange={() => props.modifyFilterCategory(category)}/>
            <label for={category}>{category}</label>
        </div>
	);

    return (
        <div className={styles.categories}>
            {listCategories}
        </div>
    )
}

export default function SearchBar(props) {
    return (
        <div className={styles.search_bar}>
            <div className={styles.search_button}>
                <input />            
                <button>Search</button>
            </div>
            <div className={styles.button_container}>
                <button onClick={() => {props.sortByDate(false)}}>Sort By Latest</button>
                <button onClick={() => {props.sortByDate(true)}}>Sort By Oldest</button>
                <CategoryChecklist categories={props.categories} modifyFilterCategory={props.modifyFilterCategory}/>
                <button onClick={props.filterByCategory}>Filter By Category</button>
            </div>
        </div>
    )
}