import styles from "./Store.module.scss";
import ListItem from "./ListItem";

var items = [0, 1, 2, 3, 4, 5, 6, 7, 8, 9];

function GameList(props) {
	const items = props.items;
	const listItems = items.map((item) => 
		<ListItem id={`0000${item}`} />
	);

	return (
		<div className={styles.game_list}>
			<div className={styles.game_list_container}>
				{listItems}
			</div>
		</div>
	)
}

export default function Store() {
	return (
		<div className={styles.store}>
			<div className={styles.search_bar}>
				<h1>Search Bar</h1>
			</div>
			
			<GameList items={items}/>
		</div>
	);
}