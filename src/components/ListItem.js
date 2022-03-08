import styles from "./ListItem.module.scss"
import { Link } from "react-router-dom"

export default function ListItem(props) {
    return (
        <Link to={`/game/${props.id}`}>
            <div className={styles.list_item}>
                <h1>{props.id}</h1>
            </div>
        </Link>
    )
}