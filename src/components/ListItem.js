import styles from "./ListItem.module.scss"
import { Link } from "react-router-dom"

export default function ListItem(props) {
    return (
        <Link to={`/game/${props.info.id}`}>
            <div className={styles.list_item}>
                <h1>{props.info.id}</h1>
                <h1>{props.info.date.toLocaleDateString("en-US")}</h1>
                <h1>{props.info.category.map(item => item + ", ")}</h1>
            </div>
        </Link>
    )
}