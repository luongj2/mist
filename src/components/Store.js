import { useState } from "react";
import styles from "./Store.module.scss";
import ListItem from "./ListItem";
import SearchBar from "./SearchBar";

var ogitems = [
	{
		id: 0,
		date: new Date('01/22/2009'),
		category: ["MOBA"]
	}, 

	{
		id: 1,
		date: new Date('02/29/2008'),
		category: ["RPG", "MOBA"]
	}, 

	{
		id: 2,
		date: new Date('03/07/2011'),
		category: ["MOBA"]
	}, 

	{
		id: 3,
		date: new Date('04/13/2017'),
		category: ["MOBA"]
	},

	{
		id: 4,
		date: new Date('05/02/2018'),
		category: ["RPG", "MOBA"]
	}, 

	{
		id: 5,
		date: new Date('06/25/2016'),
		category: ["RPG"]
	}, 

	{
		id: 6,
		date: new Date('07/12/2010'),
		category: ["RPG"]
	}, 

	{
		id: 7,
		date: new Date('08/22/2012'),
		category: ["RPG"]
	}
]

var categories = ["RPG", "MOBA"];

function GameList(props) {
	const items = props.items;
	const listItems = items.map((item) => 
		<ListItem info={item} />
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
	const [items, setItems] = useState(ogitems);
	const [filterCategories, setFilterCategories] = useState([]);

	function sortByDate(inc) {
		let sortedItems = [...items].sort((a, b) => b.date - a.date);
		if (inc) sortedItems = [...items].sort((a, b) => a.date - b.date);
		setItems(sortedItems);
	}

	function modifyFilterCategory(category) {
		var newFilterCategories = [...filterCategories];
		const index = [...filterCategories].indexOf(category);
		if (index > -1) {
			newFilterCategories.splice(index, 1);
		} else {
			newFilterCategories.push(category);
		}
		console.log(newFilterCategories);
		setFilterCategories(newFilterCategories);
	}


	function filterByCategory() {
		let filteredItems = [...ogitems].filter((item) => (
			filterCategories.every(category => {
				return item.category.includes(category);
			})
		));
		setItems(filteredItems);
	}

	return (
		<div className={styles.store}>
			<SearchBar sortByDate={sortByDate} filterByCategory={filterByCategory} categories={categories} modifyFilterCategory={modifyFilterCategory}/>
			<GameList items={items}/>
		</div>
		
	);
}